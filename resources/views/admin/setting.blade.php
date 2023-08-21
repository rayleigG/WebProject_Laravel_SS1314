@extends('admin.AdminLayout.Aconfig')
@section('content')
    <div class="container-fluid pt-4 px-4" style="margin-bottom: 300px">
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
        <div class="col-lg-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">CPL Team</h6>
                <div class="table-responsive">
                    <!-- Add this container -->
                    <table class="table table-hover">
                        @if ($config)
                            {{ $config->logo }}
                        @endif
                        <thead>
                            <tr>
                                <th scope="col">Logo</th>
                                <th scope="col">Facebook</th>
                                <th scope="col">Intragram</th>
                                <th scope="col">Twitter</th>
                                <th scope="col">Tiktok</th>
                                <th scope="col">Telegram</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ $config->logo }}
                                </td>
                                <td>{{ $config->facebook }}</td>
                                <td>{{ $config->instagram }}</td>
                                <td>{{ $config->twitter }}</td>
                                <td>{{ $config->tiktok }}</td>
                                <td>{{ $config->telegram }}</td>
                                <td>
                                    <a type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
                                        aria-controls="offcanvasScrolling"
                                        onclick="populateForm('{{ $config->facebook }}','{{ $config->instagram }}','{{ $config->twitter }}','{{ $config->telegram }}','{{ $config->tiktok }}','{{ $config->logo }}')">
                                        <i class="fas fa-tools"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Update config</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style="background-color: rgb(227, 249, 255)">
            <form action="{{ route('admin.config_edit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control @error('logo_') is-invalid @enderror" id="logo_"
                        name="logo_" placeholder="Facebook Link" value="{{ old('logo_') }}">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control @error('facebook_link') is-invalid @enderror"
                        id="facebook_link" name="facebook_link" placeholder="Facebook Link"
                        value="{{ old('facebook_link') }}">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control @error('instagram_link') is-invalid @enderror"
                        id="instagram_link" name="instagram_link" placeholder="Instagram Link"
                        value="{{ old('instagram_link') }}">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control @error('twitter_link') is-invalid @enderror" id="twitter_link"
                        name="twitter_link" placeholder="Twitter Link" value="{{ old('twitter_link') }}">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control @error('tiktok_link') is-invalid @enderror" id="tiktok_link"
                        name="tiktok_link" placeholder="Tiktok Link" value="{{ old('tiktok_link') }}">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control @error('tele_link') is-invalid @enderror" id="tele_link"
                        name="tele_link" placeholder="Telegram Link" value="{{ old('tele_link') }}">
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
    <script>
        function populateForm(facebook, instagram, twitter, telegram, tiktok, logo) {
            document.getElementById('facebook_link').value = facebook;
            document.getElementById('instagram_link').value = instagram;
            document.getElementById('twitter_link').value = twitter;
            document.getElementById('tele_link').value = telegram;
            document.getElementById('tiktok_link').value = tiktok;
            document.getElementById('logo_').value = logo;
        }
    </script>
@endsection
