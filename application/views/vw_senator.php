<?php
	$voter_id = $this->session->userdata('voter_id');
?>

<!DOCTYPE html>
<html>
	<head>
	 <title>Pemilu HMIF 2013 -- vote senator</title>
	 <link href="<?php echo base_url() ?>/resources/styles/bootstrap.css" rel="stylesheet">
	 <script src="<?php echo base_url() ?>/resources/scripts/bootstrap.js"></script>
	 <script src="<?php echo base_url() ?>/resources/scripts/jquery-1.8.3.min.js"></script>
	 
	 <!--script untuk seleksi gambar-->
	 <script type="text/javascript">
	 $(document).ready(function () {
		$('#form_senator_terpilih img').click(function() {

			$('#image-value').val($(this).attr('data-value'));


			$('#form_senator_terpilih img').removeClass('highlighted');


			$(this).addClass('highlighted');
			
			$("button").show();
		});
	 });
</script>
	 <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
		padding-left: 40px;
		padding-right: 40px;
      }
	  img.highlighted {
		border: 6px solid blue;
	  }
     </style>
	</head>
	<body>
	 <div class="hero-unit">
	  <form name="form_senator" id="form_senator_terpilih" action="proses_vote">
		<h2>Vote Calon Senator</h2>
		<p>Silakan memilih calon senator dengan melakukan <dfn>click</dfn> pada gambar calon yang sudah disediakan, lalu menekan tombol <dfn>Next</dfn>. Disediakan pilihan golput jika tidak ingin memilih calon senator.</p><br></br>
	 <div class="row-fluid">
	  <div class="span12">
	  <?php echo "user id: "; ?>
	  <input type="text" size="32" readonly="true" name="voter_id" value="<?php echo $voter_id; ?>" />
		<div class="row-fluid">
		 <div class="span4" align="center">
			<img src="<?php echo base_url(); ?>/resources/images//1.png" class="img-polaroid" data-value="1">
			<p>Casenator 1</p>
		 </div>
		 <div class="span4" align="center">
			<img src="<?php echo base_url(); ?>/resources/images//2.png" class="img-polaroid" data-value="2">
			<p>Casenator 2</p>
		 </div>
		 <div class="span4" align="center">
			<img src="<?php echo base_url(); ?>/resources/images//golput.jpg" class="img-polaroid" data-value="3">
			<p>Golput</p>
		 </div>
		 <input type="hidden" id="image-value" name="vote_casenator" value="">
		</div>
	  </div>
	 </div>
	 <div align="center">
	 <button style="display: none" class="btn btn-large btn-primary type="submit">Next</button>
	 </div>
	  </form>
	 </div>
	</body>
</html>
