<div class="card shadow-sm">
    <div style="background-color: rgb(46, 13, 167);" class="card-header text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Dossier Agent : {{$employee->middleName}}_{{$employee->lastName}}_{{$employee->firstName}}</h5>
        <span class="badge bg-light">
            <a href="{{route('employee.index')}}" class="btn text-white" style="background-color: rgb(112, 147, 163)">
                Retour
            </a>
        </span>
    </div>
    
    <div class="card-body">
        <ul class="nav nav-tabs" id="agentTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="poste-tab" data-bs-toggle="tab" data-bs-target="#poste">Poste & Carrière</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="famille-tab" data-bs-toggle="tab" data-bs-target="#famille">Famille</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="avantages-tab" data-bs-toggle="tab" data-bs-target="#avantages">Salaire et Avantages</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="autres-tab" data-bs-toggle="tab" data-bs-target="#autres">Autres infos</button>
            </li>
        </ul>

        <div class="tab-content pt-4" id="agentTabContent">
            
            <div class="tab-pane fade show active" id="poste">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Intitulé du poste :</strong> {{$employee->jobTitle}}</p>
                        <p><strong>Département :</strong> {{$employee->category->nameCategory}}</p>
                        <p><strong>Matricule :</strong> {{$employee->matricule}}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Date d'entrée :</strong> {{$employee->created_at->format('d/m/Y')}}</p>
                        <p><strong>Type de contrat :</strong> CDI</p>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="famille">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Membre</th>
                            <th>Nom & Prénom</th>
                            <th>Date de Naissance</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- SECTION CONJOINT --}}
                        @php 
                            $conjoint = $employee->familyState->firstWhere('relationType', \App\Enums\RelationTypeEnum::CONJOINT); 
                        @endphp
                        <tr>
                            <td><strong>{{ \App\Enums\RelationTypeEnum::CONJOINT->value }}</strong></td>
                            @if($conjoint)
                                <td>{{ $conjoint->middleName }} {{ $conjoint->firstName }}</td>
                                <td>{{ $conjoint->birthDate->format('d/m/Y') }}</td>
                            @else
                                <td colspan="2" class="text-muted">Aucun(e) conjoint(e) enregistré(e)</td>
                            @endif
                        </tr>

                        {{-- SECTION ENFANTS --}}
                        @php 
                            $enfants = $employee->familyState->where('relationType', \App\Enums\RelationTypeEnum::CHILD); 
                        @endphp
                        
                        @if($enfants->count() > 0)
                            @foreach($enfants as $enfant)
                                <tr>
                                    <td>{{ \App\Enums\RelationTypeEnum::CHILD->value }}</td>
                                    <td>{{ $enfant->firstName }} {{ $enfant->lastName }}</td>
                                    <td>{{ $enfant->birthDate->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>{{ \App\Enums\RelationTypeEnum::CHILD->value }}</td>
                                <td colspan="2" class="text-muted">Aucun enfant enregistré</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="avantages">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Salaire brut
                        <span>USD {{$employee->category->amount}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Allocation familliale par enfant
                        <span>USD {{$employee->category->familialAllocation}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Véhicule de fonction
                        <span class="badge bg-success rounded-pill">Actif</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Logement
                        <span>USD {{$employee->category->housing}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Transport
                        <span>USD {{$employee->category->transportationCost}}</span>
                    </li>
                </ul>
            </div>

            <div class="tab-pane fade" id="autres">
                <h6>Notes internes</h6>
                <div class="alert alert-light border">
                    Here will be a note
                </div>
            </div>
            
        </div>
    </div>
    <div class="card-footer text-end">
        {{-- <button class="btn btn-outline-secondary btn-sm">Modifier le dossier</button> --}}
    </div>
</div>
