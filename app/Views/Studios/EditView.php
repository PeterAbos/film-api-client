<?php

namespace App\Views\Studios;

use App\Views\Layout\LayoutView;

class EditView
{
    public function __construct(private array $studio) {}
    
    public function render() : string 
    {
        $studio = $this->studio;
        $id = $studio["id"];
        $name = htmlspecialchars($studio["name"]);

        $content = <<<HTML
        <h1>Stúdió módosítása</h1>

        <form method="post" action="/studio/edit/{$id}" class="form">

            <label for="name">Stúdió neve</label>
            <input type="text" id="name" name="name" value="{$name}" required>
            <br><br>

            <button type="submit" class="btn btn-primary">Mentés</button>
            <a href="/studio" class="btn btn-secondary">Mégse</a>
        </form>
        HTML;

        return (new LayoutView($content, "Stúdió módosítása"))->render();
    }
}