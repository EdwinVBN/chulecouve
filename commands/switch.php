<?php require_once 'helper_functions.php'; ?>
<?php
function switchChar($arguments, $person, $conn) {
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

    foreach($allChars as $char) {
        echo $char['name'] . "\n";
    }

    echo"\n";
    echo"Type your new character:\n";
    
    $newChar = readline();
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
}
?>