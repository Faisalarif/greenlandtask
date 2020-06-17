@extends('layouts.app') @section('content')

<div class="row">
    <div class="col-md-12">
        {{ Breadcrumbs::render('teachers') }}
        <h5>
            Assign Classes to: <strong>{{ $data["teacher_name"] }}</strong>
        </h5>
    </div>
    <div class="col-md-6 col-sm-12">
        <?php 
         $teacher_id =  $data["teacher_id"]; 
         $class_list = $data["class_list"];
        ?>
        {{ Form::open(array('action' => ['TeachersController@assignClasses', $teacher_id], 'method' => 'POST')) }}

        <ul class="list-group checked-list-box mt-2 mb-2">
            @foreach($class_list as $key=>$class_title)

            <li class="list-group-item">
                @if(in_array($class_title->id,$data["assigned_classes"]))
                {{Form::checkbox('assgin_classes[]', $class_title->id, true)}}
                @else
                {{Form::checkbox('assgin_classes[]', $class_title->id, false)}}
                @endif

                {{$class_title->title}}
            </li>
            @endforeach
        </ul>

        {{Form::Hidden('teacher_id',$teacher_id)}}

        {{Form::submit('Assign',['class'=>'btn btn-primary d-block'])}}

        {!! Form::close() !!}
    </div>
</div>

@endsection
