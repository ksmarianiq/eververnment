<div class="modal fade" id="modalFormOrganisteur">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ">
            <form id="formOrg" action="{{ route('Information.store') }}" data-toggle="validator" role="form"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header py-1" style="background-color:#0b3544;">
                    <h4 class="modal-title text-white">Information</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="titre">Titre</label>
                                    <input type="text" id="titre" class="form-control" value=""
                                        name="titre" style=" height:43px;" required />
                                     <input type="hidden" class="form-control" id="id" value="" name="id" style=" height:43px;" required />
                                     <input type="hidden" class="form-control" id="reference" value="" name="codeInf" style=" height:43px;" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="evn_id">Evenement</label>
                                    <select class="form-control" id="evn_id" value="" name="evn_id"
                                        style=" height:43px;">
                                        <option selected>  </option>
                                        @foreach ($Eve as $item)
                                            <option value="{{ $item->id }}">{{ $item->nomEvn }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger   pull-left" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn  btn-primary" id="btnFormEnreg">Enregistrer</button>
                    </div>

                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
