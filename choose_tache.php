<?php
session_start();
require_once "includes/database/database.php";

require_once 'includes/functions/clean_input.php';
?>
<?php
$title="choix de la database";
require_once 'includes/header.php'
?>
<form method='post' >
    <select>
        <option>
            Selectionner la tache a accomplir
        </option>
        
    </select>
</form>
<?php

require_once 'includes/footer.php'
?>