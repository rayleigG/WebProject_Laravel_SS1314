@extends('admin.AdminLayout.Aslideshow')
@section('content')
    <h4 class=" font-weight-bold text-primary px-2 mt-4">Slideshow</h4>
    <button type="button" class="btn btn-primary mx-3 my-2" data-bs-toggle="modal" data-bs-target="#exampleModal1"
        data-bs-whatever="@mdo">Add New</button>
    @if (Session('success'))
        <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
            <strong>a slideshow has been deleted!</strong>
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
                        <th scope="col">Title</th>
                        <th scope="col">Subtitle</th>
                        <th scope="col">Text</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <?php
                $i = 1;
                ?>
                <tbody>
                    @foreach ($slideshows as $item)
                        <tr>
                            <td>{{ ($slideshows->currentPage() - 1) * $slideshows->perPage() + $loop->iteration }}</td>
                            <td>...</td>
                            <td>{{ substr($item->title, 0, 15) . '...' }}</td>
                            <td>{{ substr($item->subtitle, 0, 10) . '...' }}</td>
                            <td>{{ substr($item->text, 0, 20) . '...' }}</td>
                            <td>
                                <a href="{{ route('toggleSlideshow', ['id' => $item->ssid, 'action' => $item->active]) }}">
                                    <i class="{{ $item->active == 1 ? 'far fa-eye' : 'far fa-eye-slash' }}"></i>
                                </a>
                                &nbsp;
                                <a href="{{ route('reorderSlideshow', ['id' => $item->ssid, 'action' => '1']) }}">
                                    <i class="fas fa-level-up-alt"></i>
                                </a>
                                &nbsp;
                                <a href="{{ route('reorderSlideshow', ['id' => $item->ssid, 'action' => '0']) }}">
                                    <i class="fas fa-level-down-alt"></i>
                                </a>
                                &nbsp;
                                <a href="#">
                                    <i class="far fa-edit"></i>
                                </a>
                                &nbsp;
                                <a href="#" onclick="deleteSlideshow('{{ $item->ssid }}')">
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
                {{ $slideshows->links() }}
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->
    <!-- Modal edit-->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add new slideshow</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="txttitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="txttile" name="txttitle" placeholder="Title">
                    </div>
                    <div class="mb-3">
                        <label for="txtsubTitle" class="form-label">Subtitle</label>
                        <input type="text" class="form-control" id="txtsubTitle" name="txtsubTitle"
                            placeholder="Subtitle">
                    </div>
                    <div class="mb-3">
                        <label for="txtdes" class="form-label">Description</label>
                        <textarea class="form-control" id="txtdes" name="txtdes" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="txtlink" class="form-label">Link</label>
                        <input type="text" class="form-control" id="txtlink" name="txtlink" placeholder="Link">
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="chkenable" name="chkenable"
                            checked>
                        <label class="form-check-label" for="chkenable">Enable</label>
                    </div>
                    <div class="mb-3 mt-3">
                        <p>Image</p>
                        <input class="form-control" type="file" id="img" name="img">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-danger" data-bs-dismiss="modal" value="Cancel">
                    <input class="btn btn-primary" type="submit" value="Submit" style="width:90px" name="btnSubmit">
                </div>
            </div>
        </div>
    </div>
    <!--End Edit-->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:red !important"><i
                            class="fas fa-exclamation-triangle"></i> Warning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure you want to remove this slideshow?</strong>
                </div>
                <div class="modal-footer">
                    <a href="#" id="deleteBut" class="btn btn-primary">&nbsp; Yes &nbsp;</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">&nbsp; No &nbsp;</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteSlideshow(id) {
            var deleteBut = document.getElementById("deleteBut");
            var url = "{{ route('admin.deleteSlideshow', ['id' => ':id']) }}";
            deleteBut.href = url.replace(':id', id);
        }
    </script>
@endsection
