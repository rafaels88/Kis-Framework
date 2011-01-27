<?php
class Routes extends Application {

    public function verifyRoute($route_to_verify){
        if(self::getRealPathOfRequest($route_to_verify) !== false)
            return true;
        else
            return false;
    }

    public function getParse(){
        return RoutesYaml::getParse();
    }

    public function httpRedirect($url_location){
		if(preg_match('/^\//', $url_location, $matches)){
			$web_path = "http://" . Settings::getItem('server') . Settings::getItem('webroot');
        	die(header("Location: ".$web_path.$url_location));
		}
		else
			die(header("Location: ".$url_location));
	}

    public function getParams($url){
        if(Settings::getItem('fancyurl') === true){
            $url_no_param = self::getRealPathOfRequest($url);

            $routesYaml = self::getParse();
        
            foreach($routesYaml AS $url_rota => $route){
                $a_url_rota = explode(":", $url_rota);                
                
                if($url_no_param == $a_url_rota[0]){
                    
                    if(count($a_url_rota) < 2)
                        return false;

                    $a_url = explode($url_no_param, $url);
                    $param = $a_url[1];

                    $a_param = explode("/", $param);
                    
                    $a_param_refactored = Array();
                    for($i=1; isset($a_url_rota[$i]); $i++){
                        $a_param_refactored[ substr($a_url_rota[$i],0,-1) ] = $a_param[$i-1];
                    }

                    return $a_param_refactored;
                }
            }
        }

        return false;
    }

    public function getRealPathOfRequest($url){
        if(substr($url, -1) != "/")
            $url.="/";
        
        $routesYaml = self::getParse();
        
        foreach($routesYaml AS $url_rota => $route){
            $array_url_rota = explode(":", $url_rota);
            $array_url = explode("/", $url);

            $qtd_parametros = count($array_url_rota);

            for($i = 0; $i < $qtd_parametros; $i++){
                array_pop($array_url);
            }
            $new_url = implode("/", $array_url)."/";

            if(preg_match("/^".preg_quote($array_url_rota[0], "/")."$/", $new_url))
                return $new_url;
        }

        if(self::checkUrlIsValid($url))
            return $url;
            
        return false;
    }

    //Checa se a URL eh valida, sem verificar no routes.yaml
    private function checkUrlIsValid($url){
        $a_url = explode("/",$url);
        $a_webroot = explode("/", Settings::getItem('webroot'));
        
        //Se a quantidade de parametros passados na url forem igual a 2 (controller e metodo), verifica se o caminho existe, senão é false
        if((count($a_url) - (count($a_webroot)-1)) == 2){
            
            $DirectoryIterator = new RecursiveDirectoryIterator(CONTROLLER_PATH);
            $IteratorIterator  = new RecursiveIteratorIterator($DirectoryIterator);

            while($IteratorIterator->valid()){
                if(!$IteratorIterator->isDot()){
                    if(strpos($IteratorIterator->getFileName(), ucfirst($a_url[1])."Controller" ) !== false){
                        if(method_exists(ucfirst($a_url[1])."Controller", $a_url[2])){
                            return true;
                        }

                    }
                }
                $IteratorIterator->next();
            }
        }

        return false;
    }

    public function getByUrl($url){
        $routesYaml = self::getParse();
        
        foreach($routesYaml AS $url_rota => $route){
            $array_url_rota = explode(":", $url_rota);
            
            if($array_url_rota[0] === $url){
                $route["url"] = $url_rota;
                return $route;
            }
        }

        $route = Array();
        if(self::checkUrlIsValid($url)){
            $a_url = explode("/", $url);
            $route["url"] = $url;
            $route["controller"] = ucfirst($a_url[1]);
            $route["action"] = $a_url[2];
            return $route;
        }

        return false;
    }

    public function getUrlByName($name, Array $params = Array()){
        $routesYaml = self::getParse();
        
        foreach($routesYaml AS $url_rota => $route){
            if($route["name"] === $name){

                if(Settings::getItem('fancyurl') === true){
                    foreach($params AS $key => $value){
                        $url_rota = str_replace(":".$key, $value, $url_rota);
                    }
                }
                else {
                    $a_url_rota = explode(":",$url_rota);
                    $url_rota = $a_url_rota[0];
                    
                    if(!empty($params))
                        $url_rota.="?";

                    foreach($params AS $key => $value){
                        $url_rota.=$key."=".$value;
                    }
                }

                return $url_rota;
            }
        }
    }

    public function getWebUrlByName($name, Array $params = Array()){
        $url = self::getUrlByName($name, $params);
        $webroot_path = Settings::getItem('webroot');

        return $webroot_path . $url;
    }
}


?>
