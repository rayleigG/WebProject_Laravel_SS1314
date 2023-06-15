@extends('admin.AdminLayout.Aproduct')
@section('content')
    <h4 class=" font-weight-bold text-primary px-2 mt-4">Product</h4>
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
                        <th scope="col">Brand</th>
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
                            <td>...</td>
                            <td>{{$item->pname}}</td>
                            <td>{{ '$' . number_format($item->price, 2, '.', ',')}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->category_id}}</td>
                            <td>{{$item->brand_id}}</td>
                            <td>
                                <a href="#">
                                    <i class="far fa-eye"></i>
                                </a>
                                &nbsp;
                                <a href="#">
                                    <i class="fas fa-level-up-alt"></i>
                                </a>
                                &nbsp;
                                <a href="#">
                                    <i class="fas fa-level-down-alt"></i>
                                </a>
                                &nbsp;
                                <a href="#">
                                    <i class="far fa-edit"></i>
                                </a>
                                &nbsp;
                                <a href="#">
                                    <i class="fas fa-trash-alt"></i>
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
@endsection
