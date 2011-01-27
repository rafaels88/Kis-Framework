<?php
class Auth extends Application {

    public function verifyAuth(){
        return (bool)AuthSession::getAutenticado();
    }
    
    public function verifyControllerAuth($controller, $method){
        $authYaml = self::getParse();

		if(!empty($authYaml)){
			foreach($authYaml AS $controllerYaml => $arrayMethodYaml){
				foreach($arrayMethodYaml AS $methodYaml){
					if($controllerYaml == ucfirst($controller) AND $methodYaml == $method)
						return true;
				}
			}
		}
        return false;
    }

    public function getParse(){
        return AuthYaml::getParse();
    }

}
?>
