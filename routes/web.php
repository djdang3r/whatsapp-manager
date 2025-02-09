<?php

use App\Http\Controllers\WhatsappWebhookController;
use App\Http\Controllers\WhatsappManagerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/webhook-app', [WhatsappWebhookController::class, 'handle']);
Route::get('/webhook-app', [WhatsappWebhookController::class, 'handle']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/whatsapp-api-cloud', function () {
        return view('whatsapp.index');
    })->name('whatsapp');

    Route::post('/save-whatsapp-account', [WhatsappManagerController::class, 'newAccount'])->name('new_account');
    Route::get('/whatsapp-account/{id}', [WhatsappManagerController::class, 'showAccount'])->name('show_profile');
    Route::get('/get-whatsapp-accounts', [WhatsappManagerController::class, 'getAccounts']);
    Route::get('/phone-number/{id}/profile', [WhatsappManagerController::class, 'getProfile'])->name('get_profile');
    Route::get('/templates/{phone_number_id}', [WhatsappManagerController::class, 'getTemplates'])->name('get_templates');
    Route::get('/whatsapp-chat/{phone_number_id}', [WhatsappManagerController::class, 'getConversations'])->name('get_chat');
    Route::get('/chat-history/{contactId}/{phone_number_id}', [WhatsappManagerController::class, 'getChatHistory'])->name('get_chat');
    Route::post('/send-message', [WhatsappManagerController::class, 'sendMessage'])->name('send_message');

    Route::post('/template-detail', [WhatsappManagerController::class, 'getTemplateDetail'])->name('template.detail');
    Route::post('/template-detail-name', [WhatsappManagerController::class, 'getTemplateDetailByName'])->name('template.detail.name');
    Route::post('/template-json', [WhatsappManagerController::class, 'getTemplateJson'])->name('template.json');
    Route::post('/template-create', [WhatsappManagerController::class, 'createTemplate'])->name('template.create');
    Route::post('/template-update', [WhatsappManagerController::class, 'updateTemplate'])->name('template.update');
    Route::post('/send-template', [WhatsappManagerController::class, 'sendTemplate'])->name('template.send');
    Route::post('/media/upload', [WhatsappManagerController::class, 'uploadMedia']);
});

