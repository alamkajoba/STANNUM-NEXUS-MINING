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
        <form wire:submit="updateCategory">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <label for="nameCategory">Categorie</label>
                        <input 
                            required
                            id="nameCategory"
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="nameCategory"
                        >
                        @error('nameCategory')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

                        <label for="amount">Salaire</label>
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
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

                        <label for="workDay">Jours de travail</label>
                        <input 
                            required
                            id="workDay"
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="workDay"
                        >
                        @error('workDay')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

                        <label for="workDay">Logement</label>
                        <input 
                            id="lunch"
                            class="form-control"
                            type="number"
                            step="0.01"
                            placeholder=""
                            wire:model="housing"
                        >
                        @error('housing')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

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
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

                        <label for="workDay">Allocation famille (Par enfant)</label>
                        <input 
                            id="familialAllocation"
                            class="form-control"
                            type="number"
                            step="0.01"
                            placeholder=""
                            wire:model="familialAllocation"
                        >
                        @error('familialAllocation')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
        
                        
                    </div>
                </div>
                <div>
                    <button type="submit" style="background-color: rgb(46, 13, 167);" class="btn text-white py-2 my-3">
                        Modifier
                    </button>
                </div>
            </div>
        </form>
    </div>  
</div>


