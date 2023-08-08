<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the rooms
     *
     * @return View
     */
    public function index() : View
    {
        $rooms = Room::get();
        return view('moderator.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new room
     *
     * @return View
     */
    public function create() : View
    {
        return view('moderator.rooms.create');
    }

    /**
     * Creates the room and stores it in the db
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {
        Room::create($request->validate(Room::rules()));

        return redirect(route('rooms.index'))->banner('You successfully added the room!');
    }

    /**
     * Show the form for editing the specified room
     *
     * @param Room $room
     * @return View
     */
    public function edit(Room $room) : View
    {
        return view('moderator.rooms.edit', compact('room'));
    }

    /**
     * Update the specified room and save it in the db
     *
     * @param Request $request
     * @param Room $room
     * @return RedirectResponse
     */
    public function update(Request $request, Room $room) : RedirectResponse
    {
        $room->update($request->validate([
            'max_participants' => 'required|numeric|min:1'
        ]));

        return redirect(route('rooms.index'))->banner('You successfully updated the room!');
    }

    /**
     * Delete the specified room from db
     *
     * @param Room $room
     * @return RedirectResponse
     */
    public function destroy(Room $room) : RedirectResponse // TODO: Refactor the FK constraints in the db
    {
        foreach ($room->presentations as $presentation) {
            $presentation->room_id = null;
            $presentation->save();
        }

        $room->delete();

        return redirect(route('rooms.index'))->banner('The room was successfully deleted');
    }
}
