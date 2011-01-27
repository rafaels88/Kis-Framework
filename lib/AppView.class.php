<?php
class AppView  {

    private $variables = Array();

	public function get_template($template){
        ob_start();
        extract($this->variables);
        include_once(VIEW_PATH . $template);
        $content = ob_get_clean();
        @ob_flush();
        return $content;
	}
	
	public function set($var, $value){
		$this->variables[$var] = $value;
	}
	
	public function render($template){
        ob_start(); 
        extract($this->variables);
        include_once(VIEW_PATH . $template);
        echo ob_get_clean();
        @ob_flush();
	}
}

?>
