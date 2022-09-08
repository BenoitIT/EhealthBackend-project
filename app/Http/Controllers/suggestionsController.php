<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class suggestionsController extends Controller
{
    //
    public function store(request $request)
    {
        $request->validate([
            'sender_email' => 'required|email',
            'suggestion' => 'required'
        ]);
        Suggestion::create([
            'sender_email' => $request->sender_email,
            'suggestion' => $request->suggestion,
        ]);
        return response([
            'message' => 'suggestion is sent'
        ]);
    }
    public function show()
    {
        if (auth()->user()->role == 1) {
            $suggest = Suggestion::orderBy('id', 'desc')->get();
            return response([
                'suggestions' => $suggest
            ]);
        }
    }
}
