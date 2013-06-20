<html>
    <head>

    </head>
    <body>
        <?php
        require_once("lib/steam-condenser.php");
        //$steamUser = new SteamId('76561198033242043');
        if (isset($_GET["txtId"])) {
            $getID = $_GET["txtId"];
        }
        if (isset($getID)) {
            $steamUser = new SteamId($getID);
            echo "Welcome, " . $steamUser->getNickname();
            echo "<img src='" . $steamUser->getFullAvatarUrl() . "'>";
            
            echo "<br>";
            echo "Games:  ";            
            echo "<table>";
            foreach ($steamUser->getGames() as $game) {
                echo "<tr> <td> <a href='#'>";
                echo $game->getName();
                echo " </a></td>";
                //echo "<td>";
                //echo $steamUser->getAchievementsDone();
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>

        <form action="index.php" method="get">
            <input type="text" name="txtId"> <input type="submit" value="OK">
        </form>

    </body>
</html>