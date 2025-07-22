<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    //store data from form events
    public function store(StoreEventRequest $request){
        Event::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_event' => $request->tanggal_event,
            'user_id' => Auth::id(),
        ]);
        return redirect()->back()->with('success', 'Event berhasil ditambahkan!');
    }
}
