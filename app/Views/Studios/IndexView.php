<?php

namespace App\Views\Studios;

use App\Views\Layout\LayoutView;

class IndexView
{
    public function __construct(private array $studios) {}

    public function render(): string
    {
        unset($this->studios['code']);
        $rows = array_map(fn($c) => $this->renderRow($c), $this->studios);
        $rowsHtml = implode("", $rows);

        $content = <<<HTML
        <h1>Stúdiók</h1>

        <a href="/studio/create" class="btn btn-primary">Új stúdió</a>
        <br><br>

        <table class="table">
            {$this->renderTableHead()}
            <tbody>
                {$rowsHtml}
            </tbody>
        </table>
        HTML;

        return (new LayoutView($content, "Stúdiók"))->render();
    }

    private function renderTableHead(): string
    {
        return <<<HTML
        <thead>
            <tr>
                <th>#</th>
                <th>Név</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        HTML;
    }

    private function renderRow(array $c): string
    {
        $id = $c["id"];
        $name = htmlspecialchars($c["name"]);

        return <<<HTML
        <tr>
            <td>{$id}</td>
            <td>{$name}</td>
            <td>
                <a href="/studio/edit/{$id}" class="btn btn-sm btn-warning">Szerkesztés</a>
                <a href="/studio/delete/{$id}" class="btn btn-sm btn-danger" onclick="return confirm('Biztos törlöd?')">Törlés</a>
            </td>
        </tr>
        HTML;
    }
}