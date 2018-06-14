@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Stations</h1>

@stop

@section('content')

    <div class="row">

    <div class="col-xs-12">
        <div class="box box-danger">
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                    <a href="/administration/station/create" class="btn btn-success">Ajouter une station</a>


                    <table id="data" class="table table-bordered table-hover" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>designation</th>
                                    <th>wilaya</th>
                                    <th>téléphone</th>
                                    <th>email</th>
                                    <th>/</th>


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
    </div>
@stop

@section('css')

@stop

@section('js')




    <script type="text/javascript">
        var lastIdx = null;

        var table = $('#data').DataTable({
            "processing": true,
            serverSide: false,

            ajax: '{{ url("/administration/station/data") }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'designation', name: 'designation'},
                {data: 'wilaya', name: 'wilaya'},
                {data: 'tel', name: 'tel',orderable: false},
                {data: 'email', name: 'email',orderable: false},
                {data: 'action', name: 'action',orderable: false},
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