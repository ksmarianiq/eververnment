<div class="modal fade"  id="ModalEdit" >
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ">
            <form  action="{{ route('update-evenement') }}" data-toggle="validator" role="form" method="POST">
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
                                    <label class="control-label" for="nomEvn">Nom Evenement </label>
                                    <input type="text" id="nomEvn" class="form-control" value=""
                                        name="nomEvn" style=" height:43px;" required />
                                     <input type="hidden" class="form-control" id="id" value="" name="id" style=" height:43px;" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="org_id">Nom Organisateur </label>
                                    <select class="form-control" id="org_id" value="" name="org_id"
                                        style=" height:43px;" required>
                                        @foreach ($org as $item)
                                          <option value="{{$item->id}}">{{$item->nomOrg}}</option>
                                        @endforeach
                                    </select>
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
