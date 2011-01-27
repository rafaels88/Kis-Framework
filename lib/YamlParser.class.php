<?php
require_once LIB_PATH  . 'yaml' . DIRECTORY_SEPARATOR . 'sfYamlParser.php';

class YamlParser {
    
    public static function parse($yaml_path){
        $yamlParser = new sfYamlParser();
        return $yamlParser->parse($yaml_path);
    }

}
?>
