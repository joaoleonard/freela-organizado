<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:send-show-reminder')->timezone('America/Sao_Paulo')->dailyAt('07:00');