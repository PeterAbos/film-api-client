<?php

namespace App\Views\Actors;

use App\Views\Layout\LayoutView;

class IndexView
{
    public function __construct(private array $actors) {}

    public function render(): string
    {
        $rows = array_map(fn($c) => $this->renderRow($c), $this->actors['entities']);
        $rowsHtml = implode("", $rows);

        $content = <<<HTML
        <h1>Színészek</h1>

        {$this->renderSearchBar()}

        <a href="/actors/create" class="btn btn-primary">Új színész</a>
        <br><br>

        <table class="table">
            {$this->renderTableHead()}
            <tbody>
                {$rowsHtml}
            </tbody>
        </table>
        HTML;

        return (new LayoutView($content, "Színészek"))->render();
    }

    private function renderTableHead(): string
    {
        return <<<HTML
        <thead>
            <tr>
                <th>#</th>
                <th>Név</th>
                <th>Születési dátum</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        HTML;
    }

    private function renderRow(array $c): string
    {
        $id = $c["id"];
        $name = htmlspecialchars($c["name"]);
        $birth_date = htmlspecialchars($c["birth_date"]);

        return <<<HTML
        <tr>
            <td>{$id}</td>
            <td>{$name}</td>
            <td>{$birth_date}</td>
            <td>
                <a href="/actors/edit/{$id}" class="btn btn-sm btn-warning">Szerkesztés</a>
                <a href="/actors/delete/{$id}" class="btn btn-sm btn-danger" onclick="return confirm('Biztos törlöd?')">Törlés</a>
            </td>
        </tr>
        HTML;
    }

    private function renderSearchBar(): string
    {
        return <<<HTML
        <form method="get" action="/actors" class="search-bar">
            <input type="search" name="needle" placeholder="Keresés..." class="search-input">
            <button type="submit" class="btn btn-secondary">Keres</button>
        </form>
        <br>
        HTML;
    }
}