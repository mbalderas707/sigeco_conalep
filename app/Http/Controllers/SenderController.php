<?php

namespace App\Http\Controllers;

use App\Models\Sender;
use App\Http\Requests\StoreSenderRequest;
use App\Http\Requests\UpdateSenderRequest;
use App\Models\Company;

class SenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('senders.index')->with(['senders'=>Sender::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('senders.create')->with(['companies'=>Company::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSenderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSenderRequest $request)
    {
        $position = Sender::create($request->validated());
        return redirect()->route('senders.index')->withSuccess('El remitente se ha almacenado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sender  $sender
     * @return \Illuminate\Http\Response
     */
    public function show(Sender $sender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sender  $sender
     * @return \Illuminate\Http\Response
     */
    public function edit(Sender $sender)
    {

        return view('senders.edit')->with(['sender' => $sender, 'companies' => Company::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSenderRequest  $request
     * @param  \App\Models\Sender  $sender
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSenderRequest $request, Sender $sender)
    {
        $sender->update($request->validated());
        return redirect()->route('senders.index')->withSuccess('El remitente se ha actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sender  $sender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sender $sender)
    {
        //
    }
}
