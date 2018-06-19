<div class="modal fade" id="Libirer" style="display: none;">
    <div class="modal-dialog">

            <div class="modal-content">
                    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Libirer le malade</h4>
            </div>
            <div class="modal-body">

                <form class="needs-validation" novalidate action="{{ url('/hopital/interventions/libirer') }}" method="POST">
                    {{ csrf_field() }}

                    <input type="hidden" value="{{ $intervention->id }}" name="id">


                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="intervention">Intervention</label>
                            <input type="text" class="form-control" name="intervention" id="intervention" placeholder="Intervention" value="{{ $intervention->nom }} {{ $intervention->prenom }}" disabled>
                        </div>

                        </div>



                    </div>

                    <button type="submit" class="btn btn-success right">Libirer</button>

                </form>

            </div>




            </div>


        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
