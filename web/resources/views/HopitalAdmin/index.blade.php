@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Administrateurs</h1>

@stop

@section('content')



    <div class="row">

    <div class="col-xs-12">
        <div class="box box-danger">
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addAdministrateur">
                        Ajouter un administrateur
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
            <!-- /.box-body -->
        </div>
                </div>
            </div>
        </div>

    <!-- Ajouter Service -->
    @include('admin/Modal/addAdministrateur')

    </div>
@stop

@section('css')

@stop

@section('js')




    <script type="text/javascript">
        var lastIdx = null;

        var table = $('#admin').DataTable({
            "processing": true,
            serverSide: false,

            ajax: '{{ url("/administration/admin/data") }}',
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