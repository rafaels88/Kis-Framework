<?php
class SettingsYaml implements Yaml {

    public function getParse(){
        return YamlParser::parse(file_get_contents(CONFIG_PATH . 'settings.yaml'));
    }

}


?>
