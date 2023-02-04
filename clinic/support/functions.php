<?php
    function setMessage ($result){
        if ($result > 0){
            $_SESSION['message']['text'] = "Operação executada com sucesso.";
            $_SESSION['message']['class'] = "success";
        }elseif ($result === 0){
            $_SESSION['message']['text'] = "Não foi possível executar a operação solicitada.";
            $_SESSION['message']['class'] = "danger";
        }
        unset($_POST);
    }
?>