<?php

namespace App\Http\Controllers;

use App\Models\Show;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        if ($user->isMaster() || $user->isAdmin()) {
            $shows = Show::query()->where('show_date', '>=', today()->toDateString())->get();
        } else {
            $shows = Show::query()->where('show_date', '>=', today()->toDateString())->where('user_id', $user->id)->get();
        }



        $shows = $shows->map(function ($show) {
            \Carbon\Carbon::setLocale('pt_BR');
            $show->formatted_date = \Carbon\Carbon::parse($show->show_date)->translatedFormat('d/m/y (l)');
            $show->isToday = \Carbon\Carbon::parse($show->show_date)->isToday();
            return $show;
        });

        return view('dashboard', compact('shows'));
    }
}
