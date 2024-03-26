<?php
function deleteChar($arguments, $person, $conn) {
    echo "What character do you want to delete?\n\n";

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
    echo"Type the character you want to delete:\n";

    $deleteChar = ucfirst(readline());

    if(in_array($deleteChar, $charListArray)) {
        echo "\nYou deleted " . $deleteChar;
        echo"\n";
    
        $sql = "DELETE FROM user WHERE name = :deleteChar";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':deleteChar', $deleteChar);
        $stmt->execute();
    } else {
        echo "\nThat character is not available\n";
    }  
}


?>

