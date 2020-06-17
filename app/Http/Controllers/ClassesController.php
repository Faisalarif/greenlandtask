<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Classes as ClsM;


class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get classes list
        $classes_list = ClsM::all();
        return view('classes.index')->with('classes_data',$classes_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('classes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            "title" => 'required'
        ]);

        //get class model object
        $class = new ClsM;

        $class->title = $request->input('title');
        $class->save();

        return redirect('/classes')->with('success','Class Created');
        
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

         $class_data = ClsM::find($id);

         return view('classes.edit')->with('class_data',$class_data);
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
         //
         $this->validate($request,[
            "title" => 'required'
        ]);

        //get class model object
        $class =  ClsM::find($id);

        $class->title = $request->input('title');
        $class->save();

        return redirect('/classes')->with('success','Class Updated');
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
    }
}
