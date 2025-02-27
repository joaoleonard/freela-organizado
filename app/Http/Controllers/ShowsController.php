<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShowRequest;
use App\Http\Requests\UpdateShowRequest;
use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShowsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        } elseif ($user->isMusician()) {
            return redirect('/dashboard');
        }

        $shows = Show::query()
            ->where('show_date', '>=', today()->toDateString())
            ->orderBy('show_date')
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

        return view('shows.index', compact('shows'));
    }

    public function create()
    {
        if (!auth()->user()) {
            return redirect('/login');
        } elseif (auth()->user()->isMusician()) {
            return redirect('/dashboard');
        }

        return view('shows.create');
    }

    public function store(CreateShowRequest $request)
    {
        Show::create(array_merge($request->all(), ['available_users' => json_encode([])]));

        return redirect()->route('shows')->with('success', 'Data criada com sucesso!');
    }

    public function musicianAvailability()
    {
        $shows = Show::query()
            ->where('show_date', '>=', today()->toDateString())
            ->orderBy('show_date')
            ->orderByDesc('lunchtime')
            ->get();

        $shows = $shows->map(function ($show) {
            \Carbon\Carbon::setLocale('pt_BR');
            $show->formatted_date = \Carbon\Carbon::parse($show->show_date)->translatedFormat('d/m/y (l)');
            $show->isToday = \Carbon\Carbon::parse($show->show_date)->isToday();
            $show->isSaturday = \Carbon\Carbon::parse($show->show_date)->isSaturday();
            $show->checked = in_array(auth()->user()->id, explode(',', $show->available_users));
            return $show;
        });

        return view('availability', compact('shows'));
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

    public function show($id)
    {
        $show = Show::findOrFail($id);

        \Carbon\Carbon::setLocale('pt_BR');
        $show->formatted_date = \Carbon\Carbon::parse($show->show_date)->translatedFormat('d/m/y (l)');
        $show->users = collect(explode(',', $show->available_users))
            ->filter()
            ->map(function ($userId) {
                return \App\Models\User::find($userId);
            })
            ->filter();

        return view('shows.edit', compact('show'));
    }

    public function update(UpdateShowRequest $request, $id)
    {
        $show = Show::findOrFail($id);
        $show->fill($request->all());
        $show->save();

        return redirect()->route('shows')->with('success', 'Show editado com sucesso!');
    }

    public function destroy($id)
    {
        Show::destroy($id);

        return redirect()->route('shows')->with('success', 'Show deletado com sucesso!');
    }
}
