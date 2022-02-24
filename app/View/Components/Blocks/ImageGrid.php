<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use Illuminate\Support\Collection;

class ImageGrid extends BlockComponent
{
    public ?string $title;

    public Collection $images;

    public string $columns;

    public function setup(): void
    {
        $this->title = $this->block->translatedInput('title');

        $this->images = $this->block->getMedia('image');

        $this->columns = $this->columnsFromInput();
    }
}
