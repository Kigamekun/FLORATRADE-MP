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
        <h1 class="pageNameContent">Manage Plant Categories</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Admin Menu</li>
            <li class="breadcrumb-item active">Manage Plant Categories</li>
        </ol>

        <div class="card mb-4">
            <div class="wrapperTable table-responsive">
                    <div class="card-header mx-1 bg-white d-flex justify-content-between align-items-center">
                    <span class="fw-normal fs-4 my-3 d-block">
                        Plant Categories Data
                    </span>
                    <button type="button" class="btn btn-create-add" data-bs-toggle="modal" data-bs-target="#createData">
                        + Add Categories
                    </button>
            </div>

            <div class="card-body">

                <table id="plantsTable" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Latin</th>
                            <th>Nama Indonesia</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td>{{ $item->name_latin }}</td>
                                <td>{{ $item->name_indonesia }}</td>
                                <td style="width: 20%" class="text-center">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#updateData" data-id="{{ $item->id }}"
                                    data-name_latin="{{ $item->name_latin }}"
                                    data-name_indonesia="{{ $item->name_indonesia }}" data-url="{{ route('admin.plants.update', ['id'=>$item->id]) }}">
                                    <img width="20" height="20" src="{{ url('assets/img/create-outline 1.svg') }}"
                                        alt="">
                                </button>
                                <a class="btn btn-danger"
                                        href="{{ route('admin.plants.delete', ['id' => $item->id]) }}"><img width="20"
                                            height="20" src="{{ url('assets/img/trash-outline 1.svg') }}" alt=""></a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="updateData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="updateDataLabel" aria-hidden="true">
        <div class="modal-dialog" id="updateDialog">
            <div id="modal-content" class="modal-content">
                <div class="modal-body">
                    Loading..
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="createData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="createDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div id="modal-content" class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.plants.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name_indonesia" class="form-label">Nama Indonesia</label>
                            <input type="text" class="form-control" id="name_indonesia" name="name_indonesia"
                                placeholder="Masukan nama indonesia">
                        </div>

                        <div class="mb-3">
                            <label for="name_latin" class="form-label">Nama Latin</label>
                            <input type="text" class="form-control" id="name_latin" name="name_latin"
                                placeholder="Masukan nama latin">
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
@endsection


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.dropify').dropify();
    </script>



    <script>
        $(document).ready(function() {
            $('#plantsTable').DataTable({

            });
        });
    </script>


    <script>
        $('#updateData').on('shown.bs.modal', function(e) {
            let id = $(e.relatedTarget).data('id');
            let nameLatin = $(e.relatedTarget).data('name_latin');
            let nameIndonesia = $(e.relatedTarget).data('name_indonesia');
            let url = $(e.relatedTarget).data('url'); // Pastikan ini adalah URL dengan metode PUT

            let html = `
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="${url}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body ">
                        <div class="mb-3">
                            <label for="edit_name_indonesia" class="form-label">Nama Indonesia</label>
                            <input type="text" class="form-control" id="edit_name_indonesia" name="name_indonesia" value="${nameIndonesia}">
                        </div>
                        <div class="mb-3">
                            <label for="edit_name_latin" class="form-label">Nama Latin</label>
                            <input type="text" class="form-control" id="edit_name_latin" name="name_latin" value="${nameLatin}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            `;
            $(this).find('.modal-content').html(html);
        });
    </script>
@endsection
