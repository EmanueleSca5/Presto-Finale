<?php

use Livewire\Component;
use Livewire\Attributes\Computed;

new class extends Component
{
    

    #[Computed]
    public function annunci(){
        return auth()->user()->products()->latest()->get();
    }
};
?>

<div>
    <div class="container mt-5">
        <div class="row">

            @foreach ($this->annunci as $annuncio)
            <div class="col-12 col-sm-6 col-lg-4" wire:key="annuncio-{{ $annuncio->id }}">
                <article class="card h-100 border-0 shadow-sm card-hover">
                    
                    <img src="{{ asset('storage/' . $annuncio->image) }}" alt="{{ $annuncio->title }}"
                    class="card-img-top object-fit-cover" style="height: 220px;">
                    
                    <div class="card-body d-flex flex-column">
                        <h2 class="card-title fs-5 fw-semibold">{{ $annuncio->title }}</h2>
                        <p class="card-text text-secondary small">
                            {{ \Illuminate\Support\Str::limit($annuncio->description, 90) }}
                        </p>
                        
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="fs-5 fw-bold">&euro; {{ number_format($annuncio->price, 2, ',', '.') }}</span>
                            <a href="#" class="btn btn-outline-dark btn-sm">Dettagli</a>
                            <a href="{{route("edit" , $annuncio)}}" wire:navigate class="btn btn-outline-dark btn-sm">Modifica</a>

                             <form method="POST" action="{{route("delete" , $annuncio->id)}}" >
                                @csrf
                                @method("delete")
                                <button type="submit" class="btn bg-danger mx-0 btn-outline-dark btn-sm">Elimina</button></form>
                        </div>
                    </div>
                    
                </article>
            </div>
            @endforeach
        </div>
    </div>
</div>