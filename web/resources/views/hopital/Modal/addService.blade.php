<div class="modal fade" id="addService" style="display: none;">
    <div class="modal-dialog">

            <div class="modal-content">
                    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Ajouter un service</h4>
            </div>
            <div class="modal-body">

                <form class="needs-validation" novalidate action="{{ url('administration/hopital/storeservice') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $hopital->id }}" name="id">




                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="service">Designation</label>
                            <select name="service" id="service" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                               @foreach($services as $service)
                                <option value="{{$service->id}}">{{$service->designation}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="lits">Lits</label>
                            <input type="number" class="form-control" name="lits" id="lits" placeholder="Lits" value="" required>
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
