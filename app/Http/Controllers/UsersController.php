<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\MusicianWaitlist;
use App\Models\Show;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        if (!auth()->user()) {
            return redirect('/login');
        } elseif (auth()->user()->isMusician()) {
            return redirect('/dashboard');
        }

        $users = User::query()
            ->where('id', '!=', auth()->user()->id)
            ->where('role_id', '!=', '1')
            ->get();

        $waitlistCount = MusicianWaitlist::query()->where('status', 'pending')->count();

        return view('users.index', [
            'users' => $users,
            'waitlistCount' => $waitlistCount
        ]);
    }

    public function create()
    {
        if (!auth()->user()) {
            return redirect('/login');
        } elseif (auth()->user()->isMusician()) {
            return redirect('/dashboard');
        }

        return view('users.create');
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('users')->with('success', 'Usuário criado com sucesso!');
    }

    public function show(User $user)
    {
        if (!$user) {
            return redirect()->route('users')->with('error', 'Usuário não encontrado!');
        } else if ($user->id != auth()->user()->id && !auth()->user()->isMaster()) {
            return redirect()->route('dashboard')->with('error', 'Você não tem permissão para acessar este usuário!');
        }

        $shows = Show::query()
            ->where('user_id', $user->id)
            ->where('show_date', '>=', today()->toDateString())
            ->orderBy('show_date')
            ->orderBy('show_time')
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

        return view('users.edit', compact('user', 'shows'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if (!$user) {
            return redirect()->route('users')->with('error', 'Usuário não encontrado!');
        }

        $data = $request->validated();

        $user->update($data);

        if (auth()->user()->isMaster()) {
            return redirect()->route('users')->with('success', 'Usuário atualizado com sucesso!');
        }

        return redirect()->route('dashboard')->with('success', 'Dados atualizados com sucesso!');
    }

    public function destroy(User $user)
    {
        if (!$user) {
            return redirect()->route('users')->with('error', 'Usuário não encontrado!');
        }

        $user->delete();

        return redirect()->route('users')->with('success', 'Usuário deletado com sucesso!');
    }
}
