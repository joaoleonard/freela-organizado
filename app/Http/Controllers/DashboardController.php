<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Show;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        if ($user->isAdmin()) {
            $restaurantId = Restaurant::where('admin_id', $user->id)->first()->id;

            return redirect()->route('restaurant.show', ['restaurant' => $restaurantId]);
        }

        if ($user->isMaster() || $user->isAdmin()) {
            $shows = Show::query()
                ->where('show_date', '>=', today()
                ->toDateString())
                ->orderBy('show_date')
                ->orderByDesc('lunchtime')
                ->get();
        } else {
            $shows = Show::query()
                ->where('show_date', '>=', today()
                ->toDateString())
                ->where('user_id', $user->id)
                ->orderBy('show_date')
                ->orderByDesc('lunchtime')
                ->get();
        }

        $shows = $shows->map(function ($show) {
            \Carbon\Carbon::setLocale('pt_BR');
            $show->formatted_date = \Carbon\Carbon::parse($show->show_date)->translatedFormat('d/m (l)');
            $show->isToday = \Carbon\Carbon::parse($show->show_date)->isToday();
            return $show;
        });

        return view('dashboard', compact('shows'));
    }
}
