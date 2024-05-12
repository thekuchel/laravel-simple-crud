@extends('layouts.admin')
@section('main-content')
    <h6>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb">
                <li class="breadcrumb-item active">User</li>
            </ol>
        </nav>
    </h6>
    <div class="alert-user-success"></div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    <div class="alert-delete"></div>

    <div class="modal fade" tabindex="-1" id="modal-user" aria-labelledby="modal-user-label">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal-user-label" class="modal-title"></h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body mx-0 flex-grow-0" id="modal-user-body">
                </div>
            </div>
        </div>
    </div>


    <div class="card shadow mb-4 mt-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0 font-weight-bold text-primary">Data User</h5>
            @if (can_access('user', 'add'))
                <!-- <a href="#"><button class="btn btn-primary btn-sm" style="height: 40px;">Import Data</button></a> &nbsp; -->
                <a href="/user/create" class="float-end user-modal-link add-user"><button class="btn btn-primary btn-sm"
                        style="height: 40px;"><i class='icon ni ni-plus'></i>
                        Tambah
                        Data</button></a>
            @endif
        </div>
        <div class="card-body">
            {{-- <div class="table-responsive"> --}}
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped thead-primary-custom text-nowrap dataTable" id="datatables"
                        width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th style='width:150px'>Aksi</th>
                                <th>Nama</th>
                                <th>E-Mail</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            {{--
    </div> --}}
        </div>
    </div>

    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel">Hapus Data</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    Apakah anda yakin untuk menghapus data ini ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-delete">Hapus</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-user-confirmation" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="title-user-confirmation"></h5>
                    <p class='body-user-confirmation'></p>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-6">
                            <button type="button"
                                class="btn btn-outline-secondary btn-block close-modal-user-confirmation w-100"
                                data-dismiss="modal">Periksa Kembali</button>
                        </div>

                        <div class="col-6">
                            <button type="button"
                                class="btn btn-secondary btn-block btn-confirm-user-confirmation w-100">Ya,
                                Yakin</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTables -->
    <script src="/assets/libs/datatables/datatables.min.js"></script>
    <script src="/assets/libs/datatables/datatables.bootstrap5.min.js"></script>
    <script src="/assets/libs/moment/moment.min.js"></script>
    <script>
        const datatable = $('#datatables').DataTable({
            // language: {
            //   lengthMenu: "Tampilkan _MENU_ data per halaman",
            //   zeroRecords: "Data tidak ditemukan",
            //   info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            //   infoEmpty: "Data Tidak Tersedia",
            //   infoFiltered: "(disaring dari _MAX_ total data)",
            //   search: "Pencarian",
            //   zeroRecords: "Tidak ada data ditemukan",
            //   paginate: {
            //     "first": "Pertama",
            //     "last": "Terakhir",
            //     "next": "Selanjutnya",
            //     "previous": "Sebelumnya"
            //   },
            // },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ url()->current() }}/datatables/',
            columns: [{
                    data: null,
                    orderable: false,
                    render: function(data, type, row) {
                        let return_button = '';
                        @if (can_access('user', 'edit'))
                            return_button +=
                                "<a class='btn btn-icon btn-outline-primary edit user-modal-link' href='{{ url()->current() }}/edit/" +
                                data.id + "'><i class='icon ni ni-edit'></i></a> ";
                        @endif

                        @if (can_access('user', 'delete'))
                            return_button +=
                                "<a class='btn btn-icon btn-outline-primary delete' href='#' data-id='" +
                                data.id + "'><i class='icon ni ni-trash'></i></a>";
                        @endif
                        return return_button;
                    }
                }, {
                    data: 'name',
                    name: 'u.name',
                    orderable: false
                },
                {
                    data: 'email',
                    name: 'u.email',
                    orderable: false
                },
                {
                    data: 'role',
                    name: 'r.nama',
                    orderable: false
                },
            ],
            columnDefs: [{
                targets: 2,
                className: "text-center",
            }],
        });

        $(function() {
            setTimeout(function() {
                $(".alert-success").hide(1000);
            }, 3000);


            let deleteId = 0;
            $(document).on('click', '.delete', function() {
                deleteId = $(this).data('id');
                console.log(deleteId);
                $("#modalDelete").modal('show');
            });

            $(document).on('click', '.close', function() {
                $("#modalDelete").modal('hide');
            });

            $(document).on('click', '.close-modal', function() {
                $("#modalDelete").modal('hide');
            });
            $(document).on('click', '.close-modal-user-confirmation', function() {
                $("#modal-user-confirmation").modal('hide');
            });


            $(".btn-delete").on('click', function() {
                $.get(`/user/delete/${deleteId}`)
                    .then(res => {
                        console.log(res);
                        datatable.ajax.reload();
                        $("#modalDelete").modal("hide");
                        $(".alert-delete").html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data Berhasil Dihapus!
                </div>`)
                    }).catch(err => {
                        console.log(err);
                        if (err.responseJSON) {
                            $(".alert").html(`
                        <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                            ${err.responseJSON.message}
                        </div>
                    `)
                        }
                    })

                // $("#workshopModal").modal("hide");
            })

            $(".add-user").on('click', function(e) {
                $("#modal-user-label").html("Input User Baru");
            })

            $(document).on('click', ".edit", function(e) {
                $("#modal-user-label").html("Edit User");
            })

            $(".btn-confirm-user-confirmation").on('click', function() {
                $("#modal-user-confirmation").modal('hide');
                submitForm();
            })

            $(document).on('submit', "#quill-form-submit", function(e) {
                e.preventDefault();
                if ($(this).data('state') == 'create') {
                    $(".title-user-confirmation").html("Tambahkan User");
                    $(".body-user-confirmation").html(
                        "Apakah Anda ingin menambahkan User baru? Pastikan data nya sudah benar & sesuai"
                    );
                } else {
                    $(".title-user-confirmation").html("Edit User");
                    $(".body-user-confirmation").html(
                        "Apakah Anda ingin merubah User? Pastikan data nya sudah benar & sesuai");
                }

                $("#modal-user-confirmation").modal('show');

            })

            function submitForm() {
                $(".mce").map((i, r) => {
                    var hvalue = $(r).find($(".ql-editor")).html();
                    $(r).parent().append(
                        `<textarea name='${$(r).prop("id")}' id='${$(r).prop("id")}' style='display:none' class='class-editor-generated'>${hvalue}</textarea>`
                    );
                })
                // e.currentTarget.submit();
                $("#quill-form-submit").find($(".btn-submit")).prop('disabled', 'disabled');

                const formData = new FormData($("#quill-form-submit")[0])
                $.ajax({
                    url: "/user/{{ isset($data) ? 'edit/' . $data->id : 'create' }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                }).then(function(res) {

                    datatable.ajax.reload();
                    $("#modal-user").modal("hide");
                    $(".alert-user-success").html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ isset($data) ? 'User Berhasil Dirubah!' : 'User Berhasil Disimpan!' }}
              </div>`)
                }).catch(err => {
                    // console.log(err);
                    if (err.responseJSON) {
                        const errField = Object.entries(err.responseJSON?.errors);
                        console.log(errField)
                        errField.map((r, i) => {
                            const idx = r[0];
                            const msg = r[1];
                            console.log(r);
                            $(`#modal-user input[name='${idx}']`).addClass("is-invalid");
                            $(`#modal-user select[name='${idx}']`).addClass("is-invalid");
                            $(`#modal-user input[name='${idx}']`).parent().find(
                                ".invalid-feedback").html(msg)
                            $(`#modal-user select[name='${idx}']`).parent().find(
                                ".invalid-feedback").html(msg)
                            console.log();
                        })
                    }
                    $(".class-editor-generated").remove();
                    $("#quill-form-submit").find($(".btn-submit")).prop('disabled', false);
                })
            }

            $(document).on('click', ".user-modal-link", function(e) {
                e.preventDefault();
                $("#modal-user-body").html(`<div class='w-100 text-center mt-5'><div class="spinner-border spinner-border-lg text-secondary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div></div>`)
                $("#modal-user").modal("show");
                $.get($(this).attr('href')).then(function(res) {
                    $("#modal-user-body").html(res)
                })
            })

        });
    </script>
@endsection
