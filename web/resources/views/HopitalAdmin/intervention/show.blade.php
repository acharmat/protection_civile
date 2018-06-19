

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="box box-danger">
                <div class="box-body box-profile">

                    <h3 class="profile-username text-center">{{$intervention->type}}</h3>

                    <p class="text-muted text-center">{{$intervention->etat}}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Nom</b> <a class="pull-right">{{$intervention->nom}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Prénom</b> <a class="pull-right">{{$intervention->prenom}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Age</b> <a class="pull-right">{{$intervention->age}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Sexe</b> <a class="pull-right">{{$intervention->sexe}}</a>
                        </li>
                    </ul>

                    <a href="/hopital/interventions/{{$intervention->id}}/edit" class="btn btn-danger btn-block"><b>Modifier</b></a>

                    @if($intervention->etat !== "dcd")

                    @if($intervention->situation == "non hospitaliser")
                    <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#Admission">
                        Admission
                    </button>
                     @else
                        <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#Libirer">
                            Libirer
                        </button>
                    @endif

                        @endif



                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">

            <div class="box box-danger">
                <div class="box-body box-profile">

                    <form action="{{ url('/hopital/interventions/rapport/store') }}" method="POST">
                        {{ csrf_field() }}

                        <input type="hidden" value="{{ $intervention->id }}" name="id">

                        <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                                <textarea id="body" name="body" class="form-control" ></textarea>
                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Sauvegarder</button>
                    </form>

                </div>
                <!-- /.box-body -->
            </div>


            <div class="box box-danger">
                <div class="box-body box-profile">




                    <ul class="timeline timeline-inverse">

                        @foreach($intervention->rapports()->orderBy('created_at','desc')->get() as $rapport)


                        <li>
                            <i class="fa fa-warning bg-red"></i>

                            <div class="timeline-item">

                               <span class="time">
                                          <form action="{{ url('/hopital/interventions/rapport/'.$rapport->id.'/destroy') }}" method="post">
                                                <input type="hidden" name="_method" value="delete" />
                                              {!! csrf_field() !!}
                                              <button type="submit" style="background-color: transparent; border: transparent"><i class="fa fa-times" style="color: red"></i></button>
                                            </form>
                                </span>


                                <span class="time"><i class="fa fa-clock-o"></i> {{ date('d F Y', strtotime($rapport->created_at)) }}</span>


                                <div class="timeline-body">
                                    {!! $rapport->body !!}
                                </div>

                            </div>
                        </li>

                        @endforeach

                        <li class="time-label">
                        <span class="bg-red">
                          {{ date('d F Y', strtotime($intervention->created_at)) }}
                        </span>
                        </li>
                    </ul>






                </div>
                <!-- /.box-body -->
            </div>


        </div>
        <!-- /.col -->
    </div>



    <!-- Ajouter Service -->
    @include('HopitalAdmin/intervention/Modal/Admission')
    <!-- Ajouter Service -->
    @include('HopitalAdmin/intervention/Modal/Libirer')


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

            ajax: '{{ url("/administration/hopital/".$intervention->id."/services/data") }}',
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



    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>


@stop




