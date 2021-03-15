<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DocumentType;
use App\User;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $document_type_list = DocumentType::all();

        $new_requests = User::where('status', 2)->get();
        $new_requests_count = $new_requests->count();

        return view('document_type_list', compact('new_requests_count'))->with(['document_type_list'=>$document_type_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $new_requests = User::where('status', 2)->get();
        $new_requests_count = $new_requests->count();

        return view('add_document_type', compact('new_requests_count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'document_type_name' => 'required',
            'status' => 'required',
        ]);

        $document_type = new DocumentType();
        $document_type->document_type_name = $request->document_type_name;
        $document_type->document_type_description = $request->document_type_description;
        $document_type->status = $request->status;
        $document_type->save();

        \Session::flash('message', 'Successfully Saved!');

        return redirect('/document_type_list');
    }

    public function editDocumentType($id){
        $document_type_info = DocumentType::find($id);

        $new_requests = User::where('status', 2)->get();
        $new_requests_count = $new_requests->count();

        return view('edit_document_type', compact('new_requests_count'))->with(['document_type_info'=>$document_type_info]);
    }

    public function updateDocumentType(Request $request, $id){
        $this->validate(request(), [
            'document_type_name' => 'required',
            'status' => 'required',
        ]);

        $category_info = DocumentType::find($id);
        $category_info->document_type_name = $request->document_type_name;
        $category_info->document_type_description = $request->document_type_description;
        $category_info->status = $request->status;
        $category_info->save();

        \Session::flash('message', 'Successfully Updated!');

        return redirect('/document_type_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentType $documentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentType $documentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentType $documentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentType $documentType)
    {
        //
    }
}
