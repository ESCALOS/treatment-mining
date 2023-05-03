<?php

use App\Http\Livewire\OreType\Base as OreTypeBase;
use Illuminate\Support\Facades\Route;

Route::get("/ore-type",OreTypeBase::class)->name('administrador.ore-types');
