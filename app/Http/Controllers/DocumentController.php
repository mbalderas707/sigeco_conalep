<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Company;
use App\Models\Document;
use App\Models\Tag;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $tags = Tag::all();
        $companies = Company::all();
        return view('documents.create', ['tags' => $tags, 'companies' => $companies]);
    }

    public function store(StoreDocumentRequest $request)
    {
        $document = Document::make($request->validated());
        $document->status_id = 1;
        $document->user_id = auth()->user()->id;
        $document->profile_id = 1;
        $document->save();
        $tags = $request->safe()->only('tags');
        foreach ($tags as $tag) {
            $document->tags()->attach($tag);
        }
        $senders=$request->safe()->only('senders');
        foreach($senders as $sender){
            $document->senders()->attach($sender);
        }
        return redirect()->route('documents.index')->withSuccess('El documento se ha almacenado exitosamente.');
    }

    public function edit(Document $document)
    {
        return view('documents.edit')->with(['document' => $document]);
    }

    public function update(UpdateDocumentRequest $request, Document $document)
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
        return view('documents.index')->with(['documents' => Document::currentProfile()->get()]);


    }

    public function show(Document $document)
    {
        return view('documents.show')->with(['document' => $document]);
    }
}
