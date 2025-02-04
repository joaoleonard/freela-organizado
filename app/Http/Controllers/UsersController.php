<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
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

        $users = User::query()->where('id', '!=', auth()->user()->id)->get();

        return view('users.index', compact('users'));
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

    public function show($id)
    {

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users')->with('error', 'Usuário não encontrado!');
        }

        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

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

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users')->with('error', 'Usuário não encontrado!');
        }

        $user->delete();

        return redirect()->route('users')->with('success', 'Usuário deletado com sucesso!');
    }
}
