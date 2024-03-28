<?php require_once 'helper_functions.php'; ?>
<?php

function createChar($arguments, $person, $conn) {
    while (true) {
        $continentList = "";
    
        echo "\nCreate a new character...\n";
        echo "name?\n";
    
        $newPerson = ucfirst(readline());
    
        $sql = "SELECT name FROM user";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        $nameList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        global $continents;

        if (!in_array($newPerson, array_column($nameList, 'name'), true)) {
            echo "\nWhat origin do you choose?";
    
            $sql = "SELECT * FROM continent";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
    
            $continents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            echo "\nPick your continent...\n\n";
    
            foreach ($continents as $continent) {
                echo "{$continent['name']}\n";
                $continentList .= $continent['name'] . ",";
            }
    
            $continentList = rtrim($continentList, ',');
            $continentList = explode(",", $continentList);
    
            $chooseContinent = ucfirst(readline());
    
            if (in_array($chooseContinent, array_column($continents, 'name'), true)) {
                // $sql = "SELECT id FROM continent WHERE name = :chooseContinent";
                // $stmt = $conn->prepare($sql);
                // $stmt->bindParam(':chooseContinent', $chooseContinent);
                // $stmt->execute();
    
                // $continentId = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
    
                // $sql = "INSERT INTO user (name, person_id, last_played) VALUES (:name, :person_id, False)";
                // $stmt = $conn->prepare($sql);
                // $stmt->bindParam(':name', $newPerson);
                // $stmt->bindParam(':person_id', $continentId);
                // $stmt->execute();
    
                echo "\nCharacter Created.";
                break; // Exit the loop once character is created
            } else {
                echo "\nContinent does not exist.";
                echo "\nChoose again...\n";
            }
        } else {
            echo "\nName already taken.";
            echo "\nTry again :(\n";
        }
    }

}


?>