@extends('layouts.app') @section('content')
<link
    href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"
    rel="stylesheet"
/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<div class="row">
    <div class="col-12">
        <h1 class="d-inline-block">Techers information</h1>

        <a href="/teachers/create" class="btn btn-primary float-right"
            >Create Teacher</a
        >
    </div>
</div>
<table class="table display" id="teachers_table">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Qualification</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($teachers_data) > 0)
        <?php  $sr_no = 0; ?>
        @foreach($teachers_data as $teacher)
        <?php  $sr_no++;  ?>
        <tr>
            <td>
                {{ $sr_no }}
            </td>
            <td>
                {{$teacher->second_name}}
                {{$teacher->first_name}}
            </td>
            <td>
                {{$teacher->email}}
            </td>
            <td>
                {{$teacher->qualification}}
            </td>
            <td>
                <a href="{{ url('teachers/'.$teacher->id.'/') }}">View</a> |
                <!-- <a href="/teachers/{{$teacher->id}}">View</a> | -->
                <a href="{{ url('teachers/'.$teacher->id.'/edit') }}">Edit</a>
                |
                <form style="display:inline-block;">
                    <button
                        id="<?php echo $teacher->
                        id ?>"
                        class="btn btn-link delete_teacher"
                        type="button"
                        style="padding: 2px; font-size: 16px;"
                    >
                        Delete
                    </button>
                </form>
                |
                <a href="{{ url('teachers/assignClass/'.$teacher->id.'/') }}"
                    >Assign Classes
                </a>
                |
                <a
                    href="{{ url('attandance/getTeacherAttandance/'.$teacher->id.'/') }}"
                    >View Attendance</a
                >
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        //datatable
        $("#teachers_table").DataTable({
            ordering: false
        });

        $(".delete_teacher").click(function() {
            var id = 0;
            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete teacher!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                var theacher_id = $(this).attr("id");

                if (result.value) {
                    $.ajax({
                        type: "POST",
                        // url: "/teachers/" + theacher_id,
                        url: "{{ route('operationsdelete.post') }}",
                        data: {
                            id: theacher_id
                        },

                        success: function(data) {
                            if (data.success == "deleted") {
                                Swal.fire(
                                    "Deleted!",
                                    "Teacher has been deleted.",
                                    "success"
                                );
                            }
                        }
                    });
                }
            });
        });
    });
</script>
