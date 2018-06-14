

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Ajouter une station</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">

                    <form class="needs-validation" novalidate action="{{ url('/administration/station/store') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="box-body">

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation" value="" required>
                            </div>
                        </div>


                            <div class="form-row">

                                <div class="form-group col-md-8">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse" value="" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="wilaya">Wilaya</label>

                                    <select name="wilaya" id="wilaya" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        @foreach($wilayas as $wilaya)
                                            <option value="{{$wilaya->nom}}">{{$wilaya->code}} - {{$wilaya->nom}}</option>
                                        @endforeach
                                    </select>


                                </div>


                            </div>



                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tel">Téléphone</label>
                                <input type="text" class="form-control" name="tel" id="tel" placeholder="Téléphone" value="" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">E-mail</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="E-mail" value="" required>
                            </div>
                        </div>




                        </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </div>
                </form>
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




