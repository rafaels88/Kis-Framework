<?php
class Dispatch extends Application {

    public function __construct(){}

    public static function dispatch($url, $controller, $action){
        if(Settings::getItem('fancyurl') == true){
            $a_params = Routes::getParams($url);

            if($a_params !== false){
                foreach($a_params AS $param=>$value){
                    $_GET[$param] = $value;
                }
            }
        }

        $controller_dispatch = new $controller();
        $return = $controller_dispatch->$action();

		if(isset($_GET["json"]) AND $_GET["json"] == 1)
			die( json_encode(utf8_encode($return)) );
		elseif(isset($_GET["ajax"]) AND $_GET["ajax"] == 1)
			die( utf8_encode($return) );
    }
}
?>
