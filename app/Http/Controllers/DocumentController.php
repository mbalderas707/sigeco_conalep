<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function create()
    {
        return view('documents.create');
    }

    public function store(StoreDocumentRequest $request)
    {
        $document = Document::create($request->validated());

        return redirect()->route('documents.index')->withSuccess('El documento se ha almacenado exitosamente.');
    }

    public function edit(Document $document)
    {
        return view('documents.edit')->with(['document' => $document]);
    }

    public function update(UpdateDocumentRequest $request,Document $document)
    {
        $document->update($request->validated());

        return redirect()->route('documents.index')->withSuccess('El documento se ha actualizado exitosamente.');
    }

    public function destroy($document)
    {
        $document = Document::findOrFail($document);
        $document->delete();
        return redirect()->route('documents.index')->withSuccess('El documento se ha eliminado exitosamente.');
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
