<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\View\View;

class AdminProviderCardController extends Controller
{
    public function edit(Provider $provider): View
    {
        $provider->load('categories');

        return view('admin.providers.card', compact('provider'));
    }
}
