<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    DB::table('commissions')->where('status_id', 6)->delete();
})->monthly();
