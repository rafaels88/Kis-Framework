<?php
class AuthYaml implements IYaml {

    public function getParse(){
        return YamlParser::parse(file_get_contents(CONFIG_PATH . 'auth.yaml'));
    }

}


?>
