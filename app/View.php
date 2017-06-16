<?php

namespace App;

use App\Traits\ArrayAccess;
use App\Traits\Magic;
use App\Traits\Iterator;

/**
 * Class View
 * @package App
 */
class View implements \Iterator, \Countable, \ArrayAccess
{
    use Magic;
    use Iterator;
    use ArrayAccess;

    public function render(string $template): string
    {
        ob_start();
        foreach ($this as $key => $value) {
            $$key = $value;
        }
        /** @noinspection PhpIncludeInspection */
        require $template;

        return ob_get_clean();
    }

    public function display(string $template): void
    {
        echo $this->render($template);
    }

    public function count(): int
    {
        return count($this->data);
    }
}
