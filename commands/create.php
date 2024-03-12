<?php require_once 'helper_functions.php'; ?>
<?php

function createChar($arguments, $person, $conn) {
    $continentList = "";

    echo"Create a new character...\n";
    echo"name?\n";

    $newPerson = ucfirst(readline());

    $sql = "SELECT name FROM user";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $nameList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!in_array($newPerson, array_column($nameList, 'name'), true)) {
        echo "\nWhat origin do you choose?";

        $sql = "SELECT * FROM continent";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        $continents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        echo "\nPick your continent...\n\n";
    
        foreach($continents as $continent) {
            echo "{$continent['name']}\n"; 
            
            $continentList .= $continent['name'] . ",";
        }
    
        $continentList = rtrim($continentList, ',');
        $continentList = explode(",", $continentList);
    
    } else {
        echo "\nName already taken.";
        echo "\nType CREATE again :(\n";
    }
}
?>