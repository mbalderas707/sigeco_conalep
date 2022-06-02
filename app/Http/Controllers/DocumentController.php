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

    public function destroy($document)
    {
        $document = Document::findOrFail($document);
        $document->delete();
        return $document;
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
