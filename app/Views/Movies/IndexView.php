<?php

namespace App\Views\Movies;

use App\Views\Layout\LayoutView;

class IndexView
{
    public function __construct(private array $movies) {}

    public function render(): string
    {
        $rows = array_map(fn($c) => $this->renderRow($c), $this->movies);
        $rowsHtml = implode("", $rows);

        $content = <<<HTML
        <h1>Filmek</h1>

        <a href="/movies/create" class="btn btn-primary">Új film</a>
        <br><br>

        <table class="table">
            {$this->renderTableHead()}
            <tbody>
                {$rowsHtml}
            </tbody>
        </table>
        HTML;

        return (new LayoutView($content, "Filmek"))->render();
    }

    private function renderTableHead(): string
    {
        return <<<HTML
        <thead>
            <tr>
                <th>#</th>
                <th>Cím</th>
                <th>Hossz</th>
                <th>Stúdió</th>
                <th>Rendező</th>
                <th>Kategória</th>
                <th>Év</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        HTML;
    }

    private function renderRow(array $c): string
    {
        $id = $c["id"];
        $title = htmlspecialchars($c["title"]);
        $duration = htmlspecialchars($c["duration"]);
        $studio = htmlspecialchars($c["studio"]);
        $director = htmlspecialchars($c["director"]);
        $category = htmlspecialchars($c["category"]);
        $release_year = htmlspecialchars($c["release_year"]);

        return <<<HTML
        <tr>
            <td>{$id}</td>
            <td>{$title}</td>
            <td>{$duration}</td>
            <td>{$studio}</td>
            <td>{$director}</td>
            <td>{$category}</td>
            <td>{$release_year}</td>
            <td>
                <a href="/movies/edit/{$id}" class="btn btn-sm btn-warning">Szerkesztés</a>
                <a href="/movies/delete/{$id}" class="btn btn-sm btn-danger" onclick="return confirm('Biztos törlöd?')">Törlés</a>
            </td>
        </tr>
        HTML;
    }
}