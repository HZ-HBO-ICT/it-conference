<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Models\Company;
use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class CrewController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name',
            ['participant', 'company representative', 'company member', 'booth owner']
        )->get();

        return view('crew.crew.index', compact('roles'));
    }
}
