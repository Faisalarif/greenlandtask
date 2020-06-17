@extends('layouts.app') @section('content')

<div class="row">
    <div class="col-12">
        {{ Breadcrumbs::render('classes') }}
        <h1 class="d-inline-block">Classes List</h1>

        <a href="/classes/create" class="btn btn-primary float-right"
            >Create Class</a
        >
    </div>
</div>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($classes_data) > 0)
        <?php  $sr_no = 0; ?>
        @foreach($classes_data as $class)
        <?php  $sr_no++;  ?>
        <tr>
            <td>
                {{ $sr_no }}
            </td>
            <td>
                {{$class->title}}
            </td>
            <td>
                <a href="/classes/{{$class->id}}">Edit</a>
                <!-- <a href="/classes/">Delete</a> -->
            </td>
        </tr>
        @endforeach @else

        <tr>
            <td colspan="3">
                <strong>No Data Found.</strong>
            </td>
        </tr>

        @endif
    </tbody>
</table>

@endsection
