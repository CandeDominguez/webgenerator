<?php
    session_start();
    if (isset($_GET["dominio"]) && isset($_SESSION["last_id"])) {
            shell_exec("rm -r ".$_GET["dominio"]);
            shell_exec("rm -r ".$_GET["dominio"].".zip");

            $con = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2020", "webgenerator");
            $con->query("DELETE FROM `webs` WHERE `webs`.`dominio` = '".$_GET["dominio"]."'");
            header("Location: panel.php");
             die();
        }else {
        header("Location: panel.php");
        die(); 
    } 
    
?>