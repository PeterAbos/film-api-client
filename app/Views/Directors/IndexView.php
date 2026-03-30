<?php

namespace App\Views\Directors;

use App\Views\Layout\LayoutView;

class IndexView
{
    public function __construct(private array $directors) {}

    public function render(): string
    {
        unset($this->directors['code']);
        $rows = array_map(fn($c) => $this->renderRow($c), $this->directors);
        $rowsHtml = implode("", $rows);

        $content = <<<HTML
        <h1>Rendezők</h1>

        <a href="/directors/create" class="btn btn-primary">Új rendező</a>
        <br><br>

        <table class="table">
            {$this->renderTableHead()}
            <tbody>
                {$rowsHtml}
            </tbody>
        </table>
        HTML;

        return (new LayoutView($content, "Rendezők"))->render();
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
                <a href="/directors/edit/{$id}" class="btn btn-sm btn-warning">Szerkesztés</a>
                <a href="/directors/delete/{$id}" class="btn btn-sm btn-danger" onclick="return confirm('Biztos törlöd?')">Törlés</a>
            </td>
        </tr>
        HTML;
    }
}