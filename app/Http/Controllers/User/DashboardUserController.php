<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $events = Event::where('user_id', $user->id)->orderBy('is_done', 'asc')->orderBy('tanggal_event', 'asc')->paginate(10);
        return view('dashboard', compact('user', 'events'));
    }
}
