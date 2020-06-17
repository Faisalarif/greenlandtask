@extends('layouts.app') @section('content')

<div class="row">
    <div class="col-md-12">
        {{ Breadcrumbs::render('teachers') }}
        <h1>Create Teacher</h1>
    </div>
    <div class="col-md-6 col-sm-12">
        {{ Form::open(array('action' => 'TeachersController@store', 'method' => 'POST')) }}

        <div class="form-group">
            {{Form::label('first_name','First Name*') }}
            {{Form::text('first_name','',['class'=> 'form-control', 'placeholder' => 'First Name, eg: Syed Faisal', 'required'=>'required']) }}
        </div>
        <div class="form-group">
            {{Form::label('last_name','Last Name*') }}
            {{Form::text('last_name','',['class'=> 'form-control', 'placeholder' => 'Last Name, eg: Arif', 'required'=>'required']) }}
        </div>
        <div class="form-group">
            {{Form::label('email','Email*') }}
            {{Form::text('email','',['class'=> 'form-control', 'placeholder' => 'Email, eg: john@domain.com','required'=>'required']) }}
        </div>
        <div class="form-group">
            {{Form::label('qualification','Qualification*') }}
            {{Form::text('qualification','',['class'=> 'form-control', 'placeholder' => 'Qualification, eg: Masters', 'required'=>'required']) }}
        </div>
        <div class="form-group">
            {{Form::label('status','Status') }}
            {{
                Form::select('Status', ['1' => 'Active', '0' => 'inactive'],'',['class'=> 'form-control'])
            }}
        </div>

        {{Form::submit('submit',['class'=>'btn btn-primary'])}}

        {!! Form::close() !!}
    </div>
</div>

@endsection
