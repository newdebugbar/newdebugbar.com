<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:refresh-community')->hourly()->withoutOverlapping();
