<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Historique de l'avance</h1>
        <a href="{{ route('advance.index') }}" class="btn btn-secondary">Retour</a>
    </div>

    <div class="card p-3">
        <h5>Détails de l'avance</h5>
        <p>Agent: <strong>{{ $advance->employee->middleName }} {{ $advance->employee->lastName }} {{ $advance->employee->firstName }}</strong></p>
        <p>Matricule: <strong>{{ $advance->employee->matricule }}</strong></p>
        <p>Montant initial: <strong>USD {{ number_format($advance->amount,2) }}</strong></p>
        <p>Reste à rembourser: <strong>USD {{ number_format($advance->toRefund,2) }}</strong></p>
    </div>

    <div class="card p-3 mt-3">
        <h5>Historique des remboursements</h5>
        @if($advanceRepayments->isEmpty())
            <div class="alert alert-info">Aucun remboursement enregistré.</div>
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
                    @foreach($advanceRepayments as $rep)
                        <tr>
                            <td>{{ $rep->paid_at?->format('Y-m-d') }}</td>
                            <td class="text-end">USD {{ number_format($rep->amount,2) }}</td>
                            <td>{{ optional($rep->payment)->motif ?? '—' }}</td>
                            <td>{{ optional($rep->user)->name ?? '—' }}</td>
                        </tr>
                    @endforeach
                    <tr class="fw-bold">
                        <td>Total remboursé</td>
                        <td class="text-end">USD {{ number_format($totalRepaid,2) }}</td>
                        <td colspan="2">Reste à rembourser: USD {{ number_format($remainingAdvance,2) }}</td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>
</div>
