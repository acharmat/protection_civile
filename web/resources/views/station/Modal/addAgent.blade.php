<div class="modal fade" id="addAgent" style="display: none;">
    <div class="modal-dialog">

            <div class="modal-content">
                    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Ajouter un agent</h4>
            </div>
            <div class="modal-body">

                <form class="needs-validation" novalidate action="{{ url('administration/station/agents/store') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $station->id }}" name="id">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="photo">Photo</label>
                            <input type="file" id="photo">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="matricule">Matricule</label>
                            <input type="text" class="form-control" name="matricule" id="matriculeom" placeholder="Matricule" value="" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="grade">Grade</label>
                            <input type="text" class="form-control" name="grade" id="grade" placeholder="Grade" value="" required>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom" value="" required>
                        </div>


                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="sexe" >Sexe</label>
                            <select id="sexe" name="sexe" class="form-control">
                                <option value="Homme" >Homme</option>
                                <option value="Femme" >Femme</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="date_n">Date de naissance</label>
                            <input type="date" id="date_n" class="form-control" name="date_n" value="" >
                        </div>


                        <div class="form-group col-md-4">
                                <label for="lieu_n" >Lieu de naissance</label>
                                <input type="text" id="lieu_n" class="form-control" name="lieu_n" value="" required>
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
