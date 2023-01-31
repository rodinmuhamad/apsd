@extends('template.layout')

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Master Akses User</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/beranda">Home</a></li>
                            <li class="breadcrumb-item active">Master Akses User</li>
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
                        <div class="card-body">
                            <button class="btn btn-soft-info btn-sm mb-3" id="btn_form"><i
                                    class="mdi mdi-plus mdi-16px"></i>
                                Tambah</button>
                            <span id="load" style="display: none;"><i class="mdi mdi-rotate-left mdi-spin mdi-36px">
                                    Getting Data !!!</i></span>
                            <table id="tabel_data" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td>No</td>
                                        <td>Name</td>
                                        <td>email</td>
                                        <td>Akses</td>
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
    <div class="modal fade bs-example-modal-xl" id="modal" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog ">

            <form class="needs-validation mt-4 pt-2" id="form" method="POST" action="#">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id">
                        <div class="col-md-12">
                            <label>Users</label>

                            <select name="user_id" class="form-control" required>
                                <option value="">-----</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="row" style="display: flex; align-items: center;">


                                <div class="col-md-12">
                                    <label>Akses</label>
                                    <select name="akses" class="form-control" required>
                                        <option value="">-----</option>
                                        @foreach ($akses as $item)
                                            <option value="{{ $item['url'] }}">{{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-save"><span
                                    class="btn-txt">SIMPAN</span></button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">CLOSE</button>
                        </div>
                    </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        $(document).ready(function() {
            tabel()


            $('#btn_form').click(function() {
                $('#form input[name="id"]').val('');
                $('#form')[0].reset();
                $('#modal').modal('show');
            })


            $('#form').on('submit', function(e) {
                e.preventDefault();
                //Form data

                var form_data = $('#form').serializeArray();

                $.ajax({
                    url: "/akses",
                    type: 'post',
                    dataType: 'json',
                    data: form_data
                }).done(function(data) {
                    alert(data.message);
                    tabel();
                }).fail(function(data) {
                    alert('Gagal');
                })
            })
        })

        function tabel() {
            $('#load').show();
            $('.table').DataTable().destroy();
            $('.table tbody').html('');
            $.ajax({
                type: 'GET',
                url: "/tableakses",
                dataType: 'text'
            }).done(function(data) {
                $('.table tbody').html(data);
                $('#load').hide();
                $('.table').DataTable({
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

        function hapus(a) {
            $.ajax({
                url: "/deleteakses",
                type: 'GET',
                dataType: 'json',
                data: {
                    id: a
                }
            }).done(function(data) {
                alert(data.message);
                tabel();
            }).fail(function(data) {
                alert("error");
            })
        }

        function edit(a) {
            $('#form')[0].reset();
            $.ajax({
                url: "/getakses",
                type: 'get',
                dataType: 'json',
                data: {
                    id: a
                }
            }).done(function(data) {
                $('input[name="id"]').val(data[0].id);
                $('select[name="akses"]').val(data[0].akses).change();
                $('select[name="user_id"]').val(data[0].user_id).change();
                $('#modal').modal('show');
            }).fail(function(data) {
                alert('Tidak Bisa Ambil Data');
                return false;
            })
        }
    </script>
@endsection
