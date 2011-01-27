<?php
class AuthSession extends AppModelSession {

    public static function setAutenticado($v){
        $_SESSION["auth"]["autenticado"] = $v;
    }

    public static function getAutenticado(){
        return (isset($_SESSION["auth"]["autenticado"]))? $_SESSION["auth"]["autenticado"] : null;
    }

    public static function setObjetoAutenticado(AppModel $obj){
        $_SESSION["auth"]["objetoAutenticado"] = $obj;
    }

    public static function getObjetoAutenticado(){
        return (isset($_SESSION["auth"]["objetoAutenticado"]))? $_SESSION["auth"]["objetoAutenticado"] : null;
    }

    public static function finalizarSession(){
        unset($_SESSION["auth"]);
    }
}

?>
