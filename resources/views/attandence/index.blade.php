@extends('layouts.app')
<link
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
    rel="stylesheet"
/>
<link
    href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"
    rel="stylesheet"
/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@section('content')

<div class="row">
    <div class="col-12">
        {{ Breadcrumbs::render('teachers') }}

        <h1 class="d-inline-block">Makr Teachers attedence</h1>
    </div>
</div>

<form>
    <div class="row">
        <div class="col p-0">
            <div class="input-group date" data-provide="attandance_datepicker">
                <input
                    type="text"
                    placeholder="select date"
                    class="form-control selected_Date"
                />
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary" id="marke_attandance">
                Mare Attendance
            </button>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </div>
</form>

<div class="row mt-5">
    <div class="col-md-12">
        <table class="table display" id="teachers_table" style="width:100%">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">
                        <input
                            type="checkbox"
                            id="checked_all"
                            name="mark_attandance_all"
                            value="1"
                        />
                    </th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Qualification</th>
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
                        <input
                            type="checkbox"
                            name="mark_attandance"
                            value="{{$teacher->id}}"
                            class="single_chk_teacher"
                        />
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
    </div>
</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"
></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        $(".selected_Date").datepicker("setDate", new Date());

        //check uncheck table values
        $("#checked_all").click(function() {
            if ($(this).prop("checked") == true) {
                $("input[type='checkbox']").prop("checked", true);
            } else if ($(this).prop("checked") == false) {
                $("input[type='checkbox']").prop("checked", false);
            }
        });

        //datatable
        $("#teachers_table").DataTable({
            ordering: false
        });

        //on click make attandance
        $("#marke_attandance").on("click", function(e) {
            e.preventDefault();

            if ($(".selected_Date").val() == "") {
                return false;
            }

            if ($("#checked_all").prop("checked") == false) {
                var is_attandace_marked = false;

                $('tbody [type="checkbox"]').each(function(i, chk) {
                    if (chk.checked) {
                        is_attandace_marked = true;
                    }
                });

                if (is_attandace_marked == false) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Please select teacher!",
                        footer: "<a>Why do I have this issue?</a>"
                    });
                    return false;
                }
            }

            var teachers_attandance_lsit = [];

            $('tbody [type="checkbox"]').each(function(i, chk) {
                if (chk.checked) {
                    teachers_attandance_lsit.push($(this).val());
                }
            });

            var selected_date = $(".selected_Date").val();

            $.ajax({
                type: "POST",
                url: "{{ route('makreattandance.post') }}",
                data: {
                    teachers_id: teachers_attandance_lsit,
                    attandance_date: selected_date
                },
                success: function(data) {
                    console.log(data.success);
                    if (data.success == "saved") {
                        Swal.fire(
                            "Saved!",
                            "Attadance has been marked.",
                            "success"
                        );
                    }
                }
            });
        });
    });
</script>
