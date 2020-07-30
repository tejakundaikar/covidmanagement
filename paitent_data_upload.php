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
  <?php
include 'uploadPatientDetails.php'
?>
</div>

<div class="footer">
<? echo $footer; ?>
</div>

</body>
</html>

