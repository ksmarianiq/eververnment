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

    <div class="container mb-3 ">


    </div>
    </div>

    <div class="card">
        <div class="card-header" style="background-color:#0b3544;">
            <h2 class="card-title text-white fw-bolder">Programmes</h2>
            <div class="card-tools">

            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <a id="btnModalFormOrganisteur" href="#modalFormOrganisteur" class="btn text-white mb-4"
                style="background-color:#0b3544;" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i
                    class="fas fa-plus-circle"></i> <span>Ajouter un Programme</span></a>

            <table id="dtBasictable-b" class="table table-striped table-bordered  text-truncate" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col">Libelées </th>
                        <th scope="col">Dates</th>
                        <th scope="col">Heures</th>
                        <th scope="col">Lieux</th>
                        <th scope="col">Evénements</th>
                        <th scope="col">Latitudes</th>
                        <th scope="col">Longitude</th>
                        <th scope="col">QR code</th>
                        <th scope="col">Descriptions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prog as $item)

                            <td>{{ $item->libProg }}</td>
                            <td>{{ $item->dateProg }}</td>
                            <td>{{ $item->heureProg }} </td>
                            <td>{{ $item->lieuProg }}</td>
                            <td>{{ $item->evenement->nomEvn }}</td>
                            <td>{{ $item->latitude }}</td>
                            <td>{{ $item->longitude }}</td>
                            <td>{{ QrCode::size(80)->generate($item->codeProg) }}</td>
                            <td >{{ $item->descriptionProg }}</td>
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
        <!-- /.card-body -->
    </div>
    <!-- Modal-->
    @include('Admin.pages.File_Programme.deleteProgramme')
    @include('Admin.pages.File_Programme.editProgramme')
    @include('Admin.pages.File_Programme.addProgramme')

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
                    url: "{{ route('programme.edit', ':id') }}".replace(':id', id),
                    success: function(response) {
                        // console.log(response.programme.id);
                        $('#libProg').val(response.programme.libProg);
                        $('#dateProg').val(response.programme.dateProg);
                        $('#heureProg').val(response.programme.heureProg);
                        $('#lieuProg').val(response.programme.lieuProg);
                        $('#descriptionProg').summernote("code", response.programme.descriptionProg);
                        $('#evn_id').val(response.programme.evn_id);
                        $('#latitude').val(response.programme.latitude);
                        $('#longitude').val(response.programme.longitude);
                        $('#id').val(response.programme.id);
                    }
                })
            });
        });
    </script>
    <script>
        // Générer une chaîne de caractères aléatoire de longueur donnée
        function generateRandomString(length) {
            var result = "";
            var characters = "0123456789";
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        // Générer une référence aléatoire en combinant des lettres et des chiffres
        function generateProductReference() {
            var numbers = generateRandomString(4);
            return numbers;
        }

        // Récupérer le champ de saisie
        var input = document.getElementById("reference");

        // Générer une référence aléatoire et l'afficher dans le champ de saisie
        input.value = generateProductReference();
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
            $('#dtBasictable-b').DataTable({
                "processing": true,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false,
                "scrollX": true,
                "scrollY": 200,
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
@endsection
