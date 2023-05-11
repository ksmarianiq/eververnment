@extends('Admin.pages.layout.header')
@section('Evenement')
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
            <h2 class="card-title text-white fw-bolder">Evenements</h2>
            <div class="card-tools">

            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <a id="btnModalFormOrganisteur" href="#modalFormOrganisteur" class="btn text-white mb-4"
                style="background-color:#0b3544;" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i
                    class="fas fa-plus-circle"></i> <span>Ajouter un Evenement</span></a>

                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nom Evenement</th>
                        <th>Nom organisateur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Eve as $item)
                        <tr>
                            <td>{{ $item->nomEvn }}</td>
                            <td>{{ $item->organisateur->nomOrg }}</td>
                            <td>
                                <div class=" d-flex grid ">
                                    <div class="g-col-4">
                                        <div class="editbtn" type="button" value="{{$item->id}}" >
                                             <i class="fa fa-edit" style="color: #0b3544;"></i>
                                        </div>
                                    </div>
                                    <div class="g-col-4 ml-3">
                                        <div class="deletebtn" type="button" value="{{$item->id}}" >
                                             <i  class="fa fa-trash" style="color: #ec270d;"></i>
                                        </div>
                                    </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>

                        <th>Nom Evenement</th>
                        <th>Nom organisateur</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
     <!-- Modal-->
    @include('Admin.pages.File_Evenement.deleteEvenement')
    @include('Admin.pages.File_Evenement.editEvenement')
    @include('Admin.pages.File_Evenement.addEvenement')

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
               url: "{{ route('Evenement.edit', ':id') }}".replace(':id', id),
               success: function(response) {
                  console.log(response);
                  $('#nomEvn').val(response.Evenement.nomEvn);
                  $('#org_id').val(response.Evenement.org_id);
                  $('#id').val(response.Evenement.id);
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
                "responsive": true,
                "scrollX": true,
                "scrollY": 150,
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
@endsection
