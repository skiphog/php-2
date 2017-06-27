<?php

namespace App\View;

interface ViewInterface
{
    public function render(array $data, string $template);
}
