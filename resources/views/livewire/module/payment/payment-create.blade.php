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
        <h1 class="h3 mb-0 text-gray-800">Paiement</h1>
        <a href="{{route('payment.index')}}" style="background-color: rgb(46, 13, 167);" class="btn text-white">
            Voir la liste
        </a>
    </div>



    <div class="justify-content-between card-header">
        <form wire:submit="submitPayment()">
            @csrf
            
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Selectionner le nom de l'Agent</label>
                        <input 
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model.live="search"
                            wire:keyup="searchEmployee"
                        >

                        @if (!empty($itemsEmployee))
                            <ul class="list-group mt-2">
                                <h5>Resultat de la recherche :</h5>
                                @forelse ($itemsEmployee as $itemsEmployees)
                                    <a href="" class="list-group-item mb-2 flex bg-primary-200 hover:bg-primary-500"
                                        wire:click.prevent="selectEmployee({{$itemsEmployees['id']}})">
                                        {{ $itemsEmployees['firstName'].' '. $itemsEmployees['middleName'].' '. $itemsEmployees['lastName'].' '.$itemsEmployees['matricule']}}
                                    </a>
                                @empty
                                    <div class="list-group-item mb-2 flex bg-danger-200">
                                        Aucun(e) Agent
                                    </div>
                                @endforelse
                            </ul>
                        @endif

                        <label for="">Selectionner le nom de l'Agent</label>
                        <input 
                            class="form-control"
                            type="month"
                            placeholder=""
                            wire:model="motif"
                        >


                        <label for="restDay">Jours d'abscence</label>
                        <input 
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="restDay"
                        >

                        <label for="overtimes">Heures supplementaires</label>
                        <input 
                            class="form-control"
                            type="number"
                            wire:model="overtimes"
                        >

                        <label for="">Prime d'assudite</label>
                        <input 
                            class="form-control"
                            type="number"
                            step="0.01"
                            placeholder="en USD"
                            wire:model="assudityBonus"
                        >
                    </div>

                    <div class="col-md-6">
                        <label for="">Prime de risque</label>
                        <input 
                            class="form-control"
                            type="number"
                            step="0.01"
                            placeholder="en USD"
                            wire:model="riskBonus"
                        >

                        <label for="">Prime de rendement</label>
                        <input 
                            class="form-control"
                            type="number"
                            step="0.01"
                            placeholder="en USD"
                            wire:model="performanceBonus"
                        >

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
        

