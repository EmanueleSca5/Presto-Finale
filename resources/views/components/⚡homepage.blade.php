<?php

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function products()
    {
        return $products = Product::with("category")->latest()->take(6)->get();
    }
};
?>

<div>

    <header class="d-flex flex-column justify-content-center align-items-center text-center bg-black px-3"
    style="min-height: calc(100vh - 56px);">
    <h1 class="display-1 fw-bold text-warning mb-3">PRESTO</h1>
    <p class="lead text-secondary mb-5">Compra, vendi e scopri. Il tuo annuncio è a un click.</p>

    <div class="d-flex flex-wrap gap-3 justify-content-center">
        <a href="{{ route('annunci.create') }}" wire:navigate class="btn btn-warning btn-lg px-4 fw-semibold">
            Inserisci annuncio
        </a>
        <a href="{{ route('annunci.index') }}" wire:navigate class="btn btn-outline-light btn-lg px-4">
            Sfoglia gli annunci
        </a>
    </div>
</header>

<main class="bg-body-tertiary py-5">
    <section class="container py-4">

        <h2 class="text-center fw-bold mb-5">Cosa vuoi fare?</h2>

        <div class="row g-4 justify-content-center">

            {{-- Card: crea annuncio --}}
            <article class="col-12 col-md-6 col-lg-5">
                <div class="card card-hover h-100 border-0 shadow-sm">
                    <div class="bg-warning-subtle text-warning-emphasis d-flex justify-content-center align-items-center py-5 rounded-top">
                        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 8v8M8 12h8"/>
                    </svg>
                </div>
                <div class="card-body d-flex flex-column p-4">
                    <h3 class="card-title fs-4 fw-semibold">Crea annuncio</h3>
                    <p class="card-text text-secondary">
                        Hai qualcosa da vendere? Aggiungi titolo, prezzo e foto e pubblicalo in pochi minuti.
                    </p>
                    <a href="{{ route('annunci.create') }}" wire:navigate class="btn btn-warning fw-semibold mt-auto">
                        Inserisci annuncio
                    </a>
                </div>
            </div>
        </article>

        {{-- Card: vedi annunci --}}
        <article class="col-12 col-md-6 col-lg-5">
            <div class="card card-hover h-100 border-0 shadow-sm">
                <div class="bg-dark text-warning d-flex justify-content-center align-items-center py-5 rounded-top">
                    <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                    <circle cx="11" cy="11" r="7"/>
                    <path d="m20 20-4-4"/>
                </svg>
            </div>
            <div class="card-body d-flex flex-column p-4">
                <h3 class="card-title fs-4 fw-semibold">Vedi annunci</h3>
                <p class="card-text text-secondary">
                    Cerca tra gli annunci pubblicati dagli altri utenti e trova l'affare giusto.
                </p>
                <a href="{{ route('annunci.index') }}" wire:navigate class="btn btn-dark fw-semibold mt-auto">
                    Sfoglia
                </a>
            </div>
        </div>
    </article>

</div>
</section>

<section>
    <article>
        <h2 class="text-center">Prodotti pubblicati di recente</h2>
        <section class="container py-5">
            <h2 class="text-center fw-bold mb-4">Prodotti pubblicati di recente</h2>

            <div class="row g-4">
                @foreach ($this->products as $product)
                <x-card :product="$product" />
                @endforeach
            </div>
        </section>
    </article>
</section>
</main>

</div>