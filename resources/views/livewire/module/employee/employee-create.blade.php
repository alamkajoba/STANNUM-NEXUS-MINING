<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i style="color:rgb(0, 0, 0);" class="fas fa-fw fa-users"></i>
            Gestion des agents - <small class="text-muted">Étape {{ $step }}/3</small>
        </h1>
        <div>
            <a href="{{ route('employee.index')}}" style="background-color: rgb(46, 13, 167);" class="btn text-white">Voir la liste</a>
        </div>
    </div>

    @if (session()->has('danger'))
        <div class="alert alert-danger text-center" style="position: fixed; top: 10%; left: 50%; transform: translateX(-50%); z-index: 9999;">
            {{ session('danger') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="progress mb-4" style="height: 5px;">
                <div class="progress-bar" role="progressbar" style="width: {{ ($step/3)*100 }}%; background-color: rgb(46, 13, 167);"></div>
            </div>

            <form wire:submit.prevent="{{ $step == 3 ? 'saveEmployee' : 'nextStep' }}">
                <div class="container">
                    
                    {{-- ÉTAPE 1 : ÉTAT CIVIL --}}
                    @if($step == 1)
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nom (MiddleName)</label>
                            <input wire:model="middleName" class="form-control mb-2" type="text">
                            @error('middleName') <span class="text-danger small">Vérifiez ce champ</span> @enderror

                            <label>Postnom (LastName)</label>
                            <input wire:model="lastName" class="form-control mb-2" type="text">
                            
                            <label>Prénom</label>
                            <input wire:model="firstName" class="form-control mb-2" type="text">
                        </div>
                        <div class="col-md-6">
                            <label>Genre</label>
                            <select wire:model="gender" class="form-control mb-2">
                                <option value="">Sélectionner...</option>
                                @foreach ($this->gender() as $g) <option value="{{ $g }}">{{ $g }}</option> @endforeach
                            </select>
                            
                            <label>Date de naissance</label>
                            <input wire:model="birthDate" class="form-control mb-2" type="date">
                            
                            <label>Lieu de naissance</label>
                            <input wire:model="birthTown" class="form-control mb-2" type="text">
                        </div>
                    </div>
                    @endif

                    {{-- ÉTAPE 2 : CONTACTS & ADRESSE --}}
                    @if($step == 2)
                    <div class="row">
                        <div class="col-md-6">
                            <label>Téléphone Personnel</label>
                            <input wire:model="phone" class="form-control mb-2" type="text" placeholder="+243...">
                            
                            <label>Téléphone d'Urgence</label>
                            <input wire:model="emergencyPhone" class="form-control mb-2" type="text">

                            <label>Email Personnel</label>
                            <input wire:model="mail" class="form-control mb-2" type="email">
                        </div>
                        <div class="col-md-6">
                            <label>Nationalité</label>
                            <input wire:model="nationalite" class="form-control mb-2" type="text">

                            <label>Adresse Résidentielle</label>
                            <input wire:model="address" class="form-control mb-2" type="text">
                        </div>
                    </div>
                    @endif

                    {{-- ÉTAPE 3 : INFOS PRO --}}
                    @if($step == 3)
                    <div class="row">
                        <div class="col-md-6">
                            <label>Affectation</label>
                            <input wire:model="affectation" class="form-control mb-2" type="text">

                            <label>Poste / Titre</label>
                            <input wire:model="jobTitle" class="form-control mb-2" type="text">

                            <label>Catégorie</label>
                            <select wire:model="categoryName" class="form-control mb-2">
                                <option value="">Sélectionner...</option>
                                @foreach ($selectCategory as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nameCategory }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Email Professionnel</label>
                            <input wire:model="proMail" class="form-control mb-2" type="email">

                        </div>
                    </div>
                    @endif

                    {{-- BOUTONS DE NAVIGATION --}}
                    <div class="d-flex justify-content-between mt-4">
                        @if($step > 1)
                            <button type="button" style="background-color: rgb(100, 117, 117);" wire:click="previousStep" class="btn text-white px-4">Précédent</button>
                        @else
                            <div></div>
                        @endif

                        @if($step < 3)
                            <button type="submit" style="background-color: rgb(46, 13, 167);" class="btn text-white px-4">Suivant</button>
                        @else
                            <button type="submit" style="background-color: #28a745;" class="btn text-white px-4">Confirmer l'enregistrement</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>