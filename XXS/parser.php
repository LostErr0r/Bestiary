<?php

        ini_set('display_errors',1);
        error_reporting(E_ALL);

        if($_SERVER["REQUEST_METHOD"] == "POST"){
                
                $post = file_get_contents("php://input");
                $xml = new DOMDocument();
                $xml -> loadXML($post, LIBXML_NOENT | LIBXML_DTDLOAD);
                $root = $xml -> getElementsByTagName('title') -> item(0);

                echo $root -> textContent;
        } else {
                echo"Send XML in POST";
        }
?>
