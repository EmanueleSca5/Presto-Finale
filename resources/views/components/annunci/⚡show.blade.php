<?php

use App\Models\Product;
use Livewire\Attributes\Locked;
use Livewire\Component;

new class extends Component
{
    #[Locked]
    public Product $product;

    public function mount(Product $product)
    {
        abort_unless($product->active || $product->user_id === auth()->id(), 404);

        $this->product = $product;
    }
};
?>

<div class="container py-5">

    <a href="{{ route('annunci.index') }}" wire:navigate
       class="text-decoration-none text-secondary d-inline-block mb-4">
        &larr; Torna agli annunci
    </a>

    <div class="row g-4">

        {{-- Foto --}}
        <div class="col-12 col-lg-7">
            @php
                $slides = collect();

                if ($product->image) {
                    $slides->push(asset('storage/' . $product->image));
                }

                foreach (range(1, 3) as $n) {
                    $slides->push("https://picsum.photos/seed/{$product->id}-{$n}/900/600");
                }
            @endphp

            <div id="carousel-{{ $product->id }}" wire:ignore
                 class="carousel slide rounded-4 overflow-hidden shadow-sm bg-dark">

                <div class="carousel-indicators">
                    @foreach ($slides as $i => $src)
                        <button type="button" data-bs-target="#carousel-{{ $product->id }}"
                                data-bs-slide-to="{{ $i }}" aria-label="Foto {{ $i + 1 }}"
                                class="{{ $loop->first ? 'active' : '' }}"
                                @if ($loop->first) aria-current="true" @endif></button>
                    @endforeach
                </div>

                <div class="carousel-inner">
                    @foreach ($slides as $src)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img src="{{ $src }}" alt="{{ $product->title }}"
                                 class="d-block w-100 object-fit-cover" style="height: 420px;">
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button"
                        data-bs-target="#carousel-{{ $product->id }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Precedente</span>
                </button>
                <button class="carousel-control-next" type="button"
                        data-bs-target="#carousel-{{ $product->id }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Successiva</span>
                </button>
            </div>
        </div>

        {{-- Informazioni --}}
        <div class="col-12 col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    @unless ($product->active)
                        <span class="badge text-bg-secondary mb-2">Non pubblicato</span>
                    @endunless

                    <h1 class="fs-2 fw-bold">{{ $product->title }}</h1>

                    <p class="display-6 fw-bold mb-3">
                        &euro; {{ number_format($product->price, 2, ',', '.') }}
                    </p>

                    <p class="text-secondary" style="white-space: pre-line;">{{ $product->description }}</p>

                    <a href="{{ route('category', $product->category) }}" wire:navigate
                       class="badge text-bg-warning text-decoration-none">{{ $product->category->name }}</a>

                    <hr>

                    <dl class="row small mb-4">
                        <dt class="col-5 text-secondary fw-normal">Venditore</dt>
                        <dd class="col-7">{{ $product->user->name }}</dd>

                        <dt class="col-5 text-secondary fw-normal">Pubblicato il</dt>
                        <dd class="col-7 mb-0">{{ $product->created_at->format('d/m/Y') }}</dd>
                    </dl>

                    @if ($product->user_id === auth()->id())
                        <a href="{{ route('edit', $product) }}" wire:navigate
                           class="btn btn-warning w-100 fw-semibold">
                            Modifica annuncio
                        </a>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>