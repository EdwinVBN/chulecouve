<?php require_once 'helper_functions.php'; ?>
<?php
 
function createChar($arguments, $person, $conn) {
    while (true) {
        $continentList = "";
   
        echo "\nType your character name:\n";
   
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
   
            foreach ($continents as $continent) {
                echo "{$continent['name']}\n";
                $continentList .= $continent['name'] . ",";
            }

            echo "\nPick your continent:\n";
   
            $continentList = rtrim($continentList, ',');
            $continentList = explode(",", $continentList);
   
            $chooseContinent = ucfirst(readline());
 
   
            if (in_array($chooseContinent, array_column($continents, 'name'), true)) {
                $contId = null;
 
                switch($chooseContinent){
                    case 'Africa':
                        $contId = 1;
                        break;
                    case 'Antarctica':
                        $contId = 2;
                        break;
                    case 'Asia':
                        $contId = 3;
                        break;
                    case 'Europe':
                        $contId = 4;
                        break;
                    case 'North America':
                        $contId = 5;
                        break;
                    case 'North america':
                        $contId = 5;
                        break;
                    case 'Oceania':
                        $contId = 6;
                        break;
                    case 'South America':
                        $contId = 7;
                        break;
                    case 'South america':
                        $contId = 7;
                        break;
                    case 'Arctic':
                        $contId = 8;
                        break;    
                }
   
                $sql = "INSERT INTO user (name, person_id, last_played) VALUES (:name, :person_id, FALSE)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':name', $newPerson);
                $stmt->bindParam(':person_id', $contId);
                $stmt->execute();
   
                echo "\nCharacter Created\n";
                break;
            } else {
                echo "\nContinent does not exist";
                echo "\nChoose again...\n";
            }
        } else {
            echo "\nName already taken";
            echo "\nTry again :(\n";
        }
    }
 
}
 
 
?>