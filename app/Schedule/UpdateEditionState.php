<?php

namespace App\Schedule;

abstract class UpdateEditionState
{
    protected $edition;

    public function __construct($edition)
    {
        $this->edition = $edition;
    }
}
