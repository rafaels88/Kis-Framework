<?php
class Info extends Application {

    public function getParse(){
        return InfoYaml::getParse();
    }

    public function getItem($item){
        $parse = self::getParse();
        
        return $parse[$item];
    }

}
?>
