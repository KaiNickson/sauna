<?php
	/*
	 * TO-DO:
	 * Compare the list of unlocked achievements with al the achievements of its game and get their Global Statistics (percentage of players who unlocked the achievement)
	 * MOAR/Better abstractions to improve readbility ans make comments redundant.
	 * Move the the user output to a seperate view
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
	
	function html_listitem($item){
		 echo "<li>" . $item . "</li>";
	}
	
	echo "<html>";
	echo "	<head>";
	echo "	</head>";
	echo "	<body>";
	
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
		echo "<ul>";
		foreach ($steamUser->getGames() as $game) {

			//try to get the Steam GameStats for every game the player owns
			//if no gamestats do nothing
			try {
				$stats = $steamUser->getGameStats($game->getID());
				$achievements = $stats->getAchievements();

				html_listitem($game->getName());
									
				//for each achievement that is unlocked, print achievement name in a sublist.
				echo "<ul>";
				foreach ($achievements as $achievement) {
					if ($achievement->isUnlocked()) {
						html_listitem($achievement->getName());
					}
				}

				echo "</ul>";
			} catch (Exception $e) {
				//echo $game->getName() . " does not have achievements";
			}
		}
		echo "</ul>";
	} else {
		header('Location: views/idform.php');
	}
	
	echo "	</body>";
	echo "</html>";
?>
