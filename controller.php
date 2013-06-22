<?php

/*
 * Check if a SteamID was given in the URL.
 * If so go to the Saune.php view
 * If not show the idform.php view
 */
if (isset($_GET["id"])) {
    $getID = $_GET["id"];
    header('Location: views/Sauna.php?id=' . $getID);
} else {
    header('Location: views/idform.php');
}
?>
