<?php
if(isset($_POST['surveyValues'])) {
	$details = $_POST['surveyValues'];
}

?>

<form class="gw survey-form" method="post" action="">
	<input type="hidden" name="sf_submit" id="sf_submit" value="">
	<input type="hidden" name="survey_form_nonce" value="<?php echo wp_create_nonce('survey_form'); ?>">
	<div class="g three-twelfths">
		<label for="firstname">First name</label>
	</div>
	<div class="g six-twelfths">
		<input type="text" id="firstname" name="firstname" value="<?php if(isset($details['firstname'])) echo $details['firstname']; ?>">
	</div>
	<div class="g three-twelfths">
		<label for="surname">Surname</label>
	</div>
	<div class="g six-twelfths">
		<input type="text" id="surname" name="surname" value="<?php if(isset($details['surname'])) echo $details['surname']; ?>">
	</div>
	<div class="g three-twelfths">
		<label for="firstyear">What year did you complete your dermatology residency?</label>
	</div>
	<div class="g six-twelfths">
		<select name="firstyear" id="firstyear">
			<?php
				$i = 1960;
				$length = 2014;
				do {
					$option = '<option value="';
					$option .= $i;
					$option .= '" ';
					$option .= (isset($details['firstyear']) && $details['firstyear'] == $i) ? 'selected="selected"' : '';
					$option .= '>';
					$option .= $i;
					$option .= '</option>';

					echo $option;
					$i++;
				} while ($i <= $length);
			?>
		</select>
	</div>
	<div class="g three-twelfths">
		<label for="practice">In what kind of practice setting do you work?</label>
	</div>
	<div class="g six-twelfths">
		<select name="practice" class="big-select" id="practice">
			<?php 
				$clinics = array(
					"private_single" => "Private clinic (One person)",
					"private_group" => "Private clinic (Group practice)",
					"university" => "University clinic",
					"combo" => "Combination of private and university clinic",
					"other" => "Other"
					);

				foreach($clinics as $key => $value) {
					$option = '<option value="';
					$option .= $key;
					$option .= '" ';
					$option .= (isset($details['practice']) && $details['practice'] == $key) ? 'selected="selected"' : '';
					$option .= '>';
					$option .= $value;
					$option .= '</option>';

					echo $option;
				}
			?>
			
		</select>
	</div>
	<div class="g three-twelfths">
		<label for="address">Address</label>
	</div>
	<div class="g six-twelfths">
		<input name="address" id="address" type="text" value="<?php if(isset($details['address'])) echo $details['address']; ?>">
	</div>
	<div class="g three-twelfths">
		<label for="address2">Address 2 (optional)</label>
	</div>
	<div class="g six-twelfths">
		<input name="address2" id="address2" type="text" value="<?php if(isset($details['address2'])) echo $details['address2']; ?>">
	</div>
	<div class="g three-twelfths">
		<label for="city">City</label>
	</div>
	<div class="g six-twelfths">
		<input name="city" id="city" type="text" value="<?php if(isset($details['city'])) echo $details['city']; ?>">
	</div>
	<div class="g three-twelfths">
		<label for="state">State</label>
	</div>
	<div class="g six-twelfths">
		<input id="state" name="state" type="text" value="<?php if(isset($details['state'])) echo $details['state']; ?>">
	</div>
	<div class="g three-twelfths">
		<label for="zip">Zip</label>
	</div>
	<div class="g six-twelfths">
		<input name="zip" id="zip" type="text" value="<?php if(isset($details['zip'])) echo $details['zip']; ?>">
	</div>
	<div class="g three-twelfths">
		<label for="email">Email</label>
	</div>
	<div class="g six-twelfths">
		<input name="email" id="email" type="email" value="<?php if(isset($details['email'])) echo $details['email']; ?>">
	</div>
	<div class="g three-twelfths">
		<label for="phone">Phone</label>
	</div>
	<div class="g six-twelfths">
		<input name="phone" id="phone" type="tel" value="<?php if(isset($details['phone'])) echo $details['phone']; ?>">
	</div>
	<div class="g one-whole">
		<button type="submit">Submit</button>
		<?php 
			if(isset($_POST['surveySuccess'])) {
				if(!$_POST['surveySuccess']) {
					echo '<div class="survey-message survey-error">Please enter all fields</div>';
				}
			}
		?>
	</div>

</form>