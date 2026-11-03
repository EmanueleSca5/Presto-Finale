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

        {{-- Immagine --}}
        <div class="col-12 col-lg-7">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                 class="w-100 rounded-4 shadow-sm object-fit-cover" style="max-height: 520px;">
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