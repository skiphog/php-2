<?php

namespace App;

use App\Traits\Magic;
use App\Traits\Iterator;
use App\View\ViewInterface;

/**
 * Class View
 * @package App
 */
class View implements \Iterator, \Countable
{
    use Magic;
    use Iterator;

    protected $plugin;

    public function assign($data, $value = null)
    {
        $data = is_array($data) ? $data : [$data => $value];

        foreach ($data as $key => $item) {
            $this->{$key} = $item;
        }

        return $this;
    }

    public function render(string $template): string
    {
        if ($this->plugin instanceof ViewInterface) {
            return $this->plugin->render($this->data, $template);
        }

        return $this->originRender($template);
    }

    public function display(string $template): void
    {
        echo $this->render($template);
    }

    public function setPlugin(ViewInterface $view)
    {
        $this->plugin = new $view;

        return $this;
    }

    public function count(): int
    {
        return count($this->data);
    }

    protected function originRender(string $template): string
    {
        ob_start();
        foreach ($this as $key => $value) {
            $$key = $value;
        }
        /** @noinspection PhpIncludeInspection */
        require $template;

        return ob_get_clean();
    }
}
