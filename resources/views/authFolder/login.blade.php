<!DOCTYPE html>
<html lang="en">
@include('admin.includes.head')

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <!-- Spinner End -->
        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
                            </a>
                            <h3>Sign In</h3>
                        </div>
                        {{-- @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{Session::get('error')}}
                            </div>
                        @endif --}}
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('error') is-invalid @enderror"
                                    id="floatingInput" name="email" value="{{ old('email') }}"
                                    placeholder="name@example.com" autofocus>
                                <label for="floatingInput">Email address</label>
                                @error('error')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control @error('error') is-invalid @enderror"
                                    id="floatingPassword" name="password" value="{{ old('oldpassword') }}"
                                    placeholder="Password" required autocomplete="current-password">
                                <label for="floatingPassword">Password</label>
                                @error('error')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">Forgot Password</a>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min
