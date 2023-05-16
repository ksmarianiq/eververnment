<div class="modal fade" id="modalFormOrganisteur">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ">
            <form id="formOrg" action="{{ route('programme.store') }}" data-toggle="validator" role="form"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header py-1" style="background-color:#0b3544;">
                    <h4 class="modal-title text-white">Programme</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="libProg">Libelée </label>
                                    <input type="text" class="form-control" value="" id=""
                                        name="libProg" style=" height:43px;" required />
                                    <input type="hidden" class="form-control" id="reference" name="codeProg"
                                        required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="dateProg">Date</label>
                                    <input type="date" class="form-control" value="" id=""
                                        name="dateProg" style=" height:43px;" required />
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="evn_id">Evenement</label>
                                    <select class="form-control" id="" value="" name="evn_id"
                                        style=" height:43px;" required>
                                        <option selected>Choisir un nom</option>
                                        @foreach ($Eve as $item)
                                            <option value="{{ $item->id }}">{{ $item->nomEvn }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="heureProg">Heure</label>
                                    <input type="time" class="form-control" id="" value=""
                                        name="heureProg" style=" height:43px;" required />
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="latitude">Latitude </label>
                                    <input type="text" class="form-control" value="" id=""
                                        name="latitude" style=" height:43px;" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="longitude">Longitude</label>
                                    <input type="text" class="form-control" value="" id=""
                                        name="longitude" style=" height:43px;" required />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="control-label" for="lieuProg">Lieu </label>
                                <input type="text" class="form-control" value="" id="" name="lieuProg"
                                    style=" height:43px;" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="control-label" for="descriptionProg">Description</label>
                                <textarea id="summernote" name="descriptionProg" required></textarea>
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
