<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class LegalController extends Controller
{
    public function terms()
    {
        return Inertia::render('Legal/Terms');
    }

    public function cookies()
    {
        return Inertia::render('Legal/Cookies');
    }

    public function notice()
    {
        return Inertia::render('Legal/Notice');
    }
}
