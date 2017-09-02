<?php
    //database configuration
    include 'connection_open.php';
    
    //get search term
    $searchTerm = $_GET['term'];
    $user_email_address = "test@email.com";
    //$searchTerm = '';
    //get matched data from skills table
    $query = $dbc->query("SELECT artist_name FROM artist_profile WHERE artist_name LIKE '%".$searchTerm."%' AND profile_name ='$user_email_address'");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['artist_name'];
    }
    include 'connection_close.php';
    //return json data
    echo json_encode($data);
?>