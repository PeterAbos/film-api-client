<?php

namespace App\Views\Actors;

use App\Views\Layout\LayoutView;

class CreateView
{
    public function render(): string
    {
        $content = <<<HTML
        <h1>Új színész létrehozása</h1>

        <form method="post" action="/actors/create" class="form">

            <label for="name">Színész neve</label>
            <input type="text" id="name" name="name" require>

            <label for="name">Színész születési dátum</label>
            <input type="date" id="birth_date" name="birth_date" require>

            <br>

            <button type="submit" class="btn btn-primary">Mentés</button>
            <a href="/actors" class="btn btn-secondary">Mégse</a>

        </form>
        HTML;

        return (new LayoutView($content, "Új színész"))->render();
    }
}