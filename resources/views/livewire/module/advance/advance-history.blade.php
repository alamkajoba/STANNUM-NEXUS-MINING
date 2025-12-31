<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Historique des Remboursements d'Avance</h1>
        <a href="{{ route('advance.index') }}" class="btn btn-secondary">Retour</a>
    </div>

    @if(empty($byAgent))
        <div class="alert alert-info">Aucune avance enregistrée.</div>
    @else
        <div class="mb-3">
            <input type="text" wire:model.debounce.500ms="search" class="form-control" placeholder="Rechercher un agent par nom ou matricule">
        </div>
        <div class="card">
            <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" >
                    <thead style="background-color: rgb(46, 13, 167);" class="text-white">
                    <tr>
                        <th>Agent</th>
                        <th class="text-end">Montant avancé</th>
                        <th class="text-end">Remboursé</th>
                        <th class="text-end">Reste</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($byAgent as $item)
                        <tr>
                            <td>
                                <strong>{{ $item['employee']->middleName }} {{ $item['employee']->lastName }} {{ $item['employee']->firstName }}</strong>
                          
                            </td>
                            <td class="text-end">USD {{ number_format($item['totalAdvanceAmount'],2) }}</td>
                            <td class="text-end">USD {{ number_format($item['totalRepaid'],2) }}</td>
                            <td class="text-end">USD {{ number_format($item['remaining'],2) }}</td>
                            <td class="text-center">
                                <a href="{{ route('advance.employee', $item['employee']->id) }}" class="btn btn-sm btn-primary">
                                    Voir détails
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    @endif
</div>
