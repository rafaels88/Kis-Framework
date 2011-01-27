<?php
class AppModel {

	protected static $db;

    public static function connect($server = "development"){
        $dbYaml = DB::getParse();
        self::$db = DB::connect($dbYaml[$server]['host'], $dbYaml[$server]['username'], $dbYaml[$server]['password'], $dbYaml[$server]['database']);
    }
	
}
?>
