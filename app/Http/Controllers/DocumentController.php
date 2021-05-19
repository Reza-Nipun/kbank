<?php

namespace App\Http\Controllers;

use App\Department;
use App\DocumentDepartment;
use App\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $categories = Category::where('status', 1)->get();
        $applicabilities = Applicability::where('status', 1)->get();
        $document_types = DocumentType::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        $reference_nos = Document::groupBy('reference_code')->get();

        $documents = DB::select("SELECT t1.*, t2.category_name, t3.applicability_name, t4.document_type_name, t5.document_departments 
                    FROM 
                    (SELECT *, MAX(id) AS max_id, MAX(version) as max_version 
                    FROM documents 
                    GROUP BY reference_code, category_id, applicability_id, document_type_id) AS t1
                    
                    INNER JOIN
                    categories AS t2
                    ON t1.category_id=t2.id
                    
                    INNER JOIN
                    applicabilities AS t3
                    ON t1.applicability_id=t3.id
                    
                    INNER JOIN
                    document_types AS t4
                    ON t1.document_type_id=t4.id
                    
                    INNER JOIN 
                    (SELECT A.document_id, GROUP_CONCAT(B.department_name SEPARATOR ', ') AS document_departments
                    FROM `document_departments` AS A

                    LEFT JOIN
                    departments AS B
                    ON A.department_id=B.id
                    
                    GROUP BY A.document_id) AS t5
                    
                    ON t1.id=t5.document_id");

        return view('document_list', compact('new_requests_count', 'documents', 'categories', 'applicabilities', 'document_types', 'reference_nos', 'departments'));
    }

    public  function getFilteredDocuments(Request $request){
        $subject = $request->subject;
        $category = $request->category;
        $applicability = $request->applicability;
        $document_type = $request->document_type;
        $reference_code = $request->reference_code;
        $departments = $request->departments;

        $where = "";
        $where_1 = "";

        if($subject <> ""){
            $where .= " AND subject LIKE '%$subject%'";
        }

        if($category <> ""){
            $where .= " AND category_id = '$category'";
        }

        if($applicability <> ""){
            $where .= " AND applicability_id = '$applicability'";
        }

        if($document_type <> ""){
            $where .= " AND document_type_id = '$document_type'";
        }

        if($reference_code <> ""){
            $where .= " AND reference_code = '$reference_code'";
        }

        if(!empty($departments) && sizeof($departments) > 0){
            $departments_comma_separated = "'" . implode ( "', '", $departments ) . "'";
            $where_1 .= " AND A.department_id IN ($departments_comma_separated)";
        }

        $documents = DB::select("SELECT t1.*, t2.category_name, t3.applicability_name, t4.document_type_name, t5.document_departments 
                    FROM 
                    (SELECT *, MAX(id) AS max_id, MAX(version) as max_version 
                    FROM documents 
                    WHERE 1 $where
                    GROUP BY reference_code, category_id, applicability_id, document_type_id) AS t1
                    
                    INNER JOIN
                    categories AS t2
                    ON t1.category_id=t2.id
                    
                    INNER JOIN
                    applicabilities AS t3
                    ON t1.applicability_id=t3.id
                    
                    INNER JOIN
                    document_types AS t4
                    ON t1.document_type_id=t4.id
                    
                    
                    INNER JOIN 
                    (SELECT A.document_id, GROUP_CONCAT(B.department_name SEPARATOR ', ') AS document_departments
                    FROM `document_departments` AS A

                    INNER JOIN
                    departments AS B
                    ON A.department_id=B.id
                    
                    WHERE 1 $where_1
                    
                    GROUP BY A.document_id) AS t5
                    
                    ON t1.id=t5.document_id");

        $new_row = '';

        if(Auth::user()->access_level == 0){
            foreach ($documents AS $k => $d){
                $new_row .= '<tr>';
                $new_row .= '<td class="text-center">'.($k+1).'</td>';
                $new_row .= '<td class="text-center">'.$d->subject.'</td>';
                $new_row .= '<td class="text-center">'.$d->category_name.'</td>';
                $new_row .= '<td class="text-center">'.$d->applicability_name.'</td>';
                $new_row .= '<td class="text-center">'.$d->document_departments.'</td>';
                $new_row .= '<td class="text-center">'.$d->document_type_name.'</td>';
                $new_row .= '<td class="text-center">'.$d->reference_code.'</td>';
                $new_row .= '<td class="text-center">'.$d->max_version.'</td>';
                $new_row .= '<td class="text-center">'.$d->remarks.'</td>';
                $new_row .= '<td class="text-center">
                            <a class="btn btn-sm btn-primary" href="'.url('/view_document/'.$d->max_id).'" target="_blank" title="VIEW">
                                <i class="fa fa-eye"></i>
                            </a>
                            
                            <a class="btn btn-sm btn-secondary" target="_blank" href="'.asset('storage/app/public/uploads/'.$d->document_url).'" title="DETAIL LIST">
                                <i class="fa fa-download"></i>
                            </a>
                            
                            <a class="btn btn-sm btn-warning" href="'.url('/document_detail_list/'.$d->reference_code.'/'.$d->category_id).'" title="DETAIL LIST">
                                <i class="fa fa-list"></i>
                            </a>
                        </td>';
                $new_row .= '</tr>';
            }
        }else{
            foreach ($documents AS $k => $d){
                $new_row .= '<tr>';
                $new_row .= '<td class="text-center">'.($k+1).'</td>';
                $new_row .= '<td class="text-center">'.$d->subject.'</td>';
                $new_row .= '<td class="text-center">'.$d->category_name.'</td>';
                $new_row .= '<td class="text-center">'.$d->applicability_name.'</td>';
                $new_row .= '<td class="text-center">'.$d->document_departments.'</td>';
                $new_row .= '<td class="text-center">'.$d->document_type_name.'</td>';
                $new_row .= '<td class="text-center">'.$d->reference_code.'</td>';
                $new_row .= '<td class="text-center">'.$d->max_version.'</td>';
                $new_row .= '<td class="text-center">'.$d->remarks.'</td>';
                $new_row .= '<td class="text-center">
                            <a class="btn btn-sm btn-primary" href="'.url('/view_document/'.$d->max_id).'" target="_blank" title="VIEW">
                                <i class="fa fa-eye"></i>
                            </a>
                            
                            <a class="btn btn-sm btn-warning" href="'.url('/document_detail_list/'.$d->reference_code.'/'.$d->category_id).'" title="DETAIL LIST">
                                <i class="fa fa-list"></i>
                            </a>
                        </td>';
                $new_row .= '</tr>';
            }
        }

        return $new_row;

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

        echo asset('storage/app/public/uploads/'.$file_name);

    }

    public function getDocumentDetailList($reference_code, $category_id){
        $new_requests = User::where('status', 2)->get();
        $new_requests_count = $new_requests->count();

        $documents = DB::select("SELECT t1.*, t2.category_name, t3.applicability_name, t4.document_type_name, t5.document_departments
                    FROM 
                    (SELECT *
                    FROM documents 
                    WHERE reference_code='$reference_code' AND category_id='$category_id') AS t1
                    
                    INNER JOIN
                    categories AS t2
                    ON t1.category_id=t2.id
                    
                    INNER JOIN
                    applicabilities AS t3
                    ON t1.applicability_id=t3.id
                    
                    INNER JOIN
                    document_types AS t4
                    ON t1.document_type_id=t4.id
                    
                    INNER JOIN 
                    (SELECT A.document_id, GROUP_CONCAT(B.department_name SEPARATOR ', ') AS document_departments
                    FROM `document_departments` AS A

                    INNER JOIN
                    departments AS B
                    ON A.department_id=B.id
                    
                    GROUP BY A.document_id) AS t5
                    
                    ON t1.id=t5.document_id");

        return view('document_detail_list', compact('documents', 'new_requests_count'));
    }

    public function deleteDocumentById($id){
        $document_info = Document::find($id);
        $file_name = $document_info->document_url;

        Storage::delete('public/uploads/' . $file_name);

        $document_info->delete();

        return redirect()->back();
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
        $departments = Department::where('status', 1)->get();

        return view('add_new_document', compact('new_requests_count', 'categories', 'applicabilities', 'document_types', 'departments'));
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
            'departments' => 'required',
        ]);

        $category = $request->category;
        $applicability = $request->applicability;
        $applicability_short_name = $request->applicability_short_name;
        $document_type = $request->document_type;
        $document_type_short_name = $request->document_type_short_name;
        $file = $request->file('file');
        $remarks = $request->remarks;
        $departments = $request->departments;

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
            $file_name_with_extension = $reference_code.'-'.$category.'-'.$version.'.'.$file_extension;
//            echo 'File Rename Name: '.$file_name;

            //Move Uploaded File
            $destinationPath = 'storage/app/public/uploads';
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

            $document_id = $document->id;


            foreach ($departments as $dp){

                $document_department = new DocumentDepartment();
                $document_department->document_id = $document_id;
                $document_department->department_id = $dp;
                $document_department->save();

            }

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
