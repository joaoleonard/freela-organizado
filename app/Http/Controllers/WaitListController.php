<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMusicianWaitlistRequest;
use App\Http\Requests\EditMusicianWaitlistStatusRequest;
use App\Models\MusicianWaitlist;
use Illuminate\Validation\ValidationException;

class WaitListController extends Controller
{
    public function index()
    {
        $waitlist = MusicianWaitlist::all();

        return view('waitlist.index', compact('waitlist'));
    }

    public function show(MusicianWaitlist $musicianWaitlist)
    {
        if ($musicianWaitlist->status === 'pending') {
            $musicianWaitlist->status = 'viewed';
        }

        $musicianWaitlist->save();

        return view('waitlist.show', ['user' => $musicianWaitlist]);
    }

    public function create()
    {
        return view('waitlist.join-waitinglist');
    }

    public function store(CreateMusicianWaitlistRequest $request)
    {
        try {
            $data = $request->validated();

            MusicianWaitlist::create($data);

            return view('waitlist.join-waitinglist-success', ['user_name' => $data['name']]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function update(EditMusicianWaitlistStatusRequest $request, MusicianWaitlist $musicianWaitlist)
    {
        $data = $request->validated();

        $musicianWaitlist->status = $data['status'];
        $musicianWaitlist->save();

        return redirect()->back()->with(['success' => 'Status atualizado com sucesso!']);
    }

    public function destroy(MusicianWaitlist $musicianWaitlist)
    {
        $musicianWaitlist->delete();

        return redirect()->route('waitlist')->with(['success' => 'Músico removido com sucesso!']);
    }
}
