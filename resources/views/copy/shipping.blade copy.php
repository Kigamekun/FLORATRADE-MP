@extends('layouts.base')

@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/country-license.css') }}">
@endsection


@section('content')
    <div class="contentMain">
        <h2 class="pageNameContent">Fee Ship List</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Fee Ship List</li>
        </ol>

        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add Fee Ship
            </button>
        </div>

        <div class="wrapperTable table-responsive">
            <table id="countryList" class="tables" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Shipping Method</th>
                        <th>Less Than Equal (X)</th>

                        <th>Value</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->ship_method }}</td>
                            <td>
                                <div class="detailName">
                                    <p class="name">{{ $item->count }}</p>
                                </div>
                            </td>


                            <td>
                                <div class="detailName">
                                    <p class="name">${{ $item->price }}</p>
                                </div>
                            </td>
                            <td>

                                <div class="buttonAction">
                                    <button type="button" data-id="{{ $item->id }}" data-bs-toggle="modal"
                                        data-bs-target="#updateTanaman" class="buttons success text-white me-2"
                                        data-ship_method="{{ $item->ship_method }}" data-count="{{ $item->count }}"
                                        data-price="{{ $item->price }}" data-url="{{ route('admin.shipping.update', ['id'=>$item->id]) }}">

                                        <img width="20" height="20" src="{{ url('assets/img/create-outline 1.svg') }}"
                                            alt="">
                                    </button>

                                    <a href="{{ route('admin.shipping.delete', ['id' => $item->id]) }}"
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


    </div>





    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Fee Ship List</h5>
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





        $('.file-lisensi').change(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/changeLicenseCountry",
                method: "POST",
                data: {
                    file_lisensi: $(this).prop('checked') ? 1 : 0,
                    country_id: $(this).attr('data-id')

                },
                success: function(data) {

                    console.log(data);


                },
                error: function(data) {
                    console.log(data);


                }

            });
        });
    </script>


    <script>
        $('#updateTanaman').on('shown.bs.modal', function(e) {


            var html = `
    <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Fee Ship List</h5>
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
