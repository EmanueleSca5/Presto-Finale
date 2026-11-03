<?php

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use App\Models\Product;

new class extends Component
{

    use WithFileUploads;

    #[Validate("max:20|required")]
    public string $title = "";

    #[Validate("max:255|required")]
    public string $description = "";

    #[Validate("numeric|min:0|max:999999.99|decimal:0,2|required")]
    public string $price = "";

    #[Validate("image|required|mimes:jpg,jpeg,png,webp|max:12288")]
    public $image = null;
    public function store(){

        $dati = $this->validate();
        $dati["image"] = $this->image->store("products" , "public");

        $product = auth()->user()->products()->create($dati);

        session()->flash("success" , "Annuncio pubblicato con successo");
        $this->redirectRoute("annunci.index" , navigate: true);
    }
};
?>

<div>
   <div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-7 col-xl-6">

            <div class="card bg-black border border-warning border-opacity-25 shadow-lg rounded-4" data-bs-theme="dark">
                <div class="card-body p-4 p-md-5">

                    <h1 class="fs-2 fw-bold text-warning mb-1">Crea annuncio</h1>
                    <p class="text-secondary mb-4">Compila i campi e pubblica il tuo articolo.</p>

                    <form wire:submit="store" novalidate>

                        {{-- Titolo --}}
                        <div class="mb-3">
                            <label for="title" class="form-label fw-medium">Titolo</label>
                            <input type="text" id="title" wire:model="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   placeholder="Es. Bicicletta da corsa">
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Descrizione --}}
                        <div class="mb-3">
                            <label for="description" class="form-label fw-medium">Descrizione</label>
                            <textarea id="description" wire:model="description" rows="4"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Descrivi condizioni, misure, accessori..."></textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Prezzo --}}
                        <div class="mb-3">
                            <label for="price" class="form-label fw-medium">Prezzo</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">&euro;</span>
                                <input type="number" id="price" wire:model="price" step="0.01" min="0"
                                       class="form-control @error('price') is-invalid @enderror"
                                       placeholder="0,00">
                                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                       
                        <div class="mb-3">
                            <label for="image" class="form-label fw-medium">Immagine</label>
                            <input type="file" id="image" wire:model="image" accept="image/*"
                                   class="form-control @error('image') is-invalid @enderror">
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror

                            <div wire:loading wire:target="image" class="form-text text-warning">
                                Caricamento in corso...
                            </div>

                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" alt="Anteprima"
                                     class="image-fluid rounded-3 mt-3" style="max-height: 220px;">
                            @endif
                        </div>

                   
                        <div class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-warning btn-lg fw-semibold px-4"
                                    wire:loading.attr="disabled" wire:target="store">
                                <span wire:loading wire:target="store" class="spinner-border spinner-border-sm me-2"></span>
                                Pubblica annuncio
                            </button>
                            <a href="{{ route('annunci.index') }}" wire:navigate class="btn btn-outline-light btn-lg">
                                Annulla
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>