<div>
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
        <h1 class="h3 mb-0 text-gray-800">
            <i style="color:rgb(0, 0, 0);" class="fas fa-fw fa-credit-card"></i>
            Paiement
        </h1>
        <a href="{{route('payment.index')}}" style="background-color: rgb(46, 13, 167);" class="btn text-white">
            Voir la liste
        </a>
    </div>



    <div class="justify-content-between card-header">
        <form wire:submit.prevent="submitPayment">
            @csrf
            
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="position-relative mb-1">
                            <label for="agent_search">Sélectionner le nom de l'Agent</label>
                            <input 
                                id="agent_search"
                                class="form-control"
                                type="text"
                                placeholder="Rechercher par nom, prénom ou matricule..."
                                wire:model.live="search"
                                wire:keyup="searchEmployee"
                                autocomplete="off"
                            >

                            @if (!empty($itemsEmployee))
                                <ul class="list-group mt-2" style="position: absolute; z-index: 1000; width: 100%;">
                                    <li class="list-group-item disabled bg-light">
                                        <strong>Résultat de la recherche :</strong>
                                    </li>
                                    @forelse ($itemsEmployee as $item)
                                        <a href="#" 
                                        class="list-group-item list-group-item-action mb-1"
                                        wire:click.prevent="selectEmployee({{ $item['id'] }})">
                                            <div class="d-flex justify-content-between">
                                                <span>
                                                    {{-- On utilise 'full_name' car c'est la clé définie dans searchEmployee() --}}
                                                    <strong>{{ $item['full_name'] }}</strong> 
                                                    <small class="text-muted">({{ $item['function_name'] }})</small>
                                                </span>
                                                <span class="badge bg-info text-dark">
                                                    {{ $item['matricule'] }}
                                                </span>
                                            </div>
                                        </a>
                                    @empty
                                        <li class="list-group-item list-group-item-danger">
                                            Aucun agent trouvé pour "{{ $search }}"
                                        </li>
                                    @endforelse
                                </ul>
                            @endif


                        </div>
                        <div class="mb-1">
                            <label for="">Selectionner le motif de paiement</label>
                            <input 
                                class="form-control"
                                type="month"
                                wire:model="motif"
                            >
                        </div>
                        <div class="mb-1">
                            <label for="restDay">Jours d'abscence</label>
                            <input 
                                class="form-control"
                                type="number"
                                wire:model="restDay"
                                step="1"
                                min="0"
                            >
                        </div>
                        <div class="mb-1">
                            <label for="restDay">Jours d'incapacité</label>
                            <input 
                                class="form-control"
                                type="number"
                                wire:model="justifyDay"
                                step="1"
                                min="0"
                            >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-1">
                            <label for="">Prime d'assiduité</label>
                            <input 
                                class="form-control"
                                type="number"
                                step="0.01"
                                wire:model="assudityBonus"
                                min="0"
                            >
                        </div>
                        <div class="mb1">
                            <label for="">Prime de risque</label>
                            <input 
                                class="form-control"
                                type="number"
                                step="0.01"
                                wire:model="riskBonus"
                                min="0"
                            >
                        </div>
                        <div class="mb1">
                            <label for="">Prime de rendement</label>
                            <input 
                                class="form-control"
                                type="number"
                                step="0.01"
                                wire:model="performanceBonus"
                                min="0"
                            >
                        </div>
                        <div class="mb-1">
                            <label for="overtimes">Heures supplementaires</label>
                            <input 
                                class="form-control"
                                type="number"
                                step="0.01"
                                wire:model="overtimes"
                                min="0"
                            >
                        </div>

                    </div>
                </div>
                

                <div>
                    <button style="background-color: rgb(46, 13, 167);" class="btn text-white py-2 my-3">
                        Valider
                    </button>
                </div>
            </div>
        </form>
    </div>  
</div>
        

