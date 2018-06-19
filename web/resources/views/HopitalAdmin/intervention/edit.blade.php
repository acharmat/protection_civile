

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ $intervention->nom }} {{ $intervention->prenom }}</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">


                <form class="needs-validation" novalidate action="{{ url('hopital/interventions/update') }}" method="POST">
                    {{ csrf_field() }}

                    <input type="hidden" value="{{ $intervention->id }}" name="id">

                    <div class="box-body">



                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="type">Type</label>
                                <input type="text" class="form-control" name="type" id="type" placeholder="Type" value="{{$intervention->type}}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="etat">Etat</label>
                                <input type="text" class="form-control" name="etat" id="etat" placeholder="Etat" value="{{$intervention->etat}}" required>
                            </div>
                        </div>

                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="{{$intervention->nom}}" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" value="{{$intervention->prenom}}" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="age">Age</label>
                            <input type="text" class="form-control" name="age" id="age" placeholder="Age" value="{{$intervention->age}}" required>
                        </div>
                    </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="prenom">Prénom</label>
                                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" value="{{$intervention->prenom}}" required>
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




