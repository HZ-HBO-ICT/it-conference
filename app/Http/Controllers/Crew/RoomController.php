<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        Room::create($request->validate([
            'name' => 'required|unique:rooms',
            'max_participants' => 'required|numeric|min:1'
        ]));

        return redirect(route('moderator.rooms.index'))->banner('You successfully added the room!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
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
        foreach ($room->presentations as $presentation) {
            $presentation->room_id = null;
            $presentation->timeslot_id = null;
            $presentation->save();
        }

        $room->delete();

        return redirect(route('moderator.rooms.index'))->banner('The room was successfully deleted');
    }
}
