<?php

namespace App\Views\Actors;

use App\Views\Layout\LayoutView;

class EditView
{
    public function __construct(private array $actor) {}
    
    public function render() : string 
    {
        $actor = $this->actor;
        $id = $actor["id"];
        $name = htmlspecialchars($actor["name"]);
        $birth_date = htmlspecialchars($actor["birth_date"]);

        $content = <<<HTML
        <h1>Színész módosítása</h1>

        <form method="post" action="/actors/edit/{$id}" class="form">

            <label for="name">Színész neve</label>
            <input type="text" id="name" name="name" value="{$name}" required>
            <br>
            <label for="date">Szül. dátum</label>
            <input type="date" id="birth_date" name="birth_date" value="{$birth_date}" required>
            <br><br>

            <button type="submit" class="btn btn-primary">Mentés</button>
            <a href="/actors" class="btn btn-secondary">Mégse</a>
        </form>
        HTML;

        return (new LayoutView($content, "Színész módosítása"))->render();
    }
}