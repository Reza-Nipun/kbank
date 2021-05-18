<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Applicability;
use App\Category;
use App\Department;
use App\DocumentType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(){

    }

    public function getDepartments($token=null){

        if($token == 'base64:2KaPiyfhZjmv4jBupIucIwetufCu+N3a9K6jGHCc2E='){
            $departments = Department::where('status', 1)->get();

            $response_data = [
                'message' => 'Success',
                'data' => $departments
            ];

            return response()->json($response_data, 200);
        }else{

            $response_data = [
                'message' => 'Unauthorized',
                'data' => 'No Data Found'
            ];

            return response()->json($response_data, 401);
        }

    }

    public function getCategories($token=null){

        if($token == 'base64:2KaPiyfhZjmv4jBupIucIwetufCu+N3a9K6jGHCc2E='){
            $categories = Category::where('status', 1)->get();

            $response_data = [
                'message' => 'Success',
                'data' => $categories
            ];

            return response()->json($response_data, 200);
        }else{

            $response_data = [
                'message' => 'Unauthorized',
                'data' => 'No Data Found'
            ];

            return response()->json($response_data, 401);
        }

    }

    public function getApplicabilityList($token=null){

        if($token == 'base64:2KaPiyfhZjmv4jBupIucIwetufCu+N3a9K6jGHCc2E='){
            $applicability_list = Applicability::where('status', 1)->get();

            $response_data = [
                'message' => 'Success',
                'data' => $applicability_list
            ];

            return response()->json($response_data, 200);
        }else{

            $response_data = [
                'message' => 'Unauthorized',
                'data' => 'No Data Found'
            ];

            return response()->json($response_data, 401);
        }

    }

    public function getDocumentTypes($token=null){

        if($token == 'base64:2KaPiyfhZjmv4jBupIucIwetufCu+N3a9K6jGHCc2E='){
            $document_types = DocumentType::where('status', 1)->get();

            $response_data = [
                'message' => 'Success',
                'data' => $document_types
            ];

            return response()->json($response_data, 200);
        }else{

            $response_data = [
                'message' => 'Unauthorized',
                'data' => 'No Data Found'
            ];

            return response()->json($response_data, 401);
        }

    }

    public function getFilteredDocuments($token=null, $subject=null, $category=null, $applicability=null, $document_type=null, $department=null){

//        var_dump($token, $subject, $category);
//        die();

        if($token == 'base64:2KaPiyfhZjmv4jBupIucIwetufCu+N3a9K6jGHCc2E='){

            $where = "";
            $where_1 = "";

            if($subject <> "" && $subject <> 'null'){
                $where .= " AND subject LIKE '%$subject%'";
            }

            if($category <> "" && $category <> 'null'){
                $where .= " AND category_id = '$category'";
            }

            if($applicability <> "" && $applicability <> 'null'){
                $where .= " AND applicability_id = '$applicability'";
            }

            if($document_type <> "" && $document_type <> 'null'){
                $where .= " AND document_type_id = '$document_type'";
            }

            if($department != "" && $department <> 'null'){
                $where_1 .= " AND A.department_id = '$department'";
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

            $response_data = [
                'message' => 'Success',
                'data' => $documents
            ];

            return response()->json($response_data, 200);
        }else{

            $response_data = [
                'message' => 'Unauthorized',
                'data' => 'No Data Found'
            ];

            return response()->json($response_data, 401);
        }

    }

}
