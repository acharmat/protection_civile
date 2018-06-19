

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Administrateur : {{ $user->nom }} {{ $user->pranom }}</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">


                <form class="needs-validation" novalidate action="{{ url('administration/admin/update') }}" method="POST">
                    {{ csrf_field() }}

                    <input type="hidden" value="{{ $user->id }}" name="id">

                    <div class="box-body">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="{{$user->nom}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="prenom">Prénom</label>
                                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" value="{{$user->prenom}}" required>
                            </div>
                        </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{$user->email}}" required>
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




