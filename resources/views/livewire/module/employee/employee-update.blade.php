<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i style="color:rgb(0, 0, 0);" class="fas fa-fw fa-users"></i>
            Modification agent - <small class="text-muted">Étape {{ $step }}/{{$totalSteps}}</small>
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
                <div class="progress-bar" role="progressbar" style="width: {{ ($step/$totalSteps)*100 }}%; background-color: rgb(46, 13, 167);"></div>
            </div>

            <form wire:submit.prevent="{{ $step == 4 ? 'saveEmployee' : 'nextStep' }}">
                <div class="container">
                    
                    {{-- ÉTAPE 1 : ÉTAT CIVIL --}}
                    @if($step == 1)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label>Nom</label>
                                <input wire:model="middleName" class="form-control mb-2" type="text">
                                @error('middleName') <span style="color: rgb(252, 0, 0)" class="flex">Remplissez le champ uniquement des lèttres et (-)</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Postnom</label>
                                <input wire:model="lastName" class="form-control mb-2" type="text">
                                @error('lastName') <span style="color: rgb(252, 0, 0)" class="flex">Remplissez le champ uniquement des lèttres et (-)</span> @enderror
                            </div>

                            <div class="mb-1">
                                <label>Prénom</label>
                                <input wire:model="firstName" class="form-control mb-2" type="text">
                                @error('firstName') <span style="color: rgb(252, 0, 0)" class="flex">Remplissez le champ uniquement des lèttres et (-)</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label>Genre</label>
                                <select wire:model="gender" class="form-control mb-2">
                                    <option>Sélectionner...</option>
                                    @foreach ($this->gender() as $g) 
                                        <option value="{{ $g }}">{{ $g }}</option> 
                                    @endforeach
                                </select>
                                @error('gender') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Selectionnez une valeur entre homme, femme
                                    </span> 
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label>Date de naissance</label>
                                <input wire:model="birthDate" class="form-control mb-2" type="date">
                                @error('birthDate') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Verifiez la date
                                    </span> 
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label>Lieu de naissance</label>
                                <input wire:model="birthTown" class="form-control mb-2" type="text">
                                @error('birthTown') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- ÉTAPE 2 : CONTACTS & ADRESSE --}}
                    @if($step == 2)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label>Téléphone Personnel</label>
                                <input wire:model="phone" class="form-control mb-2" type="text" placeholder="+243...">
                                @error('phone') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label>Téléphone d'Urgence</label>
                                <input wire:model="emergencyPhone" class="form-control mb-2" type="text">
                                @error('emergencyPhone') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label>Email Personnel</label>
                                <input wire:model="mail" class="form-control mb-2" type="text">
                                @error('mail') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label>Nationalité</label>
                                <input wire:model="nationality" class="form-control mb-2" type="text">
                                @error('nationality') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label>Adresse Résidentielle</label>
                                <input wire:model="address" class="form-control mb-2" type="text">
                                @error('address') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- ÉTAPE 3 : INFOS PRO --}}
                    @if($step == 3)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label>Fonction</label>
                                <select wire:model="functionName" class="form-control mb-2">
                                    <option value="">Sélectionner...</option>
                                    @forelse ($functionType ?? [] as $functions)
                                        <option value="{{ $functions->id }}">{{ $functions->nameFunction }}</option>
                                    @empty
                                        <option value="" disabled>Aucune fonction disponible</option>
                                    @endforelse
                                </select>
                                @error('functionName') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label>Section</label>
                                <input wire:model="section" class="form-control mb-2" type="text">
                                @error('section') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label>Département</label>
                                <input wire:model="department" class="form-control mb-2" type="text">
                                @error('department') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label>Catégorie professionnelle</label>
                                <select wire:model="professionalCategory" class="form-control mb-2">
                                    <option>Sélectionner...</option>
                                    @foreach ($this->category() as $cat)
                                        <option value="{{ $cat }}">{{ $cat }}</option>
                                    @endforeach
                                </select>
                                @error('professionalCategory') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                            <div class="mb-1">
                                <label>Echélon</label>
                                <select wire:model="echelon" class="form-control mb-2">
                                    <option>Sélectionner...</option>
                                    @foreach ($this->echelon() as $ech)
                                        <option value="{{ $ech }}">{{ $ech }}</option>
                                    @endforeach
                                </select>
                                @error('echelon') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label>Site</label>
                                <input wire:model="site" class="form-control mb-2" type="text">
                                @error('site') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label>Début du contrat</label>
                                <input wire:model="startDate" class="form-control mb-2" type="date">
                                @error('startDate') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- ÉTAPE 4 : INFOS PRO --}}
                    @if($step == 4)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label>Mail professionnel</label>
                                <input wire:model="proMail" class="form-control mb-2" type="email">
                                @error('proMail') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label>Numéro professionnel</label>
                                <input wire:model="proPhone" class="form-control mb-2" type="text">
                                @error('proPhone') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label>Numéro de compte bancaire</label>
                                <input wire:model="acountNumber" class="form-control mb-2" type="text">
                                @error('acountNumber') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <label>Numéro CNSS</label>
                                <input wire:model="cnssNumber" class="form-control mb-2" type="text">
                                @error('cnssNumber') 
                                    <span style="color: rgb(252, 0, 0)" class="flex">
                                        Ce champ est réquis
                                    </span> 
                                @enderror
                            </div>
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

                        @if($step < 4)
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