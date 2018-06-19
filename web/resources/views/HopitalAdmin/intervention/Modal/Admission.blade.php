<div class="modal fade" id="Admission" style="display: none;">
    <div class="modal-dialog">

            <div class="modal-content">
                    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Admission au service</h4>
            </div>
            <div class="modal-body">

                <form class="needs-validation" novalidate action="{{ url('/hopital/interventions/admission') }}" method="POST">
                    {{ csrf_field() }}

                    <input type="hidden" value="{{ $intervention->id }}" name="id">
                    <input type="hidden" value="{{ $intervention->hopital_id }}" name="hopital">



                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="intervention">Intervention</label>
                            <input type="text" class="form-control" name="intervention" id="intervention" placeholder="Intervention" value="{{ $intervention->nom }} {{ $intervention->prenom }}" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="service">Service</label>
                            <select name="service" id="service" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                               @foreach($services as $service)
                                <option value="{{$service->id}}">{{$service->designation}}</option>
                                @endforeach
                            </select>
                        </div>



                    </div>

                    <button type="submit" class="btn btn-success right">Admission</button>

                </form>

            </div>




            </div>


        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
