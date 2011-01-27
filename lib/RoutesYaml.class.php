<?php
class RoutesYaml implements Yaml {

    public function getParse(){
        return YamlParser::parse(file_get_contents(CONFIG_PATH . 'routes.yaml'));
    }

}


?>
