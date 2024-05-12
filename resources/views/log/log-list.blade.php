@extends('layouts.admin')
@section('main-content')
    <h6>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb">
                <li class="breadcrumb-item active">
                    Log
                </li>
            </ol>
        </nav>
    </h6>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0 font-weight-bold text-primary">History Log</h5>
            <div class="col-md-6 text-end px-0">
            </div>
        </div>
        <div class="card-body">
            {{-- <div class="table-responsive"> --}}
            <div class="row">
                <div class="col-sm-12">
                    <table class="table text-nowrap table-bordered dataTable" id="datatables" width="100%" cellspacing="0"
                        role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                        <thead>
                            <tr role="row">
                                <th>Date & Time</th>
                                <th>User Name</th>
                                <th>Action</th>
                                <th>Entity</th>
                                <th>Name</th>
                                <th>Changes</th>
                        </thead>
                    </table>
                </div>
            </div>
            {{--
        </div> --}}
        </div>
    </div>


    <script src="/assets/libs/datatables/datatables.min.js"></script>
    <script src="/assets/libs/datatables/datatables.bootstrap5.min.js"></script>
    <script src="/assets/libs/moment/moment.min.js"></script>
    <script>
        const datatable = $('#datatables').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            scrollX: true,
            sScrollXInner: "100%",
            // scrollCollapse: true,
            scrollY: '500px',
            ajax: {
                url: '/logs/list-datatables',
                data: function(d) {
                    // d.custom = $('#myInput').val();
                    // etc
                },
            },
            columns: [{
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, row) {
                        return moment(data).format("DD MMM yyyy HH:mm:ss")
                    }
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: 'action',
                    name: 'action',
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    data: 'model',
                    name: 'model',
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    data: null,
                    name: null,
                    render: function(data, type, row) {
                        const loggable = JSON.parse(data.data.replace(/&quot;/g,'"'));
                        if (data.model == "App\\Repository\\Employee")
                            return '<a href="#">' + loggable.name + '</a>';
                        else if (loggable.name) return  loggable.name;
                        else return '';
                    }
                },
                {
                    data: 'fields',
                    name: 'fields',
                    render: function(data, type, row) {
                        if (data != null) {
                            json = JSON.parse(data.replace(/&quot;/ig,'"'));
                            output = "";
                            for(var key in json) {
                                if (key == "updated_at" || key == "created_at") continue;
                                output += key + ": " + json[key] + "<br/>";
                            }
                            return output;
                        } else {
                            return "";
                        }
                    }
                },
            ]
        });

        $("#export").on('click', function() {
            window.location =
                `/log/export`

        })
    </script>
@endsection
