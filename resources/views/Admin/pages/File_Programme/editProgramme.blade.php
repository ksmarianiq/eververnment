<div class="modal fade"  id="ModalEdit" >
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ">
            <form id="formOrg" action="{{ route('update-programme') }}" data-toggle="validator" role="form"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                <input type="text" class="form-control" value="" id="libProg" name="libProg" style=" height:43px;" required />
                                <input type="hidden" class="form-control" id="id" value="" name="id" style=" height:43px;" required />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="dateProg">Date</label>
                                <input type="text" class="form-control" value="" id="dateProg"
                                    name="dateProg" style=" height:43px;" required />
                            </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="evn_id">Evenement</label>
                                <select class="form-control" id="evn_id" value="" name="evn_id" style=" height:43px;" required>
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
                                <input type="text" class="form-control" id="heureProg" value="" name="heureProg"
                                    style=" height:43px;" required />
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="latitude">Latitude </label>
                                <input type="text" class="form-control" value="" id="latitude" name="latitude"
                                    style=" height:43px;" required />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="longitude">Longitude</label>
                                <input type="text" class="form-control" value=""  id="longitude" name="longitude"
                                    style=" height:43px;" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="control-label" for="lieuProg">Lieu </label>
                                <input type="text" class="form-control" value="" id="lieuProg"name="lieuProg"
                                    style=" height:43px;" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="control-label" for="descriptionProg">Description</label>
                                <textarea id="descriptionProg" name="descriptionProg"  required></textarea>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger   pull-left"
                        data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn  btn-primary" id="btnFormEnreg">Modifier</button>
                </div>

            </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
