<div class="mb-5">

    <!-- Notification flash -->

    @if (session()->has('success'))
        <div id="alert-success" 
            class="alert alert-success fade show text-center shadow-lg"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('danger'))
        <div id="alert-success" 
            class="alert alert-danger fade show text-center shadow-lg"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            {{ session('danger') }}
        </div>
    @endif

    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i style="color:rgb(0, 0, 0);" class="fas fa-fw fa-users"></i>
            Liste des souscriptions avance
        </h1>
        <div class="d-none d-sm-inline-block shadow-sm">
            <input wire:model.live="search" class="form-control" type="text" placeholder="Rechercher...">
        </div>
    </div>

    <!-- Table -->
    <div class="card-body">
        <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" >
                    <thead style="background-color: rgb(46, 13, 167);" class="text-white">
                        <tr>
                            <th>n</th>
                            <th>Agent</th>
                            <th>Matricule</th>
                            <th>Montant total</th>
                            <th>Montant restant</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody >
                        @forelse ($advance as $advances)
                            <tr >
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $advances->employee->middleName }} {{ $advances->employee->lastName }} {{ $advances->employee->firstName }}</td>
                                <td>{{ $advances->employee->matricule }}</td>
                                <td>{{ $advances->amount }} $</td>
                                <td>{{ $advances->toRefund }} $</td>
                                <td>
                                    <div>
                                        {{-- <a href="#" class="btn text-white" style="background-color: rgb(97, 97, 156)">
                                            <i style="color:rgb(255, 255, 255);" class="fas fa-fw fa-print"></i>
                                            Imprimer
                                        </a> --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-danger">Oups! Aucun(e) abonné(e) trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $advance->links() }}
            </div>

        <!-- Modal delete student -->
        <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModal" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0">
                    <div style="background-color: rgb(46, 13, 167);" class="modal-header text-white rounded-0">
                        <h5 class="modal-title" id="deleteStudentModal">Confirmer l'action</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulaire de connexion -->
                        <form wire:submit.prevent="destroyStudent">
                            <div class="mb-3">
                                <label for="username" class="form-label">Identifiant</label>
                                <input type="text" class="form-control" wire:model.defer="user" required autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" wire:model.defer="password" required autocomplete="off">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button 
                            wire:click="destroyStudent" 
                            style="background-color: rgb(97, 97, 156)" 
                            class="btn text-white"
                        >
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ModalEnd -->
    </div>
</div>



