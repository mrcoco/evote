<?php
	$token = $this->session->userdata('voter_id');
?>

<!DOCTYPE html>
<html>
	<head>
	 <title>Pemilu HMIF 2013 -- feedback</title>
	  <link href="<?php echo base_url() ?>/resources/styles/bootstrap.css" rel="stylesheet">
	 <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
		padding-left: 40px;
		padding-right: 40px;
      }
     </style>
	</head>
	<body>
		<div class="hero-unit">
		
			<form name="form_feedback" action="selesai">
				<h1>Feedback</h1>
				<input type="hidden" name="voter_id" value="<?php echo $token; ?>" />
				<p>Silakan memberikan kesan,pesan,kritik,atau komentar mengenai Pemilu HMIF 2013</p>
				<textarea style="resize: none;"
				placeholder="Tuliskan feedback di sini."
				rows="6" cols="60" maxlength=255></textarea>
				<br></br>
				<strong><small>Tulisan maksimal 255 karakter.</small></strong>
				<br></br>
				<input type="submit" value="Submit">
			</form>
		
		</div>
		<script src="bootstrap.js"></script>
		<script src="jquery-1.8.3.min.js"></script>
	</body>
</html>
