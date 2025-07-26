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
        return redirect()->back()->with('success', 'Event Berhasil Ditambahkan!')->withInput();
    }

    public function update(StoreEventRequest $request, $id)
    {   
        $event = Event::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $event->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_event' => $request->tanggal_event,
        ]);

        return redirect()->back()->with('success', 'Event Berhasil Diperbarui');
    }

    public function change($id){
        $event = Event::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $event->update([
            'is_done' => !$event->is_done,
        ]);

        $status = $event->is_done ? 'ditandai selesai' : 'ditandai belum selesai';
        return redirect()->back()->with('success', "Event berhasil $status.");
    }

    public function destroy($id){
        $event = Event::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $event->delete();
        return redirect()->back()->with('success', 'Event Berhasil Dihapus');
    }

}
