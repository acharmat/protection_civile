<div class="modal fade" id="addAmbulance" style="display: none;">
    <div class="modal-dialog">

            <div class="modal-content">
                    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Ajouter un service</h4>
            </div>
            <div class="modal-body">

                <form class="needs-validation" novalidate action="{{ url('administration/station/storeambulance') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $station->id }}" name="id">




                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="marque">Marque</label>
                            <input type="text" class="form-control" name="marque" id="marque" placeholder="Marque" value="" required>

                        </div>

                        <div class="form-group col-md-6">
                            <label for="matricule">Matricule</label>
                            <input type="text" class="form-control" name="matricule" id="matricule" placeholder="Matricule" value="" required>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-success right">Ajouter</button>

                </form>

            </div>




            </div>


        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
