<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeachersModel as TM;
use App\Classes as ClsM;
use App\AssignClassesTeachers as assignedModel;
use Illuminate\Support\Facades\DB;


class TeachersController extends Controller
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

        return view('teachers.index')->with('teachers_data' , $teachers_);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //validat the reuiired fields
        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'qualification'=> 'required'
        ]);

        //teachers model
        $teacherModel = new TM;


        // asslign from filds to model object 
        $teacherModel->first_name = $request->input('first_name');
        $teacherModel->second_name = $request->input('last_name');
        $teacherModel->email = $request->input('email');
        $teacherModel->qualification = $request->input('qualification');
        $teacherModel->save();

        return redirect('/teachers')->with('success','Teacher Created');

    }

  /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assignClass($id)
    {
        //getClasses
        $classes_list = ClsM::all();
        $teacher_name = TM::find($id)->first_name;
        $assigned_class_list = assignedModel::where('teacher_id',$id)->get('class_id');

        $assigned_Array = array();


        foreach ($assigned_class_list as $value) {
            $assigned_Array[] =  $value->class_id;
        }


        
        $classes_data = [
            "teacher_id" => $id,
            "teacher_name" => $teacher_name,
            "class_list" =>  $classes_list,
            "assigned_classes" => $assigned_Array
        ];

        return view('teachers.assignClass')->with('data',$classes_data);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignClasses(Request $request)
    {

        // //teachers model
        $assignedModel = new assignedModel;

        // $cls_ids = array();

        $cls_ids = $request->assgin_classes; 

        $teacher_id = $request->teacher_id;

        if(is_null($cls_ids) || empty($cls_ids)){

            return redirect('/teachers/assignClass/'.$teacher_id)->with('warning','No Class Selected');

        }else {

            //deleting assinged clases
            assignedModel::where('teacher_id',$teacher_id)->delete();
        
     
            //assigning again
            for ($i=0; count($cls_ids) > $i;  $i++) { 
                
                //teachers model
                $assignedModel_ = new assignedModel;

                $assignedModel_->class_id = $cls_ids[$i];
                $assignedModel_->teacher_id = $teacher_id;
                $assignedModel_->save();
            }


            return redirect('/teachers')->with('success','Classes Assigned');
        }
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $teacher_info = TM::find($id);

        $teachers_ = DB::table('assign_classesto_teachers')
        ->select('classes.title')
        ->leftjoin('classes','classes.id','=','assign_classesto_teachers.class_id','and','assign_classesto_teachers.teacher_id', '=', $teacher_info->id)
        ->where('assign_classesto_teachers.teacher_id', '=' , $teacher_info->id)
        ->get();

        $teacher_data = [
            "teacher_info" => $teacher_info,
            "assigned_classes" => $teachers_
        ];

        return view('teachers.show')->with('teacher_data',$teacher_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $teacher_data = TM::find($id);

        return view('teachers.edit')->with('teacher_data',$teacher_data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //validat the reuiired fields
         $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'qualification'=> 'required'
        ]);

        //teachers model
        $teacherModel =  TM::find($id);


        // asslign from filds to model object 
        $teacherModel->first_name = $request->input('first_name');
        $teacherModel->second_name = $request->input('last_name');
        $teacherModel->email = $request->input('email');
        $teacherModel->qualification = $request->input('qualification');
        $teacherModel->save();

        return redirect('/teachers')->with('success','Teacher Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        try {
                $teacher = TM::find($id);  
                $teacher->delete();
            return response()->json(['success'=>'deleted']);
               
    } catch (\Throwable $th) {
        //throw $th;

    return response()->json(['success'=>$th->getMessage()]);

    } 
    }


   
   
}
