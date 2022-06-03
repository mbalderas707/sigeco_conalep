<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function create()
    {
        return view('documents.create');
    }

    public function store()
    {
        $document = Document::create(request()->all());

        return redirect(route('documents.index'));
    }

    public function edit($document)
    {
        return view('documents.edit')->with(['document' => Document::findOrFail($document)]);
    }

    public function update($document)
    {
        $document = Document::findOrFail($document);

        $document->update(request()->all());

        return redirect(route('documents.index'));
    }

    public function destroy($document)
    {
        $document = Document::findOrFail($document);
        $document->delete();
        return redirect(route('documents.index'));
    }

    public function index()
    {
        return view('documents.index')->with(['documents' => Document::all()]);
    }

    public function show($document)
    {
        return view('documents.show')->with(['document' => Document::findOrFail($document)]);
    }
}
