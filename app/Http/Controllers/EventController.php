<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function note(Request $request, $id)
    {
        // Validasi manual
        $validator = Validator::make($request->all(), [
            'note' => 'nullable|string|max:1000', // contoh maksimal 1000 karakter
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'note-event-' . $id);
        }

        $event = Event::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $event->update([
            'note' => $request->note,
        ]);

        return redirect()->back()
            ->with('success', 'Catatan Berhasil Ditambahkan')
            ->with('open_modal', 'note-event-' . $event->id);
    }

    public function destroy($id){
        $event = Event::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $event->delete();
        return redirect()->back()->with('success', 'Event Berhasil Dihapus');
    }

}
