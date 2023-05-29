@extends('Etudiant.pages.layout.header')
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
            <div class="card-header" style="background-color:#1b440b;">
                <h2 class="card-title text-white fw-bolder">Utilisateur Etudiant</h2>
                <div class="card-tools">

                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">

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

                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>.............</td>
                                    <td>
                                        <div class=" d-flex grid ">

                                            <div class="g-col-4 ml-3">
                                                <div class="editbtn" type="button" value="{{ $user->id }}">
                                                    <i class="fa fa-edit" style="color: #1b440b;"></i>
                                                </div>
                                            </div>
                                            <div class="g-col-4 ml-3">
                                                <div class="deletebtn" type="button" value="{{ $user->id }}">
                                                    <i class="fa fa-trash" style="color: #ec270d;"></i>
                                                </div>
                                            </div>
                                    </td>
                                </tr>

                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.card-body -->
        </div>

    </div>
    </div>


    <!-- Modal-->
    @include('Etudiant.pages.File_User.deleteUser')
    @include('Etudiant.pages.File_User.editUser')


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
                    url: "{{ route('etudiant.edit', ':id') }}".replace(':id', id),
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
