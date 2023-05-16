<div class="modal fade"  id="ModalEdit" >
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ">
            <form  action="{{ route('update-Hotesse') }}" data-toggle="validator" role="form" method="POST">
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
                                    <label class="control-label" for="nomHote">Nom Hotesse</label>
                                    <input type="text" id="nomHote" class="form-control" value=""
                                        name="nomHote" style=" height:43px;" required />
                                     <input type="hidden" class="form-control" id="id" value="" name="id" style=" height:43px;" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="evn_id">Evenement</label>
                                    <select class="form-control" id="evn_id" value="" name="evn_id"
                                        style=" height:43px;" required>
                                        <option selected>Choisir un nom</option>
                                        @foreach ($Eve as $item)
                                            <option value="{{ $item->id }}">{{ $item->nomEvn }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="emailHote">Email </label>
                                    <input type="email" class="form-control" value="" id="emailHote" name="emailHote" style=" height:43px;" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="telephoneHote">Telephone</label>
                                    <input type="text" class="form-control" value="" id="telephoneHote"
                                        name="telephoneHote" style=" height:43px;" required />
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
