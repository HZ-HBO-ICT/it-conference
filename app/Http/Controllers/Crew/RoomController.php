<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Sponsorship;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RoomController extends Controller
{
    /**
     * Display a listing of the rooms
     *
     * @return View
     */
    public function index(): View
    {
        if (Auth::user()->cannot('viewAny', Room::class)) {
            abort(403);
        }

        $rooms = Room::get();
        return view('crew.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new room
     *
     * @return View
     */
    public function create(): View
    {
        if (Auth::user()->cannot('create', Room::class)) {
            abort(403);
        }

        return view('crew.rooms.create');
    }

    /**
     * Creates the room and stores it in the db
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if (Auth::user()->cannot('create', Room::class)) {
            abort(403);
        }

        Room::create($request->validate([
            'name' => 'required|unique:rooms|string|max:255',
            'max_participants' => 'required|numeric|min:1|max:999'
        ]));

        return redirect(route('moderator.rooms.index'))->banner('You successfully added the room!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        if (Auth::user()->cannot('view', Room::class)) {
            abort(403);
        }

        return view('crew.rooms.show', compact('room'));
    }

    /**
     * Delete the specified room from db
     *
     * @param Room $room
     * @return RedirectResponse
     */
    public function destroy(Room $room): RedirectResponse // TODO: Refactor the FK constraints in the db
    {
        if (Auth::user()->cannot('delete', $room)) {
            abort(403);
        }

        foreach ($room->presentations as $presentation) {
            $presentation->room_id = null;
            $presentation->timeslot_id = null;
            $presentation->save();
        }

        $room->delete();

        return redirect(route('moderator.rooms.index'))->banner('The room was successfully deleted');
    }
}
