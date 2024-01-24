<?php

if (isset($_POST['CustomerID']) && isset($_POST['Name']) && isset($_POST['Email'])) {
    require 'connect.php';

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $CustomerID = $_POST['CustomerID'];
    $Name = $_POST['Name'];
    $Email =  $_POST['Email'];

    echo 'CustomerID = ' . $CustomerID;
    echo 'Name = ' . $Name;
    echo 'Email = ' . $Email;


    $sql = "UPDATE customer SET Name = :Name, Email = :Email WHERE CustomerID = :CustomerID";
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':Name', $_POST['Name']);
    $stmt->bindParam(':Email', $_POST['Email']);
    $stmt->bindParam(':CustomerID', $_POST['CustomerID']);


    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if ($stmt->execute()) {
        echo '
        <script type="text/javascript">
        
        $(document).ready(function(){
        
            swal({
                title: "Success!",
                text: "Successfuly update customer information",
                type: "success",
                timer: 2500,
                showConfirmButton: false
              }, function(){
                    window.location.href = "index.php";
              });
        });
        
        </script>
        ';
    }
    $conn = null;
}
