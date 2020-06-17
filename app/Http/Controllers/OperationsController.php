<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeachersModel as TM;
use App\Classes as ClsM;
use App\AssignClassesTeachers as assignedModel;
use Illuminate\Support\Facades\DB;


class OperationsController extends Controller
{

    public function delete(Request $request)
    {
        //
        
        try {
                
                $teacher = TM::find($request->id);  
                $teacher->delete();
            return response()->json(['success'=>'deleted']);
               
    } catch (\Throwable $th) {
        //throw $th;

    return response()->json(['success'=>$th->getMessage()]);

    } 
    }

}