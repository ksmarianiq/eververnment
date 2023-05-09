<div class="modal fade" id="modalFormOrganisteur">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ">
            <form id="formOrg" action="{{ route('organisateur.store') }}" data-toggle="validator" role="form"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header py-1" style="background-color:#0b3544;">
                    <h4 class="modal-title text-white">Organisateur</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="nomOrg">Nom Organisateur </label>
                                    <input type="text" class="form-control"  value="" name="nomOrg"
                                        style=" height:43px;" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="emailOrg">Email</label>
                                    <input type="text" class="form-control" value="" name="emailOrg"
                                        style=" height:43px;" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="control-label" for="num1Org">N° Téléphone 1</label>
                                    <input type="text" class="form-control"  value="" name="num1Org" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="control-label" for="num2Org">N° Téléphone 2</label>
                                    <input type="text" class="form-control" value="" name="num2Org" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="control-label" for="whatsappNum">N° Whatsapp</label>
                                    <input type="text" class="form-control" value="" name="whatsappNum"
                                        required />
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger   pull-left"
                            data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn  btn-primary" id="btnFormEnreg">Enregistrer</button>
                    </div>

                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
