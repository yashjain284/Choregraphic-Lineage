<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();
  if(isset($_SESSION["user_email_address"]) && !isset($_SESSION['artist_profile_view'])){
    $first_name = array();
    $last_name = array();
    $email_address = array();
    $website = array();
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

    if(isset($_POST["lineage_artist_first_name"]) && !empty($_POST["lineage_artist_first_name"])){
      $_SESSION["lineage_artist_first_name"] = $_POST["lineage_artist_first_name"];
      $first_name = $_POST["lineage_artist_first_name"];
    }

    if(isset($_POST["lineage_artist_last_name"]) && !empty($_POST["lineage_artist_last_name"])){
      $_SESSION["lineage_artist_last_name"] = $_POST["lineage_artist_last_name"];
      $last_name = $_POST["lineage_artist_last_name"];
    }

    if(isset($_POST["lineage_artist_email_address"]) && !empty($_POST["lineage_artist_email_address"])){
      $_SESSION["lineage_artist_email_address"] = $_POST["lineage_artist_email_address"];
      $email_address = $_POST["lineage_artist_email_address"];
    }

    if(isset($_POST["lineage_artist_website"]) && !empty($_POST["lineage_artist_website"])){
      $_SESSION["lineage_artist_website"] = $_POST["lineage_artist_website"];
      $website = $_POST["lineage_artist_website"];
    }

    if(isset($_POST["studied_start_date"]) && !empty($_POST["studied_start_date"])){
      $_SESSION["studied_start_date"] = $_POST["studied_start_date"];
      $studied_sd = $_POST["studied_start_date"];
    }

    if(isset($_POST["studied_end_date"]) && !empty($_POST["studied_end_date"])){
      $_SESSION["studied_end_date"] = $_POST["studied_end_date"];
      $studied_ed = $_POST["studied_end_date"];
    }

    if(isset($_POST["studied_duration_years"]) && !empty($_POST["studied_duration_years"])){
      $_SESSION["studied_duration_years"] = $_POST["studied_duration_years"];
      $studied_years = $_POST["studied_duration_years"];
    }

    if(isset($_POST["studied_duration_months"]) && !empty($_POST["studied_duration_months"])){
      $_SESSION["studied_duration_months"] = $_POST["studied_duration_months"];
      $studied_months = $_POST["studied_duration_months"];
    }

    if(isset($_POST["danced_start_date"]) && !empty($_POST["danced_start_date"])){
      $_SESSION["danced_start_date"] = $_POST["danced_start_date"];
      $danced_sd = $_POST["danced_start_date"];
    }

    if(isset($_POST["danced_end_date"]) && !empty($_POST["danced_end_date"])){
      $_SESSION["danced_end_date"] = $_POST["danced_end_date"];
      $danced_ed = $_POST["danced_end_date"];
    }

    if(isset($_POST["danced_duration_years"]) && !empty($_POST["danced_duration_years"])){
      $_SESSION["danced_duration_years"] = $_POST["danced_duration_years"];
      $danced_years = $_POST["danced_duration_years"];
    }

    if(isset($_POST["danced_duration_months"]) && !empty($_POST["danced_duration_months"])){
      $_SESSION["danced_duration_months"] = $_POST["danced_duration_months"];
      $danced_months = $_POST["danced_duration_months"];
    }

    if(isset($_POST["collaborated_start_date"]) && !empty($_POST["collaborated_start_date"])){
      $_SESSION["collaborated_start_date"] = $_POST["collaborated_start_date"];
      $collaborated_sd = $_POST["collaborated_start_date"];
    }

    if(isset($_POST["collaborated_end_date"]) && !empty($_POST["collaborated_end_date"])){
      $_SESSION["collaborated_end_date"] = $_POST["collaborated_end_date"];
      $collaborated_ed = $_POST["collaborated_end_date"];
    }

    if(isset($_POST["collaborated_duration_years"]) && !empty($_POST["collaborated_duration_years"])){
      $_SESSION["collaborated_duration_years"] = $_POST["collaborated_duration_years"];
      $collaborated_years = $_POST["collaborated_duration_years"];
    }

    if(isset($_POST["collaborated_duration_months"]) && !empty($_POST["collaborated_duration_months"])){
      $_SESSION["collaborated_duration_months"] = $_POST["collaborated_duration_months"];
      $collaborated_months = $_POST["collaborated_duration_months"];
    }

    if(isset($_POST["relationship_influenced"])){
      foreach ($_POST["relationship_influenced"] as $influenced) {
        $influenced_by[$influenced] = $influenced;
      }
      $_SESSION["influenced_by"] = $influenced_by;
    }

    // if(isset($_POST["influenced_start_date"]) && !empty($_POST["influenced_start_date"])){
    //   $_SESSION["influenced_start_date"] = $_POST["influenced_start_date"];
    //   $influenced_sd = $_POST["influenced_start_date"];
    // }
    //
    // if(isset($_POST["influenced_end_date"]) && !empty($_POST["influenced_end_date"])){
    //   $_SESSION["influenced_end_date"] = $_POST["influenced_end_date"];
    //   $influenced_ed = $_POST["influenced_end_date"];
    // }
    //
    // if(isset($_POST["influenced_duration_years"]) && !empty($_POST["influenced_duration_years"])){
    //   $_SESSION["influenced_duration_years"] = $_POST["influenced_duration_years"];
    //   $influenced_years = $_POST["influenced_duration_years"];
    // }
    //
    // if(isset($_POST["influenced_duration_months"]) && !empty($_POST["influenced_duration_months"])){
    //   $_SESSION["influenced_duration_months"] = $_POST["influenced_duration_months"];
    //   $influenced_months = $_POST["influenced_duration_months"];
    // }

    $artist_id_map = array();
    foreach ($first_name as $key => $value) {
      $artist_id_map[$value.$last_name[$key].$email_address[$key].$website[$key]] = -1;
    }

    /*************/

    include 'connection_open.php';

    $query = "SELECT artist_first_name, artist_last_name, artist_email_address, artist_website, artist_profile_id FROM artist_profile WHERE ";
    foreach($first_name as $key => $value){
      $query .= "(artist_first_name = '".$value."' AND artist_last_name = '".$last_name[$key]."' AND artist_email_address = '".$email_address[$key]."' AND artist_website = '".$website[$key]."') OR ";
    }

    $query = substr($query, 0, -3);
    $result = mysql_query($query) or die('Error querying database.: '  .mysql_error($dbc));

    while($row = mysql_fetch_assoc($result)){
      if($artist_id_map[$row["artist_first_name"].$row["artist_last_name"].$row["artist_email_address"].$row["artist_website"]] == -1){
        $artist_id_map[$row["artist_first_name"].$row["artist_last_name"].$row["artist_email_address"].$row["artist_website"]] = $row["artist_profile_id"];
      }
    }

    if(count($first_name) > mysql_num_rows($result)){
      $artists = array();
      $query = "INSERT INTO artist_profile (artist_first_name, artist_last_name, artist_email_address, artist_website, is_user_artist) VALUES ";
      foreach ($first_name as $key => $value) {
        if($artist_id_map[$value.$last_name[$key].$email_address[$key].$website[$key]] == -1){
          $artists[] = "('".$value."', '".$last_name[$key]."', '".$email_address[$key]."', '".$website[$key]."', 'other')";
        }
      }
      $query .= implode(',', $artists);
      $result = mysql_query($query) or die('Error querying database.: '  .mysql_error($dbc));

      $query = "SELECT artist_first_name, artist_last_name, artist_email_address, artist_website, artist_profile_id FROM artist_profile WHERE ";
      foreach($first_name as $key => $value){
        $query .= "(artist_first_name = '".$value."' AND artist_last_name = '".$last_name[$key]."' AND artist_email_address = '".$email_address[$key]."' AND artist_website = '".$website[$key]."') OR ";
      }

      $query = substr($query, 0, -3);
      $result = mysql_query($query) or die('Error querying database.: '  .mysql_error($dbc));

      while($row = mysql_fetch_assoc($result)){
        if($artist_id_map[$row["artist_first_name"].$row["artist_last_name"].$row["artist_email_address"].$row["artist_website"]] == -1){
          $artist_id_map[$row["artist_first_name"].$row["artist_last_name"].$row["artist_email_address"].$row["artist_website"]] = $row["artist_profile_id"];
        }
      }
    }

    $query = "DELETE FROM artist_relation WHERE artist_profile_id_1='".$_SESSION['artist_profile_id']."'";
    $result = mysql_query($query) or die('Error querying database.: '  .mysql_error($dbc));

    $query = "INSERT INTO artist_relation (artist_profile_id_1, artist_profile_id_2, artist_name_1, artist_name_2, artist_email_id_2,
              artist_website_2, artist_relation, start_date, end_date, duration_years, duration_months) VALUES ";

    foreach($first_name as $key => $value){
      if(($studied_months[$key] != 0 || $studied_years[$key] != 0) && ($studied_months[$key] != "" || $studied_years[$key] != "")){
        $relations[] = "('".$_SESSION['artist_profile_id']."', '".$artist_id_map[$value.$last_name[$key].$email_address[$key].$website[$key]]."',
                       '".$_SESSION['artist_first_name']."-".$_SESSION['artist_last_name']."',
                       '".$value."-".$last_name[$key]."', '$email_address[$key]', '$website[$key]', 'Studied With', '".$studied_sd[$key]."',
                       '".$studied_ed[$key]."', '".$studied_years[$key]."', '".$studied_months[$key]."')";
      }
      if(($danced_months[$key] != 0 || $danced_years[$key] != 0) && ($danced_months[$key] != "" || $danced_years[$key] != "")){
        $relations[] = "('".$_SESSION['artist_profile_id']."', '".$artist_id_map[$value.$last_name[$key].$email_address[$key].$website[$key]]."',
                       '".$_SESSION['artist_first_name']."-".$_SESSION['artist_last_name']."',
                       '".$value."-".$last_name[$key]."', '$email_address[$key]', '$website[$key]', 'Danced For', '".$danced_sd[$key]."',
                       '".$danced_ed[$key]."', '".$danced_years[$key]."', '".$danced_months[$key]."')";
      }
      if(($collaborated_months[$key] != 0 || $collaborated_years[$key] != 0) && ($collaborated_months[$key] != "" || $collaborated_years[$key] != "")){
        $relations[] = "('".$_SESSION['artist_profile_id']."', '".$artist_id_map[$value.$last_name[$key].$email_address[$key].$website[$key]]."',
                       '".$_SESSION['artist_first_name']."-".$_SESSION['artist_last_name']."',
                       '".$value."-".$last_name[$key]."', '$email_address[$key]', '$website[$key]', 'Collaborated With', '".$collaborated_sd[$key]."',
                       '".$collaborated_ed[$key]."', '".$collaborated_years[$key]."', '".$collaborated_months[$key]."')";
      }
      if(isset($influenced_by[$key])){
        $relations[] = "('".$_SESSION['artist_profile_id']."', '".$artist_id_map[$value.$last_name[$key].$email_address[$key].$website[$key]]."',
                       '".$_SESSION['artist_first_name']."-".$_SESSION['artist_last_name']."',
                       '".$value."-".$last_name[$key]."', '$email_address[$key]', '$website[$key]', 'Influenced By', '',
                       '', '', '')";
      }
    }

    $query .= implode(',', $relations);
    $query .= " ON DUPLICATE KEY UPDATE artist_name_1 = VALUES(artist_name_1), artist_name_2 = VALUES(artist_name_2),
              artist_email_id_2 = VALUES(artist_email_id_2), artist_website_2 = VALUES(artist_website_2), start_date = VALUES(start_date),
              end_date = VALUES(end_date), duration_years = VALUES(duration_years), duration_months=VALUES(duration_months)";
    echo $query;
    $result = mysql_query($query) or die('Error querying database.: '  .mysql_error($dbc));
  }
  if(isset($_SESSION["artist_profile_add"])){
    header("Location: thank_you.php");
  }else{
    header("Location: add_user_profile.php");
  }
?>
