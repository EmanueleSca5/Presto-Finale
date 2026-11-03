<?php

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Computed]
    public function products()
    {
        return Product::where('active', true)->latest()->paginate(9);
    }
};
?>

<div>
    <div class="container py-5">

  

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="fs-2 fw-bold mb-0">Annunci</h1>
            <p class="text-secondary mb-0">{{ $this->products->total() }} annunci disponibili</p>
        </div>
        <a href="{{ route('annunci.create') }}" wire:navigate class="btn btn-warning fw-semibold">
            + Crea annuncio
        </a>
    </div>

    <div class="row g-4">
        @forelse ($this->products as $product)
            <div class="col-12 col-sm-6 col-lg-4" wire:key="product-{{ $product->id }}">
                <article class="card h-100 border-0 shadow-sm card-hover">

                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                         class="card-img-top object-fit-cover" style="height: 220px;">

                    <div class="card-body d-flex flex-column">
                        <h2 class="card-title fs-5 fw-semibold">{{ $product->title }}</h2>
                        <p class="card-text text-secondary small">
                            {{ \Illuminate\Support\Str::limit($product->description, 90) }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="fs-5 fw-bold">&euro; {{ number_format($product->price, 2, ',', '.') }}</span>
                            <a href="#" class="btn btn-outline-dark btn-sm">Dettagli</a>
                        </div>
                    </div>

                </article>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center text-secondary py-5 border rounded-4">
                    Non ci sono ancora annunci. <a href="{{ route('annunci.create') }}" wire:navigate>Pubblica il primo.</a>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $this->products->links() }}
    </div>

</div>
</div>