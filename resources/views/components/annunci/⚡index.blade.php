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
        return Product::with('category')->where('active', true)->latest()->paginate(9);
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
            <x-card :product="$product" wire:key="product-{{ $product->id }}" />
                @empty
                <div class="col-12"> ... "Non ci sono ancora annunci" ... </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $this->products->links() }}
            </div>

        </div>
    </div>