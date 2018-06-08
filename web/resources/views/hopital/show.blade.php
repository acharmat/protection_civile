

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="box box-danger">
                <div class="box-body box-profile">

                    <h3 class="profile-username text-center">{{$hopital->type}}</h3>

                    <p class="text-muted text-center">{{$hopital->designation}}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Téléphone</b> <a class="pull-right">{{$hopital->tel}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>E-mail</b> <a class="pull-right">{{$hopital->email}}</a>
                        </li>
                    </ul>

                    <a href="/administration/hopital/{{$hopital->id}}/edit" class="btn btn-danger btn-block"><b>Modifier</b></a>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#services" data-toggle="tab" aria-expanded="true">Services</a></li>
                    <li class=""><a href="#administrateur" data-toggle="tab" aria-expanded="false">Administrateur</a></li>
                    <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Map</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="services">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addService">
                            Ajouter un service
                        </button>

                        <table id="data" class="table table-bordered table-hover" cellspacing="0">
                            <thead>
                                    <tr>
                                        <th>designation</th>
                                        <th>lits</th>
                                        <th>/</th>


                                    </tr>
                            </thead>
                            <tbody>





                            </tbody>



                        </table>



                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="administrateur">

                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addAdministrateur">
                            Ajouter un service
                        </button>

                        <table id="admin" class="table table-bordered table-hover" cellspacing="0">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Action</th>


                            </tr>
                            </thead>
                            <tbody>





                            </tbody>



                        </table>


                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                                    <input class="form-control" id="inputName" placeholder="Name" type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input class="form-control" id="inputEmail" placeholder="Email" type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                                    <input class="form-control" id="inputName" placeholder="Name" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                                <div class="col-sm-10">
                                    <input class="form-control" id="inputSkills" placeholder="Skills" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>


    <!-- Ajouter Service -->
    @include('hopital/Modal/addService')
    <!-- Ajouter Service -->
    @include('hopital/Modal/addAdministrateur')



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

    <script type="text/javascript">
        var lastIdx = null;

        var table = $('#data').DataTable({
            "processing": true,
            serverSide: false,

            ajax: '{{ url("/administration/hopital/".$hopital->id."/services/data") }}',
            columns: [
                {data: 'designation', name: 'designation'},
                {data: 'lits', name: 'lits'},
                {data: 'action', name: 'action',orderable: false, searchable: false}
            ],

            "searching": true,
            "autoWidth": false,
            "lengthChange": false,
            "stateSave": true,
            "responsive": true,
            "order": [[0, 'desc']],
            iDisplayLength: 10,
            fixedHeader: true,
            initComplete: function ()
            {
                var r = $('#data thead tr');
                r.find('th').each(function(){
                    $(this).css('padding', 8);
                });
                $('#data thead').append(r);
                $('#search_0').css('text-align', 'center');
            }
        });
        table.columns().eq(0).each(function(colIdx) {
            $('input', table.column(colIdx).header()).on('keyup change', function() {
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
        });
        table.columns().eq(0).each(function(colIdx) {
            $('select', table.column(colIdx).header()).on('change', function() {
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
            $('select', table.column(colIdx).header()).on('click', function(e) {
                e.stopPropagation();
            });
        });
        $('#data tbody')
            .on( 'mouseover', 'td', function () {
                var colIdx = table.cell(this).index().column;
                if ( colIdx !== lastIdx ) {
                    $( table.cells().nodes() ).removeClass( 'highlight' );
                    $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
                }
            } )
            .on( 'mouseleave', function () {
                $( table.cells().nodes() ).removeClass( 'highlight' );
            } );
    </script>


    <script type="text/javascript">
        var lastIdx = null;

        var table = $('#admin').DataTable({
            "processing": true,
            serverSide: false,

            ajax: '{{ url("/administration/hopital/".$hopital->id."/admin/data") }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nom', name: 'nom'},
                {data: 'prenom', name: 'prenom'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action',orderable: false, searchable: false}
            ],

            "searching": true,
            "autoWidth": false,
            "lengthChange": false,
            "stateSave": true,
            "responsive": true,
            "order": [[0, 'desc']],
            iDisplayLength: 10,
            fixedHeader: true,
            initComplete: function ()
            {
                var r = $('#data thead tr');
                r.find('th').each(function(){
                    $(this).css('padding', 8);
                });
                $('#data thead').append(r);
                $('#search_0').css('text-align', 'center');
            }
        });
        table.columns().eq(0).each(function(colIdx) {
            $('input', table.column(colIdx).header()).on('keyup change', function() {
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
        });
        table.columns().eq(0).each(function(colIdx) {
            $('select', table.column(colIdx).header()).on('change', function() {
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
            $('select', table.column(colIdx).header()).on('click', function(e) {
                e.stopPropagation();
            });
        });
        $('#data tbody')
            .on( 'mouseover', 'td', function () {
                var colIdx = table.cell(this).index().column;
                if ( colIdx !== lastIdx ) {
                    $( table.cells().nodes() ).removeClass( 'highlight' );
                    $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
                }
            } )
            .on( 'mouseleave', function () {
                $( table.cells().nodes() ).removeClass( 'highlight' );
            } );
    </script>



@stop




