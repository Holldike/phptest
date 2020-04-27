<?php

class View
{
    public string $content;
    public string $title = 'Title';
    public array $assets;
    public array $data;

    public function render($view, $onlyContent = false)
    {
        $this->content = VIEW_DIR . DIRECTORY_SEPARATOR . $view . '.php';

        if ($onlyContent) {
            require $this->content;
        } else {
            require VIEW_DIR . DIRECTORY_SEPARATOR . 'common.php';
        }
    }
}