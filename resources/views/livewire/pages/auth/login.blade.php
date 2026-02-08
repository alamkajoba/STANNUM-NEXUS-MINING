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

