<?php
class Controller extends Application {
	
	protected $view;

	public function __construct(){
		$this->view = new AppView();
	}
}

?>
