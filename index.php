<?php
include 'page_structure_content.php';

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="main_style.css">
</head>
<body>

<div class="header">
<? echo $header; ?>
</div>

<div class="topnav">
<? echo $navigation_bar; ?>	
</div>

<div style="padding-left:16px">
  <ul>
  <li><a href=paitent_data_upload.php>Upload Patient Data </a></li>
  <li><a href=electricity_data_upload.php>Electricity data Upload</a> </li>
  <li><a href=covid_care_bed_data_upload.php> COVID Care Center Bed data Upload</a> </li>
  <li><a href=covid_hospital_data_upload.php>COVID Hospital data Upload</a> </li>
  <li><a href=covid_care_center_data_upload.php>COVID Care Center data Upload</a> </li>
  
</div>

<div class="footer">
<? echo $footer; ?>
</div>
</body>
</html>

