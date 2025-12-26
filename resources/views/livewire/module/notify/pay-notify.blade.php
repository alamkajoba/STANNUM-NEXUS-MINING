<div>
{{-- L'écran de chargement --}}
{{-- @if ($loading )
    <div wire:loading wire:target="envoyerMails" 
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999; display: flex; align-items: center; justify-content: center;">
        
        <div style="background: white; padding: 30px; border-radius: 15px; text-align: center; box-shadow: 0px 10px 30px rgba(0,0,0,0.3);">
            
            <div style="color: rgb(46, 13, 167); margin-bottom: 15px;">
                <i class="fas fa-circle-notch fa-spin fa-3x"></i>
            </div>
            
            <h4 style="color: #333; margin-bottom: 5px;">Alvine Business</h4>
            <p style="color: #666; margin: 0;">Envoi des mails vers Hostinger en cours...</p>
            <small style="color: #999;">Veuillez ne pas fermer cette fenêtre.</small>
        </div>
    </div>
@endif --}}

<!-- notify -->
     @if (session()->has('success'))
        <div id="alert-success" 
            class="alert alert-success fade show text-center"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            {{ session('success') }}
        </div>
    @endif
     @if (session()->has('danger'))
        <div id="alert-danger" 
            class="alert alert-danger fade show text-center"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            {{ session('danger') }}
        </div>
    @endif

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Notifier les agents pour un paiement disponible</h1>
    </div>



    <div class="justify-content-between card-header">
        <form wire:submit.prevent="sendMail">
            @csrf
            
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <label for="motif">Selectionner le mois </label>
                        <input 
                            class="form-control"
                            type="month"
                            placeholder=""
                            wire:model="motif"
                        >
                    </div>

                    <div class="col-md-6">

                    </div>
                </div>
                <div>
                    
                    <button type="submit" 
                            style="background-color: rgb(46, 13, 167);" 
                            class="btn text-white py-2 my-3">
                        <i class="fas fa-paper-plane"></i> Lancer l'envoi des mails
                    </button>
                </div>
            </div>
        </form>
    </div>  
</div>
        


