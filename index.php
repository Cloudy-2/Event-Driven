<?php
  
    include 'D:\xamp\htdocs\Event-Driven\config\database.php';

    echo "<br/>";

    $sql = "SELECT * FROM logindata";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      
        while ($row = $result->fetch_assoc()) {
            echo 'LogIn_Data: ' . $row['Email'] . "<br/>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>