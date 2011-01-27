<?php
class AppModelSession extends Application {

    public static function start(){
        session_start();
    }

    public static function stop(){
        session_destroy();
    }
	
}
?>
