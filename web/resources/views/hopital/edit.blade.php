

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Hopital {{ $hopital->designation }}</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">

                <form class="needs-validation" novalidate action="{{ url('/administration/hopital/update') }}" method="POST">
                    {{ csrf_field() }}

                    <input type="hidden" value="{{ $hopital->id }}" name="id">


                    <div class="box-body">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="CHU" {{ $hopital->type == 'CHU' ? 'selected' : '' }}>CHU</option>
                                    <option value="EHU" {{ $hopital->type == 'EHU' ? 'selected' : '' }}>EHU</option>
                                    <option value="EPH" {{ $hopital->type == 'EPH' ? 'selected' : '' }}>EPH</option>
                                    <option value="EPSP"  {{ $hopital->type == 'EPSP' ? 'selected' : '' }}>EPSP</option>
                                    <option value="Polycliniques"  {{ $hopital->type == 'Polycliniques' ? 'selected' : '' }}>Polycliniques</option>
                                    <option value="Salles de soins"  {{ $hopital->type == 'Salles de soins' ? 'selected' : '' }}>Salles de soins</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation" value="{{ $hopital->designation }}" required>
                            </div>
                        </div>


                        <div class="form-row">

                        <div class="form-group col-md-8">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse" value="{{ $hopital->adresse }}" required>
                        </div>

                            <div class="form-group col-md-4">
                                <label for="wilaya">Wilaya</label>

                                <select name="wilaya" id="wilaya" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    @foreach($wilayas as $wilaya)
                                        <option value="{{$wilaya->nom}}" {{ $wilaya->nom == $hopital->wilaya ? 'selected' : '' }}>{{$wilaya->code}} - {{$wilaya->nom}}</option>
                                    @endforeach
                                </select>


                            </div>



                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="{{ $hopital->latitude }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="{{ $hopital->longitude }}" required>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tel">Téléphone</label>
                                <input type="text" class="form-control" name="tel" id="tel" placeholder="Téléphone" value="{{ $hopital->tel }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">E-mail</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="E-mail" value="{{ $hopital->email }}" required>
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




