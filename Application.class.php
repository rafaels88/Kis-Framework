<?php
class Application {

    public static $instance;

    private function __construct(){
        AppModelSession::start();
	    AppModel::connect( Settings::getItem('dbserver') );
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new Application();
        }

        return self::$instance;
    }


    public function run(){
        if(strpos($_SERVER["REQUEST_URI"], "?")){
            $a_request_uri = explode("?", $_SERVER["REQUEST_URI"]);
            $request_uri   = $a_request_uri[0];
        }
        else
            $request_uri = $_SERVER["REQUEST_URI"];
            
        $request_uri = explode(Settings::getItem('webroot'), $request_uri);
        
        $route = Routes::getByUrl( Routes::getRealPathOfRequest($request_uri[1]) );

        if(Routes::verifyRoute($request_uri[1])){
			if(Settings::getItem('authentication') === true AND Auth::verifyControllerAuth($route["controller"], $route["action"])){
				if(Auth::verifyAuth()){
					Dispatch::dispatch($request_uri[1], $route["controller"]."Controller", $route["action"]);
				}
				else {
					foreach(Routes::getParse() AS $route){
						if(array_key_exists('behavior', $route)){
							if($route["behavior"] == "login"){
								Routes::httpRedirect( Routes::getUrlByName($route["name"]) );
							}
						}
					}
				}
			}
			else {
				Dispatch::dispatch($request_uri[1], $route["controller"]."Controller", $route["action"]);
			}
        }
        else {
			foreach(Routes::getParse() AS $route){
				if(array_key_exists('behavior', $route)){
					if($route["behavior"] == "404"){
						Routes::httpRedirect( Routes::getUrlByName($route["name"]) );
					}
				}
			}
        }
    }
    
}


?>
