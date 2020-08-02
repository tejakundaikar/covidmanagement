<?php
//used for CSS puspose to color active page.
$home_page = "inactive";
$upload_master_table_page = "active";
$download_report_page = "inactive";

use COVID\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

if (isset($_POST["import"])) {

    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {

        $file = fopen($fileName, "r");

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {

            $male_beds = "";
            if (isset($column[0])) {
                $male_beds = mysqli_real_escape_string($conn, $column[0]);
            }
            $female_beds = "";
            if (isset($column[1])) {
                $female_beds = mysqli_real_escape_string($conn, $column[1]);
            }
            $emergency_beds = "";
            if (isset($column[2])) {
                $emergency_beds = mysqli_real_escape_string($conn, $column[2]);
            }

            $sqlInsert = "INSERT into CCBedCapacity (male_beds,female_beds,emergency_beds)
                   values (?,?,?,?)";
            $paramType = "ssss";
            $paramArray = array(
                $male_beds,
                $female_beds,
                $emergency_beds,
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);

            if ($insertId) {
                $type = "success";
                $message = " Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

    <head>
        <script src="js/formuploadjs.js"></script>

        <link rel="stylesheet" type="text/css" href="css/table.css">

    </head>

    <body>
        <h2>Upload Covid Care Center Bed Capacity</h2>

        <div id="response"
             class="<?php if (!empty($type)) {
    echo $type . " display-block";
} ?>">
                 <?php if (!empty($message)) {
                     echo $message;
                 } ?>
        </div>
        <div class="outer-scontainer">
            <div class="row">

                <form class="form-horizontal" action="" method="post"
                      name="frmCSVImport" id="frmCSVImport"
                      enctype="multipart/form-data">
                    <div class="input-row">
                        <label class="col-md-4 control-label">Choose CSV
                            File</label> <input type="file" name="file"
                                            id="file" accept=".csv">
                        <button type="submit" id="submit" name="import"
                                class="btn-submit">Import</button>
                        <br />

                    </div>

                </form>

            </div>

        </div>

    </body>

</html>
