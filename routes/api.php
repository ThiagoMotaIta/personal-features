<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidueController;

// List All Residues
Route::get('residues', [ResidueController::class, 'getAllResidues']);

// Create new Residues by file Uploaded
Route::post('add-residues', [ResidueController::class, 'newResidue']);

// Delete Residue
Route::delete('delete-residue/{id}', [ResidueController::class, 'deleteResidue']);

// Edit Residue
Route::put('edit-residue/{id}', [ResidueController::class, 'updateResidue']);