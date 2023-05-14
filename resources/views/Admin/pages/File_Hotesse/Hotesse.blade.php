@extends('Admin.pages.layout.header')
@section('Hotesse')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class=" w-100 d-lg-block">
        <div class="card">
            <div class="card-header" style="background-color:#0b3544;">
                <h2 class="card-title text-white fw-bolder">Hotesse</h2>
                <div class="card-tools">

                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <a id="btnModalFormOrganisteur" href="#modalFormOrganisteur" class="btn text-white mb-4"
                    style="background-color:#0b3544;" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i
                        class="fas fa-plus-circle"></i> <span>Ajouter un Hotesse</span></a>
                <div class="dataTable-container">
                    <table id="dtBasictable-a" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nom  Hotesse</th>
                                <th>Email </th>
                                <th>Telephone </th>
                                <th>Evenement</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Hote as $item)
                                <tr>
                                    <td>{{ $item->nomHote }}</td>
                                    <td>{{ $item->emailHote }}</td>
                                    <td>{{ $item->telephoneHote }}</td>
                                    <td>{{ $item->evenement->nomEvn }}</td>
                                    <td>
                                        <div class=" d-flex grid ">
                                            <div class="g-col-4">
                                                <div class="editbtn" type="button" value="{{ $item->id }}">
                                                    <i class="fa fa-edit" style="color: #0b3544;"></i>
                                                </div>
                                            </div>
                                            <div class="g-col-4 ml-3">
                                                <div class="deletebtn" type="button" value="{{ $item->id }}">
                                                    <i class="fa fa-trash" style="color: #ec270d;"></i>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
            <!-- /.card-body -->
        </div>

    </div>
    </div>


    <!-- Modal-->
    @include('Admin.pages.File_Hotesse.deleteHotesse')
    @include('Admin.pages.File_Hotesse.editHotesse')
    @include('Admin.pages.File_Hotesse.addHotesse')

    <!-- Modal-->
    @include('sweetalert::alert')
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.deletebtn', function() {
                var iddelte = $(this).attr('value');
                //alert('ID de l\'organisateur : ' + id);
                $('#ModalDelete').modal('show');
                $('#deleteing_id').val(iddelte);
            });

            $(document).on('click', '.editbtn', function() {
                var id = $(this).attr('value');
                //alert('ID de l\'organisateur : ' + id);
                $('#ModalEdit').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{ route('Hotesse.edit', ':id') }}".replace(':id', id),
                    success: function(response) {
                        //console.log(response.Hotesse);
                        $('#evn_id').val(response.Hotesse.evn_id);
                        $('#nomHote').val(response.Hotesse.nomHote);
                        $('#emailHote').val(response.Hotesse.emailHote);
                        $('#telephoneHote').val(response.Hotesse.telephoneHote);
                        $('#id').val(response.Hotesse.id);
                    }
                })
            });
        });
    </script>
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote({
                height: 100,
                placeholder: 'Entrer un texte',
            });
            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#dtBasictable-a').DataTable({
                "processing": true,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "scrollX": true,
                "scrollY": 200,
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
@endsection
