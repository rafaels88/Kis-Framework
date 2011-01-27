<?php
abstract class YamlFactory {
    
    public static function getParse($yaml){
        switch($yaml){
            case 'auth.yaml':
                $classYaml = new AuthYaml();
                break;
            case 'db.yaml':
                $classYaml = new DbYaml();
                break;
            case 'info.yaml':
                $classYaml = new InfoYaml();
                break;
            case 'routes.yaml':
                $classYaml = new RoutesYaml();
                break;
            default: 
                return false;
                break;
        }

        return $classYaml->getParse();
    }
}
?>
