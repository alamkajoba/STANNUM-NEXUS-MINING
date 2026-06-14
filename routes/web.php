<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Module\HomePage\HomePage;
use Illuminate\Http\Request;
use App\Livewire\Module\Employee\EmployeeIndex;
use App\Livewire\Module\Employee\EmployeeCreate;
use App\Livewire\Module\Employee\EmployeeUpdate;
use App\Livewire\Module\Deduction\DeductionIndex;
use App\Livewire\Module\Deduction\DeductionCreate;
use App\Livewire\Module\Deduction\DeductionUpdate;
use App\Livewire\Module\Payment\PaymentIndex;
use App\Livewire\Module\Payment\PaymentCreate;
use App\Livewire\Module\Payment\PaymentUpdate;
use App\Livewire\Module\Payment\PaySlipPrint;
use App\Livewire\Module\Advance\AdvanceIndex;
use App\Livewire\Module\Advance\AdvanceCreate;
use App\Livewire\Module\Family\FamilyIndex;
use App\Livewire\Module\Family\FamilyCreate;
use App\Livewire\Module\Family\FamilyUpdate;
use App\Livewire\Module\User\UserIndex;
use App\Livewire\Module\User\UserCreate;
use App\Livewire\Module\User\UserUpdate;
use App\Livewire\Module\User\AssignPermission;
use App\Livewire\Module\User\SetPassword;
use App\Livewire\Module\Notify\PayNotify;
use App\Livewire\Module\Notify\NoteNotify;
use App\Livewire\Module\Advance\AdvanceShow;
use App\Livewire\Module\Advance\AdvanceHistory;
use App\Livewire\Module\Advance\EmployeeAdvanceDetail;
use App\Livewire\Module\Attendance\AttendanceIndex;
use App\Http\Controllers\AttendancePdfController;
use App\Livewire\Module\FunctionType\FunctionTypeIndex;
use App\Livewire\Module\FunctionType\FunctionTypeCreate;
use App\Livewire\Module\FunctionType\FunctionTypeUpdate;
use App\Livewire\Module\Employee\IdCardPrint;


Route::get('/', function () {
    return redirect()->route('login');
});

#Home routes
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('dashboard', HomePage::class)->name('dashboard');
});

#Users routes
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('index', UserIndex::class)->name('index');
    Route::get('create', UserCreate::class)->name('create');
    Route::get('update/{id}', UserUpdate::class)->name('update');
    Route::get('set', SetPassword::class)->name('set');
});

#Permissions routes
Route::middleware('auth')->prefix('permission')->name('permission.')->group(function () {
    Route::get('assign/{id}', AssignPermission::class)->name('assign');
});

#Employee routes
Route::middleware('auth')->prefix('employee')->name('employee.')->group(function () {
    Route::get('index', EmployeeIndex::class)->name('index');
    Route::get('create', EmployeeCreate::class)->name('create');
    Route::get('update/{id}', EmployeeUpdate::class)->name('update');
    Route::get('printCard/{id}', IdCardPrint::class)->name('printCard');
});

#function routes
Route::middleware('auth')->prefix('function')->name('function.')->group(function () {
    Route::get('index', FunctionTypeIndex::class)->name('index');
    Route::get('create', FunctionTypeCreate::class)->name('create');
    Route::get('update/{functionType}', FunctionTypeUpdate::class)->name('update');
});

#FamilyState routes
Route::middleware('auth')->prefix('family')->name('family.')->group(function () {
    Route::get('index/{id}', FamilyIndex::class)->name('index');
    Route::get('create', FamilyCreate::class)->name('create');
    Route::get('update/{id}', FamilyUpdate::class)->name('update');
});

#advance routes
Route::middleware('auth')->prefix('advance')->name('advance.')->group(function () {
    Route::get('index', AdvanceIndex::class)->name('index');
    Route::get('create', AdvanceCreate::class)->name('create');
    Route::get('show/{id}', AdvanceShow::class)->name('show');
    Route::get('history', AdvanceHistory::class)->name('history');
    Route::get('employee/{employeeId}', EmployeeAdvanceDetail::class)->name('employee');
});


#Payment routes
Route::middleware('auth')->prefix('payment')->name('payment.')->group(function () {
    Route::get('index', PaymentIndex::class)->name('index');
    Route::get('create', PaymentCreate::class)->name('create');
    Route::get('update/{id}', PaymentUpdate::class)->name('update');
    Route::get('print/{id}', PaySlipPrint::class)->name('print');
});

#Attendance routes
Route::middleware('auth')->prefix('attendance')->name('attendance.')->group(function () {
    Route::get('index', AttendanceIndex::class)->name('index');
    Route::get('pdf', [AttendancePdfController::class, 'generate'])->name('pdf');
});

#Notify routes
Route::middleware('auth')->prefix('notify')->name('notify.')->group(function () {
    Route::get('payNotify', PayNotify::class)->name('payNotify');
    Route::get('noteNotify', NoteNotify::class)->name('noteNotify');
});


#Deduction routes
Route::middleware('auth')->prefix('deduction')->name('deduction.')->group(function () {
    Route::get('index', DeductionIndex::class)->name('index');
    Route::get('create', DeductionCreate::class)->name('create');
    Route::get('update/{id}', DeductionUpdate::class)->name('update');
});

#Logout route
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

require __DIR__.'/auth.php';
