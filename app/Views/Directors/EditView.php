<?php

namespace App\Views\Directors;

use App\Views\Layout\LayoutView;

class EditView
{
    public function __construct(private array $director) {}
    
    public function render() : string 
    {
        $director = $this->director;
        $id = $director["id"];
        $name = htmlspecialchars($director["name"]);
        $birth_date = htmlspecialchars($director["birth_date"]);

        $content = <<<HTML
        <h1>Rendező módosítása</h1>

        <form method="post" action="/directors/edit/{$id}" class="form">

            <label for="name">Rendező neve</label>
            <input type="text" id="name" name="name" value="{$name}" required>
            <br>
            <label for="date">Szül. dátum</label>
            <input type="date" id="birth_date" name="birth_date" value="{$birth_date}" required>
            <br><br>

            <button type="submit" class="btn btn-primary">Mentés</button>
            <a href="/directors" class="btn btn-secondary">Mégse</a>
        </form>
        HTML;

        return (new LayoutView($content, "Rendező módosítása"))->render();
    }
}