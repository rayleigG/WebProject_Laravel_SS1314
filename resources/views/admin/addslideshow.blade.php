@extends('admin.AdminLayout.Aconfig')
@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <form action="{{ route('admin.addSlideshow') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="txttitle" class="form-label">Title</label>
                <input type="text" class="form-control @error('txttitle') is-invalid @enderror" id="txttitle"
                    name="txttitle" placeholder="Title" value="{{ old('txttitle') }}">
                @error('txttitle')
                    <div class="invalid-feedback">Required</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="txtsubTitle" class="form-label">Subtitle</label>
                <input type="text" class="form-control @error('txtsubTitle') is-invalid @enderror" id="txtsubTitle"
                    name="txtsubTitle" placeholder="Subtitle" value="{{ old('txtsubTitle') }}">
                @error('txtsubTitle')
                    <div class="invalid-feedback">Required</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="txttext" class="form-label">Description</label>
                <textarea class="form-control @error('txttext') is-invalid @enderror" id="txttext" name="txttext" rows="2">{{ old('txttext') }}</textarea>
                @error('txttext')
                    <div class="invalid-feedback">Required</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="txtlink" class="form-label">Link</label>
                <input type="text" class="form-control @error('txtlink') is-invalid @enderror" id="txtlink"
                    name="txtlink" placeholder="Link" value="{{ old('txtlink') }}">
                @error('txtlink')
                    <div class="invalid-feedback">Required</div>
                @enderror
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="chkenable" name="chkenable" checked>
                <label class="form-check-label" for="chkenable">Enable</label>
            </div>
            <div class="mb-3 mt-3">
                <p>Image</p>
                <input class="form-control @error('img') is-invalid @enderror" type="file" id="img" name="img">
                @error('img')
                    <div class="invalid-feedback">Required</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!-- Sales Chart End -->
@endsection
