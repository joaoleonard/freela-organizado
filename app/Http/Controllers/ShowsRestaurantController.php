<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShowRequest;
use App\Http\Requests\UpdateShowRequest;
use App\Models\Restaurant;
use App\Models\Show;
use App\Models\User;
use Illuminate\Http\Request;

class ShowsRestaurantController extends Controller
{
    public function index(Restaurant $restaurant)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        } elseif ($user->isMusician()) {
            return redirect('/dashboard');
        }

        if ($user->isAdmin() && $user->id != $restaurant->admin_id) {
            return redirect('/dashboard');
        }

        $shows = $restaurant->shows()
            ->where('show_date', '>=', today()->toDateString())
            ->orderBy('show_date', 'asc')
            ->orderByDesc('lunchtime')
            ->get();

        $shows = $shows->map(function ($show) {
            $show->users = collect(explode(',', $show->available_users))
                ->filter()
                ->map(function ($userId) {
                    return \App\Models\User::find($userId);
                })
                ->filter();

            \Carbon\Carbon::setLocale('pt_BR');
            $show->formatted_date = \Carbon\Carbon::parse($show->show_date)->translatedFormat('d/m');
            $show->week_day = \Carbon\Carbon::parse($show->show_date)->translatedFormat('(l)');
            $show->isToday = \Carbon\Carbon::parse($show->show_date)->isToday();
            $show->isSaturday = \Carbon\Carbon::parse($show->show_date)->isSaturday();
            return $show;
        });

        return view('restaurants.shows.index', compact('restaurant', 'shows'));
    }

    public function create(Restaurant $restaurant)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        } elseif ($user->isMusician()) {
            return redirect('/dashboard');
        }

        if ($user->isAdmin() && $user->id != $restaurant->admin_id) {
            return redirect('/dashboard');
        }

        return view('restaurants.shows.create', compact('restaurant'));
    }

    public function store(Restaurant $restaurant, CreateShowRequest $request)
    {
        Show::create(array_merge($request->all(), [
            'available_users' => json_encode([]),
            'restaurant_id' => $restaurant->id,
        ]));

        return redirect()->route('restaurant.shows', $restaurant->id)->with('success', 'Data criada com sucesso!');
    }

    public function show(Restaurant $restaurant, Show $show)
    {
        \Carbon\Carbon::setLocale('pt_BR');
        $show->formatted_date = \Carbon\Carbon::parse($show->show_date)->translatedFormat('d/m (l)');
        $show->users = collect(explode(',', $show->available_users))
            ->filter()
            ->map(function ($userId) {
                return User::find($userId);
            })
            ->filter();

        $allUsers = User::whereHas('role', function ($query) {
            $query->where('type', 'musician');
        })->whereHas('restaurants', function ($query) use ($restaurant) {
            $query->where('restaurant_id', $restaurant->id);
        })->get();
        $show->other_users = $allUsers->diff($show->users);

        return view('restaurants.shows.edit', compact('restaurant', 'show'));
    }

    public function update(UpdateShowRequest $request, Restaurant $restaurant, Show $show)
    {
        $show->fill($request->all());
        $show->save();

        return redirect()->route('restaurant.shows', $restaurant->id)->with('success', 'Show editado com sucesso!');
    }

    public function destroy(Restaurant $restaurant, Show $show)
    {
        $show->delete();

        return redirect()->route('restaurant.shows', $restaurant->id)->with('success', 'Show deletado com sucesso!');
    }
}
