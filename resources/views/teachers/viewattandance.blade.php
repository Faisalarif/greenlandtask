@extends('layouts.app')
<link
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
    rel="stylesheet"
/>
<link
    href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"
    rel="stylesheet"
/>
<style>
    .present {
        background: #3f9c3f;
        padding: 6px 10px;
        color: #fff;
        border-radius: 5px;
    }

    .absent {
        background: #e3342f;
        padding: 6px 10px;
        color: #fff;
        border-radius: 5px;
    }
</style>
@section('content')

<div class="row">
    <div class="col-12">
        <h1 class="d-inline-block">Teacher Attadence Recored</h1>
    </div>
</div>

<form>
    <div class="row">
        <div class="col">
            <div class="input-group date" data-provide="attandance_datepicker">
                <input
                    type="text"
                    placeholder="From Date"
                    class="form-control selected_Date"
                />
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="input-group date" data-provide="attandance_datepicker">
                <input
                    type="text"
                    placeholder="TO Date"
                    class="form-control selected_Date"
                />
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>
        <div class="col">
            <button
                type="submit"
                class="btn btn-primary"
                id="marke_attandance"
                disabled
            >
                Select
            </button>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </div>
</form>

<div class="row mt-5">
    <div class="col">
        <table class="table display" id="teachers_table" style="width:100%">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Attadence</th>
                </tr>
            </thead>
            @for ($i=1; $i <= 10; $i++)
            <tr>
                <td>
                    {{ $i }}
                </td>
                <td>
                    <?php
                    echo $last_ten_days = date('Y-m-d',strtotime(-$i." days"));
              ?>
                </td>
                <td>
                    @if(in_array($last_ten_days,$attandance_record))
                    <strong class="present">Present</strong>
                    @else
                    <strong class="absent">Absent</strong>
                    @endif
                </td>
            </tr>
            @endfor
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
<script type="text/javascript">
    $(document).ready(function() {
        $(".date").datepicker({
            setDate: new Date(),
            todayHighlight: true,
            autoclose: true,
            format: "dd/mm/yyyy",
            clearBtn: true
        });

        // $(".selected_Date").val();
        // $(".selected_Date").datepicker("setDate", new Date());
    });
</script>
