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
        <h1 class="pageNameContent">Manage Shipping</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Admin Menu</li>
            <li class="breadcrumb-item active">Manage Shipping</li>
        </ol>

        <div class="card mb-4">
            <div class="wrapperTable table-responsive">
                <div class="card-header mx-1 bg-white d-flex justify-content-between align-items-center">
                    <span class="fw-normal fs-4 my-3 d-block">
                            Shipping Data
                    </span>
                    <button type="button" class="btn btn-create-add" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        + Add Shipping
                    </button>
                </div>
            </div>

<<<<<<< HEAD
            <div class="card-body">
=======
         <div class="card-body">
            <table id="countryList" class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Shipping Method</th>
                        <th>Less Than Equal (X)</th>
                        <th>Value</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $item->ship_method }}</td>
                            <td>{{ $item->count }}</td>
                            <td>{{ $item->price }}</td>
                            <td style="width: 20%" class="text-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#updateTanaman" data-id="{{ $item->id }}"
                                data-ship_method="{{ $item->ship_method }}" data-count="{{ $item->count }}"
                                data-price="{{ $item->price }}" data-url="{{ route('admin.shipping.update', ['id'=>$item->id]) }}">
                                <img width="20" height="20" src="{{ url('assets/img/create-outline 1.svg') }}"
                                    alt="">
                            </button>
                            <a class="btn btn-danger"
                                    href="{{ route('admin.shipping.delete', ['id' => $item->id]) }}"><img width="20"
                                        height="20" src="{{ url('assets/img/trash-outline 1.svg') }}" alt=""></a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
         </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div id="modal-content" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Shipping List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.shipping.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label" for="ship_method">Ship Method</label>
                            <input type="text" class="form-control" name="ship_method" id="ship_method">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="Count / QTY">Count / QTY</label>
                            <input type="number" class="form-control" name="count" id="count">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="price">Price</label>
                            <input type="number" class="form-control" name="price" id="price">
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





        // $('.file-lisensi').change(function() {

        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         url: "/admin/changeLicenseCountry",
        //         method: "POST",
        //         data: {
        //             file_lisensi: $(this).prop('checked') ? 1 : 0,
        //             country_id: $(this).attr('data-id')

        //         },
        //         success: function(data) {

        //             console.log(data);


        //         },
        //         error: function(data) {
        //             console.log(data);


        //         }

        //     });
        // });
    </script>


    <script>
        $('#updateTanaman').on('shown.bs.modal', function(e) {


            var html = `
    <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Shipping List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="${$(e.relatedTarget).data('url')}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label" for="ship_method">Shipping Method</label>
                        <input type="text" class="form-control" name="ship_method" id="ship_method" value="${$(e.relatedTarget).data('ship_method')}">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="Count / QTY">Count / QTY</label>
                        <input type="number" class="form-control" name="count" id="count" value="${$(e.relatedTarget).data('count')}">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="price">price</label>
                        <input type="number" class="form-control" name="price" value="${$(e.relatedTarget).data('price')}" id="price" >
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
