<?php

namespace App\View\Composers;

use App\Models\SavedProvider;
use Illuminate\View\View;

class SavedProvidersComposer
{
    public function compose(View $view): void
    {
        if (auth()->check() && auth()->user()->isFamily()) {
            $ids = SavedProvider::where('user_id', auth()->id())
                ->pluck('provider_id')
                ->all();
        } else {
            $ids = [];
        }

        $view->with('savedProviderIds', $ids);
    }
}
