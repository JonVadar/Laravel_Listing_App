<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $listings =
            $request->user()->role !== 'suspended' ?
            $request->user()->listings()->latest()->paginate(10) :
            null;

        return Inertia::render('Dashboard', [
            'listings' => $listings,
            'status' => session('status')
        ]);
    }
}
