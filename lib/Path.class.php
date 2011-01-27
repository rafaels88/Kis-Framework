<?php
class Path extends Application {

    public function getParse(){
        return PathYaml::getParse();
    }

    public function getItem($item){
        $parse = self::getParse();
        
        return $parse[$item];
    }

}
?>
