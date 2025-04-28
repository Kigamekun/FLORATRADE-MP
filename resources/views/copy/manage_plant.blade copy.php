@extends('layouts.base')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
@endsection



@section('menu')
<div class="sidebar-menu-wrapper">
    <li class="listMenuName">
        <p>Admin Menu</p>
    </li>
    <li class="list-menu ">
        <div class="icon">
            <ion-icon name="grid"></ion-icon>
        </div>
        <a href="/admin" class="sidebar-menu">Dashboard Admin</a>
    </li>
    <li class="list-menu ">
        <div class="icon">
            <ion-icon name="folder-open"></ion-icon>
        </div>
        <a href="{{ route('admin.plants.index') }}" class="sidebar-menu">Manage Marga (Plants)</a>
    </li>

    <li class="list-menu active">
        <div class="icon">
            <ion-icon name="leaf"></ion-icon>
        </div>
        <a href="{{ route('admin.plant.index') }}" class="sidebar-menu">Manage Plant</a>
    </li>

    <li class="list-menu ">
        <div class="icon">
            <ion-icon name="card"></ion-icon>
        </div>
        <a href="{{ route('admin.voucher.index') }}" class="sidebar-menu">Manage Voucher</a>
    </li>

    <li class="list-menu">
        <div class="icon">
            <ion-icon name="airplane"></ion-icon>
        </div>
        <a href="{{ route('admin.shipping.index') }}" class="sidebar-menu">Manage Shipping</a>
    </li>

    <li class="list-menu ">
        <div class="icon">
            <ion-icon name="cart"></ion-icon>
        </div>
        <a href="{{ route('admin.order.index') }}" class="sidebar-menu">Manage Transaction</a>
    </li>

    <li class="list-menu">
        <div class="icon">
            <ion-icon name="cash"></ion-icon>
        </div>
        <a href="{{ route('admin.pricing.index') }}" class="sidebar-menu">Manage Pricing</a>
    </li>
    <li class="list-menu">
        <div class="icon">
            <ion-icon name="reader"></ion-icon>
        </div>
        <a href="{{ route('admin.terms.index') }}" class="sidebar-menu">Manage Terms</a>
    </li>
    <li class="list-menu">
        <div class="icon">
            <ion-icon name="person"></ion-icon>
        </div>
        <a href="{{ route('admin.user.index') }}" class="sidebar-menu">Manage User</a>
    </li>
    <li class="list-menu">
        <div class="icon">
            <ion-icon name="receipt"></ion-icon>
        </div>
        <a href="{{ route('admin.faq.index') }}" class="sidebar-menu">Manage Faq</a>
    </li>
</div>
@endsection

@section('content')
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: 14px;
        }

    </style>
    <div class="contentMain">
        <h2 class="pageNameContent">Manage Plant</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage Plant</li>
        </ol>

        <div class="wrapperTable table-responsive">
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createData">
                    Create Plant
                </button>
            </div>
            <br>
            <table id="plantsTable" class="tables" style="width:100%">
                <thead>
                    <tr>
                        <th># </th>
                        <th>Name</th>
                        <th>Stock</th>
                        <th>Category</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>{{ DB::table('base_plants')->where('id', $item->category_id)->first()->name_latin }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-plant" type="checkbox"
                                        id="flexSwitchCheckDefault" data-id="{{ $item->id }}"
                                        {{ $item->status ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td style="width: 20%">

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#updateData" data-id="{{ $item->id }}"
                                    data-name="{{ $item->name }}" data-stock="{{ $item->stock }}"
                                    data-price="{{ $item->price }}" data-category="{{ $item->category }}"
                                    data-description="{{ $item->description }}" data-thumb="{{ $item->thumb }}"
                                    data-status="{{ $item->status }}"
                                    data-wholesale_price="{{ $item->wholesale_price }}" data-url="{{ route('admin.plant.update', ['id'=>$item->id]) }}">

                                    <img width="20" height="20" src="{{ url('assets/img/create-outline 1.svg') }}"
                                        alt="">
                                </button>
                                <a class="btn btn-danger"
                                    href="{{ route('admin.plant.delete', ['id' => $item->id]) }}"><img width="20"
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
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Plant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.plant.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukan nama tanaman"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Jumlah Stok</label>
                            <input type="number" class="form-control" id="stock" name="stock" placeholder="Masukan jumlah stok tanaman"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" min="0.00" step="0.01" class="form-control" id="price" name="price"
                                placeholder="Masukan harga tanaman" required>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="price" class="form-label">Minimal Pembelian</label>
                                    <input type="number" class="form-control" id="price" name="max[]"
                                        placeholder="Minimal pembelian barang" required>
                                </div>
                                <div class="col-4">
                                    <label for="price" class="form-label">Harga Grosir</label>
                                    <input type="number" min="0.00" step="0.01" class="form-control" id="price"
                                        name="wholesale_price[]" placeholder="Masukan Harga" required>
                                </div>
                                <div class="col-2">
                                    <div class="d-flex align-items-end h-100">
                                        <button type="button" id="addRow" class="btn btn-primary w-100">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3" id="newPrice">
                        </div>

                        <div class="mb-3">
                            <label for="Kompetensi Keahlian" class="form-label">Plants Marga</label>
                            <input type="text" id="category_id" name="category_id" placeholder="Search Marga"
                                class="form-control" autocomplete="off" required />
                        </div>


                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" placeholder="Masukan detail tanaman" id="editor"></textarea>
                        </div>


                        {{-- <input type="file" name="thumb" class="dropify" required /> --}}
                        <input type="file" class="form-control" name="thumb[]" multiple />
                        <br>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="status" type="checkbox"
                                    id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Status Plant</label>
                            </div>
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

            wholesale = $(e.relatedTarget).data('wholesale_price');
            var whole = '<div class="mb-3" id="newPrice">';
            Object.keys(wholesale).forEach(function(key) {
                whole += `
                <div class="row">
                    <div class="col-6">
                        <input type="number" class="form-control" id="price" name="max[]"
                        placeholder="Minimal pembelian" value="${key}" required>
                    </div>
                <div class="col-4">
                    <input type="number" min="0.00" step="0.01" class="form-control" id="price"
                    name="wholesale_price[]" placeholder="Masukan harga value="${wholesale[key]}" required>
                </div>
                <div class="col-2">
                    <button type="button" id="addRow" class="btn btn-danger w-100">-</button>
                </div>
            </div>`;

            });


            whole += '</div>';

            var html = `
            <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Plant</h5>
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
                    <label for="stock" class="form-label">stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" placeholder="isi stock " value="${$(e.relatedTarget).data('stock')}">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">price</label>
                    <input type="number" min="0.00"  step="0.01" class="form-control" id="price" name="price" placeholder="isi price " value="${$(e.relatedTarget).data('price')}">
                </div>


                <div class="mb-3" id="newPrice">
                    ${whole}
                </div>


                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">description</label>
                    <textarea class="form-control" name="description" placeholder="Masukan Konten" id="editor">${$(e.relatedTarget).data('description')}</textarea>
                </div>


                <input type="file" class="form-control" name="thumb[]" multiple  />
                <br>

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





    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script type="text/javascript">
        var route = "{{ url('marga-search') }}";
        $('#category_id').typeahead({
            source: function(query, process) {
                return $.get(route, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>

    <script>
        // add row
        $("#addRow").click(function() {
            var html = `
                <div class="row appendedRow mb-1">
                    <div class="col-6">
                        <input type="number" class="form-control" id="price" name="max[]"
                        placeholder="Min pembelian" required>
                    </div>
                <div class="col-4">
                    <input type="number" min="0.00" step="0.01" class="form-control" id="price"
                    name="wholesale_price[]" placeholder="Masukan harga grosir" required>
                </div>
                <div class="col-2">
                    <button type="button" id="removeRow" class="btn btn-danger w-100">-</button>
                </div>
            </div>`;
            $('#newPrice').append(html);
        });


        $(document).on('click', '#removeRow', function() {
            $(this).closest('.appendedRow').remove();
        });



        $('.status-plant').change(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.plant.changeStatus') }}",
                method: "POST",
                data: {
                    status: $(this).prop('checked') ? 1 : 0,
                    id: $(this).attr('data-id')
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
@endsection
