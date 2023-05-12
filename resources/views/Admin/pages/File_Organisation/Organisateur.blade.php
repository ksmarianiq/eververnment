@extends('Admin.pages.layout.header')
@section('Organisateur')

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




    <div class="card">
        <div class="card-header" style="background-color:#0b3544;">
            <h2 class="card-title text-white fw-bolder">Organisateurs</h2>
            <div class="card-tools">

            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <a id="btnModalFormOrganisteur" href="#modalFormOrganisteur" class="btn text-white mb-4"
                style="background-color:#0b3544;" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i
                    class="fas fa-plus-circle"></i> <span>Ajouter un Oraganisteur</span></a>

           <div class="dataTable-container">
            <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col">Nom Organisateur</th>
                        <th scope="col">Email</th>
                        <th scope="col">N° Téléphone 1</th>
                        <th scope="col">N° Téléphone 2</th>
                        <th scope="col">N° Whatsapp</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($org as $item)
                        <tr>
                            <td>{{ $item->nomOrg }}</td>
                            <td>{{ $item->emailOrg }}</td>
                            <td>{{ $item->num1Org }}</td>
                            <td>{{ $item->num2Org }} </td>
                            <td>{{ $item->whatsappNum }}</td>
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
                <tfoot>
                        <th>Nom Organisateur</th>
                        <th>Email</th>
                        <th>N° Téléphone 1</th>
                        <th>N° Téléphone 2</th>
                        <th>N° Whatsapp</th>
                        <th>Actions</th>
                </tfoot>
            </table>
           </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- Modal-->
    @include('Admin.pages.File_Organisation.deleteOrganisateur')
    @include('Admin.pages.File_Organisation.editOrganisateur')
    @include('Admin.pages.File_Organisation.addOrganisateur')

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
                    url: "{{ route('organisateur.edit', ':id') }}".replace(':id', id),
                    success: function(response) {
                        // console.log(response.organisateur.id);
                        $('#nomOrg').val(response.organisateur.nomOrg);
                        $('#num1Org').val(response.organisateur.num1Org);
                        $('#num2Org').val(response.organisateur.num2Org);
                        $('#emailOrg').val(response.organisateur.emailOrg);
                        $('#whatsappNum').val(response.organisateur.whatsappNum);
                        $('#id').val(response.organisateur.id);

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
            $('#dtBasicExample').DataTable({
                "processing": true,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "scrollX": true,
                "scrollY": 250,
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
@endsection
