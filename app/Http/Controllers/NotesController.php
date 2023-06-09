<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('owner')->only(['show', 'edit', 'destroy']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Auth::user()->notes);
        $notes = Note::where('user_id', Auth::user()->id)->get();
        $others = Auth::user()->shared;
        $notes = $notes->merge($others);
        return view('notes.index', compact(['notes']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $isEdit = false;
        return view('notes.create-edit', compact(['isEdit']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $request->validate(
            [
                "title"=>"required|min:4|unique:notes,title",
                "description"=>"required|min:8",
            ]
        );

        $note = new Note();
        $note->title = $request->title;
        $note->description = $request->description;
        $note->user_id = Auth::user()->id;
        $note->save();

        $note->shared()->attach($request->share);


        return redirect(route('notes.show', $note->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        // return $note;
        return view('notes.show', compact(['note']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        $isEdit = true;
        return view('notes.create-edit', compact(['isEdit','note']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $request->validate(
            [
                "title"=>"required",
                "description"=>"required",
            ]
        );

        $note->title = $request->title;
        $note->description = $request->description;
        $note->user_id = Auth::user()->id;
        $note->update();

        $note->shared()->detach();
        $note->shared()->attach($request->share);

        return redirect(route('notes.show', $note->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        // dd($note); // to see the var dump we use dd function
        $note->delete();
        return redirect(route('home'));
    }
}
