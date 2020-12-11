<?php
    $servername = "localhost";
    $username = "root";
    $password = "";


    $conn = new mysqli($servername, $username, $password);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "CREATE DATABASE items";

    if($conn->query($sql) === true){
      echo "Database created successfully<br>";
    }else{
        die("Error creating database: " . $conn->error);
    }

    $conn->select_db("items");

    $sql = "CREATE TABLE items (
       id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(40),
        type VARCHAR(40),
        make VARCHAR(40),
        model VARCHAR(40),
        brand VARCHAR(40),
        description VARCHAR(60)
        )";

        if($conn->query($sql) === true){
            echo "Table created successfully<br>";
        } else {
            die("Error creating table: " . $conn->error);
        }

    
    $users = Array();
    $csv = file_get_contents('./input.csv');
    $csv_array = explode("\n", $csv);
    array_shift($csv_array);
    $counter = 0;
    foreach($csv_array as $input){
        if(empty($input)){
            continue;
        }
        $users[] = explode(',', $input);
        if($counter == 0){
            
        }
        
        $counter++;
    }

    $add_user = $conn->prepare("INSERT INTO items (id, name, type, make, model, brand, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $add_user->bind_param("issssss", $id, $name, $type, $make, $model, $brand, $description);

    foreach($users as $item){
        $name = $item[1];
        $type = $item[2];
        $make = $item[3];
        $model = $item[4];
        $brand = $item[5];
        $description = $item[6];
        $add_user->execute();
    }

    $add_user->close();

?>
