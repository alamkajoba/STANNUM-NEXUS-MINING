<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i style="color:rgb(0, 0, 0);" class="fas fa-fw fa-users"></i>
            Gestion des categories
        </h1>
        <div>
            <a href="{{ route('category.index')}}" style="background-color: rgb(46, 13, 167);" class="btn text-white">Voir la liste</a>
        </div>
    </div>

    {{-- NOTIFY --}}
    @if (session()->has('danger'))
        <div id="alert-success" 
            class="alert alert-danger fade show text-center"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            {{ session('danger') }}
        </div>
    @endif
    {{-- table --}}
    <div class="justify-content-between card-header">
        <form wire:submit="submitCategory">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-1">
                            <label for="nameCategory">Catégorie</label>
                            <input 
                                id="nameCategory"
                                class="form-control"
                                type="text"
                                placeholder=""
                                wire:model="nameCategory"
                            >
                            @error('nameCategory')
                                <span style="color: rgb(252, 0, 0)" class="flex">Ce champs ne doit pas être vide</span>
                            @enderror
                        </div>
                        
                        <div class="mb-1">
                            <label for="amount">Salaire de base</label>
                            <input 
                                required
                                id="amount"
                                class="form-control"
                                type="number"
                                step="0.01"
                                placeholder=""
                                wire:model="amount"
                            >
                            @error('amount')
                                <span style="color: rgb(252, 0, 0)" class="flex">Saisissez une valeur superieure a 1</span>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <label for="workDay">Jours de travail</label>
                            <input 
                                id="workDay"
                                class="form-control"
                                type="number"
                                placeholder=""
                                wire:model="workDay"
                            >
                            @error('workDay')
                                <span style="color: rgb(252, 0, 0)" class="flex">La valeur doit etre comprise entre 1 et 31</span>
                            @enderror
                        </div>    
                        <div class="mb-1">
                            <label for="workDay">Logement</label>
                            <input 
                                id="housing"
                                class="form-control"
                                type="number"
                                step="0.01"
                                placeholder=""
                                wire:model="housing"
                            >
                            @error('housing')
                                <span style="color: rgb(252, 0, 0)" class="flex">verifiez ce champs</span>
                            @enderror
                        </div>

                        <div class="mb-1">
                            <label for="workDay">Transport</label>
                            <input 
                                id="transportationCost"
                                class="form-control"
                                type="number"
                                step="0.01"
                                placeholder=""
                                wire:model="transportationCost"
                            >
                            @error('transportationCost')
                                <span style="color: rgb(252, 0, 0)" class="flex">verifiez ce champs</span>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <label for="familialAllocation">Allocation familliale (Par enfant)</label>
                            <input 
                                id="familialAllocation"
                                class="form-control"
                                type="number"
                                step="0.01"
                                placeholder=""
                                wire:model="familialAllocation"
                            >
                            @error('familialAllocation')
                                <span style="color: rgb(252, 0, 0)" class="flex">verifiez ce champs</span>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="col-md-6">
        
                        
                    </div>
                </div>
                <div>
                    <button type="submit" style="background-color: rgb(46, 13, 167);" class="btn text-white py-2 my-3">
                        Valider
                    </button>
                </div>
            </div>
        </form>
    </div>  
</div>

