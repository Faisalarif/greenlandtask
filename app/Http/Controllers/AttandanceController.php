<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TeachersModel as TM;

use App\MarkeAttandanceModel as AttandanceModel;


class AttandanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teachers_ = TM::all();
        
        // $teachers_ = DB::table('teachers')
        // ->select('teachers.id','teachers.first_name','teachers.second_name','teachers.email','teachers.qualification','classes.title')
        // ->leftjoin('assign_classesto_teachers','assign_classesto_teachers.teacher_id','=','teachers.id')
        // ->leftjoin('classes','classes.id','=','assign_classesto_teachers.class_id')
        // ->get();

        return view('attandence.index')->with('teachers_data' , $teachers_);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function markeAttandance(Request $request)
    {
        // \Log::info($request);


        try {
            
                $teacher_ids = $request->input('teachers_id');
                $attandace_date = $request->input('attandance_date');
                
                
                $selected_date = strtotime($attandace_date);

                $selected_date = date('Y-m-d',$selected_date);

                foreach ($teacher_ids as $key => $value) {


                    $matchThese = ['teacher_id' => $value, 'date' => $selected_date];

                    $results = AttandanceModel::where($matchThese)->get();

                    if(count($results) == 0){

                         //model for attandance
                    $attandance = new AttandanceModel;

                    $attandance->teacher_id = $value;
                    $attandance->date = $selected_date;
                    $attandance->attandance = 1;
                    $attandance->admin_id = 0;
                    $attandance->save();
                       

                    }

                    $results = [];
                    
                   
                }    

                
                
                return response()->json(['success'=>'saved']);


        } catch (\Throwable $th) {
            //throw $th;

        return response()->json(['success'=>$th->getMessage()]);

        } 

   
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getTeacherAttandance($id){

        
       $rec = AttandanceModel::orderBy('updated_at', 'desc')->where('teacher_id',$id)->offset(0)->limit(10)->get('date');

       $rec_arr = array();


        foreach ($rec as $value) {
            $rec_arr[] =  $value->date;
        }



 
       return View('teachers.viewattandance')->with('attandance_record',$rec_arr);
    }
}
