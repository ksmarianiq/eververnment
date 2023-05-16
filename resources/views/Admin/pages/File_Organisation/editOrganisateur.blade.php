<div class="modal fade" id="ModalEdit">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ">
            <form action="{{ route('update-organisation') }}" data-toggle="validator" role="form" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header py-1" style="background-color:#0b3544;">
                    <h4 class="modal-title text-white">Modification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="nomOrg">Nom Organisateur </label>
                                    <input type="text" class="form-control" id="nomOrg" name="nomOrg"
                                        style=" height:43px;" required />
                                    <input type="hidden" class="form-control" id="id" value=""
                                        name="id" style=" height:43px;" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="emailOrg">Email</label>
                                    <input type="email" class="form-control" id="emailOrg" name="emailOrg"
                                        style=" height:43px;" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="control-label" for="num1Org">N° Téléphone 1</label>
                                    <input type="text" class="form-control" id="num1Org" name="num1Org" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="control-label" for="num2Org">N° Téléphone 2</label>
                                    <input type="text" class="form-control" id="num2Org" name="num2Org" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="control-label" for="whatsappNum">N° Whatsapp</label>
                                    <input type="text" class="form-control" id="whatsappNum" name="whatsappNum"
                                        required />
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger   pull-left" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn  btn-primary" id="btnFormEnreg">Modifier</button>
                    </div>

                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
