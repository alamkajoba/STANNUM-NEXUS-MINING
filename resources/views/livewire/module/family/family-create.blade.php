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
        <h1 class="h3 mb-0 text-gray-800">Ajouter un membre de famille</h1>
        <a href="{{route('employee.index')}}" style="background-color: rgb(46, 13, 167);" class="btn text-white">
            Voir la liste
        </a>
    </div>



    <div class="justify-content-between card-header">
        <form wire:submit="submitFamily()">
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
                                        {{ $itemsEmployees['firstName'].' '. $itemsEmployees['middleName'].' '. $itemsEmployees['lastName']}}
                                    </a>
                                @empty
                                    <div class="list-group-item mb-2 flex bg-danger-200">
                                        Aucun(e) Agent
                                    </div>
                                @endforelse
                            </ul>
                        @endif
                        
                        <label for="">Nom</label>
                        <input 
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="middleName"
                        >

                        
                        <label for="">Postnom</label>
                        <input 
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="lastName"
                        >

                        <label for="">Prenom</label>
                        <input 
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="firstName"
                        >
                    </div>

                    <div class="col-md-6">
                        <label for="gender">Genre</label>
                        <select wire:model="gender" id="gender" class="form-control">
                            <option>Selectionner...</option>
                            @foreach ($this->gender() as $genders)
                                <option value="{{ $genders }}">{{ $genders }}</option>
                            @endforeach
                        </select>
                        @error('gender')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

                        <label for="">Date de naissance</label>
                        <input 
                            class="form-control"
                            type="date"
                            placeholder=""
                            wire:model="birthDate"
                        >

                        
                        <label for="">Lieu de naissance</label>
                        <input 
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="birthTown"
                        >

                        <label for="relationType">Type de relation</label>
                        <select wire:model="relationType" id="relationType" class="form-control">
                            <option>Selectionner...</option>
                            @foreach ($this->relation() as $relations)
                                <option value="{{ $relations }}">{{ $relations }}</option>
                            @endforeach
                        </select>
                        @error('relationType')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror
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
        

