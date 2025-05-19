@extends('layouts.base')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
    integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
@endsection

@push('styles')
<link href="{{ asset('assets/css/admin_content.css') }}" rel="stylesheet">
@endpush

@section('content')
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: 14px;
        }

        div.dataTables_wrapper div.dataTables_length,
        div.dataTables_wrapper div.dataTables_filter {
            margin-bottom: 1rem; /* atau ubah sesuai kebutuhan */
        }
    </style>

    <div class="contentMain">
        <h1 class="pageNameContent">Manage Pricing List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Admin Menu</li>
            <li class="breadcrumb-item active">Manage Pricing List</li>
        </ol>

        <div class="card mb-4">
            <div class="wrapperTable table-responsive">
                    <div class="card-header mx-1 bg-white d-flex justify-content-between align-items-center">
                    <span class="fw-normal fs-4 my-3 d-block">
                        Pricing List Data
                    </span>
                    <button type="button" class="btn btn-create-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        + Create Pricing
                    </button>
            </div>

            <div class="card-body">
                <table id="countryList" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Greather Than (X)</th>
                            <th class="text-center">Less Than (X)</th>
                            <th class="text-center">Value</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-center">
                                    <div class="detailName">
                                        <p class="name">{{ $item->count }}</p>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="detailName">
                                        <p class="name">
                                            @php
                                                try {
                                                    echo $data[$key + 1]->count;
                                                } catch (\Throwable $th) {
                                                    echo 'DST';
                                                }
                                            @endphp
                                        </p>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="detailName">
                                        <p class="name">{{ $item->value }}%</p>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="buttonAction">
                                        <button type="button" class="btn btn-primary" data-id="{{ $item->id }}" data-bs-toggle="modal"
                                            data-bs-target="#updateTanaman"
                                            data-count="{{ $item->count }}" data-value="{{ $item->value }}" data-url="{{ route('admin.pricing.update', ['id'=>$item->id]) }}">

                                            <img width="20" height="20" src="{{ url('assets/img/create-outline 1.svg') }}"
                                                alt="">
                                        </button>

                                        <a href="{{ route('admin.pricing.delete', ['id' => $item->id]) }}"
                                            class="btn btn-danger">
                                            <img width="20" height="20" src="{{ url('assets/img/trash-outline 1.svg') }}"
                                                alt="">
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- <div class="contentMain">
        <h2 class="pageNameContent">Pricing List</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Pricing List</li>
        </ol>

        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add Pricing
            </button>
        </div>

        <div class="wrapperTable table-responsive">
            <table id="countryList" class="tables" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Greather Than (X)</th>
                        <th>Less Than (X)</th>
                        <th>Value</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <div class="detailName">
                                    <p class="name">{{ $item->count }}</p>
                                </div>
                            </td>

                            <td>
                                <div class="detailName">
                                    <p class="name">
                                        @php
                                            try {
                                                echo $data[$key + 1]->count;
                                            } catch (\Throwable $th) {
                                                echo 'DST';
                                            }
                                        @endphp
                                    </p>
                                </div>
                            </td>

                            <td>
                                <div class="detailName">
                                    <p class="name">{{ $item->value }}%</p>
                                </div>
                            </td>
                            <td>

                                <div class="buttonAction">
                                    <button type="button" data-id="{{ $item->id }}" data-bs-toggle="modal"
                                        data-bs-target="#updateTanaman" class="buttons success text-white me-2"
                                        data-count="{{ $item->count }}" data-value="{{ $item->value }}" data-url="{{ route('admin.pricing.update', ['id'=>$item->id]) }}">

                                        <img width="20" height="20" src="{{ url('assets/img/create-outline 1.svg') }}"
                                            alt="">
                                    </button>

                                    <a href="{{ route('admin.pricing.delete', ['id' => $item->id]) }}"
                                        class="buttons danger text-white">
                                        <img width="20" height="20" src="{{ url('assets/img/trash-outline 1.svg') }}"
                                            alt="">
                                    </a>
                                </div>



                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div> -->





    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Pricing List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.pricing.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label" for="Count / QTY">Count / QTY</label>
                            <input type="number" class="form-control" name="count" id="count">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="Value">Value</label>
                            <input type="number" class="form-control" name="value" id="value">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateTanaman" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="updateTanamanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div id="modal-content" class="modal-content">
                <div class="modal-body">
                    Loading ...
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('#countryList').DataTable({
                "info": false,
                "bSort": false,
            });
        });




    </script>


    <script>
        $('#updateTanaman').on('shown.bs.modal', function(e) {


            var html = `
    <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Pricing List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="${$(e.relatedTarget).data('url')}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label" for="Count / QTY">Count / QTY</label>
                        <input type="number" class="form-control" name="count" id="count" value="${$(e.relatedTarget).data('count')}">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="Value">Value</label>
                        <input type="number" class="form-control" name="value" value="${$(e.relatedTarget).data('value')}" id="value" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
`;

            $('#modal-content').html(html);

        })
    </script>
@endsection
