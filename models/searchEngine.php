<?php

include('../config/database.php');

if(isset($_POST['search'])) {
    $value = $_POST['search'];

   
    $sql = "SELECT * FROM LoginData WHERE (Firstname LIKE ? OR Lastname LIKE ?)";
    $stmt = $conn->prepare($sql);
    $searchParam = "%$value%";
    $stmt->bind_param("ss", $searchParam, $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td style="text-align: center;">
                    <?= $row['User ID'] ?>
                </td>
                <td>
                    <?= $row['Firstname'] ?>, <?= $row['Lastname'] ?>
                </td>
                <td class="d-grid">
                    <button type="button" 
                    class="btn btn-sm btn-block btn-success" 
                    data-bs-toggle="modal"
                    data-bs-target="#view-details">
                        View
                    </button>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "0 results";
    }

    $stmt->close(); 
} else {
    echo "Search value not provided";
}

$conn->close();
?>
