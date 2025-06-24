<?php

namespace App\Http\Controllers;

use App\Models\Show;
use Illuminate\Http\Request;

class ShowsController extends Controller
{
    public function musicianAvailability()
    {
        $restaurants = auth()->user()->restaurants;

        $restaurants = $restaurants->map(function ($restaurant) {
            $restaurant->shows = Show::query()
                ->where('show_date', '>=', today()->toDateString())
                ->where('restaurant_id', $restaurant->id)
                ->orderBy('show_date')
                ->orderBy('show_time')
                ->get();

            $restaurant->shows = $restaurant->shows->map(function ($show) {
                \Carbon\Carbon::setLocale('pt_BR');
                $show->formatted_date = \Carbon\Carbon::parse($show->show_date)->translatedFormat('d/m (l)');
                $show->isToday = \Carbon\Carbon::parse($show->show_date)->isToday();
                $show->isSaturday = \Carbon\Carbon::parse($show->show_date)->isSaturday();
                $show->checked = in_array(auth()->user()->id, explode(',', $show->available_users)) || $show->user_id == auth()->user()->id;
                return $show;
            });

            return $restaurant;
        });

        return view('availability', compact('restaurants'));
    }

    public function setAvailability(Request $request)
    {
        $user = auth()->user();

        $showIds = $request->input('shows', []);

        $allShows = Show::query()->where('show_date', '>=', today()->toDateString())->get();

        foreach ($allShows as $show) {
            if (in_array($show->id, $showIds)) {
                $availableUsers = $show->available_users ? explode(',', $show->available_users) : [];
                if (!in_array($user->id, $availableUsers)) {
                    $availableUsers[] = $user->id;
                    $show->available_users = implode(',', $availableUsers);
                    $show->save();
                }
            } else {
                $availableUsers = $show->available_users ? explode(',', $show->available_users) : [];
                if (($key = array_search($user->id, $availableUsers)) !== false) {
                    unset($availableUsers[$key]);
                    $show->available_users = implode(',', $availableUsers);
                    $show->save();
                }
            }
        }

        return redirect()->route('dashboard')->with('success', 'Disponibilidade preenchida com sucesso!');
    }
}
