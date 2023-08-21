@extends('admin.AdminLayout.Aproduct')
@php
    use App\Models\Category;
@endphp
@section('content')
    <h4 class=" font-weight-bold text-primary px-2 mt-4">Product</h4>
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight">Add new product</button>
    @if (Session('success'))
        <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session('error'))
        <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-2">
            <table class="table table-secondary table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <?php
                $i = 1;
                ?>
                <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                            <td><img src="{{ asset('image/product/thumbnail/' . $item->img) }}" alt=""></td>
                            <td>{{ $item->pname }}</td>
                            <td>{{ '$' . number_format($item->price, 2, '.', ',') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ Category::where('category_id', $item->category_id)->pluck('catName')->first() }}</td>
                            <td>
                                <a
                                    href="{{ route('admin.toggleProduct', ['id' => $item->productID, 'action' => $item->active]) }}">
                                    <i class="{{ $item->active == 1 ? 'far fa-eye' : 'fas fa-eye-slash' }}"></i>
                                </a>
                                &nbsp;
                                <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"
                                    aria-controls="offcanvasWithBothOptions"
                                    onclick="fetchDataForEdit('{{ $item->productID }}','{{ $item->pname }}','{{ $item->price }}','{{ $item->quantity }}','{{ $item->active }}','{{ $item->img }}')">
                                    <i class="far fa-edit"></i>
                                </a>
                                &nbsp;
                                <a href="#" onclick="deleteProduct('{{ $item->productID }}')">
                                    <i class="fas fa-trash-alt" data-bs-toggle="modal" data-bs-target="#deleteModal"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between">
            <div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Offcanvas right</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('add.product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="product_name" class="form-label">product name</label>
                    <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name"
                        name="product_name" placeholder="product name" value="{{ old('product_name') }}">
                    @error('product_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="product_price" class="form-label">product price</label>
                    <input type="text" class="form-control @error('product_price') is-invalid @enderror"
                        id="product_price" name="product_price" placeholder="product price"
                        value="{{ old('product_price') }}">
                    @error('product_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="product_qty" class="form-label">product quantity</label>
                    <input type="text" class="form-control @error('product_qty') is-invalid @enderror" id="product_qty"
                        name="product_qty" placeholder="product quantity" value="{{ old('product_qty') }}">
                    @error('product_qty')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Product Category</label>
                    <select class="form-control @error('category_product') is-invalid @enderror" id="category_product"
                        name="category_product">
                        @foreach ($categories as $item)
                            <option value="{{ $item->category_id }}">{{ $item->catName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="chkenable" name="chkenable"
                        checked>
                    <label class="form-check-label" for="chkenable">Enable</label>
                </div>
                <div class="mb-3 mt-3">
                    <p>Image</p>
                    <input class="form-control @error('img') is-invalid @enderror" type="file" id="img"
                        name="img">
                    @error('img')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:red !important"><i
                            class="fas fa-exclamation-triangle"></i> Warning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure you want to remove this Product?</strong>
                </div>
                <div class="modal-footer">
                    <a href="#" id="deleteBut" class="btn btn-primary">&nbsp; Yes &nbsp;</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">&nbsp; No &nbsp;</button>
                </div>
            </div>
        </div>
    </div>
    {{-- for Edit product --}}
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdrop with scrolling</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('update.product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" id="product_id">
                <div class="mb-3">
                    <label for="product_name" class="form-label">product name</label>
                    <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                        id="product_name_edit" name="product_name" placeholder="product name"
                        value="{{ old('product_name') }}">
                    @error('product_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="product_price" class="form-label">product price</label>
                    <input type="text" class="form-control @error('product_price') is-invalid @enderror"
                        id="product_price_edit" name="product_price" placeholder="product price"
                        value="{{ old('product_price') }}">
                    @error('product_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="product_qty" class="form-label">product quantity</label>
                    <input type="text" class="form-control @error('product_qty') is-invalid @enderror"
                        id="product_qty_edit" name="product_qty" placeholder="product quantity"
                        value="{{ old('product_qty') }}">
                    @error('product_qty')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Product Category</label>
                    <select class="form-control @error('category_product') is-invalid @enderror"
                        id="category_product_edit" name="category_product">
                        @foreach ($categories as $item)
                            <option value="{{ $item->category_id }}">{{ $item->catName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="chkenable_edit" name="chkenable"
                        checked>
                    <label class="form-check-label" for="chkenable">Enable</label>
                </div>
                <div class="mb-3 mt-3">
                    <p>Old Image</p>
                    <img src="" alt="" id="oldImage">
                </div>
                <div class="mb-3 mt-3">
                    <p>Image</p>
                    <input class="form-control @error('img') is-invalid @enderror" type="file" id="img"
                        name="img">
                    @error('img')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <script>
        function deleteProduct(id) {
            var deleteBut = document.getElementById("deleteBut");
            var url = "{{ route('admin.deleteProduct', ['id' => ':id']) }}";
            deleteBut.href = url.replace(':id', id);
        }

        function fetchDataForEdit(id, pname, price, qty, active, img) {
            document.getElementById('product_id').value = id;
            document.getElementById('product_qty_edit').value = qty;
            document.getElementById('product_price_edit').value = price;
            document.getElementById('product_name_edit').value = pname;
            document.getElementById('oldImage').src = '{{ asset('image/product/thumbnail/') }}' + '/' + img;
            document.getElementById('chkenable_edit').checked = (active == '1') ? true : false;
            console.log(img);
        }
    </script>
@endsection
