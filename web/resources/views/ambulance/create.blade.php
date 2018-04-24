@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">


            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">


                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>


                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" novalidate action="{{ url('/ambulance/store') }}" method="POST">
                    {{ csrf_field() }}


                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="matricule">Matricule</label>
                            <input type="text" class="form-control" name="matricule" id="matricule" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Ajouter</button>
                </form>

            </main>


        </div>
    </div>
</div>
@endsection
