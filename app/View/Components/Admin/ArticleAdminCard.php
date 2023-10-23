<?php

namespace App\View\Components\Admin;

use Closure;
use App\Models\Article;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ArticleAdminCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Article $article,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.admin.article-admin-card');
    }
}
