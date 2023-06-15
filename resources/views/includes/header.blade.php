@php
    use App\Models\Cart;
    use App\Models\Product;
@endphp
<!-- Start Top Nav -->
<nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
    <div class="container text-light">
        <div class="w-100 d-flex justify-content-between">
            <div>
                <i class="fa fa-envelope mx-2"></i>
                <a class="navbar-sm-brand text-light text-decoration-none"
                    href="mailto:info@company.com">info@company.com</a>
                <i class="fa fa-phone mx-2"></i>
                <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
            </div>
            <div>
                <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i
                        class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                <a class="text-light" href="https://www.instagram.com/" target="_blank"><i
                        class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                <a class="text-light" href="https://twitter.com/" target="_blank"><i
                        class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i
                        class="fab fa-linkedin fa-sm fa-fw"></i></a>
                <a class="text-light btn btn-success mx-3" href="{{ route('user.logout') }}">
                    Log out <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </div>
</nav>
<!-- Close Top Nav -->
<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand text-success logo h1 align-self-center" href="index.html">
            Zay
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
            id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">{{ __('home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">{{ __('about') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/shop">{{ __('shop') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">{{ __('contact') }}</a>
                    </li>
                </ul>
            </div>
            <div class="navbar align-self-center d-flex">
                <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                        <div class="input-group-text">
                            <i class="fa fa-fw fa-search"></i>
                        </div>
                    </div>
                </div>
                <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal"
                    data-bs-target="#templatemo_search">
                    <i class="fa fa-fw fa-search text-dark mr-2"></i>
                </a>
                <a class="nav-icon position-relative text-decoration-none" href="#" role="button"
                    data-bs-toggle="modal" data-bs-target="#cartModal">
                    <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                    @php
                        $userId = auth()->user() ? auth()->user()->id : null;
                        $cartCount = $userId ? Cart::where('user_id', $userId)->sum('quantity') : 0;
                    @endphp

                    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light"
                        style="color: #ff0000;">
                        {{ $cartCount }}
                    </span>


                </a>
                <a class="nav-icon position-relative text-decoration-none" href="#" role="button"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa fa-fw fa-user text-dark mr-3"></i>
                    <span
                        class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                </a>
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Language
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item" href="/language/en">
                                <img src={{ url('assets/img/flag/usa.png') }} alt="" class="dropdown-item-icon"
                                    style="width: 25px; height: 25px;">
                                English
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/language/km">
                                <img src={{ url('assets/img/flag/cambodia.png') }} alt=""
                                    class="dropdown-item-icon" style="width: 25px; height: 25px;">
                                Khmer
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/language/cn">
                                <img src={{ url('assets/img/flag/china.png') }} alt=""
                                    class="dropdown-item-icon" style="width: 25px; height: 25px;">
                                Chinese
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

    </div>
</nav>
<!-- Search Modal -->
<div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="w-100 pt-1 mb-5 text-right">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="get" class="modal-content modal-body border-0 p-0">
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="inputModalSearch" name="q"
                    placeholder="Search ...">
                <button type="submit" class="input-group-text bg-success text-light">
                    <i class="fa fa-fw fa-search text-white"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<!-- Search Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">User Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section class="vh-100" style="background-color: #f4f5f7;">
                    <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col col-lg-6 mb-4 mb-lg-0">
                                <div class="card mb-3" style="border-radius: .5rem;">
                                    <div class="row g-0">
                                        <div class="col-md-4 gradient-custom text-center text-white"
                                            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                                alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                                            <h5>Marie Horwitz</h5>
                                            <p>Web Designer</p>
                                            <i class="far fa-edit mb-5"></i>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body p-4">
                                                <h6>Information</h6>
                                                <hr class="mt-0 mb-4">
                                                <div class="row pt-1">
                                                    <div class="col-6 mb-3">
                                                        <h6>Email</h6>
                                                        <p class="text-muted">info@example.com</p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6>Phone</h6>
                                                        <p class="text-muted">123 456 789</p>
                                                    </div>
                                                </div>
                                                <h6>Projects</h6>
                                                <hr class="mt-0 mb-4">
                                                <div class="row pt-1">
                                                    <div class="col-6 mb-3">
                                                        <h6>Recent</h6>
                                                        <p class="text-muted">Lorem ipsum</p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6>Most Viewed</h6>
                                                        <p class="text-muted">Dolor sit amet</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-start">
                                                    <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                                    <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                                    <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
<!--Cart Modal-->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div
        class="modal-dialog modal-right modal-dialog-scrollable {{ auth()->user() && Cart::where('user_id', $userId)->sum('quantity') != 0 ? 'modal-xl' : '' }}">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title font-weight-bold px-2 mt-4" style="color:#83c589;" id="exampleModalLabel">
                    Check out</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section style="height: 90%;">
                    <div id="cart-total"></div>
                    <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-12">
                                <div class="card card-registration card-registration-2 mb-5 mt-2"
                                    style="border-radius: 15px;">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            <div class="col-lg-8">
                                                <div class="p-5">
                                                    @if (auth()->user() && !Cart::where('user_id', $userId)->sum('quantity') == 0)
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-5">
                                                            <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                                            <h6 class="mb-0 text-muted">3 items</h6>
                                                        </div>
                                                        <hr class="my-4">
                                                        @foreach ($productsInCart as $item)
                                                            @php
                                                                $qty = Cart::where('user_id', auth()->user()->id)
                                                                    ->where('product_id', $item->product_id)
                                                                    ->sum('quantity');
                                                                
                                                                $productName = Product::where('productID', $item->product_id)
                                                                    ->pluck('pname')
                                                                    ->first();
                                                                $productPrice = Product::where('productID', $item->product_id)
                                                                    ->pluck('price')
                                                                    ->first();
                                                                $productImg = Product::where('productID', $item->product_id)
                                                                    ->pluck('img')
                                                                    ->first();
                                                            @endphp
                                                            <div
                                                                class="row mb-4 d-flex justify-content-between align-items-center">
                                                                <div class="col-md-2 col-lg-2 col-xl-2">
                                                                    <img src="assets/img/{{ $productImg }}"
                                                                        class="img-fluid rounded-3"
                                                                        alt="Cotton T-shirt">
                                                                </div>
                                                                <div class="col-md-3 col-lg-3 col-xl-3">
                                                                    <h6 class="text-black mb-0">{{ $productName }}
                                                                    </h6>
                                                                </div>
                                                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                                    <button class="btn btn-link px-2"
                                                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                                        <i class="fas fa-minus"></i>
                                                                    </button>
                                                                    <input type="number" class="quantity-input_Cart"
                                                                        min="1" value="{{ $qty }}"
                                                                        readonly>
                                                                    <button class="btn btn-link px-2"
                                                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                                    <h6 class="mb-0">
                                                                        {{ '$' . number_format($productPrice, 2, '.', ',') }}
                                                                    </h6>
                                                                </div>
                                                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                                    <form
                                                                        action="{{ route('removeFromCart', ['id' => $item->product_id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="text-muted btn btn-link">
                                                                            <i class="fas fa-times"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <h4>Your bag is empty</h4>
                                                        <p>Check out our latest arrivals stay up-to-date with latest
                                                            styles</p>
                                                    @endif
                                                    <hr class="my-4">
                                                    <div class="pt-5">
                                                        <h6 class="mb-0"><a href="{{ route('user.shop') }}"
                                                                class="text-body"><i
                                                                    class="fas fa-long-arrow-alt-left me-2"></i>Back to
                                                                shop</a></h6>
                                                    </div>
                                                </div>
                                            </div>
                                            @if (auth()->user() && Cart::where('user_id', $userId)->sum('quantity') != 0)
                                                <div class="col-lg-4 bg-grey">
                                                    <div class="p-5">
                                                        <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                                        <hr class="my-4">

                                                        <div class="d-flex justify-content-between mb-4">
                                                            <h5 class="text-uppercase">items 3</h5>
                                                            <h5>€ 132.00</h5>
                                                        </div>

                                                        <h5 class="text-uppercase mb-3">Shipping</h5>

                                                        <div class="mb-4 pb-2">
                                                            <select class="select">
                                                                <option value="1">Standard-Delivery- €5.00
                                                                </option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                                <option value="4">Four</option>
                                                            </select>
                                                        </div>
                                                        <h5 class="text-uppercase mb-3">Give code</h5>
                                                        <div class="mb-5">
                                                            <div class="form-outline">
                                                                <input type="text" id="form3Examplea2"
                                                                    class="form-control form-control-lg"
                                                                    placeholder="Enter Your code">
                                                            </div>
                                                        </div>
                                                        <hr class="my-4">
                                                        <div class="d-flex justify-content-between mb-5">
                                                            <h5 class="text-uppercase">Total price</h5>
                                                            <h5>€ 137.00</h5>
                                                        </div>
                                                        <button type="button" class="btn btn-dark btn-block btn-lg"
                                                            data-mdb-ripple-color="dark">Register</button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Check Out</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).on('submit', '#remove-from-cart-form', function(event) {
            event.preventDefault();
            $.ajax({
                url: '/remove-from-cart',
                type: 'POST',
                data: $(this).serialize(),
            });
        });
    </script>
@endpush
<!--End Cart Modal-->
