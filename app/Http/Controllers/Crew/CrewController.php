<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Models\Company;
use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class CrewController extends Controller
{
    /**
     * Returns the main page of the crew page
     * @return View
     */
    public function index() : View
    {
        if (!Gate::authorize('view-crew')) {
            abort(403);
        }

        $roles = Role::whereNotIn(
            'name',
            ['participant', 'company representative', 'company member', 'booth owner']
        )->get();

        return view('crew.crew.index', compact('roles'));
    }
}
