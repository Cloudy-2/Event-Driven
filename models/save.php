<?php

$registration = array(
    'ApplicationID' => "'" . $_POST['inp_appid'] . "'",
    'TESAwardNumber' => "'" . $_POST['inp_tesno'] . "'",
    'StudentID' => "'" . $_POST['inp_sid'] . "'",
    'FirstName' => "'" . $_POST['inp_fname'] . "'",
    'LastName' => "'" . $_POST['inp_lname'] . "'",
    'ExtName' => "'" . $_POST['inp_ename'] . "'",
    'MiddleName' => "'" . $_POST['inp_mname'] . "'",
    'Gender' => "'" . $_POST['inp_gender'] . "'",
    'ContactNumber' => "'" . $_POST['inp_contact'] . "'",
    'AwardBatch' => "'" . $_POST['inp_batch'] . "'",
    'Status' => "'" . $_POST['inp_status'] . "'",
);

save($registration);

function save($data)
{
    include('../config/database.php');

    $attributes = implode(", ", array_keys($data));
    $values = implode(", ", array_values($data));
    $query = "INSERT INTO registrationform ($attributes) VALUES ($values)";

    if($conn->query($query) === TRUE){
        header('location: registration.php?success');
    }else{
        header('location: registration.php?invalid');
    }

    $conn->close();
}