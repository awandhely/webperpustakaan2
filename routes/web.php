<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// ================= ADMIN CONTROLLERS =================
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BorrowingController as AdminBorrowingController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;

// ================= USER CONTROLLER =================
use App\Http\Controllers\User\BorrowingController as UserBorrowingController;
use App\Http\Controllers\User\BookCollectionController;

// ================= PETUGAS CONTROLLERS =================
use App\Http\Controllers\Petugas\ReportController as PetugasReportController;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $role = auth()->user()->role;

    if ($role === 'admin') {
        return redirect('/admin');
    }

    if ($role === 'petugas') {
        return redirect('/petugas');
    }

    return redirect('/user');

})->middleware('auth')->name('dashboard');



/*
|--------------------------------------------------------------------------
| Profile (semua role)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Login Admin & Petugas
|--------------------------------------------------------------------------
*/
Route::get('/login-staff', function () {
    return view('auth.login-staff');
})->name('login.staff');

Route::post('/login-staff', [AuthenticatedSessionController::class, 'storeStaff']);

Route::get('/test-borrowings', function () {
    return view('admin.borrowings.index');
});


/*
|--------------------------------------------------------------------------
| ================= ADMIN AREA =================
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard Admin
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Management User
    Route::get('users/export', [UserManagementController::class, 'export'])->name('users.export');
    Route::resource('users', UserManagementController::class);

    // Management Buku
    Route::resource('books', BookController::class);

    // Management Kategori Buku
    Route::resource('categories', CategoryController::class);

    /*
    |--------------------------------------------------------------------------
    | Peminjaman Buku (ADMIN)
    |--------------------------------------------------------------------------
    */
    Route::get('borrowings', [AdminBorrowingController::class, 'index'])
        ->name('borrowings.index');

    Route::patch(
        'borrowings/{borrowing}/confirm',
        [AdminBorrowingController::class, 'confirm']
    )->name('borrowings.confirm');

    Route::patch(
        'borrowings/{borrowing}/reject',
        [AdminBorrowingController::class, 'reject']
    )->name('borrowings.reject');

    Route::patch(
        'borrowings/{borrowing}/return',
        [AdminBorrowingController::class, 'returnBook']
    )->name('borrowings.return');

    // Riwayat Ulasan (Ratings)
    Route::get('ratings', [\App\Http\Controllers\Admin\BookRatingController::class, 'index'])
        ->name('ratings.index');
    Route::delete('ratings/{rating}', [\App\Http\Controllers\Admin\BookRatingController::class, 'destroy'])
        ->name('ratings.destroy');

    // Laporan (ADMIN)
    Route::get('reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export', [AdminReportController::class, 'export'])->name('reports.export');
});

/*
|--------------------------------------------------------------------------
| ================= PETUGAS AREA =================
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {
        
    Route::get('/', function () {
        return view('petugas.dashboard');
    })->name('dashboard');

    // Management User (Anggota)
    Route::get('users/export', [\App\Http\Controllers\Petugas\UserManagementController::class, 'export'])->name('users.export');
    Route::resource('users', \App\Http\Controllers\Petugas\UserManagementController::class);

    // Management Buku
    Route::resource('books', \App\Http\Controllers\Petugas\BookController::class);

    // Management Kategori
    Route::resource('categories', \App\Http\Controllers\Petugas\CategoryController::class);

    // Peminjaman Buku
    Route::get('borrowings', [\App\Http\Controllers\Petugas\BorrowingController::class, 'index'])
        ->name('borrowings.index');

    Route::patch('borrowings/{borrowing}/confirm', [\App\Http\Controllers\Petugas\BorrowingController::class, 'confirm'])
        ->name('borrowings.confirm');

    Route::patch('borrowings/{borrowing}/reject', [\App\Http\Controllers\Petugas\BorrowingController::class, 'reject'])
        ->name('borrowings.reject');

    Route::patch('borrowings/{borrowing}/return', [\App\Http\Controllers\Petugas\BorrowingController::class, 'returnBook'])
        ->name('borrowings.return');

    // Laporan (PETUGAS)
    Route::get('reports', [PetugasReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export', [PetugasReportController::class, 'export'])->name('reports.export');
});

/*
|--------------------------------------------------------------------------
| ================= USER AREA =================
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        // ✅ ROOT /user → redirect ke dashboard
        Route::get('/', function () {
            return redirect()->route('user.dashboard');
        });

        // ✅ DASHBOARD USER
        Route::get('dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');

        // daftar buku
        Route::get('books', [UserBorrowingController::class, 'index'])
            ->name('books.index');

        // detail buku
        Route::get('books/{book}', [UserBorrowingController::class, 'show'])
            ->name('books.show');

        // 🔥 FORM PEMINJAMAN (INI YANG HILANG)
        Route::get('books/{book}/borrow', [UserBorrowingController::class, 'create'])
            ->name('books.borrow.form');

        // simpan peminjaman
        Route::post('books/{book}/borrow', [UserBorrowingController::class, 'store'])
            ->name('books.borrow');

        // history peminjaman
        Route::get('borrowings/history', [UserBorrowingController::class, 'history'])
            ->name('borrowings.history');

        // download bukti peminjaman
        Route::get('borrowings/{borrowing}/download', [UserBorrowingController::class, 'downloadReceipt'])
            ->name('borrowings.download');

        // rating buku
        Route::post('books/{book}/rate', [\App\Http\Controllers\User\BookRatingController::class, 'store'])
            ->name('books.rate');

        // koleksi buku
        Route::get('collection', [BookCollectionController::class, 'index'])
            ->name('collection.index');
            
        Route::post('books/{book}/collection', [BookCollectionController::class, 'toggle'])
            ->name('books.collection.toggle');
            
});


/*
|--------------------------------------------------------------------------
| Auth Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
