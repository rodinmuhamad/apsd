@extends('template.layout')

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Master User</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/beranda">Home</a></li>
                            <li class="breadcrumb-item active">Master User</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <h4 class="card-title">Buttons example</h4> -->
                        <button class="btn btn-soft-info btn-sm" id="btn_add"><i class="mdi mdi-plus mdi-16px"></i>
                            Tambah</button>
                        <div class="card-body">
                            <span id="load" style="display: none;"><i class="mdi mdi-rotate-left mdi-spin mdi-36px">
                                    Getting Data !!!</i></span>
                            <table id="tabel_data" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td>No</td>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Password</td>
                                        <td>Level</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end cardaa -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <!-- Static Backdrop Modal -->
    <div class="modal fade bs-example-modal-xl" id="modal_add" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <label hidden id="lbl_id"></label>
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <div class="row"> -->
                    <label>ID Supplier</label>
                    <input type="text" class="form-control form-control-sm" id="id_sup" name="id_sup">
                    <label>Nama Supplier</label>
                    <input type="text" class="form-control form-control-sm" id="nama" name="nama">
                    <label>Singkatan</label>
                    <input type="text" class="form-control form-control-sm" id="singkat" name="singkat">
                    <label>Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat"></textarea>
                    <!-- </div>                     -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_simpan">Simpan</button>
                    <button type="button" class="btn btn-success" id="btn_ubah">Ubah</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script src="{{ asset('minia/assets/libs/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            tabel()
        })

        function tabel() {
            $('#load').show();
            $.ajax({
                type: 'GET',
                url: "/tableuser",
                dataType: 'text'
            }).done(function(data) {
                $('.table').dataTable().fnClearTable();
                $('.table').dataTable().fnDraw();
                $('.table').dataTable().fnDestroy();
                $('.table tbody').html(data);
                $('#load').hide();
                $('.table').dataTable({
                    scrollX: true,
                    lengthMenu: [
                        [5, 25, 50, -1],
                        ['5', '25', '50', 'all']
                    ]
                });
            }).fail(function(data) {
                $('#load').hide();
                alert('Gagal');
            })
        }
    </script>
@endsection
