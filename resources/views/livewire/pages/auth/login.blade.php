<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login()
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();
        return redirect()->route('dashboard.dashboard');
    }
}; ?>


<div class="auth-container">
    <div class="auth-card">
        
        <div class="auth-form-section">
            <div class="form-header">
                <h1>Connexion</h1>
                <p>Accédez à votre espace entreprise</p>
            </div>

            <form wire:submit.prevent="login">
                <div class="input-group">
                    <label for="email">Identifiant</label>
                    <input wire:model="form.identifiant" type="identifiant" id="identifiant" required>
                </div>

                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" wire:model="form.password" required>
                </div>

                <div class="form-footer">
                    <label class="remember-me">
                        <input type="checkbox"> Se souvenir de moi
                    </label>
                    <a href="#" class="forgot-link">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="btn-login">Se connecter</button>
            </form>
        </div>

        <div class="auth-image-section">
            <div class="image-overlay">
                <h2>Alvine Business</h2>
                <p>Innover, Sécuriser, Connecter.</p>
            </div>
        </div>
        
    </div>
</div>






{{-- 




<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <div class="p-5">
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <div class="text-center">
                                    <img src="{{ asset('img/finallogo.jpeg') }}" class="mb-4" style="height: 60px;" alt="Logo">
                                    <h1 class="h4 text-gray-900 mb-4">Bienvenue !</h1>
                                </div>

                                <form wire:submit="login" class="user">
                                    <div class="form-group mb-3">
                                        <label class="small mb-1 text-gray-600">Identifiant</label>
                                        <input wire:model="form.identifiant" type="text" class="form-control form-control-user" placeholder="Votre identifiant..." required autofocus>
                                        <x-input-error :messages="$errors->get('form.identifiant')" class="mt-2" />
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="small mb-1 text-gray-600">Mot de passe</label>
                                        <input wire:model="form.password" type="password" class="form-control form-control-user" placeholder="Mot de passe" required>
                                        <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox small">
                                            <input wire:model="form.remember" type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Se souvenir de moi</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block w-100 py-2" style="background-color: #5a5c69; border: none;">
                                        Connexion
                                    </button>
                                </form>

                                <hr>

                                <div class="text-center">
                                    @if (Route::has('password.request'))
                                        <a class="small text-muted" href="{{ route('password.request') }}" wire:navigate>
                                            Mot de passe oublié ?
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 d-none d-lg-block bg-login-image" 
                             style="background: url('{{ asset('img/votre-photo-mining.jpg') }}'); background-size: cover; background-position: center;">
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <small class="text-muted">Copyright ©2025 - 2026 | STANNUM NEXUS MINING | Powered by Alvine Business</small>
            </div>
        </div>
    </div>
</div> --}}
