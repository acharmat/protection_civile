@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">


            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">


                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>



                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Matricule</th>
                            <th>Disponabilité</th>
                            <th>Header</th>
                            <th>Header</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(count($ambulances)>0)
                            @foreach($ambulances as $ambulance)

                                <tr>

                                    <td>{{$ambulance->id}}</td>
                                    <td>{{$ambulance->matricule}}</td>
                                    <td>{{$ambulance->dispo}}</td>
                                    <td>//</td>
                                    <td>//</td>

                        </tr>
                            @endforeach
                        @endif
                        </tbody>



                    </table>
                </div>

            </main>


        </div>
    </div>
</div>
@endsection
