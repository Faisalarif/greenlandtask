@extends('layouts.app') @section('content')

<div class="row">
    <div class="col-md-12">
        {{ Breadcrumbs::render('classes') }}
        <h1>Create Teacher</h1>
    </div>
    <div class="col-md-6 col-sm-12">
        {{ Form::open(array('action' => 'ClassesController@store', 'method' => 'POST')) }}

        <div class="form-group">
            {{Form::label('title','Title*') }}
            {{Form::text('title','',['class'=> 'form-control', 'placeholder' => 'Class Name, eg: Standard One', 'required'=>'required']) }}
        </div>

        {{Form::submit('submit',['class'=>'btn btn-primary'])}}

        {!! Form::close() !!}
    </div>
</div>

@endsection
