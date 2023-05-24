@extends('Admin.pages.layout.header')
@section('Invite')

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
            <h2 class="card-title text-white fw-bolder">Invités</h2>
            <div class="card-tools">

            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <a id="btnModalFormOrganisteur" href="#modalFormOrganisteur" class="btn text-white mb-4"
                style="background-color:#0b3544;" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i
                    class="fas fa-plus-circle"></i> <span>Ajouter un Invité</span></a>

           <div class="dataTable-container">
            <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col">Nom Invités</th>
                        <th scope="col">Emails</th>
                        <th scope="col">N° Tel</th>
                        <th scope="col">Nombre Adultes</th>
                        <th scope="col">Nombre D'Enfants</th>
                        <th scope="col">QR codes</th>
                        <th scope="col">Tables Adultes</th>
                        <th scope="col">Evenements</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Invite as $item)
                        <tr>
                            <td>{{ $item->nomInv }}</td>
                            <td>{{ $item->emailInv }}</td>
                            <td>{{ $item->telephoneInv }}</td>
                            <td>{{ $item->nbreInv }} </td>
                            <td>{{ $item->enfant }} </td>
                            <td>{{ QrCode::size(80)->generate($item->codeInv) }}</td>
                            <td>{{ $item->tables->nomTableInv  ?? 'Nom Table non défini'  }}</td>
                            <td>{{ $item->evenement->nomEvn ?? 'Evenement non défini'}}</td>
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
    <!-- Modal-->
    @include('Admin.pages.File_Invite.deleteInvite')
    @include('Admin.pages.File_Invite.editInvite')
    @include('Admin.pages.File_Invite.addInvite')

    <!-- Modal-->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.deletebtn', function() {
                var iddelte = $(this).attr('value');
                //alert('ID de l\'Invite : ' + id);
                $('#ModalDelete').modal('show');
                $('#deleteing_id').val(iddelte);
            });

            $(document).on('click', '.editbtn', function() {
                var id = $(this).attr('value');
                //alert('ID de l\'Invite : ' + id);
                $('#ModalEdit').modal('show');
                $.ajax({
                    type: "GET",
                    url: "{{ route('Invite.edit', ':id') }}".replace(':id', id),
                    success: function(response) {
                        // console.log(response.Invite.id);
                        $('#nomInv').val(response.Invite.nomInv);
                        $('#telephoneInv').val(response.Invite.telephoneInv);
                        $('#emailInv').val(response.Invite.emailInv);
                        $('#nbreInv').val(response.Invite.nbreInv);
                        $('#ivn_table_id').val(response.Invite.ivn_table_id);
                        $('#evn_id').val(response.Invite.evn_id);
                        $('#codeInv').val(response.Invite.codeInv);
                        $('#enfant').val(response.Invite.enfant);
                        $('#id').val(response.Invite.id);
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
                "autoWidth": false,
                "responsive": false,
                "scrollX": true,
                "scrollY": 200,
            });
            $('.dataTables_length').addClass('bs-select');
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
@endsection
