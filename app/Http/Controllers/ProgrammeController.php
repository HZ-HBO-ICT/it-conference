<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProgrammeController extends Controller
{
    /**
     * Displays an index page of the general programme
     *
     * @return View
     */
    public function index(): View
    {
        $lectures = Presentation::where('type', 'lecture')
            ->whereNotNull('room_id')
            ->whereNotNull('timeslot_id')
            ->orderBy('start')
            ->get();

        $workshops = Presentation::where('type', 'workshop')
            ->whereNotNull('room_id')
            ->whereNotNull('timeslot_id')
            ->orderBy('start')
            ->get();

        $lectureTimeslots = $lectures->map->only('start')->unique();
        $workshopTimeslots = $workshops->map->only('start')->unique();

        return view('programme.index', compact(
            'lectures',
            'workshops',
            'lectureTimeslots',
            'workshopTimeslots'
        ));
    }

    /**
     * Displays details of the specific presentation
     *
     * @param Presentation $presentation
     * @return View
     */
    public function show(Presentation $presentation): View
    {
        $styles = [
            1 => [
                'borderColor' => 'bg-gradient-to-r from-yellow-300 to-yellow-600', // Gold
                'linkColor' => 'text-yellow-400 hover:text-yellow-500',
                'textColor' => 'text-yellow-400',
                'iconColor' => 'stroke-yellow-400 hover:stroke-yellow-500',
            ],
            2 => [
                'borderColor' => 'bg-gradient-to-r from-gray-300 to-gray-600', // Silver
                'linkColor' => 'text-gray-600 hover:text-gray-700',
                'textColor' => 'text-gray-600',
                'iconColor' => 'stroke-gray-600 hover:stroke-gray-700',
            ],
            3 => [
                'borderColor' => 'bg-gradient-to-r from-orange-300 to-orange-600', // Bronze
                'linkColor' => 'text-orange-400 hover:text-orange-500',
                'textColor' => 'text-orange-400',
                'iconColor' => 'stroke-orange-400 hover:stroke-orange-500',
            ],
        ];

        $company = $presentation->company;
        if ($company && $company->is_sponsorship_approved && isset($styles[$company->sponsorship_id])) {
            $borderColor = $styles[$company->sponsorship_id]['borderColor'];
            $linkColor = $styles[$company->sponsorship_id]['linkColor'];
            $iconColor = $styles[$company->sponsorship_id]['iconColor'];
            $textColor = $styles[$company->sponsorship_id]['textColor'];
        } else {
            $borderColor = 'bg-gradient-to-r from-blue-300 via-blue-400 to-blue-500'; // Default
            $linkColor = 'text-blue-400 hover:text-blue-600';
            $textColor = 'text-blue-400';
            $iconColor = 'stroke-blue-400 dark:stroke-blue-400';
        }

        return view(
            'programme.show',
            compact('presentation', 'borderColor', 'linkColor', 'textColor', 'iconColor')
        );
    }

    /**
     * Handles enrollment for the presentation
     *
     * @param Presentation $presentation
     * @return int
     */
    public function enroll(Presentation $presentation)
    {
        if (Auth::user()->cannot('enroll', $presentation)) {
            return 403;
        }

        $enrollmentResult = Auth::user()->joinPresentation($presentation);

        if (!$enrollmentResult) {
            return redirect(route('programme.presentation.show', compact('presentation')))
                ->banner("Something went wrong with enrolling for {$presentation->name}");
        }

        return redirect(route('programme'))
            ->banner("You have successfully enrolled for {$presentation->name}");
    }

    /**
     * Handles disenrollment from the presentation
     *
     * @param Presentation $presentation
     * @return int
     */
    public function disenroll(Presentation $presentation)
    {
        if (Auth::user()->cannot('disenroll', $presentation)) {
            return 403;
        }

        Auth::user()->leavePresentation($presentation);

        return redirect(route('programme'))
            ->banner("You have successfully deregistered from the {$presentation->name}");
    }
}
