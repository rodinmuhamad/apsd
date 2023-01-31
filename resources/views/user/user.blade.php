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
                                        <td>Image</td>
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
                            <label>Nama users</label>
                            <input type="text" name="name" class="form-control" placeholder="Isi Nama" required>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label>Image</label>
                            <div class="row" style="display: flex; align-items: center;">
                                <div class="col-md-6">
                                    <label for="photo">
                                        <img id="imagePreview" style="max-width: 200px;max-height: 200px;"
                                            src="{{ asset('minia/assets/no_photo.png') }}" />
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <small>
                                        -Klik Gambar untuk upload logo<br>
                                        -ukuran foto max 1 MB<br>-ekstensi *.jpeg,*.jpg dan *.png</small>
                                    <input title="open file" id="photo" name="image" type="file"
                                        class="form-control input-xs" style="display:none" onchange="readURL(this)"
                                        style="cursor: pointer;" />
                                </div>

                                <div class="col-md-12">
                                    <label>email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Isi Username"
                                        required>
                                </div>

                                <div class="col-md-12">
                                    <label>Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text showpassword"><i class="fa fa-eye"></i></span>
                                        </div>
                                        <input type="password" name="password" class="form-control inputpassword"
                                            placeholder="Isi Passsword">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label>Level</label>
                                    <select name="level" class="form-control">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
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
                $('#imagePreview').attr('src', "{{ asset('minia/assets/no_photo.png') }}");
                $('#form')[0].reset();
                $('#modal').modal('show');
            })

            $(".showpassword").on('click', function() {
                var input = $(".inputpassword");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }

            });


            $('#form').on('submit', function(e) {
                e.preventDefault();
                //Form data

                var data = new FormData();
                var form_data = $('#form').serializeArray();
                $.each(form_data, function(key, input) {
                    if (input.name != 'image') {
                        data.append(input.name, input.value);
                    }
                });


                //image
                if ($('#form input[name="image"').val()) {
                    var statesArray = ['jpg', 'jpeg', 'png']; // list out all

                    var extension = $('#form input[name="image"').val().replace(/^.*\./, "").toLowerCase();
                    var index = $.inArray(extension, statesArray);
                    if (index < 0) {
                        alert('harus berekstensi JPG,JPEG,PNG');
                        btnloadhide()
                        $(this).val("");
                        return false;
                    }
                    if ($('#form input[name="image"]')[0].files[0].size / 1024 > 1000) {
                        alert("Foto anda terlalu besar, harus kurang dari 1 MB. Thanks!!");
                        $(this).val("");
                        return false;
                    }
                    //File data
                    var file_data = $('#form input[name="image"]').prop('files')[0];
                    data.append("image", file_data);
                }
                //end image

                $.ajax({
                    url: "/user",
                    type: 'post',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: data
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
                url: "/tableuser",
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
                url: "/deleteuser",
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
                url: "/getuser",
                type: 'get',
                dataType: 'json',
                data: {
                    id: a
                }
            }).done(function(data) {
                $('input[name="id"]').val(data[0].id);
                $('input[name="name"]').val(data[0].name);
                $('input[name="email"]').val(data[0].email);
                $('input[name="password"]').val('');
                $('select[name="level"]').val(data[0].level).change();
                $('#imagePreview').attr('src', '{{ asset('/') }}'+ (data[0].image == '' || data[0].image == null ? 'assets/user/no_photo.png' : data[0].image));
                $('#modal').modal('show');
            }).fail(function(data) {
                alert('Tidak Bisa Ambil Data');
                return false;
            })
        }

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
