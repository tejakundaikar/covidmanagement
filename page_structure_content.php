
<?php

//$home_page="active";
//$upload_master_table_page="inactive";
//$download_report_page="inactive";


$header = "<h2>COVID Goa Data Analysis</h2>
  <h4>Visualisation and prediction</h4>";

$navigation_bar = "<a class=\"".$home_page."\"href=\"index.php\">Home</a>
  <a class=\"".$upload_master_table_page."\"href=\"uploadMasterTable.php\"> Upload Master Tables </a>
  <a class=\"".$download_report_page."\"href=\"downloadReports.php\">Report Downloads </a>";


$masterTabelupload = "<h2>Upload Master Tables</h2>
            <ul>
                <li><a href=paitent_data_upload.php>Upload Patient Data </a></li>
                <li><a href=electricity_data_upload.php>Electricity data Upload</a> </li>
                <li><a href=covid_care_bed_data_upload.php> COVID Care Center Bed data Upload</a> </li>
                <li><a href=covid_hospital_data_upload.php>COVID Hospital data Upload</a> </li>
                <li><a href=covid_care_center_data_upload.php>COVID Care Center data Upload</a> </li>
            </ul>";

$downloadReport = " <h2>Downlod Report</h2>
            <ul>
                <li><a href=downloadContactTracingReport.php>Downlod ContactTracing Report</a></li>
                <li><a href=downloadCovidCenterBedStatusReport.php>Downlod COVID Center Bed Status Report</a></li>
                <li><a href=downloadHospitalCenterBedStatusReport.php>Downlod COVID Hospital Bed Status Report</a></li>
            </ul> ";

$footer = "<p>contact details: abc@nn.cc</p>";
?>
