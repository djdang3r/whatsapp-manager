<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Jobs\ProcessCampaignBatch;

class CampaignController extends Controller
{
    public function launchCampaign(Campaign $campaign)
    {
        if($campaign->type === 'PROGRAMADA') {
            $campaign->update(['status' => 'SCHEDULED']);
        } else {
            ProcessCampaignBatch::dispatch($campaign);
            $campaign->update(['status' => 'ACTIVE']);
        }
    }

    public function create()
    {
        return view('campaigns.create'); // Vista con el formulario
    }

    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'name' => 'required|max:255',
            'message_content' => 'required',
            'type' => 'required|in:INMEDIATA,PROGRAMADA'
        ]);

        // Creación de la campaña
        Campaign::create($validated);

        return redirect()->route('campaigns.index')
            ->with('success', 'Campaña creada exitosamente');
    }
}
