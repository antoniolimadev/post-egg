<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class NoteController extends Controller
{
    public function index(): View
    {
        return view('notes');
    }
}
