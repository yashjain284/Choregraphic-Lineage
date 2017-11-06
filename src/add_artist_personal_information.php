<?php
include 'path.php';
include 'menu.php';
include 'util.php';

my_session_start();

if(isset($_SESSION["user_email_address"]) && !isset($_SESSION['artist_profile_view'])){

	$is_artist = "";
	$first_name = "";
	$last_name = "";
	$email_address = "";
	$status = "";
	$dob = "";
	$dod = "";
	$genre = "";
	$genre_other = "";
	$user_email_address=$_SESSION["user_email_address"];

	if(isset($_POST["profile_selection"]) && !empty($_POST["profile_selection"])){
		$_SESSION["profile_selection"] = $_POST["profile_selection"];
		$is_artist= $_POST["profile_selection"];
	}

	if(isset($_POST["artist_first_name"]) && !empty($_POST["artist_first_name"])){
	  $_SESSION["artist_first_name"] = $_POST["artist_first_name"];
		$first_name = $_POST["artist_first_name"];
	}

	if(isset($_POST["artist_last_name"]) && !empty($_POST["artist_last_name"])){
	  $_SESSION["artist_last_name"] = $_POST["artist_last_name"];
		$last_name = $_POST["artist_last_name"];
	}

	if(isset($_POST["artist_email_address"]) && !empty($_POST["artist_email_address"])){
	  $_SESSION["artist_email_address"] = $_POST["artist_email_address"];
		$email_address = $_POST["artist_email_address"];
	}

	if(isset($_POST["artist_status"]) && !empty($_POST["artist_status"])){
	  $_SESSION["artist_status"] = $_POST["artist_status"];
		$status = $_POST["artist_status"];
	}

	if(isset($_POST["date_of_birth"]) && !empty($_POST["date_of_birth"])){
	  $_SESSION["date_of_birth"] = $_POST["date_of_birth"];
		$dob = $_POST["date_of_birth"];
	}

	if(isset($_POST["date_of_death"]) && !empty($_POST["date_of_death"])){
	  $_SESSION["date_of_death"] = $_POST["date_of_death"];
		$dod = $_POST["date_of_death"];
	}

	if(isset($_POST["artist_genre"]) && !empty($_POST["artist_genre"])){
		if(count($_POST["artist_genre"]) != 0){
			$_SESSION["artist_genre"] = "";
			foreach ($_POST["artist_genre"] as $genrevar) {
				$_SESSION["artist_genre"] = $_SESSION["artist_genre"] . "," . $genrevar;
			}
			$genre = $_SESSION["artist_genre"];
		}
	}

	if(isset($_POST["other_artist_text_input"]) && !empty($_POST["other_artist_text_input"])){
	  $_SESSION["other_artist_text_input"] = $_POST["other_artist_text_input"];
		$genre_other = $_POST["other_artist_text_input"];
	}


	if($is_artist != "" || $first_name != "" || $last_name != "" || $email_address != ""
		|| $status != "" || $dob != "" || $dod != "" || $genre != "" || $genre_other != ""){
		include 'connection_open.php';

		if(!isset($_SESSION["artist_profile_id"])){
			$query = "INSERT INTO artist_profile
			(
			is_user_artist,
			artist_first_name,
			artist_last_name,
			artist_email_address,
			artist_living_status,
			artist_dob,
			artist_dod,
			artist_genre,
			genre_other,
			profile_name)
			VALUES
			(
			'$is_artist',
			'$first_name',
			'$last_name',
			'$email_address',
			'$status',
			'$dob',
			'$dod',
			'$genre',
			'$genre_other',
			'$user_email_address'
			)";

			$result = mysql_query($query)
			or die('Error querying database.: '  .mysql_error($dbc));
			$_SESSION["form_1"] = "completed";
			$query = "SELECT artist_profile_id FROM artist_profile
								WHERE artist_first_name='$first_name' and artist_last_name='$last_name' and artist_email_address='$email_address'";
			$result = mysql_query($query)
			or die('Error querying database.: '  .mysql_error($dbc));
			$count=mysql_num_rows($result);
			if($count==1){
				$row = mysql_fetch_assoc($result);
				$_SESSION["artist_profile_id"] = $row["artist_profile_id"];
			}
		}else{
			$query = "UPDATE artist_profile SET
				is_user_artist='$is_artist',
				artist_first_name='$first_name',
				artist_last_name='$last_name',
				artist_email_address='$email_address',
				artist_living_status='$status',
				artist_dob='$dob',
				artist_dod='$dod',
				artist_genre='$genre',
				genre_other='$genre_other' WHERE artist_profile_id = '".$_SESSION['artist_profile_id']."'";

			$result = mysql_query($query)
			or die('Error querying database.: '  .mysql_error($dbc));
		}
		include 'connection_close.php';
	}
}
if(isset($_SESSION['country_residence'])){
	echo "<script>var country_res='".$_SESSION['country_residence']."';</script>";
}
if(isset($_SESSION['country_birth'])){
	echo "<script>var country_birth='".$_SESSION['country_birth']."';</script>";
}
if(isset($_SESSION['state_residence'])){
	echo "<script>var state_res='".$_SESSION['state_residence']."';</script>";
}
if(isset($_SESSION['artist_profile_view'])){
	echo "<script>var disabled_input=true;</script>";
}else{
	echo "<script>var disabled_input=false;</script>";
}

?>

<html>
<head>
	<title>Personal Information</title>
	<style type="text/css">

	</style>

</head>

<body>
	<?php
	include 'form_links_header.php'
	?>
	<form enctype="multipart/form-data" action="add_artist_biography.php" method="post">
		<!-- Getting gender info-->
		<div class="row">
			<div class="progress" role="progressbar" tabindex="0" aria-valuenow="20" aria-valuemin="0" aria-valuetext="20 percent" aria-valuemax="100">
				<span class="progress-meter" style="width: 20%">
					<p class="progress-meter-text">20%</p>
				</span>
			</div>
		</div>
		<div class="row">
			<p align="middle"><h2><strong>PERSONAL INFORMATION</strong></h2></p>
		</div>
		<div class="row">

			<h5><em>Please tell us more about your self...</em></h5>
		</div>

		<div class="row">
			<fieldset class="large-8 columns">
				<label><legend><strong><?php echo ((isset($_SESSION["profile_selection"]) && ($_SESSION["profile_selection"] == "artist"))?"Your":"Artist") ?> Gender</strong></legend></label>
				<div class="medium-2 column">
					<label for="gender_male">
						<input  autocomplete="off" type="radio" id="gender_male" name="gender" value="male"
						<?php
							if(isset($_SESSION["gender"])){
									echo (($_SESSION["gender"]=='male')?'checked':'');
							}
						?>
						/>
						Male
					</label>
				</div>
				<div class="medium-2 column">
					<label for="gender_female">
						<input  autocomplete="off" type="radio" id="gender_female" name="gender" value="female"
						<?php
							if(isset($_SESSION["gender"])){
									echo (($_SESSION["gender"]=='female')?'checked':'');
							}
						?>
						/>
						Female
					</label>
				</div>
				<div class="medium-2 column">
					<label for="gender_other">
						<input  autocomplete="off" type="radio" id="gender_other" name="gender" value="other"
						<?php
							if(isset($_SESSION["gender"])){
									echo (($_SESSION["gender"]=='other')?'checked':'');
							}
						?>
						/>
						Other
					</label>
				</div>
				<div class="medium-4 column" style="float:left !important;">
					<!-- <label for="gender_other_text" id="gender_other_text_label">
						Please Specify Your Gender:
						<input  autocomplete="off" type="text" id="gender_other_text" name="gender_other"
						value="<?php echo isset($_SESSION['gender_other'])?$_SESSION['gender_other']:'' ?>" />
					</label> -->
				</div>
			</fieldset>
		</div>
		<!-- Getting Ethnicity info -->
		<div class="row">
			<fieldset class="large-10 columns">
				<label><legend><strong><?php echo ((isset($_SESSION["profile_selection"]) && $_SESSION["profile_selection"] == "artist")?"Your":"Artist") ?> Ethnicity</strong></legend></label>
				<div class="medium-3 column">
					<label for="ethnicity_cw">
						<input  autocomplete="off" type="radio" id="ethnicity_cw" name="ethnicity" value="cw"
						<?php
							if(isset($_SESSION["ethnicity"])){
									echo (($_SESSION["ethnicity"]=='cw')?'checked':'');
							}
						?>
						/>
						Caucasian or White
					</label>
				</div>
				<div class="medium-3 column">
					<label for="ethnicity_aab">
						<input  autocomplete="off" type="radio" id="ethnicity_aab" name="ethnicity" value="aab"
						<?php
							if(isset($_SESSION["ethnicity"])){
									echo (($_SESSION["ethnicity"]=='aab')?'checked':'');
							}
						?>
						/>
						African American or Black
					</label>
				</div>
				<div class="medium-3 column">
					<label for="ethnicity_hl">
						<input  autocomplete="off" type="radio" id="ethnicity_hl" name="ethnicity" value="hl"
						<?php
							if(isset($_SESSION["ethnicity"])){
									echo (($_SESSION["ethnicity"]=='hl')?'checked':'');
							}
						?>
						/>
						Hispanic or Latino
					</label>
				</div>
				<div class="medium-3 column">
					<label for="ethnicity_asian">
						<input  autocomplete="off" type="radio" id="ethnicity_asian" name="ethnicity" value="asian"
						<?php
							if(isset($_SESSION["ethnicity"])){
									echo (($_SESSION["ethnicity"]=='asian')?'checked':'');
							}
						?>
						/>
						Asian
					</label>
				</div>
				<div class="medium-3 column">
					<label for="ethnicity_ani">
						<input  autocomplete="off" type="radio" id="ethnicity_ani" name="ethnicity" value="ani"
						<?php
							if(isset($_SESSION["ethnicity"])){
									echo (($_SESSION["ethnicity"]=='ani')?'checked':'');
							}
						?>
						/>
						Alaskan National or Indian
					</label>
				</div>
				<div class="medium-3 column">
					<label for="ethnicity_hpi">
						<input  autocomplete="off" type="radio" id="ethnicity_hpi" name="ethnicity" value="hsp"
						<?php
							if(isset($_SESSION["ethnicity"])){
									echo (($_SESSION["ethnicity"]=='hsp')?'checked':'');
							}
						?>
						/>
						Hawaiian or Pacific Islander
					</label>
				</div>
				<div class="medium-3 column">
					<label for="ethnicity_other">
						<input  autocomplete="off" type="radio" id="ethnicity_other" name="ethnicity" value="other"
						<?php
							if(isset($_SESSION["ethnicity"])){
									echo (($_SESSION["ethnicity"]=='other')?'checked':'');
							}
						?>
						/>
						Other
					</label>
				</div>
				<div class="medium-3 column" style="float:left !important;">
					<label for="ethnicity_other_text" id="ethnicity_other_text_label">
						Please Specify Your ethnicity:
						<input  autocomplete="off" type="text" id="ethnicity_other_text" name="ethnicity_other"
						value="<?php echo isset($_SESSION['ethnicity_other'])?$_SESSION['ethnicity_other']:'' ?>" />
					</label>
				</div>
			</fieldset>
		</div>

		<!-- Getting Date of Birth info -->
		<?php if(isset($_SESSION["profile_selection"]) && $_SESSION["profile_selection"] == "artist"): ?>
			<div class="row">
				<fieldset class="large-2 columns">
					<label><legend><strong>Your Date of Birth</strong></legend>
						<input type="text" class="date_of_birth" id="date_of_birth" placeholder="mm-dd-yyyy" name="date_of_birth" required
						value="<?php echo isset($_SESSION['date_of_birth'])?$_SESSION['date_of_birth']:'' ?>" />
					</label>
				</fieldset>
			</div>
		<?php endif; ?>
		<!-- Getting Address info -->
		<div class="row">
			<fieldset class="large-10 columns">
				<div class="row">
					<div class="medium-4 columns shrink">
						<label for="city" class="text-left middle"><legend><strong>City of Residence</strong></legend>
							<input type="text" id="city" placeholder="City" name= "city_residence"
							value="<?php echo (isset($_SESSION['city_residence'])?$_SESSION['city_residence']:'') ?>" />
						</label>
					</div>
					<div class="medium-4 columns country_residence">
						<label for="country_residence" class="text-left middle"><legend><strong>Country of residence</strong></legend>
							<select id=country_residence name="country_residence"
							value="<?php echo (isset($_SESSION['country_residence'])?$_SESSION['country_residence']:'') ?>" />
								<option value="">Select your country</option>
								<option value="Afganistan">Afghanistan</option>
								<option value="Albania">Albania</option>
								<option value="Algeria">Algeria</option>
								<option value="American Samoa">American Samoa</option>
								<option value="Andorra">Andorra</option>
								<option value="Angola">Angola</option>
								<option value="Anguilla">Anguilla</option>
								<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
								<option value="Argentina">Argentina</option>
								<option value="Armenia">Armenia</option>
								<option value="Aruba">Aruba</option>
								<option value="Australia">Australia</option>
								<option value="Austria">Austria</option>
								<option value="Azerbaijan">Azerbaijan</option>
								<option value="Bahamas">Bahamas</option>
								<option value="Bahrain">Bahrain</option>
								<option value="Bangladesh">Bangladesh</option>
								<option value="Barbados">Barbados</option>
								<option value="Belarus">Belarus</option>
								<option value="Belgium">Belgium</option>
								<option value="Belize">Belize</option>
								<option value="Benin">Benin</option>
								<option value="Bermuda">Bermuda</option>
								<option value="Bhutan">Bhutan</option>
								<option value="Bolivia">Bolivia</option>
								<option value="Bonaire">Bonaire</option>
								<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
								<option value="Botswana">Botswana</option>
								<option value="Brazil">Brazil</option>
								<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
								<option value="Brunei">Brunei</option>
								<option value="Bulgaria">Bulgaria</option>
								<option value="Burkina Faso">Burkina Faso</option>
								<option value="Burundi">Burundi</option>
								<option value="Cambodia">Cambodia</option>
								<option value="Cameroon">Cameroon</option>
								<option value="Canada">Canada</option>
								<option value="Canary Islands">Canary Islands</option>
								<option value="Cape Verde">Cape Verde</option>
								<option value="Cayman Islands">Cayman Islands</option>
								<option value="Central African Republic">Central African Republic</option>
								<option value="Chad">Chad</option>
								<option value="Channel Islands">Channel Islands</option>
								<option value="Chile">Chile</option>
								<option value="China">China</option>
								<option value="Christmas Island">Christmas Island</option>
								<option value="Cocos Island">Cocos Island</option>
								<option value="Colombia">Colombia</option>
								<option value="Comoros">Comoros</option>
								<option value="Congo">Congo</option>
								<option value="Cook Islands">Cook Islands</option>
								<option value="Costa Rica">Costa Rica</option>
								<option value="Cote DIvoire">Cote D'Ivoire</option>
								<option value="Croatia">Croatia</option>
								<option value="Cuba">Cuba</option>
								<option value="Curaco">Curacao</option>
								<option value="Cyprus">Cyprus</option>
								<option value="Czech Republic">Czech Republic</option>
								<option value="Denmark">Denmark</option>
								<option value="Djibouti">Djibouti</option>
								<option value="Dominica">Dominica</option>
								<option value="Dominican Republic">Dominican Republic</option>
								<option value="East Timor">East Timor</option>
								<option value="Ecuador">Ecuador</option>
								<option value="Egypt">Egypt</option>
								<option value="El Salvador">El Salvador</option>
								<option value="Equatorial Guinea">Equatorial Guinea</option>
								<option value="Eritrea">Eritrea</option>
								<option value="Estonia">Estonia</option>
								<option value="Ethiopia">Ethiopia</option>
								<option value="Falkland Islands">Falkland Islands</option>
								<option value="Faroe Islands">Faroe Islands</option>
								<option value="Fiji">Fiji</option>
								<option value="Finland">Finland</option>
								<option value="France">France</option>
								<option value="French Guiana">French Guiana</option>
								<option value="French Polynesia">French Polynesia</option>
								<option value="French Southern Ter">French Southern Ter</option>
								<option value="Gabon">Gabon</option>
								<option value="Gambia">Gambia</option>
								<option value="Georgia">Georgia</option>
								<option value="Germany">Germany</option>
								<option value="Ghana">Ghana</option>
								<option value="Gibraltar">Gibraltar</option>
								<option value="Great Britain">Great Britain</option>
								<option value="Greece">Greece</option>
								<option value="Greenland">Greenland</option>
								<option value="Grenada">Grenada</option>
								<option value="Guadeloupe">Guadeloupe</option>
								<option value="Guam">Guam</option>
								<option value="Guatemala">Guatemala</option>
								<option value="Guinea">Guinea</option>
								<option value="Guyana">Guyana</option>
								<option value="Haiti">Haiti</option>
								<option value="Hawaii">Hawaii</option>
								<option value="Honduras">Honduras</option>
								<option value="Hong Kong">Hong Kong</option>
								<option value="Hungary">Hungary</option>
								<option value="Iceland">Iceland</option>
								<option value="India">India</option>
								<option value="Indonesia">Indonesia</option>
								<option value="Iran">Iran</option>
								<option value="Iraq">Iraq</option>
								<option value="Ireland">Ireland</option>
								<option value="Isle of Man">Isle of Man</option>
								<option value="Israel">Israel</option>
								<option value="Italy">Italy</option>
								<option value="Jamaica">Jamaica</option>
								<option value="Japan">Japan</option>
								<option value="Jordan">Jordan</option>
								<option value="Kazakhstan">Kazakhstan</option>
								<option value="Kenya">Kenya</option>
								<option value="Kiribati">Kiribati</option>
								<option value="Korea North">Korea North</option>
								<option value="Korea Sout">Korea South</option>
								<option value="Kuwait">Kuwait</option>
								<option value="Kyrgyzstan">Kyrgyzstan</option>
								<option value="Laos">Laos</option>
								<option value="Latvia">Latvia</option>
								<option value="Lebanon">Lebanon</option>
								<option value="Lesotho">Lesotho</option>
								<option value="Liberia">Liberia</option>
								<option value="Libya">Libya</option>
								<option value="Liechtenstein">Liechtenstein</option>
								<option value="Lithuania">Lithuania</option>
								<option value="Luxembourg">Luxembourg</option>
								<option value="Macau">Macau</option>
								<option value="Macedonia">Macedonia</option>
								<option value="Madagascar">Madagascar</option>
								<option value="Malaysia">Malaysia</option>
								<option value="Malawi">Malawi</option>
								<option value="Maldives">Maldives</option>
								<option value="Mali">Mali</option>
								<option value="Malta">Malta</option>
								<option value="Marshall Islands">Marshall Islands</option>
								<option value="Martinique">Martinique</option>
								<option value="Mauritania">Mauritania</option>
								<option value="Mauritius">Mauritius</option>
								<option value="Mayotte">Mayotte</option>
								<option value="Mexico">Mexico</option>
								<option value="Midway Islands">Midway Islands</option>
								<option value="Moldova">Moldova</option>
								<option value="Monaco">Monaco</option>
								<option value="Mongolia">Mongolia</option>
								<option value="Montserrat">Montserrat</option>
								<option value="Morocco">Morocco</option>
								<option value="Mozambique">Mozambique</option>
								<option value="Myanmar">Myanmar</option>
								<option value="Nambia">Nambia</option>
								<option value="Nauru">Nauru</option>
								<option value="Nepal">Nepal</option>
								<option value="Netherland Antilles">Netherland Antilles</option>
								<option value="Netherlands">Netherlands (Holland, Europe)</option>
								<option value="Nevis">Nevis</option>
								<option value="New Caledonia">New Caledonia</option>
								<option value="New Zealand">New Zealand</option>
								<option value="Nicaragua">Nicaragua</option>
								<option value="Niger">Niger</option>
								<option value="Nigeria">Nigeria</option>
								<option value="Niue">Niue</option>
								<option value="Norfolk Island">Norfolk Island</option>
								<option value="Norway">Norway</option>
								<option value="Oman">Oman</option>
								<option value="Pakistan">Pakistan</option>
								<option value="Palau Island">Palau Island</option>
								<option value="Palestine">Palestine</option>
								<option value="Panama">Panama</option>
								<option value="Papua New Guinea">Papua New Guinea</option>
								<option value="Paraguay">Paraguay</option>
								<option value="Peru">Peru</option>
								<option value="Phillipines">Philippines</option>
								<option value="Pitcairn Island">Pitcairn Island</option>
								<option value="Poland">Poland</option>
								<option value="Portugal">Portugal</option>
								<option value="Puerto Rico">Puerto Rico</option>
								<option value="Qatar">Qatar</option>
								<option value="Republic of Montenegro">Republic of Montenegro</option>
								<option value="Republic of Serbia">Republic of Serbia</option>
								<option value="Reunion">Reunion</option>
								<option value="Romania">Romania</option>
								<option value="Russia">Russia</option>
								<option value="Rwanda">Rwanda</option>
								<option value="St Barthelemy">St Barthelemy</option>
								<option value="St Eustatius">St Eustatius</option>
								<option value="St Helena">St Helena</option>
								<option value="St Kitts-Nevis">St Kitts-Nevis</option>
								<option value="St Lucia">St Lucia</option>
								<option value="St Maarten">St Maarten</option>
								<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
								<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
								<option value="Saipan">Saipan</option>
								<option value="Samoa">Samoa</option>
								<option value="Samoa American">Samoa American</option>
								<option value="San Marino">San Marino</option>
								<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
								<option value="Saudi Arabia">Saudi Arabia</option>
								<option value="Senegal">Senegal</option>
								<option value="Serbia">Serbia</option>
								<option value="Seychelles">Seychelles</option>
								<option value="Sierra Leone">Sierra Leone</option>
								<option value="Singapore">Singapore</option>
								<option value="Slovakia">Slovakia</option>
								<option value="Slovenia">Slovenia</option>
								<option value="Solomon Islands">Solomon Islands</option>
								<option value="Somalia">Somalia</option>
								<option value="South Africa">South Africa</option>
								<option value="Spain">Spain</option>
								<option value="Sri Lanka">Sri Lanka</option>
								<option value="Sudan">Sudan</option>
								<option value="Suriname">Suriname</option>
								<option value="Swaziland">Swaziland</option>
								<option value="Sweden">Sweden</option>
								<option value="Switzerland">Switzerland</option>
								<option value="Syria">Syria</option>
								<option value="Tahiti">Tahiti</option>
								<option value="Taiwan">Taiwan</option>
								<option value="Tajikistan">Tajikistan</option>
								<option value="Tanzania">Tanzania</option>
								<option value="Thailand">Thailand</option>
								<option value="Togo">Togo</option>
								<option value="Tokelau">Tokelau</option>
								<option value="Tonga">Tonga</option>
								<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
								<option value="Tunisia">Tunisia</option>
								<option value="Turkey">Turkey</option>
								<option value="Turkmenistan">Turkmenistan</option>
								<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
								<option value="Tuvalu">Tuvalu</option>
								<option value="Uganda">Uganda</option>
								<option value="Ukraine">Ukraine</option>
								<option value="United Arab Erimates">United Arab Emirates</option>
								<option value="United Kingdom">United Kingdom</option>
								<option value="United States of America">United States of America</option>
								<option value="Uraguay">Uruguay</option>
								<option value="Uzbekistan">Uzbekistan</option>
								<option value="Vanuatu">Vanuatu</option>
								<option value="Vatican City State">Vatican City State</option>
								<option value="Venezuela">Venezuela</option>
								<option value="Vietnam">Vietnam</option>
								<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
								<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
								<option value="Wake Island">Wake Island</option>
								<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
								<option value="Yemen">Yemen</option>
								<option value="Zaire">Zaire</option>
								<option value="Zambia">Zambia</option>
								<option value="Zimbabwe">Zimbabwe</option>
							</select>
						</label>
					</div>
					<div class="medium-4 columns" id="states_US">
						<label for="state_residence" class="text-left middle"><legend><strong>State of Residence</strong></legend>
							<select id="state_residence" name="state_residence"
							value="<?php echo (isset($_SESSION['state_residence'])?$_SESSION['state_residence']:'') ?>" />
								<option value="">Select your state</option>
								<option  value="AL">Alabama</option>
								<option  value="AK">Alaska</option>
								<option  value="AZ">Arizona</option>
								<option  value="AR">Arkansas</option>
								<option  value="CA">California</option>
								<option  value="CO">Colorado</option>
								<option  value="CT">Connecticut</option>
								<option  value="DE">Delaware</option>
								<option  value="DC">District Of Columbia</option>
								<option  value="FL">Florida</option>
								<option  value="GA">Georgia</option>
								<option  value="HI">Hawaii</option>
								<option  value="ID">Idaho</option>
								<option  value="IL">Illinois</option>
								<option  value="IN">Indiana</option>
								<option  value="IA">Iowa</option>
								<option  value="KS">Kansas</option>
								<option  value="KY">Kentucky</option>
								<option  value="LA">Louisiana</option>
								<option  value="ME">Maine</option>
								<option  value="MD">Maryland</option>
								<option  value="MA">Massachusetts</option>
								<option  value="MI">Michigan</option>
								<option  value="MN">Minnesota</option>
								<option  value="MS">Mississippi</option>
								<option  value="MO">Missouri</option>
								<option  value="MT">Montana</option>
								<option  value="NE">Nebraska</option>
								<option  value="NV">Nevada</option>
								<option  value="NH">New Hampshire</option>
								<option  value="NJ">New Jersey</option>
								<option  value="NM">New Mexico</option>
								<option  value="NY">New York</option>
								<option  value="NC">North Carolina</option>
								<option  value="ND">North Dakota</option>
								<option  value="OH">Ohio</option>
								<option  value="OK">Oklahoma</option>
								<option  value="OR">Oregon</option>
								<option  value="PA">Pennsylvania</option>
								<option  value="RI">Rhode Island</option>
								<option  value="SC">South Carolina</option>
								<option  value="SD">South Dakota</option>
								<option  value="TN">Tennessee</option>
								<option  value="TX">Texas</option>
								<option  value="UT">Utah</option>
								<option  value="VT">Vermont</option>
								<option  value="VA">Virginia</option>
								<option  value="WA">Washington</option>
								<option  value="WV">West Virginia</option>
								<option  value="WI">Wisconsin</option>
								<option  value="WY">Wyoming</option>
							</select>
						</label>
					</div>
					<div class="medium-4 columns" id="states_international">
						<label for="state_province" class="text-left middle"><legend><strong>State/Province of Residence</strong></legend>
							<input autocomplete="off" type="text" id="state_province" name="state_province" placeholder="Enter your state or province"
							value="<?php echo (isset($_SESSION['state_province'])?$_SESSION['state_province']:'') ?>" />
						</label>
					</div>
					<div class="columns"></div>
				</div>

				<div class="row">
					<div class="large-3 columns country_birth">
						<label><legend><strong>Country you were born in</strong></legend>
							<select name="country_birth" 
							value="<?php echo isset($_SESSION['country_birth'])?$_SESSION['country_birth']:'' ?>" />
								<option value="">Select your country</option>
								<option value="Afganistan">Afghanistan</option>
								<option value="Albania">Albania</option>
								<option value="Algeria">Algeria</option>
								<option value="American Samoa">American Samoa</option>
								<option value="Andorra">Andorra</option>
								<option value="Angola">Angola</option>
								<option value="Anguilla">Anguilla</option>
								<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
								<option value="Argentina">Argentina</option>
								<option value="Armenia">Armenia</option>
								<option value="Aruba">Aruba</option>
								<option value="Australia">Australia</option>
								<option value="Austria">Austria</option>
								<option value="Azerbaijan">Azerbaijan</option>
								<option value="Bahamas">Bahamas</option>
								<option value="Bahrain">Bahrain</option>
								<option value="Bangladesh">Bangladesh</option>
								<option value="Barbados">Barbados</option>
								<option value="Belarus">Belarus</option>
								<option value="Belgium">Belgium</option>
								<option value="Belize">Belize</option>
								<option value="Benin">Benin</option>
								<option value="Bermuda">Bermuda</option>
								<option value="Bhutan">Bhutan</option>
								<option value="Bolivia">Bolivia</option>
								<option value="Bonaire">Bonaire</option>
								<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
								<option value="Botswana">Botswana</option>
								<option value="Brazil">Brazil</option>
								<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
								<option value="Brunei">Brunei</option>
								<option value="Bulgaria">Bulgaria</option>
								<option value="Burkina Faso">Burkina Faso</option>
								<option value="Burundi">Burundi</option>
								<option value="Cambodia">Cambodia</option>
								<option value="Cameroon">Cameroon</option>
								<option value="Canada">Canada</option>
								<option value="Canary Islands">Canary Islands</option>
								<option value="Cape Verde">Cape Verde</option>
								<option value="Cayman Islands">Cayman Islands</option>
								<option value="Central African Republic">Central African Republic</option>
								<option value="Chad">Chad</option>
								<option value="Channel Islands">Channel Islands</option>
								<option value="Chile">Chile</option>
								<option value="China">China</option>
								<option value="Christmas Island">Christmas Island</option>
								<option value="Cocos Island">Cocos Island</option>
								<option value="Colombia">Colombia</option>
								<option value="Comoros">Comoros</option>
								<option value="Congo">Congo</option>
								<option value="Cook Islands">Cook Islands</option>
								<option value="Costa Rica">Costa Rica</option>
								<option value="Cote DIvoire">Cote D'Ivoire</option>
								<option value="Croatia">Croatia</option>
								<option value="Cuba">Cuba</option>
								<option value="Curaco">Curacao</option>
								<option value="Cyprus">Cyprus</option>
								<option value="Czech Republic">Czech Republic</option>
								<option value="Denmark">Denmark</option>
								<option value="Djibouti">Djibouti</option>
								<option value="Dominica">Dominica</option>
								<option value="Dominican Republic">Dominican Republic</option>
								<option value="East Timor">East Timor</option>
								<option value="Ecuador">Ecuador</option>
								<option value="Egypt">Egypt</option>
								<option value="El Salvador">El Salvador</option>
								<option value="Equatorial Guinea">Equatorial Guinea</option>
								<option value="Eritrea">Eritrea</option>
								<option value="Estonia">Estonia</option>
								<option value="Ethiopia">Ethiopia</option>
								<option value="Falkland Islands">Falkland Islands</option>
								<option value="Faroe Islands">Faroe Islands</option>
								<option value="Fiji">Fiji</option>
								<option value="Finland">Finland</option>
								<option value="France">France</option>
								<option value="French Guiana">French Guiana</option>
								<option value="French Polynesia">French Polynesia</option>
								<option value="French Southern Ter">French Southern Ter</option>
								<option value="Gabon">Gabon</option>
								<option value="Gambia">Gambia</option>
								<option value="Georgia">Georgia</option>
								<option value="Germany">Germany</option>
								<option value="Ghana">Ghana</option>
								<option value="Gibraltar">Gibraltar</option>
								<option value="Great Britain">Great Britain</option>
								<option value="Greece">Greece</option>
								<option value="Greenland">Greenland</option>
								<option value="Grenada">Grenada</option>
								<option value="Guadeloupe">Guadeloupe</option>
								<option value="Guam">Guam</option>
								<option value="Guatemala">Guatemala</option>
								<option value="Guinea">Guinea</option>
								<option value="Guyana">Guyana</option>
								<option value="Haiti">Haiti</option>
								<option value="Hawaii">Hawaii</option>
								<option value="Honduras">Honduras</option>
								<option value="Hong Kong">Hong Kong</option>
								<option value="Hungary">Hungary</option>
								<option value="Iceland">Iceland</option>
								<option value="India">India</option>
								<option value="Indonesia">Indonesia</option>
								<option value="Iran">Iran</option>
								<option value="Iraq">Iraq</option>
								<option value="Ireland">Ireland</option>
								<option value="Isle of Man">Isle of Man</option>
								<option value="Israel">Israel</option>
								<option value="Italy">Italy</option>
								<option value="Jamaica">Jamaica</option>
								<option value="Japan">Japan</option>
								<option value="Jordan">Jordan</option>
								<option value="Kazakhstan">Kazakhstan</option>
								<option value="Kenya">Kenya</option>
								<option value="Kiribati">Kiribati</option>
								<option value="Korea North">Korea North</option>
								<option value="Korea Sout">Korea South</option>
								<option value="Kuwait">Kuwait</option>
								<option value="Kyrgyzstan">Kyrgyzstan</option>
								<option value="Laos">Laos</option>
								<option value="Latvia">Latvia</option>
								<option value="Lebanon">Lebanon</option>
								<option value="Lesotho">Lesotho</option>
								<option value="Liberia">Liberia</option>
								<option value="Libya">Libya</option>
								<option value="Liechtenstein">Liechtenstein</option>
								<option value="Lithuania">Lithuania</option>
								<option value="Luxembourg">Luxembourg</option>
								<option value="Macau">Macau</option>
								<option value="Macedonia">Macedonia</option>
								<option value="Madagascar">Madagascar</option>
								<option value="Malaysia">Malaysia</option>
								<option value="Malawi">Malawi</option>
								<option value="Maldives">Maldives</option>
								<option value="Mali">Mali</option>
								<option value="Malta">Malta</option>
								<option value="Marshall Islands">Marshall Islands</option>
								<option value="Martinique">Martinique</option>
								<option value="Mauritania">Mauritania</option>
								<option value="Mauritius">Mauritius</option>
								<option value="Mayotte">Mayotte</option>
								<option value="Mexico">Mexico</option>
								<option value="Midway Islands">Midway Islands</option>
								<option value="Moldova">Moldova</option>
								<option value="Monaco">Monaco</option>
								<option value="Mongolia">Mongolia</option>
								<option value="Montserrat">Montserrat</option>
								<option value="Morocco">Morocco</option>
								<option value="Mozambique">Mozambique</option>
								<option value="Myanmar">Myanmar</option>
								<option value="Nambia">Nambia</option>
								<option value="Nauru">Nauru</option>
								<option value="Nepal">Nepal</option>
								<option value="Netherland Antilles">Netherland Antilles</option>
								<option value="Netherlands">Netherlands (Holland, Europe)</option>
								<option value="Nevis">Nevis</option>
								<option value="New Caledonia">New Caledonia</option>
								<option value="New Zealand">New Zealand</option>
								<option value="Nicaragua">Nicaragua</option>
								<option value="Niger">Niger</option>
								<option value="Nigeria">Nigeria</option>
								<option value="Niue">Niue</option>
								<option value="Norfolk Island">Norfolk Island</option>
								<option value="Norway">Norway</option>
								<option value="Oman">Oman</option>
								<option value="Pakistan">Pakistan</option>
								<option value="Palau Island">Palau Island</option>
								<option value="Palestine">Palestine</option>
								<option value="Panama">Panama</option>
								<option value="Papua New Guinea">Papua New Guinea</option>
								<option value="Paraguay">Paraguay</option>
								<option value="Peru">Peru</option>
								<option value="Phillipines">Philippines</option>
								<option value="Pitcairn Island">Pitcairn Island</option>
								<option value="Poland">Poland</option>
								<option value="Portugal">Portugal</option>
								<option value="Puerto Rico">Puerto Rico</option>
								<option value="Qatar">Qatar</option>
								<option value="Republic of Montenegro">Republic of Montenegro</option>
								<option value="Republic of Serbia">Republic of Serbia</option>
								<option value="Reunion">Reunion</option>
								<option value="Romania">Romania</option>
								<option value="Russia">Russia</option>
								<option value="Rwanda">Rwanda</option>
								<option value="St Barthelemy">St Barthelemy</option>
								<option value="St Eustatius">St Eustatius</option>
								<option value="St Helena">St Helena</option>
								<option value="St Kitts-Nevis">St Kitts-Nevis</option>
								<option value="St Lucia">St Lucia</option>
								<option value="St Maarten">St Maarten</option>
								<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
								<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
								<option value="Saipan">Saipan</option>
								<option value="Samoa">Samoa</option>
								<option value="Samoa American">Samoa American</option>
								<option value="San Marino">San Marino</option>
								<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
								<option value="Saudi Arabia">Saudi Arabia</option>
								<option value="Senegal">Senegal</option>
								<option value="Serbia">Serbia</option>
								<option value="Seychelles">Seychelles</option>
								<option value="Sierra Leone">Sierra Leone</option>
								<option value="Singapore">Singapore</option>
								<option value="Slovakia">Slovakia</option>
								<option value="Slovenia">Slovenia</option>
								<option value="Solomon Islands">Solomon Islands</option>
								<option value="Somalia">Somalia</option>
								<option value="South Africa">South Africa</option>
								<option value="Spain">Spain</option>
								<option value="Sri Lanka">Sri Lanka</option>
								<option value="Sudan">Sudan</option>
								<option value="Suriname">Suriname</option>
								<option value="Swaziland">Swaziland</option>
								<option value="Sweden">Sweden</option>
								<option value="Switzerland">Switzerland</option>
								<option value="Syria">Syria</option>
								<option value="Tahiti">Tahiti</option>
								<option value="Taiwan">Taiwan</option>
								<option value="Tajikistan">Tajikistan</option>
								<option value="Tanzania">Tanzania</option>
								<option value="Thailand">Thailand</option>
								<option value="Togo">Togo</option>
								<option value="Tokelau">Tokelau</option>
								<option value="Tonga">Tonga</option>
								<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
								<option value="Tunisia">Tunisia</option>
								<option value="Turkey">Turkey</option>
								<option value="Turkmenistan">Turkmenistan</option>
								<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
								<option value="Tuvalu">Tuvalu</option>
								<option value="Uganda">Uganda</option>
								<option value="Ukraine">Ukraine</option>
								<option value="United Arab Erimates">United Arab Emirates</option>
								<option value="United Kingdom">United Kingdom</option>
								<option value="United States of America">United States of America</option>
								<option value="Uraguay">Uruguay</option>
								<option value="Uzbekistan">Uzbekistan</option>
								<option value="Vanuatu">Vanuatu</option>
								<option value="Vatican City State">Vatican City State</option>
								<option value="Venezuela">Venezuela</option>
								<option value="Vietnam">Vietnam</option>
								<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
								<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
								<option value="Wake Island">Wake Island</option>
								<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
								<option value="Yemen">Yemen</option>
								<option value="Zaire">Zaire</option>
								<option value="Zambia">Zambia</option>
								<option value="Zimbabwe">Zimbabwe</option>
							</select>
						</label>
					</div>
					<div class="columns"></div>
				</div>

			</fieldset>
		</div>



		<div class="row">
			<p align="middle"><h2><strong>EDUCATIONAL INFORMATION</strong></h2></p>
		</div>

		<div class="row">
			<legend><strong>University/College</strong></legend>
			<div class="medium-12 column">
				<?php if(isset($_SESSION['university']) && count($_SESSION['university']) > 0): ?>
					<?php foreach ($_SESSION['university'] as $key => $value): ?>
						<div id="education_entries" class="row education_entries">
							<div class="small-3 column">
								<label for="university_name">University Name
									<input type="text" class="university_name" id="university_name" name="university[]"
									placeholder="Name of the school/University" 
									value="<?php echo $value ?>"
									/>
								</label>
							</div>
							<div class="small-3 column">
								<label for="major">Major
									<input type="text" class="major" id="major" name="major[]" placeholder="Name of the Major" 
									value="<?php echo $_SESSION['major'][$key] ?>" />
								</label>
							</div>
							<div class="small-3 column">
								<label for="degree">Degree
									<input type="text" class="degree" id="degree" name="degree[]" placeholder="Name of the degree earned"
									value="<?php echo $_SESSION['degree'][$key] ?>" />
								</label>
							</div>
							<div class="small-3 column">
								<label for="delete_college_education"><span><br></span>
									<button type="button" id="delete_college_education" class="alert button delete_education_entry education_button"><span>Delete</span></button>
								</label>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div id="education_entries" class="row education_entries">
						<div class="small-3 column">
							<label for="university_name">University Name
								<input type="text" class="university_name" id="university_name" name="university[]" placeholder="Name of the school/University" >
							</label>
						</div>
						<div class="small-3 column">
							<label for="major">Major
								<input type="text" class="major" id="major" name="major[]" placeholder="Name of the Major" >
							</label>
						</div>
						<div class="small-3 column">
							<label for="degree">Degree
								<input type="text" class="degree" id="degree" name="degree[]" placeholder="Name of the degree earned">
							</label>
						</div>
						<div class="small-3 column">
							<label for="delete_college_education"><span><br></span>
								<button type="button" id="delete_college_education" class="alert button delete_education_entry education_button"><span>Delete</span></button>
							</label>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<div class="row">
				<div class="large-4 large-centered column">
					<button class="success button education_button" id="addUniversity" type="button">
						<span>Add another college/university</span>
					</button>
				</div>
			</div>

		</div>

		<div class="row">
			<legend><strong>Other Education (Non University/College)</strong></legend>
			<div class="medium-12 column">

			<?php if(isset($_SESSION['institution_name']) && count($_SESSION['institution_name']) > 0): ?>
				<?php foreach ($_SESSION['institution_name'] as $key => $value): ?>
					<div id="other_education_entries" class="row other_education_entries">
						<div class="small-5 column">
							<label for="institution_name">Institution Name
								<input type="text" class="institution_name" id="institution_name" name="institution_name[]"
								placeholder="Name of the Institution" 
								value="<?php echo $value ?>"
								/>
							</label>
						</div>
						<div class="small-4 column">
							<label for="other_degree">Degree, Certificate or Training
								<input type="text" class="other_degree" id="other_degree" name="other_degree[]"
								placeholder="Name of the Degree, Certificate or Training" 
								value="<?php echo $_SESSION['other_degree'][$key] ?>"
								/>
							</label>
						</div>
						<div class="small-3 column">
							<label for="delete_other_education"><span><br></span>
								<button type="button" id="delete_other_education" class="alert button delete_other_education_entry education_button"><span>Delete</span></button>
							</label>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div id="other_education_entries" class="row other_education_entries">
					<div class="small-5 column">
						<label for="institution_name">Institution Name
							<input type="text" class="institution_name" id="institution_name" name="institution_name[]" placeholder="Name of the Institution" >
						</label>
					</div>
					<div class="small-4 column">
						<label for="other_degree">Degree, Certificate or Training
							<input type="text" class="other_degree" id="other_degree" name="other_degree[]" placeholder="Name of the Degree, Certificate or Training" >
						</label>
					</div>
					<div class="small-3 column">
						<label for="delete_other_education"><span><br></span>
							<button type="button" id="delete_other_education" class="alert button delete_other_education_entry education_button"><span>Delete</span></button>
						</label>
					</div>
				</div>
			<?php endif; ?>

			</div>
			<div class="row">
				<div class="large-4 large-centered column">
					<button class="success button education_button" id="addInstitution" type="button">
						<span>Add another institution/college</span>
					</button>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="large-2 small-8 columns">
				<button class="primary button float-right" id="previous" type="button">
					<span>Previous</span>
				</button>
			</div>
			<div class="large-2 small-8 columns">
				<button class="primary button" id="next" type="submit">
					<span><?php echo ((isset($_SESSION['artist_profile_view']))?"":"Save & ") ?>Next</span>
				</button>
			</div>
			<div class="column">
			</div>
		</div>
	</form>
</body>


<script type="text/javascript">

	var noOfEducation=$(".education_entries").length;
	var noOfOther=$(".other_education_entries").length;

	$(".delete_education_entry").click(function(){
		if(noOfEducation>1)
			$(this).closest(".education_entries").remove();
		else//Clear the text if there is only a single
			$(this).closest(".education_entries").find('input:text').val('');

		noOfEducation=$(".education_entries").length;
		noOfOther=$(".other_education_entries").length;
	});

	$(".delete_other_education_entry").click(function(){
		if(noOfOther>1)
			$(this).closest(".other_education_entries").remove();
		else
			$(this).closest(".other_education_entries").find('input:text').val('');
		noOfEducation=$(".education_entries").length;
		noOfOther=$(".other_education_entries").length;

	});

	$("input[name='gender']").click(function(){
		if($("input[name='gender']:checked").val() == "other"){
			$("#gender_other_text").val("");
			$("#gender_other_text_label").show();
		}else{
			$("#gender_other_text_label").hide();
		}
	});

	$("input[name='ethnicity']").click(function(){
		console.log($("input[name='ethnicity']:checked").val());
		if($("input[name='ethnicity']:checked").val() == "other"){
			$("#ethnicity_other_text").val("");
			$("#ethnicity_other_text_label").show();
		}else{
			$("#ethnicity_other_text_label").hide();
		}
	});

	$("#country_residence").change(function(){
		var currCountry = $(this).val();
		if(currCountry=="United States of America"){
			$("#states_US").show();
			$("#states_international").hide();
		}
		else{
			$("#state_province").val("");
			$("#states_international").show();
			$("#states_US").hide();
		}
	});


	$("#addUniversity").click(function()
	{
		noOfEducation = noOfEducation + 1;
		var clone = $('.education_entries:last').clone();
		clone.find("input:text").val("");
		clone.insertAfter('.education_entries:last');

		$(".delete_education_entry").click(function(){
			if(noOfEducation>1){
				$(this).closest(".education_entries").remove();
				noOfEducation=$(".education_entries").length;
				noOfOther=$(".other_education_entries").length;
			}
			else{
				$(this).closest(".education_entries").find('input:text').val('');
			}
		});
	});
	$("#addInstitution").click(function(){

		//console.log("Number of Education entries : "+noOfEducation);
		//console.log("Number of Other entries : "+noOfOther);
		noOfOther = noOfOther + 1;
		var clone = $('.other_education_entries:last').clone();
		clone.find("input:text").val("");
		clone.insertAfter('.other_education_entries:last');

		$(".delete_other_education_entry").click(function(){

			if(noOfOther>1){
				$(this).closest(".other_education_entries").remove();
				noOfEducation=$(".education_entries").length;
				noOfOther=$(".other_education_entries").length;
			}
			else{
				$(this).closest(".other_education_entries").find('input:text').val('');
			}
		});
	});





	$("#previous").click(function() {
	// onclick event is assigned to the #button element.
	window.open("/src/add_artist_profile.php","_self");

	  //document.location.href = "/src/add_artist_personal_information.php",true;
	});
	// onclick event is assigned to the #button element.
	// $("#next").click(function() {
	// 	window.open("/src/add_artist_biography.php","_self");
	// });


	$(document).ready(function(){
		//$("#gender_other_text").val("");
		$("#gender_other_text_label").hide();
		//$("#ethnicity_other_text").val("");
		$("#ethnicity_other_text_label").hide();
		$("#states_US").hide();
		$("#states_international").hide();
		if($("input[name='ethnicity']:checked").val() == "other"){
			$("#ethnicity_other_text_label").show();
		}
		if($("input[name='gender']:checked").val() == "other"){

			$("#gender_other_text_label").show();
		}
		if (typeof country_res !== 'undefined') {
			$(".country_residence").find("option[value='" + country_res + "']").attr('selected','selected');
			if(country_res=="United States of America"){
				$("#states_US").show();
				$("#states_international").hide();
			} else {
				$("#states_international").show();
				$("#states_US").hide();
			}
		}
		if (typeof country_birth !== 'undefined') {
			$(".country_birth").find("option[value='" + country_birth + "']").attr('selected','selected');
		}
		if (typeof state_res !== 'undefined') {
			console.log(state_res);
			$("option[value='" + state_res + "']").attr('selected','selected');
		}
		if(disabled_input){
			$('input').attr('disabled','true');
			$('select').attr('disabled','true');
			$('.education_button').hide();
		}
	});

</script>


<?php
include 'footer.php';
?>

</html>
