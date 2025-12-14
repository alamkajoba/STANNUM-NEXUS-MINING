<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Module\HomePage\HomePage;
use Illuminate\Http\Request;
use App\Livewire\Module\Employee\EmployeeIndex;
use App\Livewire\Module\Employee\EmployeeCreate;
use App\Livewire\Module\Employee\EmployeeUpdate;
use App\Livewire\Module\Category\CategoryIndex;
use App\Livewire\Module\Category\CategoryCreate;
use App\Livewire\Module\Category\CategoryUpdate;
use App\Livewire\Module\Deduction\DeductionIndex;
use App\Livewire\Module\Deduction\DeductionCreate;
use App\Livewire\Module\Deduction\DeductionUpdate;
use App\Livewire\Module\Payment\PaymentIndex;
use App\Livewire\Module\Payment\PaymentCreate;
use App\Livewire\Module\Payment\PaymentUpdate;
use App\Livewire\Module\Payment\PaySlipPrint;
use App\Livewire\Module\Advance\AdvanceIndex;
use App\Livewire\Module\Advance\AdvanceCreate;

Route::get('/', function () {
    return redirect()->route('login');
});

#Home routes
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('dashboard', HomePage::class)->name('dashboard');
});

#Employee routes
Route::middleware('auth')->prefix('employee')->name('employee.')->group(function () {
    Route::get('index', EmployeeIndex::class)->name('index');
    Route::get('create', EmployeeCreate::class)->name('create');
    Route::get('update/{id}', EmployeeUpdate::class)->name('update');
});

#Category routes
Route::middleware('auth')->prefix('category')->name('category.')->group(function () {
    Route::get('index', CategoryIndex::class)->name('index');
    Route::get('create', CategoryCreate::class)->name('create');
    Route::get('update/{id}', CategoryUpdate::class)->name('update');
});

#advance routes
Route::middleware('auth')->prefix('advance')->name('advance.')->group(function () {
    Route::get('index', AdvanceIndex::class)->name('index');
    Route::get('create', AdvanceCreate::class)->name('create');
});


#Payment routes
Route::middleware('auth')->prefix('payment')->name('payment.')->group(function () {
    Route::get('index', PaymentIndex::class)->name('index');
    Route::get('create', PaymentCreate::class)->name('create');
    Route::get('update/{id}', PaymentUpdate::class)->name('update');
    Route::get('print/{id}', PaySlipPrint::class)->name('print');
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
