<?php

namespace App\Livewire\Module\Attendance;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

#[Layout('layouts.app')]
class AttendanceIndex extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    public ?string $search = '';
    public array $itemsEmployee = [];
    public array $selectedEmployee = [null];
    public ?int $employeeId = null;
    public $date;
    public array $employees = [];
    public array $attendanceSelections = [];
    public Carbon $weekStart;
    public array $weekDates = [];
    public array $attendancesMap = [];
    public array $lockedRows = [];

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
        $this->weekStart = Carbon::now()->startOfWeek();
        $this->loadWeekDates();

        $this->employees = Employee::orderBy('lastName')
            ->get()
            ->map(function ($e) {
                return [
                    'id' => $e->id,
                    'full_name' => trim($e->middleName.' '.$e->lastName.' '.$e->firstName),
                ];
            })->toArray();

        foreach ($this->employees as $emp) {
            $this->attendanceSelections[$emp['id']] = [];
        }

        $this->loadAttendancesMap();

      
        foreach ($this->employees as $emp) {
            foreach ($this->weekDates as $wd) {
                $this->attendanceSelections[$emp['id']][$wd] = $this->attendancesMap[$emp['id']][$wd] ?? null;
            }
        }
    }

    protected function loadWeekDates(): void
    {
        $this->weekDates = [];
        for ($i = 0; $i < 7; $i++) {
            $d = $this->weekStart->copy()->addDays($i);
            $this->weekDates[] = $d->format('Y-m-d');
        }
    }

    protected function loadAttendancesMap(): void
    {
        $this->attendancesMap = [];
        $employeeIds = array_column($this->employees, 'id');
        if (empty($employeeIds)) {
            return;
        }

        $start = $this->weekStart->copy()->startOfDay()->toDateString();
        $end = $this->weekStart->copy()->addDays(6)->endOfDay()->toDateString();

        $rows = Attendance::whereIn('employee_id', $employeeIds)
            ->whereBetween('date', [$start, $end])
            ->get();

        foreach ($rows as $r) {
            $d = Carbon::parse($r->date)->format('Y-m-d');
            $this->attendancesMap[$r->employee_id][$d] = $r->status;
        }

        // Determine locked rows: if any attendance exists for the week for an employee, consider the week locked
        $this->lockedRows = [];
        foreach ($this->employees as $emp) {
            $locked = false;
            foreach ($this->weekDates as $wd) {
                if (! empty($this->attendancesMap[$emp['id']][$wd] ?? null)) {
                    $locked = true;
                    break;
                }
            }
            if ($locked) {
                $this->lockedRows[$emp['id']] = true;
            }
        }
    }

  

    public function previousWeek(): void
    {
        $this->weekStart = $this->weekStart->copy()->subWeek();
        $this->loadWeekDates();
        $this->loadAttendancesMap();
    }

    public function nextWeek(): void
    {
        $this->weekStart = $this->weekStart->copy()->addWeek();
        $this->loadWeekDates();
        $this->loadAttendancesMap();
    }

   
    public function markAttendance(int $employeeId, string $date, string $status): void
    {
        if (! in_array($status, ['present', 'absent', 'justified'])) {
            return;
        }

        if (! isset($this->attendanceSelections[$employeeId])) {
            $this->attendanceSelections[$employeeId] = [];
        }

        $this->attendanceSelections[$employeeId][$date] = $status;
    }

   
    public function saveRow(int $employeeId): void
    {
        if (! isset($this->attendanceSelections[$employeeId])) {
            return;
        }

       
        if (! empty($this->lockedRows[$employeeId])) {
            session()->flash('danger', 'La semaine est verrouillée et ne peut plus être modifiée.');
            return;
        }

        $saved = 0;

        foreach ($this->attendanceSelections[$employeeId] as $date => $status) {
            if (! in_array($status, ['present', 'absent', 'justified'])) {
                continue;
            }

            $attendance = Attendance::where('employee_id', $employeeId)
                ->whereDate('date', $date)
                ->first();

            if ($attendance) {
                $attendance->update(['status' => $status, 'user_id' => auth()->id()]);
            } else {
                Attendance::create([
                    'employee_id' => $employeeId,
                    'user_id' => auth()->id(),
                    'date' => $date,
                    'status' => $status,
                    'notes' => null,
                ]);
            }

            $this->attendancesMap[$employeeId][$date] = $status;
            $saved++;
        }
        // Lock the row after saving the week's entries
        if ($saved > 0) {
            $this->lockedRows[$employeeId] = true;
        }

        session()->flash('success', sprintf('%d présence(s) enregistrée(s) pour l\'agent.', $saved));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function searchEmployee(): void
    {
        $this->itemsEmployee = [];

        if (trim($this->search) === '') {
            return;
        }

        $query = Employee::query();

        $query->where(function ($query) {
            $query->where('firstName', 'like', '%'.$this->search.'%')
                ->orWhere('middleName', 'like', '%'.$this->search.'%')
                ->orWhere('lastName', 'like', '%'.$this->search.'%');
        });

        $this->itemsEmployee = $query->limit(10)->get()->map(function ($employee) {
            return [
                'id' => $employee->id,
                'full_name' => trim($employee->middleName.' '.$employee->lastName.' '.$employee->firstName),
            ];
        })->toArray();
    }

    public function selectEmployee(int $itemId): void
    {
        $employee = Employee::find($itemId);

        if (! $employee) {
            return;
        }

        $this->selectedEmployee = [
            'id' => $employee->id,
            'full_name' => trim($employee->middleName.' '.$employee->lastName.' '.$employee->firstName),
        ];
        $this->employeeId = $employee->id;
        $this->itemsEmployee = [];
        $this->search = $this->selectedEmployee['full_name'];
    }

    public function saveAttendance(): void
    {
        $this->validate([
            'employeeId' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,justified',
            'notes' => 'nullable|string|max:255',
        ]);

        $exists = Attendance::where('employee_id', $this->employeeId)
            ->whereDate('date', $this->date)
            ->exists();

        if ($exists) {
            session()->flash('danger', 'La présence/absence de cet agent est déjà enregistrée pour cette date.');
            return;
        }

        Attendance::create([
            'employee_id' => $this->employeeId,
            'user_id' => auth()->id(),
            'date' => $this->date,
            'status' => $this->status,
            'notes' => $this->notes,
        ]);

        session()->flash('success', 'Présence/absence enregistrée avec succès.');
        $this->reset(['search', 'itemsEmployee', 'selectedEmployee', 'employeeId', 'date', 'status', 'notes']);
        $this->date = now()->format('Y-m-d');
    }

    public function render()
    {
       
        $attendances = Attendance::with('employee')
            ->orderBy('date')
            ->paginate(10);

        return view('livewire.module.attendance.attendance-index', [
            'attendances' => $attendances,
            'weekDates' => $this->weekDates,
            'attendancesMap' => $this->attendancesMap,
        ]);
    }
}
