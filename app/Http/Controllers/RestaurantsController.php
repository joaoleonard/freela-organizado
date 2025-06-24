<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRestaurantRequest;
use App\Http\Requests\LinkMusicianRestaurantRequest;
use App\Models\Restaurant;
use App\Models\User;

class RestaurantsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        } elseif (!$user->isMaster()) {
            return redirect('/dashboard');
        }

        $restaurants = Restaurant::query()
            ->orderBy('name')
            ->get();

        return view('restaurants.index', compact('restaurants'));
    }

    public function show(Restaurant $restaurant)
    {
        if (auth()->user()->isAdmin() && auth()->user()->id != $restaurant->admin_id) {
            return redirect('/dashboard');
        }

        $shows = $restaurant->shows()
            ->where('show_date', '>=', today()->toDateString())
            ->orderBy('show_date', 'asc')
            ->orderBy('show_time', 'asc')
            ->get();

        $shows = $shows->map(function ($show) {
            \Carbon\Carbon::setLocale('pt_BR');
            $show->formatted_date = \Carbon\Carbon::parse($show->show_date)->translatedFormat('d/m (l)');
            $show->isToday = \Carbon\Carbon::parse($show->show_date)->isToday();
            return $show;
        });

        return view('restaurants.show', compact('restaurant', 'shows'));
    }

    public function create()
    {
        $admins = User::query()
            ->where('role_id', '2')
            ->orderBy('name')
            ->get();

        return view('restaurants.create', compact('admins'));
    }

    public function store(CreateRestaurantRequest $request)
    {
        $request->validated();

        Restaurant::create($request->all());

        return redirect('/restaurants')->with('success', 'Restaurante criado com sucesso!');
    }

    public function musicians(Restaurant $restaurant)
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

        $musicians = $restaurant->musicians()
            ->orderBy('name')
            ->get();

        return view('restaurants.musicians.index', compact('musicians', 'restaurant'));
    }

    public function addMusician(Restaurant $restaurant)
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

        $musicians = User::query()
            ->where('role_id', '3')
            ->whereDoesntHave('restaurants', function ($query) use ($restaurant) {
                $query->where('restaurants.id', $restaurant->id);
            })
            ->orderBy('name')
            ->get();

        return view('restaurants.musicians.link', compact('restaurant', 'musicians'));
    }

    public function linkMusician(Restaurant $restaurant, LinkMusicianRestaurantRequest $request)
    {
        $request->validated();

        $musician = User::findOrFail($request->musician_id);

        $restaurant->musicians()->attach($musician->id);

        return redirect()->route('restaurant.musicians', $restaurant->id)->with('success', 'Músico vinculado com sucesso!');
    }

    public function unlinkMusician(Restaurant $restaurant, User $musician)
    {
        $restaurant->musicians()->detach($musician->id);

        return redirect()->route('restaurant.musicians', $restaurant->id)->with('success', 'Músico desvinculado com sucesso!');
    }

    public function showMusician(Restaurant $restaurant, User $musician)
    {
        $shows = $restaurant->shows()
            ->where('user_id', $musician->id)
            ->orderBy('date', 'desc')
            ->get();

        $shows = $shows->map(function ($show) {
            \Carbon\Carbon::setLocale('pt_BR');
            $show->formatted_date = \Carbon\Carbon::parse($show->show_date)->translatedFormat('d/m (l)');
            $show->isToday = \Carbon\Carbon::parse($show->show_date)->isToday();
            return $show;
        });

        return view('restaurants.musicians.show', compact('restaurant', 'musician', 'shows'));
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return redirect('/restaurants')->with('success', 'Restaurante deletado com sucesso!');
    }
}
