<div class="col-12 col-sm-6 col-lg-4" wire:key="product-{{ $product->id }}">
    <article class="card h-100 border-0 shadow-sm card-hover">
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                 class="card-img-top object-fit-cover" style="height: 220px;">
        @else
            <div class="card-img-top object-fit-cover bg-black" style="height: 220px"></div>
        @endif

        <div class="card-body d-flex flex-column">
            <a href="{{ route('category', $product->category) }}" wire:navigate
               class="badge text-bg-warning text-decoration-none align-self-start mb-2">
                {{ $product->category->name }}
            </a>

            <h2 class="card-title fs-5 fw-semibold">{{ $product->title }}</h2>
            <p class="card-text text-secondary small">
                {{ \Illuminate\Support\Str::limit($product->description, 90) }}
            </p>

            <div class="d-flex justify-content-between align-items-center mt-auto">
                <span class="fs-5 fw-bold">&euro; {{ number_format($product->price, 2, ',', '.') }}</span>
                <a href="{{ route('show', ['product' => $product]) }}" wire:navigate
                   class="btn btn-outline-dark btn-sm">Dettagli</a>
            </div>
        </div>
    </article>
</div>
