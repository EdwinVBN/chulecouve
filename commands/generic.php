<?php require_once 'helper_functions.php'; ?>
<?php
    /**
    * generic commands with no specific gameplay elements
    */
    function help($arguments, $person, $conn) {
        /**
         * returns all commands available to the player
         */
        echo "type commands as <command> <paramaters>\n";
        echo "f.i. 'look dex'\n";
        echo "available commands:\n";

        global $text_to_magic_converter; // use 'global' at your own risk!

        echo implode(', ', array_keys($text_to_magic_converter)) . "\n";
    }

    function location($arguments, $person, $conn) {
        $sql = "SELECT name, description FROM continent WHERE current_location = 'true'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $location = $stmt->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT name FROM user WHERE last_played = 'true'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $currChar = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "\nYou're playing as {$currChar['name']} and your location is {$location['name']}\n";
        echo "\e[3m\"{$location['description']}\"\e[23m\n";



    }

    function quit($arguments, $person, $conn) {
        /**
         * game shutdown
         */
        echo "have a nice day!\n";
        exit();
    }
?>