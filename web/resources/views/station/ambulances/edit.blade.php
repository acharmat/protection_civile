

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> Ambulance {{ $ambulance->matricule }}</h1>
@stop

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">

                <form class="needs-validation" novalidate action="{{ url('/administration/station/ambulances/update') }}" method="POST">
                    {{ csrf_field() }}

                    <input type="hidden" value="{{ $ambulance->id }}" name="id">


                    <div class="box-body">

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control"  id="designation"  value="{{ $ambulance->marque }}" disabled>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="lits">Lits</label>
                                <input type="number" class="form-control" name="lits" id="lits" placeholder="Lits" value="{{ $ambulance->matricule }}" required>
                            </div>

                        </div>


                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Modifier</button>
                    </div>
                </form>
            </div>

        </div>


        </div>


    </div>



@stop

@section('css')

@stop

@section('js')

    <script>

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

        })

    </script>


@stop




