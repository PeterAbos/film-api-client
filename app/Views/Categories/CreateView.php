<?php

namespace App\Views\Categories;

use App\Views\Layout\LayoutView;

class CreateView
{
    public function render(): string
    {
        $content = <<<HTML
        <h1>Új kategória létrehozása</h1>

        <form method="post" action="/category/create" class="form">

            <label for="name">Kategória neve</label>
            <input type="text" id="name" name="name" require>

            <br>

            <button type="submit" class="btn btn-primary">Mentés</button>
            <a href="/category" class="btn btn-secondary">Mégse</a>

        </form>
        HTML;

        return (new LayoutView($content, "Új kategória"))->render();
    }
}