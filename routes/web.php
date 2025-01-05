<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ECController;
use App\Http\Controllers\UEController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\NoteController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('ues', UEController::class);
Route::resource('ecs', ECController::class);
Route::resource('notes', NoteController::class);
Route::resource('etudiants', EtudiantController::class);

Route::get('notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
Route::post('notes', [NoteController::class, 'store'])->name('notes.store');
Route::get('/notes/moyenne/{etudiantId}', [NoteController::class, 'calculerMoyenne'])->name('notes.moyenne');
