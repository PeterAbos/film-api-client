<?php

namespace App\Views\Categories;

use App\Views\Layout\LayoutView;

class EditView
{
    public function __construct(private array $category) {}
    
    public function render() : string 
    {
        $category = $this->category;
        $id = $category["id"];
        $name = htmlspecialchars($category["name"]);

        $content = <<<HTML
        <h1>Kategória módosítása</h1>

        <form method="post" action="/category/edit/{$id}" class="form">

            <label for="name">Kategória neve</label>
            <input type="text" id="name" name="name" value="{$name}" required>
            <br><br>

            <button type="submit" class="btn btn-primary">Mentés</button>
            <a href="/category" class="btn btn-secondary">Mégse</a>
        </form>
        HTML;

        return (new LayoutView($content, "Kategória módosítása"))->render();
    }
}