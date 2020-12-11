<?php
    $servername = "localhost";
    $username = "root";
    $password = "";


    $conn = new mysqli($servername, $username, $password);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->select_db("items");

    $sql = "SELECT * FROM items";
    $user_list = $conn->query($sql);
    $users = array();

    if($user_list->num_rows > 0){
        while($user = $user_list->fetch_assoc()) {
            $users[] = $user;
        }
    } else {
        die("No users found");
    }

    $conn->close();
?>

<!DOCTYPE html>
<html>
    <body>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>TYPE</th>
                    <th>MAKE</th>
                    <th>MODEL</th>
                    <th>BRAND</th>
                    <th>DESCRIPTION</th>
                </tr>
            </thead>
            <tbody>
        <?php
        foreach($users as $user) {
            echo <<<END
            <tr>
                <td>{$user['id']}</td>
                <td>{$user['name']}</td>
                <td>{$user['type']}</td>
                <td>{$user['make']}</td>
                <td>{$user['model']}</td>
                <td>{$user['brand']}</td>
                <td>{$user['description']}</td>
            </tr>
            END;
        }
?>
        </tbody>
    </table>
    </body>
    </html>