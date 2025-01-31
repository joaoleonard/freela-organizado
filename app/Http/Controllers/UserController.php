<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;

class UserController extends Controller
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
