<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        @for ($i = 0; $i < count($slideshows); $i++)
            @if ($i == 0)
                <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="{{ $i }}" class="active">
                </li>
            @else
                <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="{{ $i }}" class="">
                </li>
            @endif
        @endfor
    </ol>
    <div class="carousel-inner">
        @foreach ($slideshows as $item)
            @if ($loop->first)
                <div class="carousel-item active">
            @else
                    <div class="carousel-item">
            @endif
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./assets/img/{{ $item->img }}" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">{{ $item->title }}</h1>
                            <h3 class="h2">{{ $item->subtitle }}</h3>
                            <p>
                                {{ $item->text }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
<a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button"
    data-bs-slide="prev">
    <i class="fas fa-chevron-left"></i>
</a>
<a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button"
    data-bs-slide="next">
    <i class="fas fa-chevron-right"></i>
</a>
</div>
