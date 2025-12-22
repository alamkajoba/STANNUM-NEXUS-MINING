<div class="card shadow-sm">
    <div style="background-color: rgb(46, 13, 167);" class="card-header text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Dossier Agent : {{$fullName}}</h5>
        <span style="color: rgb(46, 13, 167);" class="badge bg-light">MATRICULE: {{$matricule}}</span>
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
                <button class="nav-link" id="avantages-tab" data-bs-toggle="tab" data-bs-target="#avantages">Categorie et Avantages</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="autres-tab" data-bs-toggle="tab" data-bs-target="#autres">Autres infos</button>
            </li>
        </ul>

        <div class="tab-content pt-4" id="agentTabContent">
            
            <div class="tab-pane fade show active" id="poste">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Intitulé du poste :</strong> Analyste Développeur</p>
                        <p><strong>Département :</strong> Informatique</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Date d'entrée :</strong> 12/05/2022</p>
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
                        <tr>
                            <td>Conjoint(e)</td>
                            <td>Marie Dupont</td>
                            <td>15/03/1988</td>
                        </tr>
                        <tr>
                            <td>Enfant</td>
                            <td>Lucas Dupont</td>
                            <td>20/10/2015</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="avantages">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Véhicule de fonction
                        <span class="badge bg-success rounded-pill">Actif</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Ticket Restaurant (9€)
                        <span class="badge bg-success rounded-pill">Actif</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Prime de fin d'année
                        <span class="badge bg-secondary rounded-pill">Annuel</span>
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
        <button class="btn btn-outline-secondary btn-sm">Modifier le dossier</button>
    </div>
</div>
