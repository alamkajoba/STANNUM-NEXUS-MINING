<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Détails des avances de :  {{ $employee->middleName }} {{ $employee->lastName }} {{ $employee->firstName }}</h1>
        <a href="{{ route('advance.history') }}" class="btn btn-secondary">Retour</a>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card p-3">
                <h5>Informations Agent</h5>
                <p><strong>Matricule:</strong> {{ $employee->matricule }}</p>
                <p><strong>Catégorie:</strong> {{ $employee->category->nameCategory ?? '—' }}</p>
                <p><strong>Fonction:</strong> {{ $employee->jobTitle ?? '—' }}</p>
                <p><strong>Affectation:</strong> {{ $employee->affectation ?? '—' }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <h5>Résumé Avances</h5>
                <p><strong>Total avancé:</strong> USD {{ number_format($totalAdvanced,2) }}</p>
                <p><strong>Total remboursé:</strong> USD {{ number_format($totalRepaid,2) }}</p>
                <p><strong>Reste à rembourser:</strong> USD {{ number_format($totalRemaining,2) }}</p>
                <p><strong>Taux remboursement:</strong> {{ $totalAdvanced > 0 ? number_format(($totalRepaid / $totalAdvanced) * 100, 1) : 0 }}%</p>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h6 class="mb-0">Avances consenties</h6>
        </div>
        <div class="card-body">
            @if($advances->isEmpty())
                <p class="text-muted">Aucune avance enregistrée pour cet agent.</p>
            @else
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Reste</th>
                            <th>Taux</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($advances as $adv)
                            <tr>
                                <td>{{ $adv->created_at->format('Y-m-d') }}</td>
                                <td class="text-end">USD {{ number_format($adv->amount,2) }}</td>
                                <td class="text-end">USD {{ number_format($adv->toRefund,2) }}</td>
                                <td>{{ $adv->amount > 0 ? number_format((($adv->amount - $adv->toRefund) / $adv->amount) * 100, 1) : 0 }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-success text-white">
            <h6 class="mb-0">Historique des remboursements</h6>
        </div>
        <div class="card-body">
            @if($repayments->isEmpty())
                <p class="text-muted">Aucun remboursement enregistré pour cet agent.</p>
            @else
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Paiement</th>
                            <th>Enregistré par</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($repayments as $rep)
                            <tr>
                                <td>{{ $rep->paid_at?->format('Y-m-d') }}</td>
                                <td class="text-end">USD {{ number_format($rep->amount,2) }}</td>
                                <td>{{ optional($rep->payment)->motif ?? '—' }}</td>
                                <td>{{ optional($rep->user)->name ?? '—' }}</td>
                            </tr>
                        @endforeach
                        <tr class="fw-bold">
                            <td>Total</td>
                            <td class="text-end">USD {{ number_format($totalRepaid,2) }}</td>
                            <td colspan="2"></td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
