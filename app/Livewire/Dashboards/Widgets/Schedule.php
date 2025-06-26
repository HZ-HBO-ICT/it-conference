<?php

namespace App\Livewire\Dashboards\Widgets;

use App\Models\Edition;
use App\Models\Presentation;
use App\Models\Timeslot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Livewire\Component;

/**
 * Implementation inspiration
 * https://dev.to/crayoncode/building-a-vertical-calendar-with-html-css-js-2po2
 */
class Schedule extends Component
{
    /**
     * @var string[]
     */
    public array $timeslots = [];
    public Authenticatable|User $user;
    public $presentations;
    public int $startHour;
    public int $endHour;
    public Edition|null $edition;

    public function mount(Authenticatable|User $user, $startHour, $endHour) {
        $this->generateTimeslots();
        $this->user = $user;
        $this->presentations = $user->participatingIn->merge($user->presenter_of ? collect([$user->presenter_of]) : []);
        $this->startHour = $startHour;
        $this->endHour = $endHour;
        $this->edition = Edition::current();
    }

    /**
     * @return void
     */
    public function generateTimeslots()
    {
        $this->timeslots = [];
        for ($hour = $this->startHour; $hour <= $this->endHour; $hour++) {
            $this->timeslots[] = [
                'time' => sprintf('%02d:00', $hour),
                'hour' => $hour
            ];
        }
    }

    public function getPresentationPosition(Presentation $presentation)
    {
        $startTime = Carbon::parse($presentation->start);
        $endTime = $startTime->copy()->addMinutes($presentation->presentationType->duration);

        $startHour = $startTime->hour;
        $startMinute = $startTime->minute;
        $endHour = $endTime->hour;
        $endMinute = $endTime->minute;

        $top = (($startHour - $this->startHour) * 60) + ($startMinute * 1);
        $height = (($endHour - $startHour) * 60) + (($endMinute - $startMinute) * 1);

        return [
            'top' => $top . 'px',
            'height' => $height . 'px'
        ];
    }

    public function render()
    {
        return view('livewire.dashboards.widgets.schedule');
    }
}
