@props(['product'])
<div class="swiper-slide">
    <div class="card fp-dish-card">
        <div class="fp-dish-img-wrapper">
            {{-- <span class="fp-dish-badge">Top Rated</span> --}}
            <img src="{{ asset($product->productImage->first()->image_path) }}" alt="{{ $product->title }}">
        </div>
        <div class="card-body p-4">
            <a href="/{{ $product->id }}">
                <h5 class="fw-bold fs-5 text-truncate mb-2">{{ $product->title ?? '' }}</h5>
            </a>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <span class="fp-dish-price">Rs {{ $product->price }}</span>
                    @if ($product->initial_price)
                        <span class="fp-dish-price-cut">Rs {{ $product->initial_price }}</span>
                    @endif
                </div>
                <button class="btn btn-sm btn-outline-success rounded-circle"
                    onclick="addToCart({{ $product->id }})"><i class="bi bi-plus-lg"></i></button>
            </div>
        </div>
    </div>
</div>
