<div class="modal fade" id="addAdministrateur" style="display: none;">
    <div class="modal-dialog">

            <div class="modal-content">
                    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Ajouter un administrateur</h4>
            </div>
            <div class="modal-body">

                <form class="needs-validation" novalidate action="{{ url('administration/hopital/storeadmin') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $hopital->id }}" name="id">




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

                        <div class="form-group col-md-6">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" value="" required>
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
