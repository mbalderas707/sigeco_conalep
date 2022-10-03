<?php

namespace App\Http\Controllers;

use App\Models\Turn;
use App\Http\Requests\StoreTurnRequest;
use App\Http\Requests\UpdateTurnRequest;
use App\Models\Department;
use App\Models\Document;
use App\Models\Instruction;
use App\Models\Position;
use App\Models\Profile;
use Illuminate\Http\Request;

class TurnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $document=Document::find($request->get('document'));
        $positions = Position::all();
        $departments = Department::all();
        $instructions= Instruction::all();


        return view('turns.create')->with(['document'=>$document,'positions'=>$positions, 'departments'=>$departments, 'instructions'=>$instructions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTurnRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTurnRequest $request)
    {
        $document = Document::find($request->get('document_id'));
        $turn= Turn::make($request->validated());
        $turn->concluded=false;
        $turn->user_id = auth()->user()->id;
        $turn->save();
        $turn->profiles()->attach($request->get('profiles'));

        return redirect()->route('documents.show', $document)->withSuccess('El Turno se ha realizado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Turn  $turn
     * @return \Illuminate\Http\Response
     */
    public function show(Turn $turn)
    {
        return view('turns.show')->with(['turn' => $turn]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Turn  $turn
     * @return \Illuminate\Http\Response
     */
    public function edit(Turn $turn)
    {
        $departments = Department::all();
        $positions=Position::all();
        $instructions= Instruction::all();

        return view('turns.edit')->with(['turn'=> $turn,'departments'=>$departments,'positions'=>$positions,'instructions'=>$instructions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTurnRequest  $request
     * @param  \App\Models\Turn  $turn
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTurnRequest $request, Turn $turn)
    {
        $turn->update($request->validated());
        $turn->profiles()->sync($request->profiles);

        return redirect()->route('turns.show', $turn)->withSuccess('El Turno se ha actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Turn  $turn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turn $turn)
    {
        //
    }
}
