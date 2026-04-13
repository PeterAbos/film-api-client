<?php

namespace App\Views\Casting;

use App\Views\Layout\LayoutView;

class IndexView
{
    public function __construct(private array $casting) {}

    public function render(): string
    {
        $rows = array_map(fn($c) => $this->renderRow($c), $this->casting);
        $rowsHtml = implode("", $rows);

        $content = <<<HTML
        <h1>Szereposztások</h1>

        <a href="/casting/create" class="btn btn-primary">Új szereposztás</a>
        <br><br>

        <table class="table">
            {$this->renderTableHead()}
            <tbody>
                {$rowsHtml}
            </tbody>
        </table>
        HTML;

        return (new LayoutView($content, "Szerepek"))->render();
    }

    private function renderTableHead(): string
    {
        return <<<HTML
        <thead>
            <tr>
                <th>#</th>
                <th>Film</th>
                <th>Színész</th>
                <th>Karakter</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        HTML;
    }

    private function renderRow(array $c): string
    {
        $id = $c["id"];
        $title = htmlspecialchars($c["title"]);
        $actor = htmlspecialchars($c["actor"]);
        $character = htmlspecialchars($c["character_name"]);

        return <<<HTML
        <tr>
            <td>{$id}</td>
            <td>{$title}</td>
            <td>{$actor}</td>
            <td>{$character}</td>
            <td>
                <a href="/casting/edit/{$id}" class="btn btn-sm btn-warning">Szerkesztés</a>
                <a href="/casting/delete/{$id}" class="btn btn-sm btn-danger" onclick="return confirm('Biztos törlöd?')">Törlés</a>
            </td>
        </tr>
        HTML;
    }
}