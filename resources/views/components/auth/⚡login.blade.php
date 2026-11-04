<?php

use Livewire\Component;
use Livewire\Attributes\Validate;

new class extends Component
{
    #[Validate("required|email")]
    public string $email = "";


    #[Validate("required")]
    public string $password = "";

    public function login(){
       $this->validate();

        if (! Auth::attempt(["email" => $this->email, "password" => $this->password])) {
            $this->addError("email" , "credenziali non valide");
            return;
        }

        session()->regenerate();

        session()->flash("success" , "login avvenuto con successo");

        $this->redirectRoute("annunci.create" , navigate: true);
    }
};
?>

<div>
    <div class="container">
        <div class="row justify-content-center my-5 bg-black py-5">
            <p class="fs-1 fw-bold text-warning text-center">ACCEDI</p>
            <form wire:submit="login" class="w-75">

                <p class="fs-5 fw-medium m-0 text-warning mt-3">Email</p>
                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror

                <p class="fs-5 fw-medium m-0 text-warning mt-3">Password</p>
                <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror

                <div class="d-flex my-2">
                    <input type="checkbox"  class=" me-2">
                    <p class="text-white m-0 p-0">Ricordami</p>
                </div>

                <button type="submit" class="btn btn-warning" wire:loading.attr="disabled">Accedi</button>
                <div>
                    <p class="text-white mb-0 my-2">Non sei ancora registrato?</p>
                    <a class="fs-4 text-white" href="{{route("auth.register")}}">Registrati!</a>
                </div>
            </form>
        </div>
</div>
</div>