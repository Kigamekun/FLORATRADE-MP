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
            <h1 class="pageNameContent">Manage FAQ</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Admin Menu</li>
                <li class="breadcrumb-item active">Manage FAQ</li>
            </ol>

            <div class="card mb-4">
                <div class="wrapperTable table-responsive">
                        <div class="card-header mx-1 bg-white d-flex justify-content-between align-items-center">
                        <span class="fw-normal fs-4 my-3 d-block">
                            FAQ Data
                        </span>
                        <button type="button" class="btn btn-create-add" data-bs-toggle="modal" data-bs-target="#createData">
                            + Create FAQ
                        </button>
                </div>

                <div class="card-body">
                    <table id="faqTable" class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td style="width: 20%" class="text-center">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#updateData" data-id="{{ $item->id }}"
                                        data-title="{{ $item->title }}" data-description="{{ $item->description }}"
                                        data-url="{{ route('admin.faq.update', ['id' => $item->id]) }}">
                                        <img width="20" height="20" src="{{ url('assets/img/create-outline 1.svg') }}"
                                            alt="">
                                    </button>
                                    <a class="btn btn-danger"
                                        href="{{ route('admin.faq.delete', ['id' => $item->id]) }}"><img width="20"
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
                    <h5 class="modal-title" id="staticBackdropLabel">Create Faq</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.faq.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Question</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Fill question">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Answer</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="Type Here"></textarea>
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
            $('#faqTable').DataTable({

            });
        });
    </script>


    <script>
        $('#updateData').on('shown.bs.modal', function(e) {
            var html = `
            <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Faq</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="${$(e.relatedTarget).data('url')}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Question</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="isi title " value="${$(e.relatedTarget).data('title')}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Answer</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10">${$(e.relatedTarget).data('description')}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
`;

            $('#modal-content').html(html);
            $('.dropify').dropify();

        });
    </script>
@endsection
