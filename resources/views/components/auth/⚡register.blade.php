<?php

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    #[Validate("required|min:3|max:30")]
    public string $name = "";

    #[Validate("required|unique:users,email|email")]
    public string $email = "";

    #[Validate("required|min:8|confirmed")]
    public string $password = "";

    public string $password_confirmation = "";

    public function register(){
        $dati = $this->validate();;

        $user = User::create($dati);

        Auth::login($user);
        session()->regenerate();

        session()->flash("success" , "Registrazione avvenuta con successo");

        $this->redirect("/", navigate: true);
    }
}
?>

<div>
    <div class="container">
        <div class="row justify-content-center my-5 bg-black py-5">
            <p class="fs-1 fw-bold text-warning text-center">REGISTRATI</p>
            <form wire:submit="register" class="w-75">
                <p class="fs-5 fw-medium m-0 text-warning">Nome</p>
                <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                

                <p class="fs-5 fw-medium m-0 text-warning mt-3">Email</p>
                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                
                <p class="fs-5 fw-medium m-0 text-warning mt-3">Password</p>
                <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror

                 <p class="fs-5 fw-medium m-0 text-warning mt-3">Conferma password</p>
                <input type="password" wire:model="password_confirmation" class="form-control @error('password') is-invalid @enderror">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                
                <div class="d-flex my-2">
                    <input type="checkbox"  class=" me-2">
                    <p class="text-white m-0 p-0">Ricordami</p>
                </div>
                
                <button type="submit" class="btn btn-warning" wire:loading.attr="disabled">Accedi</button>
            </form>
        </div>
</div>
</div>