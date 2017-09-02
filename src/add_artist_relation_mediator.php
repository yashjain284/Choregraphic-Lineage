<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();

if(isset($_SESSION["artist_profile_id"])){

  include 'connection_open.php';
  $artist_id = $_SESSION["artist_profile_id"];
  $query = "SELECT * FROM artist_profile WHERE artist_profile_id = '$artist_id'";
  $artist_profile = mysql_query($query) or die('Error querying database.: '  .mysql_error($dbc));
  $artist_profile = mysql_fetch_assoc($artist_profile);

  if($artist_profile["artist_first_name"] != ''){
    $_SESSION["artist_first_name"] = $artist_profile["artist_first_name"];
  }
  if($artist_profile["artist_last_name"] != ''){
    $_SESSION["artist_last_name"] = $artist_profile["artist_last_name"];
  }
  if($artist_profile["artist_email_address"] != ''){
    $_SESSION["artist_email_address"] = $artist_profile["artist_email_address"];
  }

  $query = "SELECT * FROM artist_relation WHERE artist_profile_id_1 = '$artist_id' ORDER BY artist_profile_id_2";
  $artist_relations = mysql_query($query) or die('Error querying database.: '  .mysql_error($dbc));

  $lineage_first_name = array();
  $lineage_last_name = array();
  $lineage_website = array();
  $lineage_email_address = array();
  $studied_sd = array();
  $studied_ed = array();
  $studied_years = array();
  $studied_months = array();
  $danced_sd = array();
  $danced_ed = array();
  $danced_years = array();
  $danced_months = array();
  $collaborated_sd = array();
  $collaborated_ed = array();
  $collaborated_years = array();
  $collaborated_months = array();
  $influenced_by = array();

  $temp_artist_id = 0;
  $relation_artist_counter = -1;

  while($row = mysql_fetch_assoc($artist_relations)){
    if($temp_artist_id != $row["artist_profile_id_2"]){
      $temp_artist_id = $row["artist_profile_id_2"];
      $relation_artist_counter = $relation_artist_counter + 1;
      $name = explode("-",$row['artist_name_2']);
      $lineage_first_name[] = $name[0];
      $lineage_last_name[] = $name[1];
      $lineage_email_address[] = $row["artist_email_id_2"];
      $lineage_website[] = $row["artist_website_2"];
      $studied_sd[] = "";
      $studied_ed[] = "";
      $studied_years[] = "";
      $studied_months[] = "";
      $danced_sd[] = "";
      $danced_ed[] = "";
      $danced_years[] = "";
      $danced_months[] = "";
      $collaborated_sd[] = "";
      $collaborated_ed[] = "";
      $collaborated_years[] = "";
      $collaborated_months[] = "";
    }
    if($row["artist_relation"] == "Studied With"){
      $studied_sd[$relation_artist_counter] = ($row["start_date"] == "0000-00-00"?"":$row["start_date"]);
      $studied_ed[$relation_artist_counter] = ($row["end_date"] == "0000-00-00"?"":$row["end_date"]);
      $studied_years[$relation_artist_counter] = $row["duration_years"];
      $studied_months[$relation_artist_counter] = $row["duration_months"];
    }else if($row["artist_relation"] == "Danced For"){
      $danced_sd[$relation_artist_counter] = ($row["start_date"] == "0000-00-00"?"":$row["start_date"]);
      $danced_ed[$relation_artist_counter] = ($row["end_date"] == "0000-00-00"?"":$row["end_date"]);
      $danced_years[$relation_artist_counter] = $row["duration_years"];
      $danced_months[$relation_artist_counter] = $row["duration_months"];
    }else if($row["artist_relation"] == "Collaborated With"){
      $collaborated_sd[$relation_artist_counter] = ($row["start_date"] == "0000-00-00"?"":$row["start_date"]);
      $collaborated_ed[$relation_artist_counter] = ($row["end_date"] == "0000-00-00"?"":$row["end_date"]);
      $collaborated_years[$relation_artist_counter] = $row["duration_years"];
      $collaborated_months[$relation_artist_counter] = $row["duration_months"];
    }else if($row["artist_relation"] == "Influenced By"){
      $influenced_by[$relation_artist_counter] = $relation_artist_counter;
    }
  }
  $_SESSION["lineage_artist_first_name"] = $lineage_first_name;
  $_SESSION["lineage_artist_last_name"] = $lineage_last_name;
  $_SESSION["lineage_artist_email_address"] = $lineage_email_address;
  $_SESSION["lineage_artist_website"] = $lineage_website;
  $_SESSION["studied_start_date"] = $studied_sd;
  $_SESSION["studied_end_date"] = $studied_ed;
  $_SESSION["studied_duration_years"] = $studied_years;
  $_SESSION["studied_duration_months"] = $studied_months;
  $_SESSION["danced_start_date"] = $danced_sd;
  $_SESSION["danced_end_date"] = $danced_ed;
  $_SESSION["danced_duration_years"] = $danced_years;
  $_SESSION["danced_duration_months"] = $danced_months;
  $_SESSION["collaborated_start_date"] = $collaborated_sd;
  $_SESSION["collaborated_end_date"] = $collaborated_ed;
  $_SESSION["collaborated_duration_years"] = $collaborated_years;
  $_SESSION["collaborated_duration_months"] = $collaborated_months;
  $_SESSION["influenced_by"] = $influenced_by;

  include 'connection_close.php';

  $location = "add_lineage.php";
  header("Location: ".$location."");
}
