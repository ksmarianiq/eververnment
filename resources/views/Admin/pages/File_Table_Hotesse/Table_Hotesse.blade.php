@extends('Admin.pages.layout.header')
@section('Table_Hotesse')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        @include('sweetalert::alert')
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="container mb-3 ">
        <div class="card">
            <div class="card-header" style="background-color:#0b3544;">
                <h2 class="card-title text-white fw-bolder">Table d'hotesses</h2>
                <div class="card-tools">

                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <a id="btnModalFormOrganisteur" href="#modalFormOrganisteur" class="btn text-white mb-4"
                    style="background-color:#0b3544;" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i
                        class="fas fa-plus-circle"></i> <span>Ajouter une Table d'hotesse</span></a>
                <div class="dataTable-container">
                    <table id="dtBasictable-a" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nom Hotesses</th>
                                <th>Nom Tables</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Table_Hotesse as $item)
                                <tr>
                                    <td>{{ $item->hotesse->nomHote  ?? 'Nom Hotesse non défini'  }}</td>
                                    <td>{{ $item->ivnTables->nomTableInv ?? 'Nom Table non défini' }}</td>
                                    <td>
                                        <div class=" d-flex grid ">

                                            <div class="g-col-4 ml-3">
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
    @include('Admin.pages.File_Table_Hotesse.deleteTable_Hotesse')
    @include('Admin.pages.File_Table_Hotesse.editTable_Hotesse')
    @include('Admin.pages.File_Table_Hotesse.addTable_Hotesse')

    <!-- Modal-->
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
                    url: "{{ route('Table_Hotesse.edit', ':id') }}".replace(':id', id),
                    success: function(response) {
                        console.log(response);
                        $('#hote_id').val(response.Table_Hotesse.hote_id);
                        $('#ivn_table_id').val(response.Table_Hotesse.ivn_table_id);
                        $('#id').val(response.Table_Hotesse.id);
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
