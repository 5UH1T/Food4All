@props(['product'])
<div class="swiper-slide">

    <div class="fp-dish-card h-100">

        <div class="fp-dish-img-wrapper bg-gray-100 flex items-center justify-center">
            @if ($product->productImage->first()->image_path !== null)
                <img src="{{ asset($product->productImage->first()->image_path) }}" alt="{{ $product->title }}">
            @else
                <div class="w-20 h-20 rounded-xl  bg-gray-200 flex items-center justify-center text-gray-400">
                    <i class="bi bi-image text-3xl"></i>
                </div>
            @endif
        </div>

        <div class="p-4">
            <a href="/{{ $product->id }}" class="no-underline">
                <h5 class="font-bold text-gray-800 mb-1 ">
                    {{ $product->title ?? '' }}
                </h5>
            </a>

            <span @class([
                'text-xs py-1 px-2 rounded',
                'text-green-600 bg-green-100' =>
                    $product->categories->category_name === 'Vegetarian',
                ' text-orange-600 bg-orange-100' =>
                    $product->categories->category_name !== 'Vegetarian',
            ])>
                {{ $product->categories->category_name }}
            </span>

            <div class="flex items-center justify-between mt-2">
                <span class="fp-dish-price">
                    Rs {{ $product->price }}
                    @if ($product->initial_price)
                        <span class="fp-dish-price-cut">Rs {{ $product->initial_price }}</span>
                    @endif
                </span>

                <button class="btn btn-dark  rounded-circle !w-10 !h-10 !p-0" onclick="addToCart({{ $product->id }})">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
        </div>

    </div>
</div>
