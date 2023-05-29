@extends('Ecole.pages.layout.header')
@section('user')
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
            <div class="card-header" style="background-color:#44300b;">
                <h2 class="card-title text-white fw-bolder">Utilisateurs Ecole</h2>
                <div class="card-tools">

                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <a id="btnModalFormOrganisteur" href="#modalFormOrganisteur" class="btn text-white mb-4"
                    style="background-color:#44300b;" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i
                        class="fas fa-plus-circle"></i> <span>Ajouter un etudiant</span></a>
                <div class="dataTable-container">
                    <table id="dtBasictable-a" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Mot de passe</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email}}</td>
                                    <td>.............</td>
                                    <td>
                                        <div class=" d-flex grid ">

                                            <div class="g-col-4 ml-3">
                                                <div class="editbtn" type="button" value="{{ $item->id }}">
                                                    <i class="fa fa-edit" style="color: #44300b;"></i>
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
    @include('Ecole.pages.File_User.deleteUser')
    @include('Ecole.pages.File_User.editUser')
    @include('Ecole.pages.File_User.addUser')

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
                    url: "{{ route('ecole.edit', ':id') }}".replace(':id', id),
                    success: function(response) {
                        console.log(response);
                        $('#name').val(response.user.name);
                        $('#email').val(response.user.email);
                        $('#role').val(response.user.role);
                        $('#password').val(response.user.password);
                        $('#id').val(response.user.id);
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
