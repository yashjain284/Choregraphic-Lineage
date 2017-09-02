<?php
include 'path.php';
include 'menu.php';
include 'util.php';
?>

<html>
<head>
  <title>Contribution Welcome Page</title>
</head>
<body>

  <div class="row">
    <div class="column small-12">
      <legend><strong>Welcome</strong></legend>
      <p>Thank you in advance for contributing your lineage. Your contribution is vital to
        building a global resource for dance. The amount of time it will take to fill out
        this form will vary depending on how many artists you include in your lineage. We
        encourage you to take time to include all of the people you have studied with, danced
        for, collaborated with and been influenced by so that this resource can most accurately
        represent the rich network of our field. You can complete your lineage over time by saving it and coming back to finish it when you are ready.</p>
      </div>
    </div>
    <div class="row">
      <div class="column small-12">
        <p>See the network up until now: <a href="#">http://www.choreagraphiclineage.buffalo.edu/Network/index.html</a></p>
      </div>
    </div>
    <!-- <div class="row" style="margin-bottom:5%">
      <div class="column small-6">
        <p>A Brief Description of Choreographic Lineage Project</p>
      </div>
      <div class="column small-6">
        <label for="contribute_show_details">
          <input  autocomplete="off" type="Checkbox" id="contribute_show_details" name="contribute_show_details" >
          Show Details
        </label>
      </div>
    </div> -->
    <div class="row" style="margin-bottom:1%">
      <div class="column small-6">
        <label>
         <input type="radio" id="contribute_online_form" name="contribute_online_form" class="contribute_online_form" value="form">
         Contribute lineage via this online form
       </label>
     </div>
     <div class="column small-6">
      <label>
       <input type="radio" id="contribute_online_form" name="contribute_online_form" class="contribute_online_form" value="phone">
       Contribute lineage via phone
     </label>
   </div>
 </div>
 <div class="row">
  <div class="small-12 column">
    <button class="primary button" name="Welcome_Next_Page" id="next_page">
      <span>Next Page</span>
    </button>
  </div>
</div>
</body>

<script>
    // onclick event is assigned to the #button element.
    $("#next_page").click(function() {
      var contributionType = $(".contribute_online_form:checked").val();
      if(contributionType=="form"){
        document.location.href = "<?php echo $path ?>"+"add_artist_profile.php";
      }
      else{
        document.location.href = "<?php echo $path ?>"+"phone_contribution.php";
      }
    });
  </script>
  <?php
  include 'footer.php';
  ?>
  </html>
