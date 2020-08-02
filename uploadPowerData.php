<?php

use COVID\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            
            $CA_number = "";
            if (isset($column[0])) {
                $CA_number = mysqli_real_escape_string($conn, $column[0]);
            }
            $name = "";
            if (isset($column[1])) {
                $name = mysqli_real_escape_string($conn, $column[1]);
            }
            $home_address = "";
            if (isset($column[2])) {
                $home_address = mysqli_real_escape_string($conn, $column[2]);
            }
            $home_lat = "";
            if (isset($column[3])) {
                $home_lat = mysqli_real_escape_string($conn, $column[3]);
            }
            $home_long = "";
            if (isset($column[4])) {
                $home_long = mysqli_real_escape_string($conn, $column[4]);
            }
            
            $sqlInsert = "INSERT into PowerDeptConsumerData (CA_number	,name,home_address,home_lat,home_long)
                   values (?,?,?,?,?)";
            $paramType = "sssss";
            $paramArray = array(
                $CA_number,
                $name,
                $home_address,
                $home_lat,
                $home_long
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);
            
            if (!$insertId) {
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
    <h2>Upload Power Data</h2>

    <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
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
