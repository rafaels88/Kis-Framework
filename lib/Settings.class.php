<?php
class Settings extends Application {

    public function getParse(){
        return SettingsYaml::getParse();
    }

    public function getItem($item){
        $parse = self::getParse();
        
        return $parse[$item];
    }

}
?>
