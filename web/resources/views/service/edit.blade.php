

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Service {{ $service->designation }}</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">


                <form class="needs-validation" novalidate action="{{ url('administration/services/update') }}" method="POST">
                    {{ csrf_field() }}

                    <input type="hidden" value="{{ $service->id }}" name="id">

                    <div class="box-body">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation" value="{{$service->designation}}" required>
                        </div>
                    </div>
                    </div>
                    <div class="box-footer">

                    <button type="submit" class="btn btn-success ">Modifier</button>
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




