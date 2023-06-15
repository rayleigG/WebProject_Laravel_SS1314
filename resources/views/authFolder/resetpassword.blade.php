<!DOCTYPE html>
<html lang="en">
@include('admin.includes.head')

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="#" class="">
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Reset Password</h3>
                            </a>
                        </div>
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        {{-- @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif --}}
                        <form method="POST" action="{{ route('resetPasswordPost') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('error') is-invalid @enderror"
                                    id="floatingInput" name="email" value="{{ old('email') }}"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                                @error('error')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control @error('error') is-invalid @enderror"
                                    id="floatingPassword" name="oldpassword" value="{{ old('oldpassword') }}"
                                    placeholder="Old Password">
                                <label for="floatingPassword">Old Password</label>
                                @error('error')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control @error('newPassword') is-invalid @enderror"
                                    value="{{ old('newPassword') }}" id="floatingPassword" name="newPassword"
                                    placeholder="New Password">
                                <label for="floatingPassword">New Password</label>
                                @error('newPassword')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password"
                                    class="form-control @error('confirmPassword') is-invalid @enderror"
                                    id="floatingPassword" name="confirmPassword" placeholder="Confirm Password">
                                <label for="floatingPassword">Confirm Password</label>
                                @error('confirmPassword')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Submit</button>
                        </form>
                        <p class="text-center mb-0">Already have an Account? <a href="{{ route('login') }}">Sign In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>
    <!-- JavaScript Libraries -->
    @include('admin.includes.footer')
</body>

</html>
