<html>
    <head>
        <?php
        /*
         * TO-DO:
         * MOAR/Better abstractions to improve readbility ans make comments redundant.
         */

        //imports
        require_once("lib/steam-condenser.php");

        //PHP to HTML abstractions
        function html_newline() {
            echo "<br />";
        }

        function html_Welcome($name) {
            echo "Welcome, " . $name;
        }

        function html_Avatar($avatar) {
            echo "<img src='" . $avatar . "'>";
        }

        function html_Form() {
            echo "<form action='index.php' method='get'>";
            echo "<input type='text' name='txtId'> <input type='submit' value='OK'>";
            echo "</form>";
        }
        ?>
    </head>
    <body>

        <?php
        /*
         * Check if a SteamID was given in the URL.
         * If so show the score
         * If not show the form
         */
        if (isset($_GET["txtId"])) {
            $getID = $_GET["txtId"];
        }

        if (isset($getID)) {
            $steamUser = new SteamId($getID);

            /*
             * Formalities:
             * Show welcome message and avatar
             */
            html_Welcome($steamUser->getNickname());
            html_Avatar($steamUser->getFullAvatarUrl());

            html_newline();

            //Get array of the users games

            foreach ($steamUser->getGames() as $game) {
                try {
                    $stats = $steamUser->getGameStats($game->getID());
                    $achievements = $stats->getAchievements();
                    foreach ($achievements as $achievement) {
                        $achievement->getName();
                    }
                } catch (Exception $e) {
                    echo $game->getName() . " does not have achievements";
                }
                html_newline();
            }
        } else {
            html_Form();
        }
        ?>

    </body>
</html>