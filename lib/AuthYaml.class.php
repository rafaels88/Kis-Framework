<?php
class AuthYaml implements Yaml {

    public function getParse(){
        return YamlParser::parse(file_get_contents(CONFIG_PATH . 'auth.yaml'));
    }

}


?>
