<div class="modal fade" id="modalFormOrganisteur">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ">
            <form id="formOrg" action="{{ route('Table_Hotesse.store') }}" data-toggle="validator" role="form"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header py-1" style="background-color:#0b3544;">
                    <h4 class="modal-title text-white">Table d'hotesse</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="hote_id">Nom Hotesse</label>
                                    <select class="form-control" id="hote_id" value="" name="hote_id"
                                        style=" height:43px;" required>
                                        <option selected>Choisir un nom</option>
                                        @foreach ($Hote as $item)
                                            <option value="{{ $item->id }}">{{ $item->nomHote }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="ivn_table_id">Nom Table</label>
                                    <select class="form-control" id="ivn_table_id" value="" name="ivn_table_id"
                                        style=" height:43px;" required>
                                        <option selected>Choisir un nom</option>
                                        @foreach ($Ivn as $item)
                                            <option value="{{ $item->id }}">{{ $item->nomTableInv }}</option>
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
