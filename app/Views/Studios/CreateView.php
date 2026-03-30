<?php

namespace App\Views\Studios;

use App\Views\Layout\LayoutView;

class CreateView
{
    public function render(): string
    {
        $content = <<<HTML
        <h1>Új stúdió létrehozása</h1>

        <form method="post" action="/studio/create" class="form">

            <label for="name">Stúdió neve</label>
            <input type="text" id="name" name="name" require>

            <br>

            <button type="submit" class="btn btn-primary">Mentés</button>
            <a href="/studio" class="btn btn-secondary">Mégse</a>

        </form>
        HTML;

        return (new LayoutView($content, "Új stúdió"))->render();
    }
}