<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatBotController extends Controller
{
    public function kirimPesan(Request $request)
    {
        // Pastikan URL ini sesuai dengan "Test URL" di node Webhook n8n kamu
        $n8nUrl = 'http://localhost:5678/webhook-test/chat-bot';

        $response = Http::post($n8nUrl, [
            'pesan' => $request->input('message'),
            'user' => 'User Lokal',
            'waktu' => now()->toDateTimeString()
        ]);

        return response()->json([
            'status' => 'Terkirim ke n8n!',
            'balasan_n8n' => $response->json()
        ]);
    }
}
