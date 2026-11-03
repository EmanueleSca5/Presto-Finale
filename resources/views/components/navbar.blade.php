<nav class="navbar navbar-expand-lg navbar-dark bg-black sticky-top border-bottom border-warning border-opacity-25">
    <div class="container">
        
        <a class="navbar-brand fw-bold text-warning fs-4" href="{{ route('home') }}" wire:navigate>
            PRESTO
        </a>
        @auth
        
        @php
        $parole = preg_split("/\s+/u", trim(auth()->user()->name), -1, PREG_SPLIT_NO_EMPTY);
        
        $iniziali = count($parole) > 1 ? mb_substr($parole[0], 0, 1) . mb_substr(end($parole), 0, 1) : mb_substr($parole[0] ?? "?", 0, 2); 
        @endphp
        <div class="order-lg-last ms-auto me-2 me-lg-0 ms-lg-3">
            <span class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-circle bg-warning text-white fw-bold"
            style="width: 2.5rem; height: 2.5rem;"
            title="{{ auth()->user()->name }}">
            {{ mb_strtoupper($iniziali) }}
        </span>
    </div>
    @endauth
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
    data-bs-target="#navbarPresto" aria-controls="navbarPresto"
    aria-expanded="false" aria-label="Apri il menu">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarPresto">
    
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? 'active text-warning' : '' }}"
                href="{{ route('home') }}" wire:navigate>Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('annunci.index') ? 'active text-warning' : '' }}"
                    href="{{ route('annunci.index') }}" wire:navigate>Annunci</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('annunci.create') ? 'active text-warning' : '' }}"
                        href="{{ route('annunci.create') }}" wire:navigate>Pubblica</a>
                    </li>
                    
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('my-annunci') ? 'active text-warning' : '' }}"
                            href="{{ route('my-annunci') }}" wire:navigate>I miei annunci</a>
                        </li>    
                        <li class="nav-item">
                            <form action="{{route("logout")}}" method="POST">
                                <button class="text-white bg-black border-0" type="submit">Logout</button>
                            </form>
                        </li>
                        @endauth
                    </ul>
                    
                    
                    @guest
                    
                    <div class="d-flex gap-2">
                        <a href="{{ route('auth.login') }}" wire:navigate class="btn btn-outline-light btn-sm px-3">
                            Accedi
                        </a>
                        <a href="{{ route('auth.register') }}" wire:navigate class="btn btn-warning btn-sm px-3 fw-semibold">
                            Registrati
                        </a>
                    </div>
                    @endguest
                    
                </div>
            </div>
        </nav>