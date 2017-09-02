<?php
    //database configuration
    include 'connection_open.php';
    
    //get search term
    $searchTerm = $_GET['term'];
    //$searchTerm = '';
    //get matched data from skills table
    $query = $dbc->query("SELECT artist_name FROM artist_profile WHERE artist_name LIKE '%".$searchTerm."%'");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['artist_name'];
    }
    include 'connection_close.php';
    //return json data
    echo json_encode($data);
?>