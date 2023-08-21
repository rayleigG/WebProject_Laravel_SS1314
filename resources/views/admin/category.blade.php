@extends('admin.AdminLayout.Acategory')
@section('content')
    <!-- Sale & Revenue Start -->
    <h4 class=" font-weight-bold text-primary px-2 mt-4">Category</h4>
    <button type="button" class="btn btn-primary mx-3 my-2" data-bs-toggle="modal" data-bs-target="#exampleModal1"
        data-bs-whatever="@mdo">Add New</button>
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
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                <tbody>
                    @foreach ($categoies as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->catName }}</td>
                            <td>{{ $item->catDesc }}</td>
                            <td>
                                <a
                                    href="{{ route('admin.toggleCategory', ['id' => $item->category_id, 'action' => $item->active]) }}">
                                    <i class="{{ $item->active == 1 ? 'far fa-eye' : 'fas fa-eye-slash' }}"></i>
                                </a>
                                &nbsp;
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal"
                                    onclick="fetchDataForUpdate('{{ $item->category_id }}','{{ $item->catName }}','{{ $item->catDesc }}','{{ $item->active }}')">
                                    <i class="far fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModallLabel">Update Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update.category') }}" method="POST">
                        @csrf
                        <input type="hidden" name="category_id" id="category_id_edit">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category name</label>
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                id="category_name_edit" name="category_name" placeholder="Category name"
                                value="{{ old('category_name') }}">
                            @error('category_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_desc" class="form-label">Description</label>
                            <textarea class="form-control @error('category_desc') is-invalid @enderror" id="category_desc_edit" name="category_desc"
                                rows="2">{{ old('category_desc') }}</textarea>
                            @error('category_desc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="chkenable_edit"
                                name="chkenable" checked>
                            <label class="form-check-label" for="chkenable">Enable</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add new Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add.category') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category name</label>
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                id="category_name" name="category_name" placeholder="Category name"
                                value="{{ old('category_name') }}">
                            @error('category_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_desc" class="form-label">Description</label>
                            <textarea class="form-control @error('category_desc') is-invalid @enderror" id="category_desc" name="category_desc"
                                rows="2">{{ old('category_desc') }}</textarea>
                            @error('category_desc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="chkenable"
                                name="chkenable" checked>
                            <label class="form-check-label" for="chkenable">Enable</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->
    <script>
        function fetchDataForUpdate(id, name, desc, active) {
            document.getElementById('category_id_edit').value = id;
            document.getElementById('category_desc_edit').value = desc;
            document.getElementById('category_name_edit').value = name;
            document.getElementById('chkenable_edit').checked = (active === '1') ? true : false;
            console.log(active);
        }
    </script>
@endsection
