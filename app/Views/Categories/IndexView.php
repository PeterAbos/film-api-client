<?php

namespace App\Views\Categories;

use App\Views\Layout\LayoutView;

class IndexView
{
    public function __construct(private array $category) {}

    public function render(): string
    {
        unset($this->category['code']);
        $rows = array_map(fn($c) => $this->renderRow($c), $this->category);
        $rowsHtml = implode("", $rows);

        $content = <<<HTML
        <h1>Kategóriák</h1>

        <a href="/category/create" class="btn btn-primary">Új kategória</a>
        <br><br>

        <table class="table">
            {$this->renderTableHead()}
            <tbody>
                {$rowsHtml}
            </tbody>
        </table>
        HTML;

        return (new LayoutView($content, "Kategóriák"))->render();
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
                <a href="/category/edit/{$id}" class="btn btn-sm btn-warning">Szerkesztés</a>
                <a href="/category/delete/{$id}" class="btn btn-sm btn-danger" onclick="return confirm('Biztos törlöd?')">Törlés</a>
            </td>
        </tr>
        HTML;
    }
}