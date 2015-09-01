<?php

class SurveyForm {
	private $email = "ulrik.birgersson@scibase.com";
	private $status = false;
	private $clinics = array(
					"private_single" => "Private clinic (One person)",
					"private_group" => "Private clinic (Group practice)",
					"university" => "University clinic",
					"combo" => "Combination of private and university clinic",
					"other" => "Other"
					);

	public function __construct($details) {
		add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));

		if($this->validate($details)) {
			$this->status = $this->sendMail($details);
			$this->sendConfirmationEmail($details);
		}
	}

	private function validate($details) {
		$status = true;
		foreach($details as $key => $value) {
			if($key !== 'address2') {
				$trimValue = trim($value);

				if(empty($trimValue)) {
					$status = false;
					break;
				}
			}
		}

		$this->status = $status;
		return $status;
	}

	private function sendMail($details) {
		$emailTo = $this->email;
		$subject = "Reader Study";
		$header = "From: scibase.se <noreply@scibase.se>\r\n";

		$body = $this->formatBody($details);

		return wp_mail($emailTo, $subject, $body, $header);
	}

	private function formatBody($details) {
		extract($details);

		$body = "";

		$body .= "<h4>First name</h4>";
		$body .= "<p>$firstname</p>";

		$body .= "<h4>Surname</h4>";
		$body .= "<p>$surname</p>";

		$body .= "<h4>What year did you complete your dermatology residency?</h4>";
		$body .= "<p>$firstyear</p>";

		$body .= "<h4>In what kind of practice setting do you work?</h4>";
		$body .= "<p>" . $this->clinics[$practice] . "</p>";

		$body .= "<h4>Address</h4>";
		$body .= "<p>$address</p>";

		$body .= "<h4>Address 2</h4>";
		$body .= "<p>$address2</p>";

		$body .= "<h4>City</h4>";
		$body .= "<p>$city</p>";

		$body .= "<h4>State</h4>";
		$body .= "<p>$state</p>";

		$body .= "<h4>Zip</h4>";
		$body .= "<p>$zip</p>";

		$body .= "<h4>Email</h4>";
		$body .= "<p>$email</p>";

		$body .= "<h4>Phone</h4>";
		$body .= "<p>$phone</p>";

		return $body;
	}

	private function sendConfirmationEmail($details) {
		$emailTo = $details['email'];

		$subject = "Thank you for registering";

		$header = "From: scibase.se <noreply@scibase.se>\r\n";

		$body = '<img src="' . get_bloginfo( 'template_url' ) . '/ui/img/nevisense_logo.png" alt=""/>';

		$body .= "<p>Upon confirming eligibility, you will be contacted via email with information on how to gain access to the online survey.
			On behalf of SciBase, I look forward to your participation. Please feel free to contact me with any questions.</p>
			<p>
			Thank you for your time and consideration.<br>
			Sincerely,<br>
			Ulrik Birgersson, PhD.</p>";

		return wp_mail($emailTo, $subject, $body, $header);
	}

	public function getStatus() {
		return $this->status;
	}
}