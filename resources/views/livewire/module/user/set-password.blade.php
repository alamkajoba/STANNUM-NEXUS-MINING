<div>
    @if (session()->has('success'))
        <div id="alert-success" 
            class="alert alert-success fade show text-center shadow-lg"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('danger'))
        <div id="alert-success" 
            class="alert alert-danger fade show text-center shadow-lg"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            {{ session('danger') }}
        </div>
    @endif

        <!-- Header -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-danger">
                Attention ces informations sont tres sensibles;
                Memorisez bien les nouvelles informations avant d'enregistrer
            </h1>
            <div class="d-none d-sm-inline-block shadow-sm">
            </div>
        </div>
        {{-- table --}}
        <div class="justify-content-between card-header">
            <form wire:submit="submitData()">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">

                            <label for="">Identifiant</label>
                            <input 
                                required
                                class="form-control"
                                type="text"
                                placeholder=""
                                wire:model="identifiant"
                            >

                        </div>

                        <div class="col-md-6">
                            <label for="">Mot de passe</label>
                            <input 
                                class="form-control"
                                type="password"
                                placeholder=""      
                                wire:model="password"
                            >
                        </div>
                    </div>
                    <div>
                        <button style="background-color: rgb(7, 7, 99)" class="btn text-white py-2 my-3">
                            Valider
                        </button>
                    </div>
                </div>
            </form>
        </div>  
</div> 

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alert = document.getElementById('alert-success');
        if (alert) {
            setTimeout(() => {
                alert.classList.remove('show'); // commence la disparition
                setTimeout(() => {
                    alert.remove(); // supprime du DOM après l'animation
                }, 500); // temps pour le fade-out
            }, 3000); // affichée pendant 3 secondes
        }
    });
</script>





