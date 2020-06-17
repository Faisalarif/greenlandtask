@extends('layouts.app') @section('content')

<div class="row">
    <div class="col-md-12">
        {{ Breadcrumbs::render('classes') }}

        <h1>Update Class</h1>
    </div>
    <div class="col-md-6 col-sm-12">
        {{ Form::open(array('action' => ['ClassesController@update', $class_data->id], 'method' => 'POST')) }}

        <div class="form-group">
            {{Form::label('title','Title*') }}
            {{Form::text('title',$class_data->title,['class'=> 'form-control', 'placeholder' => 'Title, eg: Grade One', 'required'=>'required']) }}
        </div>

        {{Form::hidden('_method','PUT')}}

        {{Form::submit('submit',['class'=>'btn btn-primary'])}}

        {!! Form::close() !!}
    </div>
</div>

@endsection
