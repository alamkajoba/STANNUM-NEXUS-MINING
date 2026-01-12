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
            <i style="color:rgb(0, 0, 0);" class="fas fa-fw fa-cogs"></i>
            Déductions salariales
        </h1>
        <div class="d-none d-sm-inline-block shadow-sm">
            {{-- <input wire:model.live="search" class="form-control" type="text" placeholder="Rechercher..."> --}}
        </div>
    </div>

    <!-- Table -->
    <div class="card-body">
        <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" >
                    <thead style="background-color: rgb(46, 13, 167);" class="text-white">
                        <tr>
                            <th>CNSS</th>
                            <th>INPP</th>
                            <th>ONEM</th>
                            <th>IPR</th>
                            <th>Rétenue sur salaire</th>
                            <th>Taux remboursement Avance sur salaire</th>
                            <th colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody >
                        @forelse ($deduction as $deductions)
                            <tr >
                                <td>{{ $deductions->CNSS }} %</td>
                                <td>{{ $deductions->INPP }} %</td>
                                <td>{{ $deductions->ONEM }} %</td>
                                <td>{{ $deductions->IPR }} %</td>
                                <td>{{ $deductions->deductionSalary }} %</td>
                                <td>{{ $deductions->refundAdvanceAmount}} %</td>
                                <td>
                                    <a href="{{ route('deduction.update', $deductions->id) }}" class="btn text-white" style="background-color: rgb(158, 155, 155)">
                                        Modifier
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-danger">Oups! Aucune Déduction trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $deduction->links() }}
            </div>
    </div>
</div>



