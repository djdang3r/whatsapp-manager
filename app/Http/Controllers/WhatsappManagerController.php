<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Template;
use App\Models\WhatsappBusinessAccount;
use App\Models\WhatsappPhoneNumber;
use App\Models\WhatsappBusinessProfile;
use App\Models\Website;
use App\Controllers\WhatsappApiCloudController;
use Yajra\DataTables\Facades\DataTables;

class WhatsappManagerController extends Controller
{
    public function newAccount(Request $request){

        $validator = Validator::make($request->all(), [
            'waba_id' => 'required|string|max:255',
            'app_id' => 'required|string|max:255',
            'waba_api_token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if the account already exists
        $existingAccount = WhatsappBusinessAccount::where('whatsapp_business_id', $request->waba_id)->first();

        if ($existingAccount) {
            return response()->json([
            'success' => false,
            'message' => 'Account already exists',
            ], 409);
        }

        $business_account = $this->fetchBusinessAccount($request->waba_api_token, $request->waba_id);

        // Create a new account
        $whatsapp_account = WhatsappBusinessAccount::create([
            'whatsapp_business_id' => $request->waba_id,
            'app_id' => $request->app_id,
            'api_token' => $request->waba_api_token,
            'name' => $business_account['name'],
            'timezone_id' => $business_account['timezone_id'],
            'message_template_namespace' => $business_account['message_template_namespace']
        ]);

        $this->getPhoneNumbers($whatsapp_account->whatsapp_business_id);

        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Account validated successfully',
        ]);
    }

    public function getAccounts(Request $request)
    {
        if ($request->ajax()) {
            $data = WhatsappBusinessAccount::all();
            return DataTables::of($data)
                ->make(true);
        }

        return view('dashboard');
    }

    public function getProfile($id)
    {
        $phoneNumber = WhatsappPhoneNumber::with('businessProfile')->find($id);

        if (!$phoneNumber) {
            return response()->json(['error' => 'Phone number not found'], 404);
        }

        return response()->json($phoneNumber);
    }

    public function showAccount($id)
    {
        // Captura el id y realiza la lógica necesaria
        $whatsapp_business_account = WhatsappBusinessAccount::find($id);

        if (!$whatsapp_business_account) {
            return redirect()->back()->with('error', 'Account not found.');
        }

        return view('whatsapp.index', compact('whatsapp_business_account'));
    }

    public function getPhoneNumbers($whatsapp_business_id)
    {
        $account = WhatsappBusinessAccount::find($whatsapp_business_id);

        if (!$account) {
            Log::error('Account not found', ['whatsapp_business_id' => $whatsapp_business_id]);
            return response()->json(['error' => 'Account not found'], 404);
        }

        $api_token = $account->api_token;

        // Iniciar una transacción
        DB::beginTransaction();

        try {
            // Obtener los números de teléfono
            $phoneNumbers = $this->fetchPhoneNumbers($api_token, $whatsapp_business_id);

            foreach ($phoneNumbers as $phoneNumber) {
                $cleanedPhoneNumber = preg_replace('/\D/', '', $phoneNumber['display_phone_number']);

                // Buscar si el número de teléfono ya existe
                $phoneNumberRecord = WhatsappPhoneNumber::where('phone_number_id', $phoneNumber['id'])->first();

                // Obtener el perfil del número de teléfono
                $profileData = $this->fetchPhoneNumberProfile($api_token, $phoneNumber['id']);
                $profileData = $profileData['data'][0];

                if ($phoneNumberRecord) {
                    // Actualizar el número de teléfono existente
                    $phoneNumberRecord->update([
                        'display_phone_number' => $cleanedPhoneNumber,
                        'verified_name' => $phoneNumber['verified_name'],
                    ]);

                    // Buscar si el perfil ya existe
                    if ($phoneNumberRecord->whatsapp_bussines_profile_id !== null) {
                        $profileRecord = WhatsappBusinessProfile::where('whatsapp_business_profile_id', $phoneNumberRecord->whatsapp_bussines_profile_id)->first();

                        // Actualizar el perfil existente
                        $profileRecord->update([
                            'about' => $profileData['about'] ?? null,
                            'address' => $profileData['address'] ?? null,
                            'description' => $profileData['description'] ?? null,
                            'email' => $profileData['email'] ?? null,
                            'profile_picture_url' => $profileData['profile_picture_url'] ?? null,
                            'vertical' => $profileData['vertical'] ?? null,
                            'messaging_product' => $profileData['messaging_product'] ?? 'whatsapp',
                        ]);
                    } else {
                        // Crear un nuevo perfil
                        $profileRecord = WhatsappBusinessProfile::create([
                            'whatsapp_business_profile_id' => $phoneNumber['id'],
                            'about' => $profileData['about'] ?? null,
                            'address' => $profileData['address'] ?? null,
                            'description' => $profileData['description'] ?? null,
                            'email' => $profileData['email'] ?? null,
                            'profile_picture_url' => $profileData['profile_picture_url'] ?? null,
                            'vertical' => $profileData['vertical'] ?? null,
                            'messaging_product' => $profileData['messaging_product'] ?? 'whatsapp',
                        ]);

                        $phoneNumberRecord->update([
                            'whatsapp_business_profile_id' => $profileRecord->whatsapp_business_profile_id,
                        ]);
                    }
                } else {
                    // Crear un nuevo número de teléfono
                    $phoneNumberRecord = WhatsappPhoneNumber::create([
                        'phone_number_id' => $phoneNumber['id'],
                        'whatsapp_business_accounts_id' => $whatsapp_business_id,
                        'display_phone_number' => $cleanedPhoneNumber,
                        'verified_name' => $phoneNumber['verified_name'],
                    ]);

                    // Crear un nuevo perfil
                    $profileRecord = WhatsappBusinessProfile::create([
                        'whatsapp_business_profile_id' => $phoneNumber['id'],
                        'about' => $profileData['about'] ?? null,
                        'address' => $profileData['address'] ?? null,
                        'description' => $profileData['description'] ?? null,
                        'email' => $profileData['email'] ?? null,
                        'profile_picture_url' => $profileData['profile_picture_url'] ?? null,
                        'vertical' => $profileData['vertical'] ?? null,
                        'messaging_product' => $profileData['messaging_product'] ?? 'whatsapp',
                    ]);

                    $phoneNumberRecord->update([
                        'whatsapp_business_profile_id' => $profileRecord->whatsapp_business_profile_id,
                    ]);
                }

                // Guardar los sitios web
                if (isset($profileData['websites'])) {
                    // Eliminar sitios web existentes
                    Website::where('whatsapp_business_profile_id', $profileRecord->whatsapp_business_profile_id)->delete();

                    // Guardar nuevos sitios web
                    foreach ($profileData['websites'] as $website) {
                        // Verificar si el sitio web ya existe
                        $existingWebsite = Website::Where('whatsapp_business_profile_id', $profileRecord->whatsapp_business_profile_id)
                                                  ->where('website', $website)
                                                  ->first();

                        if (!$existingWebsite) {
                            Website::create([
                                'whatsapp_business_profile_id' => $profileRecord->whatsapp_business_profile_id,
                                'website' => $website,
                            ]);
                        }
                    }
                }
            }

            // Confirmar la transacción
            DB::commit();

            // Devolver la respuesta
            return response()->json($phoneNumbers);

        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            Log::error('Failed to fetch phone numbers or profiles', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to fetch phone numbers or profiles', 'message' => $e->getMessage()], 500);
        }
    }

    public function getTemplates($phone_number_id)
    {
        $whatsapp_phone_number = WhatsappPhoneNumber::find($phone_number_id);

        $account = $whatsapp_phone_number->businessAccount;

        if (!$account) {
            return response()->json(['error' => 'Account not found'], 404);
        }

        $api_token = $account->api_token;

        // Iniciar una transacción
        DB::beginTransaction();

        try {
            // Obtener los números de teléfono
            $templates = $this->fetchTemplates($api_token, $account->whatsapp_business_id);

            // Confirmar la transacción
            DB::commit();

            // Devolver la respuesta
            return response()->json($templates);

        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            return response()->json(['error' => 'Failed to fetch templates', 'message' => $e->getMessage()], 500);
        }
    }

    public function getConversations($phone_number_id)
    {
        $whatsapp_phone_number = WhatsappPhoneNumber::find($phone_number_id);

        $whatsapp_profile = $whatsapp_phone_number->businessProfile;

        $account = $whatsapp_phone_number->businessAccount;

        if (!$account) {
            return response()->json(['error' => 'Account not found'], 404);
        }


        $conversations = $whatsapp_profile->phoneNumber->messages->where('message_method', 'INPUT')->groupBy('message_from');



        $contacts = $conversations->map(function ($messages) {
            return $messages->first()->contact;
        });

        return response()->json($contacts);
    }

    public function getChatHistory($contactId, $phone_number_id)
    {
        $whatsapp_phone_number = WhatsappPhoneNumber::find($phone_number_id);

        if (!$whatsapp_phone_number) {
            return response()->json(['error' => 'Phone number not found'], 404);
        }

        $contact = Contact::find($contactId);

        $messages = Message::where('contact_id', $contact->contact_id)
                    ->where('whatsapp_phone_id', $whatsapp_phone_number->whatsapp_phone_id)
                    ->orderBy('created_at')
                    ->with('mediaFiles') // Asumiendo que la relación se llama 'mediaFiles'
                    ->get();

        return response()->json([
            'contact' => $contact,
            'messages' => $messages
        ]);
    }

    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'whatsapp_phone_id' => 'required|string',
            'contact_id' => 'required|string',
            'message_content' => 'nullable|string',
            'tipo' => 'required|string', // 'INPUT' o 'OUTPUT'
            'type' => 'required|string', // 'TEXT', 'IMAGE', etc.
            'media_url' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {
            // Verificar si el contacto existe en la tabla whatsapp_contacts
            $whatsapp_phone_number = WhatsappPhoneNumber::find($request->whatsapp_phone_id);

            $contact = Contact::where('contact_id', $request->contact_id)->first();

            // Enviar el mensaje a la API de WhatsApp
            $apiUrl = env('WHATSAPP_API_URL') . env('WHATSAPP_API_VERSION') . '/' . $whatsapp_phone_number->phone_number_id . '/messages';
            $apiToken = $whatsapp_phone_number->businessAccount->api_token;

            $payload = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $contact->wa_id,
                'type' => $request->type,
                'text' => [
                    'preview_url' => false,
                    'body' => $request->message_content
                ]
            ];

            $response = Http::withToken($apiToken)->post($apiUrl, $payload);

            // Agregar registro de depuración para la respuesta
            Log::debug('WhatsApp API Response Send', ['response' => $response->json()]);

            if ($response->successful()) {
                // Almacenar el mensaje en la base de datos si la solicitud a la API fue exitosa
                $message = new Message();
                $message->whatsapp_phone_id = $whatsapp_phone_number->whatsapp_phone_id;
                $message->contact_id = $contact->contact_id;
                $message->messaging_product = 'whatsapp';
                $message->message_type = $request->type;
                $message->message_method = $request->tipo;
                $message->message_from = $whatsapp_phone_number->display_phone_number;
                $message->message_to = $contact->wa_id;
                $message->wa_id = $response->json('messages')[0]['id'];
                $message->message_content = $request->message_content;
                $message->json_content = json_encode($payload); // Almacenar el JSON enviado a la API
                $message->json = $response->body(); // Almacenar la respuesta de la API
                $message->save();

                DB::commit();

                return response()->json(["success" => true]);
            } else {
                DB::rollBack();
                Log::error('Error al enviar el mensaje a la API de WhatsApp', ['response' => $response->body()]);
                return response()->json(["error" => "Error al enviar el mensaje a la API de WhatsApp", "response" => $response->body()]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al procesar la solicitud', ['message' => $e->getMessage()]);
            return response()->json(["error" => "Error al procesar la solicitud", "message" => $e->getMessage()]);
        }
    }

    private function fetchBusinessAccount($api_token, $whatsapp_business_id)
    {
        $api_url = rtrim(env('WHATSAPP_API_URL'), '/');
        $api_version = env('WHATSAPP_API_VERSION');
        $url = "{$api_url}/{$api_version}/{$whatsapp_business_id}";
        // Log::info("Fetching phone numbers from URL: " . $url);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $api_token,
        ])->get($url);

        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception("Failed to fetch whatsapp business account: " . $response->body());
        }
    }

    private function fetchPhoneNumbers($api_token, $whatsapp_business_id)
    {
        $api_url = rtrim(env('WHATSAPP_API_URL'), '/');
        $api_version = env('WHATSAPP_API_VERSION');
        $url = "{$api_url}/{$api_version}/{$whatsapp_business_id}/phone_numbers";
        // Log::info("Fetching phone numbers from URL: " . $url);

        $response = Http::withToken($api_token)->get($url);

        // dd($response->json()['data']);
        if ($response->successful()) {
            return $response->json()['data'];
        } else {
            throw new \Exception("Failed to fetch phone numbers: " . $response->body());
        }
    }

    private function fetchPhoneNumberProfile($api_token, $phone_number_id)
    {
        $api_url = rtrim(env('WHATSAPP_API_URL'), '/');
        $api_version = env('WHATSAPP_API_VERSION');

        $url = "{$api_url}/{$api_version}/{$phone_number_id}/whatsapp_business_profile?fields=about,address,description,email,profile_picture_url,websites,vertical";
        // Log::info("Fetching phone numbers from URL: " . $url);

        $response = Http::withToken($api_token)->get($url);
        // dd($response->json()['data']);
        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception("Failed to fetch phone number profile: " . $response->body());
        }
    }

    public function fetchTemplate($id, $wa_account)
    {
        // Construir la URL de la API
        $apiUrl = env('WHATSAPP_API_URL') . env('WHATSAPP_API_VERSION') . '/' . $id;
        $apiToken = $wa_account->api_token;

        // Realizar la solicitud a la API de WhatsApp
        $response = Http::withToken($apiToken)->get($apiUrl);
        // Log::debug('Fetch Template: ', ['response' => $response->json()]);

        if ($response->successful()) {
            return response()->json($response->json(), 200);
        } else {
            return response()->json(['error' => $response->json()], $response->status());
        }
    }

    private function fetchTemplates($api_token, $whatsapp_business_id)
    {
        $api_url = rtrim(env('WHATSAPP_API_URL'), '/');
        $api_version = env('WHATSAPP_API_VERSION');
        $url = "{$api_url}/{$api_version}/{$whatsapp_business_id}/message_templates";

        // Log::info("Fetching templates from URL: " . $url);

        $response = Http::withToken($api_token)->get($url);

        if ($response->status() == 200) {
            $templates = $response->json()['data'];

            foreach ($templates as $templateData) {
                Template::updateOrCreate(
                    ['wa_template_id' => $templateData['id']],
                    [
                        'whatsapp_business_id' => $whatsapp_business_id,
                        'name' => $templateData['name'],
                        'language' => $templateData['language'],
                        'category' => $templateData['category'],
                        'status' => $templateData['status'],
                        'json' => json_encode($templateData),
                    ]
                );
            }

            $templates = Template::where('whatsapp_business_id', $whatsapp_business_id)->get();

            return $templates;
        } else {
            // return response()->json(['error' => 'Failed to fetch templates', 'message' => $e->getMessage()], 500);
            return response()->json(['error' => 'Failed to fetch templates', 'message' => $response->body()], 500);
        }
    }

    public function getTemplateDetail(Request $request)
    {
        $template = Template::find($request->template_id);
        // Llama a la función renderWhatsAppTemplate
        $templateDetail = $this->renderWhatsAppTemplate($template->json, $template->template_id, $template->wa_template_id);

        return $templateDetail;
    }

    public static function renderWhatsAppTemplate($json, $template_id, $wa_template_id)
    {
        $template = json_decode($json, true);
        $html = '<div class="wb-template col-md-8 col-sm-8 col-12">
                    <div class="plantilla-card plantilla-card-header bg-success">
                        <div class="">
                            <div class="factura-title d-flex justify-content-between align-items-center">
                                <a>' . htmlspecialchars($template['name']) . '</a>
                            </div>
                        </div>
                    </div>
                    <div class="plantilla-card plantilla-card-content">
                        <div class="">
                            <div class="">';

        foreach ($template['components'] as $component) {
            switch ($component['type']) {
                case 'HEADER':
                    if (isset($component['format'])) {
                        switch ($component['format']) {
                            case 'IMAGE':
                                if (isset($component['example']['header_handle'][0])) {
                                    $headerImage = $component['example']['header_handle'][0];
                                    $defaultImage = asset('assets/images/woman-blowing-kiss-whatsapp-messenger-icon.jpg'); // Ruta a la imagen por defecto
                                    $html .= '<div class="plantilla-header">
                                                <img src="' . htmlspecialchars($headerImage) . '"
                                                     alt="Header Image"
                                                     style="max-width: 100%; height: auto;"
                                                     onerror="this.onerror=null;this.src=\'' . htmlspecialchars($defaultImage) . '\';">
                                              </div>';
                                }
                                break;
                            case 'VIDEO':
                                if (isset($component['example']['header_handle'][0])) {
                                    $headerVideo = $component['example']['header_handle'][0];
                                    $html .= '<div class="plantilla-header"><video controls style="max-width: 100%; height: auto;"><source src="' . htmlspecialchars($headerVideo) . '" type="video/mp4">Your browser does not support the video tag.</video></div>';
                                }
                                break;
                            case 'AUDIO':
                                if (isset($component['example']['header_handle'][0])) {
                                    $headerAudio = $component['example']['header_handle'][0];
                                    $html .= '<div class="plantilla-header"><audio controls style="max-width: 100%; height: auto;"><source src="' . htmlspecialchars($headerAudio) . '" type="audio/mpeg">Your browser does not support the audio element.</audio></div>';
                                }
                                break;
                            default:
                                $headerText = isset($component['text']) ? (isset($component['example']['header_text']) ? self::replaceParameters($component['text'], $component['example']['header_text']) : $component['text']) : '';
                                $html .= '<div class="plantilla-header"><span>' . $headerText . '</span></div>';
                                break;
                        }
                    }
                    break;

                case 'BODY':
                    $bodyText = isset($component['text']) ? (isset($component['example']['body_text'][0]) ? self::replaceParameters($component['text'], $component['example']['body_text'][0]) : $component['text']) : '';
                    $html .= '<div class="plantilla-body"><span>' . nl2br($bodyText) . '</span></div>';
                    break;

                case 'FOOTER':
                    $footerText = isset($component['text']) ? htmlspecialchars($component['text']) : '';
                    $html .= '<div class="plantilla-footer"><span>' . $footerText . '</span></div>';
                    break;
            }
        }

        // Hora como pie de página alineada a la derecha
        $html .= '<div class="plantilla-time"><time aria-hidden="true" class="">4:33 pm</time></div>';

        // Añadir los botones al final
        foreach ($template['components'] as $component) {
            if ($component['type'] === 'BUTTONS') {
                foreach ($component['buttons'] as $button) {
                    $buttonUrl = isset($button['url']) ? (isset($button['example'][0]) ? str_replace('{{1}}', $button['example'][0], $button['url']) : $button['url']) : '#';
                    $buttonText = isset($button['text']) ? htmlspecialchars($button['text']) : '';
                    $html .= '<div class="plantilla-button"><div class=""><a href="#" class="">' . $buttonText . '</a></div></div>';
                }
            }
        }

        $html .= '</div></div></div></div>';
        return $html;
    }

    public static function replaceParameters($text, $parameters)
    {
        foreach ($parameters as $index => $param) {
            $placeholder = '{{' . ($index + 1) . '}}';
            $text = str_replace($placeholder, htmlspecialchars($param), $text);
        }
        return $text;
    }

    public function getTemplateJson(Request $request)
    {
        $template = Template::find($request->id);
        return json_decode($template->json);
    }

    // public function createTemplate(Request $request)
    // {
    //     // $wa_account = WhatsappBusinessAccount::find($request->wa_id);
    //     $wa_account = WhatsappBusinessAccount::find('462194216974157');

    //     // Enviar el mensaje a la API de WhatsApp
    //     $apiUrl = env('WHATSAPP_API_URL') . env('WHATSAPP_API_VERSION') . '/' . $wa_account->whatsapp_business_id . '/message_templates';
    //     $apiToken = $wa_account->api_token;

    //     $jsonBody = json_decode($request->input('body'), true);

    //     if ($request->hasFile('header_file')) {
    //         $file = $request->file('header_file');
    //         $fileName = $file->getClientOriginalName();
    //         $fileSize = $file->getSize();
    //         $fileType = $file->getMimeType();
    //         $filePath = $file->getPathname();

    //         $path = $file->store('public/uploads');
    //         $multimedia_url = asset(Storage::url($path)); // Obtener la URL completa pública del archivo

    //         LOG::info('Multimedia URL: ' . $multimedia_url);

    //         // Paso 1: Iniciar una sesión de subida
    //         $appId = $wa_account->app_id;
    //         $accessToken = $apiToken;
    //         $initUploadUrl = "https://graph.facebook.com/v22.0/{$appId}/uploads?file_name=465001370_901034971594679_739546611693949742_n.jpg&file_length=87605&file_type=image/jpeg&access_token=EAAPbbWqWJo8BO3IsgkLgUx4CjGNExVDCWW03bYhr8RqldQrUKuQWkrCZBZAYMddEIGqFOAGM806os8GGf6ippT8savgjALvXRm0ZAkf12MQ11BIdxSJTvljYD91JlAGksxEbSlpgojXvy89Vf3muMcZBoVmyk3FdLCaWT3uyXkedZAj7ppgE3qheaYzLUWzgBXAZDZD";

    //         Log::info('Init Upload URL: ' . $initUploadUrl);

    //         $initResponse = Http::post($initUploadUrl, []);

    //         if (!$initResponse->successful()) {
    //             Log::error('Error al iniciar la sesión de subida', ['response' => $initResponse->json()]);
    //             return response()->json(['error' => 'Error al iniciar la sesión de subida'], 500);
    //         }

    //         LOG::info('response: ', [''=> $initResponse->json()]);

    //         $uploadSessionId = $initResponse->json('id');

    //         // Paso 2: Comenzar la subida
    //         $uploadUrl = "https://graph.facebook.com/v22.0/{$uploadSessionId}";

    //         LOG::info("Second pass: ". $uploadUrl);

    //         $uploadResponse = Http::withHeaders([
    //             'Authorization' => "OAuth {$accessToken}",
    //             'Content-Type' => $fileType,
    //             'file_offset' => 0,
    //         ])->attach('file', file_get_contents($filePath), $fileName)
    //         ->post($uploadUrl);

    //         if (!$uploadResponse->successful()) {
    //             Log::error('Error al subir el archivo', ['response' => $uploadResponse->json()]);
    //             return response()->json(['error' => 'Error al subir el archivo'], 500);
    //         }

    //         $uploadedFileHandle = $uploadResponse->json('h');

    //         LOG::info('Uploaded File Handle: ', ['handle' => $uploadedFileHandle]);

    //         // Encuentra el componente HEADER y actualiza el campo de archivo
    //         foreach ($jsonBody['components'] as &$component) {
    //             if ($component['type'] === 'HEADER' && isset($component['format']) && in_array($component['format'], ['IMAGE', 'VIDEO', 'DOCUMENT'])) {
    //                 $component['example'] = [
    //                     'header_handle' => [$uploadedFileHandle]
    //                 ];
    //                 break;
    //             }
    //         }
    //     }

    //     $payload = $jsonBody;

    //     Log::info('Create Template: ', ['payload' => $payload]);

    //     $response = Http::withToken($apiToken)->post($apiUrl, $payload);

    //     if ($response->successful()) {
    //         $templateId = $response->json('id');

    //         // Obtener la plantilla creada
    //         $templateUrl = env('WHATSAPP_API_URL') . env('WHATSAPP_API_VERSION') . '/' . $templateId;
    //         $templateResponse = Http::withToken($apiToken)->get($templateUrl);

    //         if ($templateResponse->successful()) {
    //             $templateData = $templateResponse->json();



    //             // Guardar la plantilla en la base de datos
    //             $template_tmp = Template::updateOrCreate(
    //                 ['wa_template_id' => $templateData['id']],
    //                 [
    //                     'whatsapp_business_id' => $wa_account->whatsapp_business_id,
    //                     'name' => $templateData['name'],
    //                     'language' => $templateData['language'],
    //                     'category' => $templateData['category'],
    //                     'status' => $templateData['status'],
    //                     'file' => $multimedia_url ?? null,
    //                     'json' => json_encode($templateData),
    //                 ]
    //             );

    //             LOG::info('Template created: ', ['template' => $template_tmp]);

    //             return response()->json(['message' => 'Plantilla creada y guardada con éxito.', 'template' => $templateData], 200);
    //         } else {
    //             Log::error('Error al obtener la plantilla', ['response' => $templateResponse->json()]);
    //             return response()->json(['error' => 'Error al obtener la plantilla'], 500);
    //         }
    //     } else {
    //         $error = $response->json('error');
    //         return response()->json([
    //             'message' => $error['message'] ?? 'Error desconocido',
    //             'type' => $error['type'] ?? 'Error',
    //             'code' => $error['code'] ?? 500,
    //             'error_subcode' => $error['error_subcode'] ?? null,
    //             'is_transient' => $error['is_transient'] ?? false,
    //             'error_user_title' => $error['error_user_title'] ?? null,
    //             'error_user_msg' => $error['error_user_msg'] ?? 'Hubo un error al crear la plantilla. Por favor, intenta de nuevo.',
    //             'fbtrace_id' => $error['fbtrace_id'] ?? null
    //         ], $response->status());
    //     }
    // }

    public function updateTemplate(Request $request)
    {
        $template = Template::where('wa_template_id', $request->templateId)->first();
        $wa_account = WhatsappBusinessAccount::find($template->whatsapp_business_id);

        // Enviar el mensaje a la API de WhatsApp
        $apiUrl = env('WHATSAPP_API_URL') . env('WHATSAPP_API_VERSION') . '/' . $request->templateId;
        $apiToken = $wa_account->api_token;

        $payload = $request->jsonBody;

        Log::info('Edit Template: ', ['payload' => $payload]);

        $response = Http::withToken($apiToken)->post($apiUrl, $payload);

        if ($response->successful()) {
            return response()->json(['message' => 'Solicitud de Actualizacion de plantilla enviada con éxito.'], 200);
        } else {
            return response()->json(['error' => $response->json()], $response->status());
        }
    }

    public function sendTemplate(Request $request)
    {
        $templateId = $request->input('send_template_id');
        $countryCode = ltrim($request->input('countryCode'), '+');
        $phoneNumber = $request->input('phoneNumber');
        $recipient = $countryCode . $phoneNumber;

        // Obtener los parámetros del formulario
        $params = array_filter($request->all(), function($key) {
            return strpos($key, 'param_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        if ($templateId && $recipient) {
            // Obtener la plantilla desde la base de datos
            $template = Template::where('template_id', $templateId)->first();
            $wa_account = WhatsappBusinessAccount::find($template->whatsapp_business_id)->phoneNumbers->first();

            if ($template) {
                $templateJson = json_decode($template->json, true);

                // Construir el cuerpo de la solicitud
                $components = [];

                // Procesar HEADER primero
                foreach ($templateJson['components'] as $component) {
                    if ($component['type'] === 'HEADER') {
                        $componentData = ['type' => 'header'];
                        if (isset($component['format'])) {
                            switch ($component['format']) {
                                case 'IMAGE':
                                    if (isset($component['example']['header_handle'][0])) {
                                        $headerImage = $component['example']['header_handle'][0];
                                        if ($template->file) {
                                            $componentData['parameters'][] = [
                                                'type' => 'image',
                                                'image' => ['link' => $template->file]
                                            ];
                                        } else {
                                            $componentData['parameters'][] = [
                                                'type' => 'image',
                                                'image' => ['link' => $headerImage]
                                            ];
                                        }
                                    }
                                    break;
                                case 'VIDEO':
                                    if (isset($component['example']['header_handle'][0])) {
                                        $headerVideo = $component['example']['header_handle'][0];
                                        $componentData['parameters'][] = [
                                            'type' => 'video',
                                            'video' => ['link' => $headerVideo]
                                        ];
                                    }
                                    break;
                                case 'AUDIO':
                                    if (isset($component['example']['header_handle'][0])) {
                                        $headerAudio = $component['example']['header_handle'][0];
                                        $componentData['parameters'][] = [
                                            'type' => 'audio',
                                            'audio' => ['link' => $headerAudio]
                                        ];
                                    }
                                    break;
                                default:
                                    if (isset($component['text']) && strpos($component['text'], '{{') !== false) {
                                        $headerText = $component['text'];
                                        preg_match('/{{(\d+)}}/', $headerText, $match);
                                        if (isset($match[1])) {
                                            $paramKey = 'param_HEADER_' . ($match[1] - 1);
                                            if (isset($params[$paramKey])) {
                                                $headerText = $params[$paramKey];
                                                $componentData['parameters'][] = [
                                                    'type' => 'text',
                                                    'text' => $headerText
                                                ];
                                            }
                                        }
                                    }
                                    break;
                            }
                        }
                        $components[] = $componentData;
                    }
                }

                // Procesar BODY y BUTTONS después
                foreach ($templateJson['components'] as $component) {
                    if ($component['type'] === 'FOOTER' || $component['type'] === 'HEADER') {
                        continue; // Omitir el componente FOOTER y HEADER ya procesado
                    }

                    $componentData = ['type' => strtolower($component['type'])];

                    if (isset($component['text']) && strpos($component['text'], '{{') !== false) {
                        $componentData['parameters'] = [];
                        preg_match_all('/{{(\d+)}}/', $component['text'], $matches);
                        foreach ($matches[1] as $index) {
                            $paramKey = 'param_' . strtoupper($component['type']) . '_' . ($index - 1);
                            if (isset($params[$paramKey])) {
                                $componentData['parameters'][] = [
                                    'type' => 'text',
                                    'text' => $params[$paramKey]
                                ];
                            }
                        }
                    }

                    if ($component['type'] === 'BUTTONS') {
                        foreach ($component['buttons'] as $index => $button) {
                            $buttonComponent = [
                                'type' => 'button',
                                'sub_type' => $button['type'] === 'URL' ? 'url' : 'quick_reply',
                                'index' => (string)$index,
                                'parameters' => []
                            ];
                            if ($button['type'] === 'URL') {
                                $url = $button['url'];
                                preg_match('/{{(\d+)}}/', $url, $match);
                                if (isset($match[1])) {
                                    $paramKey = 'param_BUTTON_0_' . ($match[1] - 1);
                                    if (isset($params[$paramKey])) {
                                        // $url = str_replace($match[0], $params[$paramKey], $url);
                                        $url = $params[$paramKey];
                                        $buttonComponent['parameters'][] = [
                                            'type' => 'payload',
                                            'payload' => $url
                                        ];
                                    }
                                }
                            }
                            if (!empty($buttonComponent['parameters'])) {
                                $components[] = $buttonComponent;
                            }
                        }
                    } else {
                        if (!empty($componentData['parameters'])) {
                            $components[] = $componentData;
                        }
                    }
                }

                // Construir el payload para la API de WhatsApp
                $payload = [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    'to' => $recipient,
                    'type' => 'template',
                    'template' => [
                        'name' => $templateJson['name'],
                        'language' => [
                            'code' => $templateJson['language']
                        ],
                        'components' => $components
                    ]
                ];

                // Enviar el mensaje a la API de WhatsApp
                $apiUrl = env('WHATSAPP_API_URL') . env('WHATSAPP_API_VERSION') . '/' . $wa_account->phone_number_id . '/messages';
                $apiToken = $wa_account->businessAccount->api_token;

                // Log::debug('WhatsApp API Petition', ['url' => $apiUrl, 'payload' => $payload, 'api_token' => $apiToken]);

                Log::info('Send Template: ', ['payload' => $payload]);

                $response = Http::withToken($apiToken)->post($apiUrl, $payload);

                // Log::debug('WhatsApp API Response', ['response' => $response->json()]);

                if ($response->successful()) {
                    // Almacenar el contacto si no existe
                    $contact = Contact::firstOrCreate(
                        ['wa_id' => $recipient],
                        ['country_code' => $countryCode, 'phone_number' => $phoneNumber]
                    );

                    // Formatear el payload en HTML
                    $messageContent = $this->formatPayloadToHtml($payload);

                    // Almacenar el mensaje en la base de datos
                    $message = new Message();
                    $message->whatsapp_phone_id = $wa_account->whatsapp_phone_id;
                    $message->contact_id = $contact->contact_id;
                    $message->messaging_product = 'whatsapp';
                    $message->message_type = 'TEMPLATE';
                    $message->message_method = 'OUTPUT';
                    $message->message_from = $wa_account->display_phone_number;
                    $message->message_to = $recipient;
                    $message->wa_id = $response->json('messages')[0]['id'];
                    $message->message_content = $messageContent; // Almacenar el HTML formateado
                    $message->json_content = json_encode($payload); // Almacenar el JSON enviado a la API
                    $message->json = $response->body(); // Almacenar la respuesta de la API
                    $message->save();

                    return response()->json(['message' => 'Mensaje enviado con éxito.'], 200);
                } else {
                    return response()->json(['error' => $response->json()], $response->status());
                }
            }
        }

        return response()->json(['error' => 'Datos incompletos.'], 400);
    }

    private function formatPayloadToHtml($payload)
    {
        $html = '<div class="whatsapp-message">';
        $html .= '<p><strong>To:</strong> ' . htmlspecialchars($payload['to']) . '</p>';
        $html .= '<p><strong>Template:</strong> ' . htmlspecialchars($payload['template']['name']) . '</p>';
        $html .= '<p><strong>Language:</strong> ' . htmlspecialchars($payload['template']['language']['code']) . '</p>';

        foreach ($payload['template']['components'] as $component) {
            $html .= '<div class="component">';
            $html .= '<p><strong>Type:</strong> ' . htmlspecialchars($component['type']) . '</p>';
            if (isset($component['parameters'])) {
                foreach ($component['parameters'] as $parameter) {
                    $html .= '<p><strong>Parameter:</strong> ' . htmlspecialchars($parameter['type']) . ' - ' . htmlspecialchars($parameter['text'] ?? $parameter['payload'] ?? '') . '</p>';
                }
            }
            if (isset($component['buttons'])) {
                foreach ($component['buttons'] as $button) {
                    $html .= '<p><strong>Button:</strong> ' . htmlspecialchars($button['sub_type']) . ' - ' . htmlspecialchars($button['parameters'][0]['payload'] ?? '') . '</p>';
                }
            }
            $html .= '</div>';
        }

        $html .= '</div>';
        return $html;
    }


    public function createTemplate(Request $request)
    {
        $formData = $request->all();
        Log::info('Form Data:', $formData);

        $file = $request->file('file');
        $type = $request->input('type');
        $wa_account_id = $request->input('wa_account_id');
        $jsonBody = json_decode($request->input('jsonBody'), true);
        $whatsapp_account_id = $request->input('whatsapp_account_id');

        // Log::info('File:', ['file' => $file]);
        // Log::info('Type:', ['type' => $type]);
        // Log::info('WA Account ID:', ['wa_account_id' => $wa_account_id]);
        // Log::info('JSON Body:', ['jsonBody' => $jsonBody]);
        // Log::info('WhatsApp Account ID:', ['whatsapp_account_id' => $whatsapp_account_id]);


        // 1. Validar entrada básica
        // $request->validate([
        //     'whatsapp_account_id' => ['required'],
        //     'jsonBody' => 'required|array',
        //     'jsonBody.name' => 'required|string|max:512',
        //     'jsonBody.language' => 'required|string',
        //     'jsonBody.category' => 'required|in:MARKETING,UTILITY,AUTHENTICATION',
        //     'jsonBody.components' => 'required|array',
        //     'jsonBody.components.*.type' => 'required|string',
        //     'jsonBody.components.*.text' => 'required_if:category,UTILITY,MARKETING|string',
        //     'file' => 'sometimes|file|mimes:jpeg,png,jpg,gif,svg,mp4,mp3,pdf,doc,docx|max:20480' // Validar el archivo
        // ]);

        // Obtener todos los datos del request
        $templateData = json_decode($request->input('jsonBody'), true);

        $whatsapp_account_id = $request->input('whatsapp_account_id');

        // Validación específica para autenticación
        if ($templateData['category'] === 'AUTHENTICATION') {
            // $request->validate([
            //     'jsonBody.components.0.type' => 'required|in:BODY',
            //     'jsonBody.components.0.add_security_recommendation' => 'sometimes|boolean',

            //     'jsonBody.components.1.type' => 'required|in:FOOTER',
            //     'jsonBody.components.1.code_expiration_minutes' => 'nullable|integer|min:1|max:90',

            //     'jsonBody.components.2.type' => 'required|in:BUTTONS',
            //     'jsonBody.components.2.buttons.0.type' => 'required|in:OTP',
            //     'jsonBody.components.2.buttons.0.otp_type' => 'required|in:ONE_TAP,COPY_CODE,ZERO_TAP'
            // ]);
        }

        Log::debug('Template data:', $templateData);

        // Verificar la estructura de $templateData
        if (!isset($templateData['name']) || !isset($templateData['language']) || !isset($templateData['category']) || !isset($templateData['components'])) {
            throw new \Exception('Invalid template data structure');
        }

        $wa_account = WhatsappBusinessAccount::find($whatsapp_account_id); // Cambiar por input dinámico

        // 3. Validar estructura de componentes
        // $this->validateComponents($templateData['components']);

        // 4. Procesar componentes
        $processedComponents = $this->processComponents($templateData['components']);

        // 5. Construir payload final
        $payload = [
            'name' => $templateData['name'],
            'language' => $templateData['language'],
            'category' => $templateData['category'],
            'components' => $processedComponents
        ];

        Log::debug('Payload enviado a WhatsApp:', $payload);

        // 6. Enviar a WhatsApp API
        $response = Http::withToken($wa_account->api_token)
            ->post($this->buildApiUrl($wa_account), $payload);

        Log::debug('API WhatsApp Response:', $response->json());



        if (!$response->successful()) {
            return $this->handleWhatsAppError($response);
        }

        // Capturar el ID de la respuesta
        $templateId = $response->json('id');

        // Llamar a fetchTemplate con el ID y wa_account
        $templateResponse = $this->fetchTemplate($templateId, $wa_account);
        $templateDetails = $templateResponse->getData(true);

        Log::debug('Template Detail: ', ['response' => $templateDetails]);

        $fileUrl = null;

        // Capturar y almacenar el archivo si existe y el primer componente es de tipo IMAGE, AUDIO, VIDEO o DOCUMENT
        if (isset($templateDetails['components'][0]['format'])) {
            // Capturar y almacenar el archivo si existe y el primer componente es de tipo IMAGE, AUDIO, VIDEO o DOCUMENT
            if ($request->hasFile('file') && in_array($templateDetails['components'][0]['format'], ['IMAGE', 'VIDEO', 'AUDIO', 'DOCUMENT'])) {
                try {
                    $file = $request->file('file');
                    // Log::debug('File details: ', ['original_name' => $file->getClientOriginalName(), 'size' => $file->getSize()]);

                    $filePath = $file->store('uploads', 'public'); // Almacenar el archivo en el disco 'public'
                    // Log::debug('File stored at: ', ['file_path' => $filePath]);

                    $fileUrl = Storage::url($filePath); // Obtener la URL del archivo almacenado usando Storage
                    // Log::debug('File URL: ', ['file_url' => $fileUrl]);
                } catch (\Exception $e) {
                    Log::error('Error storing file: ' . $e->getMessage());
                }
            } else {
                Log::warning('File not found or invalid format.');
            }
        } else {
            Log::warning('Template component format not set.');
        }

        $template = Template::updateOrCreate(
            ['wa_template_id' => $templateDetails['id']],
            [
                'whatsapp_business_id' => $wa_account->whatsapp_business_id,
                'name' => $templateDetails['name'],
                'language' => $templateDetails['language'],
                'category' => $templateDetails['category'],
                'status' => $templateDetails['status'],
                'file' => $fileUrl,
                'json' => json_encode($templateDetails)
            ]
        );

        // 7. Guardar en base de datos
        // return $this->saveTemplateData($response->json(), $wa_account);
        return response()->json([
            'success' => true,
            'template' => $response->json()
        ]);

        try {



        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error: ' . json_encode($e->errors()));
            return response()->json([
                'error' => 'Validation failed',
                'details' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Template creation error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Warning Server error',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    private function validateComponents($components)
    {
        $requiredComponents = ['BODY'];
        $foundComponents = array_column($components, 'type');

        if (count(array_intersect($requiredComponents, $foundComponents)) !== count($requiredComponents)) {
            throw new \Exception('Missing required components');
        }
    }

    private function processComponents($components)
    {

        return array_map(function($component) {
            switch ($component['type']) {
                case 'HEADER':
                    return $this->processHeader($component);
                case 'BODY':
                    return $this->processBody($component);
                case 'FOOTER':
                    return $this->processFooter($component);
                case 'BUTTONS':
                    return $this->processButtons($component);
                case 'AUTHENTICATION':
                    $processed = [];
                    return $this->processAuthenticationComponents($component, $processed);
                default:
                    throw new \Exception('Invalid component type');
            }
        }, $components);
    }

    private function processAuthenticationComponents($component, &$processed)
    {
        // Componente BODY predefinido
        $processed[] = [
            'type' => 'BODY',
            'text' => '{{1}} es tu código de verificación', // Texto fijo según WhatsApp
            'add_security_recommendation' => $component['securityRecommendation'] ?? false
        ];

        // Componente FOOTER (opcional)
        if (!empty($component['codeExpirationMinutes'])) {
            $processed[] = [
                'type' => 'FOOTER',
                'code_expiration_minutes' => $component['codeExpirationMinutes'] // Sin campo 'text'
            ];
        }

        // Componente BUTTONS
        $buttons = [];
        $otpType = $component['otpType'] ?? 'COPY_CODE';

        $button = [
            'type' => 'OTP',
            'otp_type' => $otpType
        ];

        if ($otpType === 'ONE_TAP') {
            $button['supported_apps'] = [
                [
                    'package_name' => 'com.tu.app.android',
                    'signature_hash' => 'TUFUSTIDUHASH'
                ]
            ];
        }

        $processed[] = [
            'type' => 'BUTTONS',
            'buttons' => [$button]
        ];
    }

    private function processHeader($component)
    {
        $validFormats = ['TEXT', 'IMAGE', 'VIDEO', 'DOCUMENT', 'LOCATION'];
        if (!in_array($component['format'], $validFormats)) {
            throw new \Exception('Invalid header format');
        }

        $processed = [
            'type' => 'HEADER',
            'format' => $component['format']
        ];

        if ($component['format'] === 'TEXT') {
            $processed['text'] = $component['text'];
            if (isset($component['example'])) {
                $processed['example'] = [
                    'header_text' => $component['example']['header_text']
                ];
            }
        }

        if (in_array($component['format'], ['IMAGE', 'VIDEO', 'DOCUMENT'])) {
            if (!isset($component['example']['header_handle'])) {
                throw new \Exception('Media handle required');
            }
            $processed['example'] = [
                'header_handle' => [$component['example']['header_handle']]
            ];
        }

        return $processed;
    }

    private function processBody($component)
    {
        $processed = [
            'type' => 'BODY',
            'text' => $component['text'] ?? null // Permitir null para autenticación
        ];

        // Solo para autenticación
        if (isset($component['add_security_recommendation'])) {
            $processed['add_security_recommendation'] = $component['add_security_recommendation'];
            unset($processed['text']); // Eliminar text que no es necesario
        }

        if (isset($component['example'])) {
            $processed['example'] = [
                'body_text' => [$component['example']['body_text']]
            ];
        }

        return $processed;
    }

    // Métodos similares para processFooter, processButtons, processAuthentication...

    private function buildApiUrl($wa_account)
    {
        return env('WHATSAPP_API_URL').env('WHATSAPP_API_VERSION')."/{$wa_account->whatsapp_business_id}/message_templates";
    }

    private function saveTemplateData($whatsappResponse, $wa_account, $fileurl)
    {
        Log::debug('Save Template 0: ', ['template' => $whatsappResponse]);

        $whatsappResponse = $whatsappResponse->json();

        Log::debug('Save Template 1: ', ['template' => $whatsappResponse]);

        $template = Template::updateOrCreate(
            ['wa_template_id' => $whatsappResponse['id']],
            [
                'whatsapp_business_id' => $wa_account->whatsapp_business_id,
                'name' => $whatsappResponse['name'],
                'language' => $whatsappResponse['language'],
                'category' => $whatsappResponse['category'],
                'status' => $whatsappResponse['status'],
                'file' => $fileurl,
                'json_response' => json_encode($whatsappResponse)
            ]
        );

        return response()->json([
            'success' => true,
            'template' => $template
        ]);
    }

    private function handleWhatsAppError($response)
    {
        $error = $response->json()['error'] ?? ['message' => 'Unknown error'];

        Log::error('WhatsApp API Error', [
            'code' => $error['code'] ?? 'N/A',
            'type' => $error['type'] ?? 'N/A',
            'message' => $error['message'] ?? 'N/A'
        ]);

        return response()->json([
            'error' => $error['error_user_msg'] ?? 'Failed to create template',
            'details' => $error
        ], $response->status());
    }

    public function uploadMedia(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|mimes:jpg,png,pdf,mp4,mov',
                'wa_account_id' => 'required|exists:whatsapp_business_accounts,whatsapp_business_id'
            ]);

            // $wa_account = WhatsappBusinessAccount::where('whatsapp_business_id', $request->wa_account_id)->first();
            $wa_account = WhatsappBusinessAccount::find($request->wa_account_id);
            $file = $request->file('file');

            // 1. Iniciar sesión de subida
            $initResponse = Http::post($this->buildUploadInitUrl($file, $wa_account));

            if (!$initResponse->successful()) {
                Log::debug('Upload init failed: ', ['response' => $initResponse->body()]);
                throw new \Exception('Upload init failed: '.$initResponse->body());
            }

            $uploadSessionId = $initResponse->json()['id'];
            Log::debug('Upload init session ID: ', ['response' => $uploadSessionId]);

            // 2. Subir archivo
            $uploadResponse = Http::withHeaders([
                'Authorization' => "OAuth {$wa_account->api_token}",
                'file_offset' => 0
            ])->attach('file', file_get_contents($file->path()), $file->getClientOriginalName())
             ->post(env('WHATSAPP_API_URL').env('WHATSAPP_API_VERSION')."/{$uploadSessionId}");

            if (!$uploadResponse->successful()) {
                Log::debug('Upload failed: ', ['response' => $uploadResponse->body()]);
                throw new \Exception('Upload failed: '.$uploadResponse->body());
            }

            Log::debug('Upload success: ', ['response' => response()->json([
                'success' => true,
                'handle' => $uploadResponse->json()['h']
            ])]);

            return response()->json([
                'success' => true,
                'handle' => $uploadResponse->json()['h']
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Media upload failed',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    private function buildUploadInitUrl($file, $wa_account)
    {
        // return env('WHATSAPP_API_URL').env('WHATSAPP_API_VERSION')."/{$wa_account->whatsapp_business_id}/message_templates";
        return env('WHATSAPP_API_URL').env('WHATSAPP_API_VERSION')."/{$wa_account->app_id}/uploads?".http_build_query([
            'file_name' => $file->getClientOriginalName(),
            'file_length' => $file->getSize(),
            'file_type' => $file->getMimeType(),
            'access_token' => $wa_account->api_token
        ]);
    }

    private function processFooter($component)
    {


        // return [
        //     'type' => 'FOOTER',
        //     'text' => $component['text']
        // ];
        $processed = [
            'type' => 'FOOTER',
            'text' => $component['text'] ?? null
        ];

        // Solo para autenticación
        if (isset($component['code_expiration_minutes'])) {
            $processed['code_expiration_minutes'] = $component['code_expiration_minutes'];
            unset($processed['text']); // Eliminar text que no es necesario
        } else {
            if (empty($component['text'])) {
                throw new \Exception('Footer text cannot be empty');
            }
        }

        return $processed;
    }

    private function processButtons($component)
    {
        $validButtonTypes = ['QUICK_REPLY', 'URL', 'PHONE_NUMBER', 'COPY_CODE', 'OTP'];
        $processedButtons = [];

        foreach ($component['buttons'] as $button) {
            if (!in_array($button['type'], $validButtonTypes)) {
                throw new \Exception('Invalid button type: '.$button['type']);
            }

            $processedButton = ['type' => $button['type']];

            switch ($button['type']) {
                case 'QUICK_REPLY':
                    $processedButton['text'] = $button['text'];
                    break;

                case 'URL':
                    $processedButton['text'] = $button['text'];
                    $processedButton['url'] = $button['url'];
                    if (isset($button['example'])) {
                        $processedButton['example'] = $button['example'];
                    }
                    break;

                case 'PHONE_NUMBER':
                    $processedButton['text'] = $button['text'];
                    $processedButton['phone_number'] = $button['phone_number'];
                    break;

                case 'COPY_CODE':
                    $processedButton['example'] = $button['example'];
                    break;

                case 'OTP':
                    if (!isset($button['otp_type'])) {
                        throw new \Exception('OTP button requires otp_type');
                    }

                    $validOtpTypes = ['ONE_TAP', 'COPY_CODE', 'ZERO_TAP'];
                    if (!in_array($button['otp_type'], $validOtpTypes)) {
                        throw new \Exception('Invalid OTP type: ' . $button['otp_type']);
                    }

                    $processedButton['otp_type'] = $button['otp_type'];

                    // Campos específicos para ONE_TAP
                    if ($button['otp_type'] === 'ONE_TAP') {
                        if (!isset($button['supported_apps'])) {
                            throw new \Exception('ONE_TAP requires supported_apps');
                        }
                        $processedButton['supported_apps'] = $button['supported_apps'];
                    }

                    // Campos específicos para COPY_CODE
                    // if ($button['otp_type'] === 'COPY_CODE') {
                    //     if (!isset($button['text'])) {
                    //         throw new \Exception('COPY_CODE requires text');
                    //     }
                    //     $processedButton['text'] = $button['text'];
                    // }
                    break;
            }

            $processedButtons[] = $processedButton;
        }

        return [
            'type' => 'BUTTONS',
            'buttons' => $processedButtons
        ];
    }
}
