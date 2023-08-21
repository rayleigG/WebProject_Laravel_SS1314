@extends('admin.AdminLayout.Aslideshow')
@section('content')
    <h4 class=" font-weight-bold text-primary px-2 mt-4">Slideshow</h4>
    <button type="button" class="btn btn-primary mx-3 my-2" data-bs-toggle="modal" data-bs-target="#exampleModal1"
        data-bs-whatever="@mdo">Add New</button>
    {{-- <a type="button" class="btn btn-primary mx-3 my-2" href="{{route('admin.showFomSlideshow')}}">Add new slideshow</a> --}}
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
                        <th scope="col">Title</th>
                        <th scope="col">Subtitle</th>
                        <th scope="col">Text</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <?php
                $i = 1;
                ?>
                <tbody id="tableBody">
                    {{-- @foreach ($slideshows as $item)
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
                    @endforeach --}}
                </tbody>
            </table>
        </div>
        {{-- <div class="d-flex justify-content-between">
            <div>
                {{ $slideshows->links() }}
            </div>
        </div> --}}
        <div class="d-flex justify-content-between">
            <div id="paginationContainer">
                <!-- Pagination links will be dynamically inserted here -->
            </div>
        </div>

    </div>
    <!-- Sale & Revenue End -->
    <!-- Modal add-->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add new slideshow</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.addSlideshow') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="txttitle" class="form-label">Title</label>
                            <input type="text" class="form-control @error('txttitle') is-invalid @enderror"
                                id="txttitle" name="txttitle" placeholder="Title" value="{{ old('txttitle') }}">
                            @error('txttitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="txtsubTitle" class="form-label">Subtitle</label>
                            <input type="text" class="form-control @error('txtsubTitle') is-invalid @enderror"
                                id="txtsubTitle" name="txtsubTitle" placeholder="Subtitle" value="{{ old('txtsubTitle') }}">
                            @error('txtsubTitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="txttext" class="form-label">Description</label>
                            <textarea class="form-control @error('txttext') is-invalid @enderror" id="txttext" name="txttext" rows="2">{{ old('txttext') }}</textarea>
                            @error('txttext')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="txtlink" class="form-label">Link</label>
                            <input type="text" class="form-control @error('txtlink') is-invalid @enderror" id="txtlink"
                                name="txtlink" placeholder="Link" value="{{ old('txtlink') }}">
                            @error('txtlink')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
        </div>
    </div>
    <!--End add-->
    <!--End edit-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add new slideshow</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.editSlideshow') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="ssid" id="ssid">
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Title</label>
                            <input type="text" class="form-control @error('editTitle') is-invalid @enderror"
                                id="editTitle" name="editTitle" placeholder="Title" value="{{ old('editTitle') }}">
                            @error('editTitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editsubtitle" class="form-label">Subtitle</label>
                            <input type="text" class="form-control @error('editsubtitle') is-invalid @enderror"
                                id="editsubtitle" name="editsubtitle" placeholder="Subtitle"
                                value="{{ old('editsubtitle') }}">
                            @error('editsubtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editText" class="form-label">Description</label>
                            <textarea class="form-control @error('editText') is-invalid @enderror" id="editText" name="editText"
                                rows="2">{{ old('txttext') }}</textarea>
                            @error('editText')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editLink" class="form-label">Link</label>
                            <input type="text" class="form-control @error('editLink') is-invalid @enderror"
                                id="editLink" name="editLink" placeholder="editLink" value="{{ old('editLink') }}">
                            @error('editLink')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="chkEditactive"
                                name="chkEditactive" checked>
                            <label class="form-check-label" for="chkEditactive">Enable</label>
                        </div>
                        <div class="mb-3 mt-3">
                            <p>Old Image</p>
                            <img src="" alt="" id="oldImage">
                        </div>
                        <div class="mb-3 mt-3">
                            <p>Image</p>
                            <input class="form-control @error('editImg') is-invalid @enderror" type="file"
                                id="editImg" name="editImg">
                            @error('editImg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!--End edit-->
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
        function fetchDataForEdit(id, title, subtitle, text, active, img, link) {
            document.getElementById('ssid').value = id;
            document.getElementById('editTitle').value = title;
            document.getElementById('editsubtitle').value = subtitle;
            document.getElementById('editText').value = text;
            document.getElementById('editLink').value = link;
            document.getElementById('oldImage').src = '{{ asset('image/slideshow/thumbnail/') }}' + '/' + img;
            document.getElementById('chkEditactive').checked = (active === '1') ? true : false;
        }

        function deleteSlideshow(id) {
            var deleteBut = document.getElementById("deleteBut");
            var url = "{{ route('admin.deleteSlideshow', ['id' => ':id']) }}";
            deleteBut.href = url.replace(':id', id);
        }
        //SELECT 
        const getData = () => {
            const xhr = new XMLHttpRequest();
            xhr.responseType = 'json';
            xhr.open('GET', 'getslideshow', true);
            xhr.onload = () => {
                if (xhr.status === 200) {
                    const response = xhr.response;
                    console.log(response);
                    const data = response.slideshows.data;
                    const res = response.slideshows;
                    // Populate table rows
                    let tr = '';
                    for (let i = 0; i < data.length; i++) {
                        const reorderUrl = "{{ route('reorderSlideshow', [':id', '1']) }}";
                        const reorderDown = "{{ route('reorderSlideshow', [':id', '0']) }}";
                        const moveUp = reorderUrl.replace(':id', data[i].ssid);
                        const moveDown = reorderDown.replace(':id', data[i].ssid)
                        const urltoggleSlideshow =
                            `{{ route('toggleSlideshow', [':id', ':action']) }}`;
                        const toggleSlideshowURL = urltoggleSlideshow.replace(':id', data[i].ssid).replace(
                            ':action', data[i].active);
                        const currentIndex = (parseInt(res.current_page) - 1) * parseInt(res.per_page) + parseInt(
                            i) + 1;
                        console.log(currentIndex);
                        tr += `
                            <tr>
                                <td>${currentIndex}</td>
                                <td>
                                    <img src='{{ asset('image/slideshow/thumbnail/${data[i].img}') }}'>
                                </td>
                                <td>${data[i].title.substr(0, 10) + '...'}</td>
                                <td>${data[i].subtitle + '...'}</td>
                                <td>${data[i].text.substr(0, 15) + '...'}</td>
                                <td>
                                    <a href="${toggleSlideshowURL}">
                                    <i class="${(data[i].active == 1) ? 'far fa-eye' : 'fas fa-eye-slash'}"></i>
                                    </a>
                                    &nbsp;
                                    <a href="${moveUp}">
                                        <i class="fas fa-level-up-alt"></i>
                                    </a>
                                    &nbsp;
                                    <a href="${moveDown}">
                                    <i class="fas fa-level-down-alt"></i>
                                    </a>
                                    &nbsp;
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal" onclick="fetchDataForEdit('${data[i].ssid}', '${data[i].title}', '${data[i].subtitle}', '${data[i].text}', '${data[i].active}', '${data[i].img}', '${data[i].link}')">
                                    <i class="far fa-edit"></i>
                                    </a>
                                    &nbsp;
                                    <a href="#" onclick="deleteSlideshow('${data[i].ssid}')">
                                    <i class="fas fa-trash-alt" data-bs-toggle="modal" data-bs-target="#deleteModal"></i>
                                    </a>
                                </td>
                            </tr>
                            `;
                    }
                    document.getElementById('tableBody').innerHTML = tr;

                    // Handle pagination links
                    const paginationContainer = document.getElementById('paginationContainer');
                    const paginationLinks = response.slideshows.links;
                    console.log(paginationLinks);
                    // Generate pagination links
                    let paginationHTML = '';
                    for (let i = 0; i < paginationLinks.length; i++) {
                        const link = paginationLinks[i];
                        if (link.active) {
                            paginationHTML +=
                                `<li class="page-item active"><span class="page-link">${link.label}</span></li>`;
                        } else if (link.url) {
                            paginationHTML +=
                                `<li class="page-item"><a href="${link.url}" class="page-link">${link.label}</a></li>`;
                        } else {
                            paginationHTML +=
                                `<li class="page-item disabled"><span class="page-link">${link.label}</span></li>`;
                        }
                    }
                    console.log(paginationHTML);
                    paginationContainer.innerHTML = `<ul class="pagination">${paginationHTML}</ul>`;
                    // Attach event listeners to pagination links
                    const paginationLinksArray = paginationContainer.getElementsByTagName('a');
                    for (let i = 0; i < paginationLinksArray.length; i++) {
                        paginationLinksArray[i].addEventListener('click', function(event) {
                            event.preventDefault();
                            const pageUrl = this.getAttribute('href');
                            fetchPageData(pageUrl);
                        });
                    }
                }
            };

            xhr.send();
        }

        // Function to fetch data for a specific page
        function fetchPageData(pageUrl) {
            const xhr = new XMLHttpRequest();
            xhr.responseType = 'json';
            xhr.open('GET', pageUrl, true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = xhr.response;
                    const data = response.slideshows.data;
                    const res = response.slideshows;

                    // Populate table rows
                    let tr = '';
                    for (let i = 0; i < data.length; i++) {
                        const reorderUrl = "{{ route('reorderSlideshow', [':id', '1']) }}";
                        const reorderDown = "{{ route('reorderSlideshow', [':id', '0']) }}";
                        const moveUp = reorderUrl.replace(':id', data[i].ssid);
                        const moveDown = reorderDown.replace(':id', data[i].ssid)
                        const urltoggleSlideshow =
                            `{{ route('toggleSlideshow', [':id', ':action']) }}`;
                        const toggleSlideshowURL = urltoggleSlideshow.replace(':id', data[i].ssid).replace(
                            ':action', data[i].active);
                        const currentIndex = (parseInt(res.current_page) - 1) * parseInt(res.per_page) + parseInt(i) +
                            1;
                        console.log(currentIndex);
                        const substring = data[i].title.substr(0, 5) + "...";
                        tr += `
                            <tr>
                                <td>${currentIndex}</td>
                                <td>
                                    <img src='{{ asset('image/slideshow/thumbnail/${data[i].img}') }}'>
                                </td>
                                <td>${data[i].title.substr(0, 10) + '...'}</td>
                                <td>${data[i].subtitle + '...'}</td>
                                <td>${data[i].text.substr(0, 15) + '...'}</td>
                                <td>
                                    <a href="${toggleSlideshowURL}">
                                    <i class="${(data[i].active == 1) ? 'far fa-eye' : 'fas fa-eye-slash'}"></i>
                                    </a>
                                    &nbsp;
                                    <a href="${moveUp}">
                                        <i class="fas fa-level-up-alt"></i>
                                    </a>
                                    &nbsp;
                                    <a href="${moveDown}">
                                        <i class="fas fa-level-down-alt"></i>
                                    </a>
                                    &nbsp;
                                    <a data-bs-toggle="modal" data-bs-target="#editModal" href="#" onclick="fetchDataForEdit('${data[i].ssid}', '${data[i].title}', '${data[i].subtitle}', '${data[i].text}', '${data[i].active}', '${data[i].img}', '${data[i].link}')">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    &nbsp;
                                    <a href="#" onclick="deleteSlideshow('${data[i].ssid}')">
                                        <i class="fas fa-trash-alt" data-bs-toggle="modal" data-bs-target="#deleteModal"></i>
                                    </a>
                                    </td>
                          </tr>
                        `;
                    }
                    document.getElementById('tableBody').innerHTML = tr;

                    // Update pagination links
                    const paginationContainer = document.getElementById('paginationContainer');
                    const paginationLinks = response.slideshows.links;
                    // Generate pagination links
                    let paginationHTML = '';
                    for (let i = 0; i < paginationLinks.length; i++) {
                        const link = paginationLinks[i];
                        if (link.active) {
                            paginationHTML +=
                                `<li class="page-item active"><span class="page-link">${link.label}</span></li>`;
                        } else if (link.url) {
                            paginationHTML +=
                                `<li class="page-item"><a href="${link.url}" class="page-link">${link.label}</a></li>`;
                        } else {
                            paginationHTML +=
                                `<li class="page-item disabled"><span class="page-link">${link.label}</span></li>`;
                        }
                    }
                    paginationContainer.innerHTML = `<ul class="pagination">${paginationHTML}</ul>`;
                    // Attach event listeners to pagination links
                    const paginationLinksArray = paginationContainer.getElementsByTagName('a');
                    for (let i = 0; i < paginationLinksArray.length; i++) {
                        paginationLinksArray[i].addEventListener('click', function(event) {
                            event.preventDefault();
                            const pageUrl = this.getAttribute('href');
                            fetchPageData(pageUrl);
                        });
                    }
                }
            };

            xhr.send();
        }
        getData();
    </script>
@endsection
