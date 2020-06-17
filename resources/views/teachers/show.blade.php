@extends('layouts.app') @section('content')

<div class="row">
    <div class="col-md-12">
        {{ Breadcrumbs::render('teachers') }}

        <h1>Teacher Detail</h1>
    </div>
    <div class="col-md-12 col-sm-12">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Second Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Qualification</th>
                    <th scope="col">Assigned Classes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$teacher_data["teacher_info"]->first_name}}</td>
                    <td>{{$teacher_data["teacher_info"]->second_name}}</td>
                    <td>{{$teacher_data["teacher_info"]->email}}</td>
                    <td>{{$teacher_data["teacher_info"]->qualification}}</td>
                    <td>
                        @if(count(($teacher_data["assigned_classes"])) > 0)
                        @foreach($teacher_data["assigned_classes"] as
                        $teacher_classes)
                        <strong> {{$teacher_classes->title}}, </strong>
                        @endforeach @else

                        <strong>No Classe assigned</strong>

                        @endif
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
