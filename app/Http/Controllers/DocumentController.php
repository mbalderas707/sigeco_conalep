<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Company;
use App\Models\Document;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $document->tags()->attach($request->tags);
        $document->senders()->attach($request->senders);
        foreach ($request->pdfs as $pdf) {
            $document->files()->create(['name' => $pdf->getClientOriginalName(), 'path' => $pdf->store($document->id, 'pdfs')]);
        }


        return redirect()->route('documents.show', $document)->withSuccess('El documento se ha almacenado exitosamente.');
    }

    public function edit(Document $document)
    {
        $tags = Tag::all();
        $companies = Company::all();
        return view('documents.edit')->with(['document' => $document, 'tags' => $tags, 'companies' => $companies]);
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
        $document->update($request->validated());
        $document->senders()->sync($request->senders);
        $document->tags()->sync($request->tags);

        if ($request->hasFile('pdfs')) {
            foreach ($request->pdfs as $pdf) {
                $document->files()->create(['name' => $pdf->getClientOriginalName(), 'path' => $pdf->store($document->id, 'pdfs')]);
            }
        }

        return redirect()->route('documents.show', $document)->withSuccess('El documento se ha actualizado exitosamente.');
    }

    public function destroy(Document $document)
    {
        foreach ($document->files as $file) {
            Storage::disk('pdfs')->delete($file->path);
            $file->delete();
        }

        $document->delete();
        return redirect()->route('documents.index')->withSuccess('El documento se ha eliminado exitosamente.');
    }

    public function index()
    {
        //return view('documents.index')->with(['documents' => Document::currentProfile()->get()]);
        return view('documents.index')->with(['documents' => Document::paginate(10)]);
    }

    public function show(Document $document)
    {
        return view('documents.show')->with(['document' => $document]);
    }
}
