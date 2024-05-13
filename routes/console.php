<?php

use App\Models\Edition;
use App\Schedule\UpdateEditionStateDaily;
use App\Schedule\UpdateEditionStateHourly;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(new UpdateEditionStateDaily(Edition::current()))
    ->daily()
    ->when(function () {
        return (Edition::current());
    });

Schedule::call(new UpdateEditionStateHourly(Edition::current()))
    ->hourly()
    ->when(function () {
        return (Edition::current());
    });
