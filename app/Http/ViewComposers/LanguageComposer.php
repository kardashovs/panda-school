<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Language;

class LanguageComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $languages;


    public function __construct(Language $languages)
    {
        // Dependencies automatically resolved by service container...
        $this->languages = $languages;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('languages', $this->languages->all());
    }
}