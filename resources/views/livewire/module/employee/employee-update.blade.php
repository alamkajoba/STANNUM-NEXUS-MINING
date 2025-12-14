<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i style="color:rgb(0, 0, 0);" class="fas fa-fw fa-users"></i>
            Gestion des agents 
        </h1>
        <div>
            <a href="{{ route('employee.index')}}" style="background-color: rgb(97, 97, 156)" class="btn text-white">Voir la liste</a>
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
        <form wire:submit="updateEmployee">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <label for="middleName">Nom</label>
                        <input 
                            required
                            id="middleName"
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="middleName"
                        >
                        @error('middleName')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

                        <label for="lastName">Postnom</label>
                        <input 
                            required
                            id="lastName"
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="lastName"
                        >
                        @error('lastName')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

                        <label for="firstName">Prénom</label>
                        <input 
                            required
                            id="firstName"
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="firstName"
                        >
                        @error('firstName')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

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

                        <label for="birthDate">Date de naissance</label>
                        <input 
                            required
                            id="birthDate"
                            class="form-control"
                            type="date"
                            placeholder=""
                            wire:model="birthDate"
                        >
                        @error('birthDate')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

                        <label for="birthTown">Lieu de naissance</label>
                        <input 
                            required
                            id="birthTown"
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="birthTown"
                        >
                        @error('birthTown')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror
                    </div>

                    <div class="col-md-6">

                        <label for="matricule">Matricule</label>
                        <input 
                            required
                            id="matricule"
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="matricule"
                        >
                        @error('matricule')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

                        <label for="type">Categorie</label>
                        <select wire:model="category" id="type" class="form-control">
                            <option>Selectionner...</option>
                            @foreach ($selectCategory as $selectCategories)
                                <option value="{{ $selectCategories->id }}">{{ $selectCategories->nameCategory }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror
                        

                        <label for="address">Adresse</label>
                        <input 
                            required
                            id="address"
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="address"
                        >
                        @error('address')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

                        <label for="phone">Contact</label>
                        <input 
                            required
                            id="phone"
                            class="form-control"
                            type="text"
                            placeholder="ex: +243 992 700 754"
                            wire:model="phone"
                        >
                        @error('phone')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

                        <label for="mail">Mail</label>
                        <input 
                            id="mail"
                            class="form-control"
                            type="email"
                            placeholder="ex: johndoe@stannum-nexus.com"
                            wire:model="mail"
                        >
                        @error('mail')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror
                        
                    </div>
                </div>
                <div>
                    <button type="submit" style="background-color: rgb(97, 97, 156)" class="btn text-white py-2 my-3">
                        Modifier
                    </button>
                </div>
            </div>
        </form>
    </div>  
</div>

