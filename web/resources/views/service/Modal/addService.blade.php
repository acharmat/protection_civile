<div class="modal fade" id="addService" style="display: none;">
    <div class="modal-dialog">

            <div class="modal-content">
                    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Ajouter un service</h4>
            </div>
            <div class="modal-body">

                <form class="needs-validation" novalidate action="{{ url('administration/services/store') }}" method="POST">
                    {{ csrf_field() }}



                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation" value="" required>
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
