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

Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
Route::get('etudiants/{id}', [EtudiantController::class, 'show'])->name('etudiants.show');


Route::get('/etudiants/{id}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
// web.php
Route::resource('etudiants', EtudiantController::class);
Route::get('notes/{id}', [NoteController::class, 'show'])->name('notes.show');
Route::get('/notes/results', [NoteController::class, 'calculerMoyenne'])->name('notes.results');
Route::get('/notes/details/{id}', [NoteController::class, 'details'])->name('notes.details');

Route::resource('notes', NoteController::class)->except(['results']);
// Route pour afficher les détails d'une note
Route::get('notes/{id}', [NoteController::class, 'show'])->name('notes.show');
Route::get('/notes/moyenne/{etudiantId}', [NoteController::class, 'calculerMoyenne'])->name('notes.moyenne');
