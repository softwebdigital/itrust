<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    public function index()
    {
        $users = User::query()->orderBy('email')->get();
        $documents = Document::query()->latest()->get();
        return view('admin.documents', compact('documents', 'users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
            'file' => 'required|file|mimes:pdf,doc,xls,xlsx,csv'
        ]);
        if ($validator->fails()) return back()->with(['validation' => true, 'error' => 'Validation error'])->withInput()->withErrors($validator);

        $document = new Document;
        $document['user_id'] = $request['user'];
        $document['type'] = $request['type'];
        $document['title'] = $request['title'];
        $document['description'] = $request['description'];

        if ($file = $request->file('file')) {
            $document['filename'] = $file->getClientOriginalName();
            $document['filesize'] = $file->getSize();
            $document['file'] = $file->move('files/'.$request['type'], time().mt_rand(100, 999).'.'.$file->getClientOriginalExtension());
        }

        if ($document->save()) return back()->with('success', 'Document Saved');
        return back()->with('error', 'Could not upload document, try again.');
    }

    public function update(Request $request, Document $document): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
            'file' => 'sometimes|file|mimes:pdf,doc,xls,xlsx,csv'
        ]);
        if ($validator->fails()) return back()->with(['edit_validation' => true, 'error' => 'Validation error'])->withInput()->withErrors($validator);

        $document['type'] = $request['type'];
        $document['user_id'] = $request['user'];
        $document['description'] = $request['description'];
        $document['title'] = $request['title'];

        if ($file = $request->file('file')) {
            $oldFile = $document['file'];
            $document['filesize'] = $file->getSize();
            $document['filename'] = $file->getClientOriginalName();
            $document['file'] = $file->move('files/'.$request['type'], time().mt_rand(100, 999).'.'.$file->getClientOriginalExtension());
        } else $oldFile = null;

        if ($document->update()) {
            if ($oldFile) unlink($oldFile);
            return back()->with('success', 'Document updated');
        }
        return back()->with('error', 'Could not upload document, try again.');
    }

    public function destroy(Document $document): RedirectResponse
    {
        if ($document->delete())
            return back()->with('success', 'Document deleted');
        return back()->with('error', 'Unable to delete document, try again');
    }
}
