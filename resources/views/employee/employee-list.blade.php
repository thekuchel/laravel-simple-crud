@extends('layouts.admin')
@section('main-content')
    <h6>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb">
                <li class="breadcrumb-item active">
                    Daftar Pekerja
                </li>
            </ol>
        </nav>
    </h6>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <div class="alert-employee-success"></div>
    <div class="alert-delete"></div>

    <div class="card shadow mb-4 mt-4">
        <div class="card-header d-flex align-items-center ">
            <div class="row w-100">
                <div class="col-md-9">
                    {{-- <h5 class="mb-0 font-weight-bold text-primary">Data Daftar Pekerja</h5> --}}
                    <input type="text" name="search_filter" id="search_filter" class="form-control"
                        placeholder="Cari Pekerja" />
                </div>
                <div class="col-md-3 text-end">
                    @if (can_access('employee', 'add'))
                        <!-- <a href="#"><button class="btn btn-primary btn-sm" style="height: 40px;">Import Data</button></a> &nbsp; -->
                        <a href="/employee/create" class="float-end w-100 add-employee employee-trigger-link"><button
                                class="btn btn-primary btn-sm btn-block" style="height: 40px;"><i
                                    class='icon ni ni-plus'></i> Tambah Pekerja</button></a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            {{-- <div class="table-responsive"> --}}
            <div class="row">
                <div class="col-sm-12">
                    <table class="table text-nowrap dataTable  table-striped  display nowrap" id="datatable" width="100%"
                        cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                        <thead>
                            <tr role="row">
                                <th style="width: 120px;">Aksi</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                {{-- <th>Username</th> --}}
                                <th>Divisi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            {{--
        </div> --}}
        </div>
    </div>

    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel"
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
                    <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-delete-record">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-employee" tabindex="-1" role="dialog" aria-labelledby="modal-employee-label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-employee-label">Hapus Data</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body modal-employee-body">
                    Apakah anda yakin untuk menghapus data ini ?
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-employee-confirmation" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="title-employee-confirmation"></h5>
                    <p class='body-employee-confirmation'></p>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-6">
                            <button type="button"
                                class="btn btn-outline-secondary btn-block close-modal-employee-confirmation w-100"
                                data-dismiss="modal">Periksa Kembali</button>
                        </div>

                        <div class="col-6">
                            <button type="button"
                                class="btn btn-primary btn-block btn-confirm-employee-confirmation w-100">Ya,
                                Yakin</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/libs/datatables/datatables.min.js"></script>
    <script src="/assets/libs/datatables/datatables.bootstrap5.min.js"></script>
    <script src="/assets/libs/moment/moment.min.js"></script>
    <script>
        const datatable = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            scrollX: true,
            sScrollXInner: "100%",
            scrollCollapse: true,
            scrollY: '500px',
            order: [
                [2, 'asc']
            ],
            ajax: {
                url: '/employee/list-datatables',
                data: function(d) {
                    // d.custom = $('#myInput').val();
                    // etc
                    return $.extend({}, d, {
                        search: $("#search_filter").val(),
                        status: $("#status_filter").val(),
                    });
                },
            },
            columns: [{
                    data: null,
                    searchable: false,
                    orderable: false,
                    class: "text-center",
                    render: function(data, type, row) {
                        // Combine the first and last names into a single table field
                        let return_button = '';
                        // return_button += `<a class='btn btn-icon btn-info' href='/employee/detail/${data.id}'><i class='tf-icons bx bx-detail'></i></a> `;

                        @if (can_access('employee', 'edit'))
                            return_button +=
                                `<a class='btn btn-icon btn-outline-primary edit employee-trigger-link' href='/employee/edit/${data.id}' data-id='${data.id}'><i class='icon ni ni-edit'></i></a> `;
                        @endif

                        @if (can_access('employee', 'delete'))
                            return_button +=
                                `<a class='btn btn-icon btn-outline-primary delete' href='#' data-id='${data.id}'><i class='icon ni ni-trash'></i></a> `;
                        @endif

                        return return_button;
                    }
                }, {
                    data: 'nik',
                    name: 'nik',
                }, {
                    data: 'name',
                    name: 'name',
                },
                // {
                //    data: 'user.username',
                //    name: 'user.username',
                //}, 
                {
                    data: 'divisi',
                    name: 'divisi',
                },
            ]
        });

        $(function() {

            let editRecordId = 0;
            $(".add-employee").on('click', () => {
                editRecordId = 0;
                $("#modal-employee-label").html("Tambah Pekerja ");
            })

            $(document).on('click', ".edit", function(e) {
                $("#modal-employee-label").html("Edit Pekerja ");
                editRecordId = $(this).data('id');
            })


            let deleteRecordId = 0;
            $(document).on('click', '.delete', function() {
                deleteRecordId = $(this).data('id');
                $("#modal-delete").modal('show');
            });


            $(".btn-delete-record").on('click', function() {
                $.get(`/employee/destroy/${deleteRecordId}`)
                    .then(res => {
                        console.log(res);
                        datatable.ajax.reload();
                        $("#modal-delete").modal("hide");
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
            })


            $("#filter-property").on('change', function(d) {
                datatableAssetList.draw();
            });


            $(document).on('click', ".employee-trigger-link", function(e) {
                e.preventDefault();
                $(".modal-employee-body").html(`<div class='w-100 text-center mt-5'><div class="spinner-border spinner-border-lg text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div></div>`)
                $("#modal-employee").modal("show");
                $.get($(this).attr('href')).then(function(res) {
                    $(".modal-employee-body").html(res)
                })
            })

            let keyupTimeout;
            $("#search_filter").on('keyup', function(d) {
                clearTimeout(keyupTimeout);
                keyupTimeout = setTimeout(() => {
                    datatable.ajax.reload();
                }, 500);

            })

            $("#status_filter").on('change', function(d) {
                datatable.ajax.reload();
            })


            // FORM Submit handler
            $(".btn-confirm-employee-confirmation").on('click', function() {
                $("#modal-employee-confirmation").modal('hide');
                submitForm();
            })

            $(document).on('submit', "#quill-form-submit", function(e) {
                e.preventDefault();
                if ($(this).data('state') == 'create') {
                    $(".title-employee-confirmation").html("Tambahkan Pekerja");
                    $(".body-employee-confirmation").html(
                        "Apakah Anda ingin menambahkan Pekerja baru? Pastikan data nya sudah benar & sesuai"
                    );
                } else {
                    $(".title-employee-confirmation").html("Edit Pekerja");
                    $(".body-employee-confirmation").html(
                        "Apakah Anda ingin merubah Pekerja? Pastikan data nya sudah benar & sesuai");
                }

                $("#modal-employee-confirmation").modal('show');
            })

            function submitForm() {
                // e.preventDefault();
                $(".mce").map((i, r) => {
                    var hvalue = $(r).find($(".ql-editor")).html();
                    $(r).parent().append(
                        `<textarea name='${$(r).prop("id")}' id='${$(r).prop("id")}' style='display:none' class='class-editor-generated'>${hvalue}</textarea>`
                    );
                })
                // e.currentTarget.submit();
                $("#quill-form-submit").find($(".btn-submit")).prop('disabled', 'disabled');

                const formData = new FormData($("#quill-form-submit")[0])
                const url = editRecordId > 0 ? `/employee/edit/${editRecordId}` : '/employee/create';
                console.log(url, editRecordId);
                $.ajax({
                    url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                }).then(function(res) {
                    console.log(datatable.ajax);
                    datatable.ajax.reload();
                    $("#modal-employee").modal("hide");
                    $(".alert-employee-success").html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ isset($data) ? 'Pekerja Berhasil Dirubah!' : 'Pekerja Berhasil Disimpan!' }}
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
                            $(`#modal-employee input[name='${idx}']`).addClass(
                                "is-invalid");
                            $(`#modal-employee select[name='${idx}']`).addClass(
                                "is-invalid");
                            $(`#modal-employee input[name='${idx}']`).parent().find(
                                ".invalid-feedback").html(msg)
                            $(`#modal-employee select[name='${idx}']`).parent().find(
                                ".invalid-feedback").html(msg)
                            console.log();
                        })
                    }
                    $(".class-editor-generated").remove();
                    $("#quill-form-submit").find($(".btn-submit")).prop('disabled', false);
                })
            }


            $(document).on('click', '.close-modal-employee-confirmation', function() {
                $("#modal-employee-confirmation").modal('hide');
            });


        });
    </script>
@endsection
