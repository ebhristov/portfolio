<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class LibraryController extends Controller
{
    public function index()
    {
        return Inertia::render('Library');
    }
}
