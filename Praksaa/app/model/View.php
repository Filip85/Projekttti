<?php

class View {
    protected $layout = 'home';
    public function render($name, $args = []) {
        ob_start();
        extract($args);
        include BP . "app/view/$name.phtml";
        $content = ob_get_clean();

        if ($this->layout) {

            include BP . "app/view/{$this->layout}.phtml";
        } else {
            echo $content;
        }
        return $this;
    }


}