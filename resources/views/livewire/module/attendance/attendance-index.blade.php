<div class="mb-5">

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
        <div id="alert-danger" 
            class="alert alert-danger fade show text-center shadow-lg"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            {{ session('danger') }}
        </div>
    @endif

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i style="color:rgb(0, 0, 0);" class="fas fa-fw fa-calendar-check"></i>
            Saisie présences / absences
        </h1>
        <a href="{{ route('attendance.index') }}" class="btn btn-primary">Actualiser</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <button wire:click.prevent="previousWeek" class="btn btn-light btn-sm">&laquo; Semaine précédente</button>
                    <button wire:click.prevent="nextWeek" class="btn btn-light btn-sm ms-2">Semaine suivante &raquo;</button>
                </div>
                <h5 class="mb-0">Pointage hebdomadaire</h5>
                <div>
                    <small class="text-muted">Semaine du {{ \Carbon\Carbon::parse($weekDates[0] ?? now())->translatedFormat('d F Y') }} au {{ \Carbon\Carbon::parse($weekDates[6] ?? now())->translatedFormat('d F Y') }}</small>
                    <a target="_blank" href="{{ route('attendance.pdf', ['weekStart' => $weekDates[0] ?? now()->format('Y-m-d')]) }}" class="btn btn-outline-secondary btn-sm ms-3">Générer PDF</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Agent</th>
                            @foreach($weekDates as $wd)
                                <th class="text-center">{{ \Carbon\Carbon::parse($wd)->translatedFormat('D d') }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $emp)
                            <tr>
                                <td style="white-space:nowrap">{{ $emp['full_name'] }}</td>
                                @foreach($weekDates as $wd)
                                    @php
                                        $current = $attendanceSelections[$emp['id']][$wd] ?? ($attendancesMap[$emp['id']][$wd] ?? null);
                                        $locked = ! empty($lockedRows[$emp['id']]);
                                    @endphp
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button @if($locked) disabled @endif wire:click.prevent="markAttendance({{ $emp['id'] }}, '{{ $wd }}', 'present')" class="btn {{ $current === 'present' ? 'btn-success' : 'btn-outline-success' }}">P</button>
                                            <button @if($locked) disabled @endif wire:click.prevent="markAttendance({{ $emp['id'] }}, '{{ $wd }}', 'absent')" class="btn {{ $current === 'absent' ? 'btn-danger' : 'btn-outline-danger' }}">A</button>
                                            <button @if($locked) disabled @endif wire:click.prevent="markAttendance({{ $emp['id'] }}, '{{ $wd }}', 'justified')" class="btn {{ $current === 'justified' ? 'btn-warning' : 'btn-outline-warning' }}">J</button>
                                        </div>
                                    </td>
                                @endforeach
                                <td style="white-space:nowrap">
                                    <button @if(! empty($lockedRows[$emp['id']])) disabled @endif wire:click.prevent="saveRow({{ $emp['id'] }})" class="btn btn-primary btn-sm">Enregistrer</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" style="background-color: rgb(30, 18, 72); color: white;">
            Dernières saisies de présence/absence
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background-color: rgb(97, 97, 156);" class="text-white">
                        <tr>
                            <th>Date</th>
                            <th>Agent</th>
                            <th>Statut</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->date?->format('d/m/Y') }}</td>
                                <td>{{ $attendance->employee?->middleName }} {{ $attendance->employee?->lastName }} {{ $attendance->employee?->firstName }}</td>
                                <td>{{ ucfirst($attendance->status) }}</td>
                                <td>{{ $attendance->notes }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-danger">Aucune saisie disponible.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $attendances->links() }}
            </div>
        </div>
    </div>
</div>
