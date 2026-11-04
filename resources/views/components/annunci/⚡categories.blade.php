<?php

use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public Category $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    #[Computed]
    public function products()
    {
        return $this->category->products()->with('category')->where('active', true)->latest()->paginate(9);
    }
};
?>

<div>
    <header class="bg-black text-center py-5 px-3">
        <p class="text-secondary text-uppercase small mb-1">Categoria</p>
        <h1 class="display-5 fw-bold text-warning mb-0">{{ $category->name }}</h1>
        <p class="text-secondary mt-2 mb-0">
            {{ $this->products->total() }}
            {{ $this->products->total() === 1 ? 'annuncio' : 'annunci' }}
        </p>
    </header>

    <main class="bg-body-tertiary py-5">
        <section class="container">

            <a href="{{ route('annunci.index') }}" wire:navigate
               class="text-decoration-none text-secondary d-inline-block mb-4">
                &larr; Tutti gli annunci
            </a>

            <div class="row g-4">
                @forelse ($this->products as $product)
                    <x-card :product="$product" />
                @empty
                    <div class="col-12">
                        <div class="text-center text-secondary py-5 border rounded-4 bg-white">
                            Non ci sono ancora annunci in questa categoria.
                            <a href="{{ route('annunci.create') }}" wire:navigate>Inserisci il primo.</a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $this->products->links() }}
            </div>

        </section>
    </main>
</div>