<?php

namespace App\Http\Controllers;

use App\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Applicability;
use App\Document;
use App\User;
use App\Category;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
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
        $new_requests = User::where('status', 2)->get();
        $new_requests_count = $new_requests->count();

//        $documents = DB::table('documents')
//                    ->select('*', DB::raw('MAX(version) as max_version'))
//                    ->groupBy('subject', 'reference_code', 'category_id', 'applicability_id', 'document_type_id')
//                    ->get();

        $documents = DB::select("SELECT t1.*, t2.category_name, t3.applicability_name, t4.document_type_name 
                    FROM 
                    (SELECT *, MAX(id) AS max_id, MAX(version) as max_version 
                    FROM documents 
                    GROUP BY reference_code, category_id, applicability_id, document_type_id) AS t1
                    
                    LEFT JOIN
                    categories AS t2
                    ON t1.category_id=t2.id
                    
                    LEFT JOIN
                    applicabilities AS t3
                    ON t1.applicability_id=t3.id
                    
                    LEFT JOIN
                    document_types AS t4
                    ON t1.document_type_id=t4.id");

        return view('document_list', compact('new_requests_count', 'documents'));
    }

    public function viewDocument($id){
//        $file_name = 'test_pdf.pdf';

//        $document_info = Document::find($id);
//        $file_name = $document_info->document_url;

        return view('view_document', compact('id'));
    }

    public function getDocumentInfoById(Request $request){

        $document_id = $request->document_id;

        $document_info = Document::find($document_id);
        $file_name = $document_info->document_url;

        echo asset('storage/uploads/'.$file_name);

    }

    public function getDocumentDetailList($reference_code){
        $documents = DB::select("SELECT t1.*, t2.category_name, t3.applicability_name, t4.document_type_name 
                    FROM 
                    (SELECT *
                    FROM documents 
                    WHERE reference_code='$reference_code') AS t1
                    
                    LEFT JOIN
                    categories AS t2
                    ON t1.category_id=t2.id
                    
                    LEFT JOIN
                    applicabilities AS t3
                    ON t1.applicability_id=t3.id
                    
                    LEFT JOIN
                    document_types AS t4
                    ON t1.document_type_id=t4.id");

        return view('document_detail_list', compact('documents'));
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

        $categories = Category::where('status', 1)->get();
        $applicabilities = Applicability::where('status', 1)->get();
        $document_types = DocumentType::where('status', 1)->get();

        return view('add_new_document', compact('new_requests_count', 'categories', 'applicabilities', 'document_types'));
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
            'category' => 'required',
            'applicability' => 'required',
            'document_type' => 'required',
            'file' => 'required|mimes:pdf',
        ]);

        $category = $request->category;
        $applicability = $request->applicability;
        $applicability_short_name = $request->applicability_short_name;
        $document_type = $request->document_type;
        $document_type_short_name = $request->document_type_short_name;
        $file = $request->file('file');
        $remarks = $request->remarks;

        $file_name = basename($request->file('file')->getClientOriginalName(), '.'.$request->file('file')->getClientOriginalExtension());

        if($file_name != '' && $applicability_short_name != '' && $document_type_short_name != ''){
            //Display File Original Name
//            $file_name_with_extension = $file->getClientOriginalName();

            $document_info = DB::select("SELECT MAX(reference_no) AS max_referece_no, MAX(version) AS max_version FROM documents
                             WHERE category_id=$category AND applicability_id=$applicability AND document_type_id=$document_type
                             AND subject='$file_name'");

            $reference_no = 0;
            if($document_info[0]->max_referece_no <> ''){
                $reference_no = ($document_info[0]->max_referece_no == '' ? $reference_no + 1 : $document_info[0]->max_referece_no);
            }else{
                $document_info_1 = DB::select("SELECT MAX(reference_no) AS max_referece_no, MAX(version) AS max_version FROM documents
                             WHERE category_id=$category AND applicability_id=$applicability AND document_type_id=$document_type");

                $reference_no = ($document_info_1[0]->max_referece_no <> '' ? $document_info_1[0]->max_referece_no + 1 : $reference_no+1);
            }



            $version = ($document_info[0]->max_version != '' ? $document_info[0]->max_version : 0) + 1;

            $reference_code = $applicability_short_name.'-'.$document_type_short_name.'-'.$reference_no;

            //Display File Extension
            $file_extension = $file->getClientOriginalExtension();

            //Renamed File Name
            $file_name_with_extension = $reference_code.'-'.$version.'.'.$file_extension;
//            echo 'File Rename Name: '.$file_name;

            //Move Uploaded File
            $destinationPath = 'storage/uploads';
            $file->move($destinationPath,$file_name_with_extension);

            $document = new Document();
            $document->reference_no = $reference_no;
            $document->reference_code = $reference_code;
            $document->subject = $file_name;
            $document->version = $version;
            $document->document_url = $file_name_with_extension;
            $document->category_id = $category;
            $document->applicability_id = $applicability;
            $document->document_type_id = $document_type;
            $document->uploaded_by = Auth::user()->id;
            $document->remarks = $remarks;
            $document->save();

            \Session::flash('message', 'Successfully Uploaded!');

            return redirect()->back();

        }else{
            \Session::flash('failed_msg', 'Invalid Request! Try Again Please.');

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
