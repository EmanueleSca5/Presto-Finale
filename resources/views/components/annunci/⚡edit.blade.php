<?php

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    #[Locked]
    public Product $product;

    #[Validate("required|max:20")]
    public string $title = "";

    #[Validate("required|max:255")]
    public string $description = "";

    #[Validate("required|numeric|min:0|max:999999.99|decimal:0,2")]
    public string $price = "";

    #[Validate("nullable|image|mimes:jpg,jpeg,png,webp|max:12288")]
    public $image = null;

    #[Validate("boolean")]
    public bool $active = true;

    public function mount(Product $product)
    {
        abort_unless($product->user_id === auth()->id(), 403);

        $this->product = $product;
        $this->title = $product->title;
        $this->description = $product->description;
        $this->price = (string) $product->price;
        $this->active = (bool) $product->active;
    }

    public function update()
    {
        abort_unless($this->product->user_id === auth()->id(), 403);

        $dati = $this->validate();

        if ($this->image) {
            Storage::disk('public')->delete($this->product->image);
            $dati["image"] = $this->image->store("products", "public");
        } else {
            unset($dati["image"]);
        }

        $this->product->update($dati);

        session()->flash("success", "Annuncio aggiornato");
        $this->redirectRoute("my-annunci", navigate: true);
    }
};
?>

<div>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-7 col-xl-6">

                <div class="card bg-black border border-warning border-opacity-25 shadow-lg rounded-4" data-bs-theme="dark">
                    <div class="card-body p-4 p-md-5">

                        <h1 class="fs-2 fw-bold text-warning mb-1">Modifica annuncio</h1>
                        <p class="text-secondary mb-4">Cambia i campi che vuoi aggiornare.</p>

                        <form wire:submit="update" novalidate>

                            <div class="mb-3">
                                <label for="title" class="form-label fw-medium">Titolo</label>
                                <input type="text" id="title" wire:model="title"
                                       class="form-control @error('title') is-invalid @enderror">
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-medium">Descrizione</label>
                                <textarea id="description" wire:model="description" rows="4"
                                          class="form-control @error('description') is-invalid @enderror"></textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label fw-medium">Prezzo</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">&euro;</span>
                                    <input type="number" id="price" wire:model="price" step="0.01" min="0"
                                           class="form-control @error('price') is-invalid @enderror">
                                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label fw-medium">Immagine</label>
                                <input type="file" id="image" wire:model="image" accept="image/*"
                                       class="form-control @error('image') is-invalid @enderror">
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div class="form-text">Lascia vuoto per tenere quella attuale.</div>

                                <div wire:loading wire:target="image" class="form-text text-warning">
                                    Caricamento in corso...
                                </div>

                                @if ($image && ! $errors->has('image'))
                                    <img src="{{ $image->temporaryUrl() }}" alt="Nuova immagine"
                                         class="img-fluid rounded-3 mt-3" style="max-height: 220px;">
                                @else
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                         class="img-fluid rounded-3 mt-3" style="max-height: 220px;">
                                @endif
                            </div>

                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" role="switch" id="active" wire:model="active">
                                <label class="form-check-label" for="active">Annuncio attivo</label>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-warning btn-lg fw-semibold px-4"
                                        wire:loading.attr="disabled" wire:target="update">
                                    <span wire:loading wire:target="update" class="spinner-border spinner-border-sm me-2"></span>
                                    Salva modifiche
                                </button>
                                <a href="{{ route('my-annunci') }}" wire:navigate class="btn btn-outline-light btn-lg">
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