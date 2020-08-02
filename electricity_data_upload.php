<?php
//used for CSS puspose to color active page.
$home_page="inactive";
$upload_master_table_page="active";
$download_report_page="inactive";

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
<?php echo $header; ?>
</div>

<div class="topnav">
<?php echo $navigation_bar; ?>
</div>

<div style="padding-left:16px">
<?php
include 'uploadPowerData.php';

?>
</div>

<div class="footer">
<? echo $footer; ?>
</div>

</body>
</html>
