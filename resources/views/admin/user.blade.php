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
            <h1 class="pageNameContent">Manage User</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item active">Manage User</li>
            </ol>

            <div class="card mb-4">
            <div class="wrapperTable table-responsive">
                    <div class="card-header mx-1 bg-white d-flex justify-content-between align-items-center">
                    <span class="fw-normal fs-4 my-3 d-block">
                        User Data
                    </span>
                    <button type="button" class="btn btn-create-add" data-bs-toggle="modal" data-bs-target="#createData">
                        + Create User
                    </button>
            </div>

            <div class="card-body">
            <table id="userTable" class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td style="width: 20%" class="text-center">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#updateData" data-id="{{ $item->id }}"
                                    data-name="{{ $item->name }}" data-email="{{ $item->email }}"
                                    data-role="{{ $item->role }}" data-address="{{ $item->address }}"
                                    data-phone="{{ $item->phone }}" data-url="{{ route('admin.user.update', ['id'=>$item->id]) }}">
                                    <img width="20" height="20" src="{{ url('assets/img/create-outline 1.svg') }}"
                                        alt="">
                                </button>
                                <a class="btn btn-danger"
                                    href="{{ route('admin.user.delete', ['id' => $item->id]) }}"><img width="20"
                                        height="20" src="{{ url('assets/img/trash-outline 1.svg') }}" alt=""></a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Tambahkan user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Minimal 2 kata">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor telepon</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukan nomor telepon">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Masukan alamat rumah">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukan password">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="0">Admin</option>
                                <option value="1">User</option>
                            </select>
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
            $('#userTable').DataTable({

            });
        });
    </script>


    <script>
        $('#updateData').on('shown.bs.modal', function(e) {
            var html = `
            <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="${$(e.relatedTarget).data('url')}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="isi name " value="${$(e.relatedTarget).data('name')}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="isi email " value="${$(e.relatedTarget).data('email')}">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="isi phone " value="${$(e.relatedTarget).data('phone')}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="isi address " value="${$(e.relatedTarget).data('address')}">
                        </div>


                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="${$(e.relatedTarget).data('role')}">${$(e.relatedTarget).data('role') == 0 ? 'Admin' : 'User'}</option>
                                <option value="0">Admin</option>
                                <option value="1">User</option>
                            </select>
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
