@php
    use App\Models\Cart;
    use App\Models\Product;
    use App\Models\Config as ModelsConfig;
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
                <a class="text-light btn btn-success mx-3"
                    href="{{ auth()->user() ? route('user.logout') : route('login') }}">
                    {{ auth()->user() ? 'Log out' : 'Log in' }}
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </div>
</nav>
<!-- Close Top Nav -->
<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand text-success logo h1 align-self-center" href="index.html">
            {{ModelsConfig::where('id', 1)->pluck('logo')->first()}}
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
                <a class="nav-icon position-relative text-decoration-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                    <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                    @php
                        $userId = auth()->user() ? auth()->user()->id : null;
                        $cartCount = $userId
                            ? Cart::where('user_id', $userId)
                                ->where('payment_status', 0)
                                ->sum('quantity')
                            : 0;
                    @endphp

                    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light"
                        style="color: #ff0000;" id="cart_count">
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
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
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
{{-- User Information --}}
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
{{-- User Information --}}
<!--Cart Modal-->
<div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel"
    style="{{ isset($productsInCart) && count($productsInCart) > 0 ? 'height: 100%;' : 'height:400px' }}">

    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasTopLabel">Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @if (isset($productsInCart) && count($productsInCart) > 0)
            <section class="h-100 py-4" style="background-color: #eee;">
                <div class="container py-2">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body p-4">
                                    {{-- //Using Normal Controller to get data --}}
                                    {{-- <table class="table table-striped table-hover table-success">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productsInCart as $item)
                                                <tr style="font-size: 15px">
                                                    <td>
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <img src="{{ asset('assets/img/' . $item->product->img) }}"
                                                                    alt="Product Image" width="30px"
                                                                    height="40px">
                                                            </div>
                                                            <div class="col">
                                                                <h6>{{ $item->product->pname }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="align-items-center justify-content-center">
                                                        {{ $item->quantity }}</td>
                                                    <td class="align-items-center justify-content-center">
                                                        {{ '$' . number_format($item->product->price, 2, '.', ',') }}
                                                    </td>
                                                    <td class="align-items-center justify-content-center">
                                                        {{ '$' . number_format($item->quantity * $item->product->price, 2, '.', ',') }}
                                                    </td>
                                                    <td class="align-items-center justify-content-center">
                                                        <form action="{{ route('removeFromCart') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $item->product_id }}">
                                                            <input type="hidden" name="cart_id"
                                                                value="{{ $item->cart_id }}">
                                                            <input type="hidden" name="quantity"
                                                                value="{{ $item->quantity }}">
                                                            <button type="submit"
                                                                style="background: transparent; border:none">
                                                                <i class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table> --}}
                                    {{-- //Using Normal Controller to get data --}}
                                    <table class="table table-striped table-hover table-success">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cart-items-body">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="container">
                                <div class="card text-center">
                                    <div class="card-header justify-content-between">
                                        Check out
                                    </div>
                                    <div class="card-body" style="text-align: left;" id="check-out">
                                        @php
                                            $cartItems = Cart::where('user_id', auth()->user()->id)
                                                ->where('payment_status', 0)
                                                ->get();
                                            $totalAmount = 0;
                                            foreach ($cartItems as $cartItem) {
                                                $totalAmount += $cartItem->product->price * $cartItem->quantity;
                                            }
                                            $subtotal = $totalAmount;
                                            $taxAmount = $totalAmount * 0.1;
                                            $shippingCost = $totalAmount * 0.05;
                                            $totalAmount = $taxAmount + $shippingCost;
                                        @endphp
                                        <h6 class="card-title">{{ auth()->user()->name . "'s Cart." }}</h6>
                                        <p class="card-text">
                                        <h6>Tax rate(%): 10% </h6>
                                        <h6 id="tax_amount">Tax amount:
                                            {{ '$' . number_format($taxAmount, 2, '.', ',') }}
                                        </h6>
                                        <h6 id="shipping_cost">Shipping Cost:
                                            {{ '$' . number_format($shippingCost, 2, '.', ',') }}</h6>
                                        <h6 id="subtotal"> Subtotal:
                                            {{ '$' . number_format($subtotal, 2, '.', ',') }}
                                        </h6>
                                        <h6 id="total_amount">Total amount:
                                            {{ '$' . number_format($totalAmount, 2, '.', ',') }}</h6>
                                        </p>
                                        <form action="{{ route('payment.charge') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="total_to_pay" id="total_to_pay">
                                            <button type="submit" class="btn btn-success">Pay with Paypal.</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @else
            <section>
                <div class="container">
                    <div class="card text-center">
                        <div class="card-header">
                            OPP !!
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Empty Cart</h5>
                            <p class="card-text">Your cart is currently empty.
                                Feel free to browse our shop and add items to your cart.
                                Thank you for visiting our store!
                            </p>
                            <a href="{{ route('user.shop') }}" class="btn btn-success">Go shop</a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
</div>
{{-- <script>
    const deleteProduct = (id) => {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/removeCart', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.onload = () => {
            if (xhr.status === 200) {
                console.log('S' + xhr.responseText);
                const deleteProduct = (id) => {
                    const parentElement = document.querySelector(`[data-id="${id}"]`).closest('.p-5');
                    if (parentElement) {
                        parentElement.remove();
                    }
                };

            } else {
                console.log('E' + xhr.responseText);
            }
        };
        const data = JSON.stringify({
            cart_id: id,
        });
        xhr.send(data);
    };
</script> --}}
<!--End Cart Modal-->
