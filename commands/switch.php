<?php require_once 'helper_functions.php'; ?>
<?php
function switchChar($conn) {
    $sql = "SELECT name FROM user WHERE last_played = 'true'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $lastPlayed = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastChar = $lastPlayed['name'];

    echo "You're playing as $lastChar, which character do you want to play as now?\n\n";

    $sql = "SELECT name FROM user";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $allChars = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $charList = "";

    foreach($allChars as $char) {
        echo $char['name'] . "\n";

        $charList .= $char['name'] . ",";
    }

    $charList = rtrim($charList, ',');
    $charListArray = explode(",", $charList);

    echo"\n";
    echo"Type your new character:\n";
    
    $newChar = readline();

    if(in_array($newChar, $charListArray)) {
        echo "\nYou're now playing as " . $newChar;
        echo"\n";

        foreach($allChars as $char) {

            if($char['name'] === $newChar) {

                $sql = "UPDATE user SET last_played = 'false' WHERE last_played = 'true'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
    
                $sql = "UPDATE user SET last_played = 'true' WHERE name = :newchar";
                $stmt = $stmt = $conn->prepare($sql);
                $stmt->bindParam(':newchar', $newChar);
                $stmt->execute();
            }
        }    
    } else {
        echo "\nThat character is not available\n";
    }   
}
?>