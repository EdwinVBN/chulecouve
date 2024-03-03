<?php require_once 'helper_functions.php'; ?>
<?php

// Ga verder vanaf de readline lijn (50, 80)
// Zorgen dat de gekozen keuze bestaat en zorgen dat data goed verwerkt word

function navigate($arguments, $person, $conn) {
    $sql = "SELECT * FROM continent WHERE current_location = 'true'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $target = $stmt->fetch(PDO::FETCH_ASSOC);

    if($target['name'] !== 'Antarctica' && $target['name'] !== 'Arctic') {
        $sql = "UPDATE continent SET current_location = 
        CASE WHEN name = :name THEN 'true' 
        ELSE 'false' END";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $target["$arguments[0]"]);
        $stmt->execute();

        echo "You are now in {$target[$arguments[0]]}!\n";
    } else {
        if($target['name'] === 'Antarctica') {
            switch($arguments[0]) {
                case "south":
                    echo "You can't go anymore south\n";
                    break;
                case "east":
                case "west":
                    echo "Looks like you're making circles!\n";
                    break;
                case "north":
                    $sql = "SELECT * FROM continent WHERE south = 'Antarctica'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    $coldVarAntarctica = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    echo "\nYou have multiple choices from here, where do you want to go?\n\n";

                    foreach($coldVarAntarctica as $var) {
                        echo "{$var['name']}\n";   
                    }

                    echo "\n";
                    echo "Type your destination:\n";

                    $destination = readline();
                    break;
                default:
                    echo "That is not a direction\n";
            }
        } else {
            switch($arguments[0]) {
                case "north":
                    echo "You can't go anymore north\n";
                    break;
                case "east":
                case "west":
                    echo "Looks like you're making circles!\n";
                    break;
                case "south":
                    $sql = "SELECT * FROM continent WHERE north = 'Arctic'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    $coldVarArctic = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    echo "\nYou have multiple choices from here, where do you want to go?\n\n";

                    foreach($coldVarArctic as $var) {
                        echo "{$var['name']}\n";   
                    }

                    echo "\n";
                    echo "Type your destination:\n";

                    $destination = readline();
                    break;
                default:
                    echo "That is not a direction\n";
            }
        }
    }
}
?>