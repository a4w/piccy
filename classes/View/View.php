<?php
namespace View;
class View{
    const TEMPLATES_PATH = __DIR__ . './../../templates/';
    private $template = null;

    /*
     * Constructs view
     * @param string $template the template file to use in rendering
     */
    function __construct($template) {
        $this->template = $template;
    }

    /*
     * Renders view
     * @param bool $returnOnly (optional) don't print html
     * @return string html rendered
     */
    function render($data, $returnOnly = false){
        extract($data);
        ob_start();
        include(self::TEMPLATES_PATH . $this->template);
        $content = ob_get_contents();
        ob_end_clean();
        if(!$returnOnly)
            echo $content;
        return $content;
    }

}
