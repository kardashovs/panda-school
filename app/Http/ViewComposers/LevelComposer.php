<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Http\Controllers\Dashboard\SectionController;

class LevelComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $section;


    public function __construct(SectionController $section)
    {
        // Dependencies automatically resolved by service container...
        $this->section = $section;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('levelCount', $this->section->level());
        $view->with('levelPercent', $this->section->levelPercent());
    }
}