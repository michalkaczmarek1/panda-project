<?php
// include required files
require_once('../views/header.html.php');

require_once('../utilities.php');
require_once('file.php');

//init objects
$Utilities = new Utilities();
$File = new File();

//create connection db
$pdo = $Utilities->dbConnection();

// set variable array to input data
$data_chart = [];
$dataPoints = [];

//check whether are errors database
if(isset($_SESSION['error_db'])){
    echo "<div class='alert alert-danger'>".$_SESSION['error_db']."</div>";
    unset($_SESSION['error_db']);
}

// check whether had been create table in database
if(isset($_SESSION['table_name'])){

    // get data to chart
    $data_chart = $File->dataChart($_SESSION['table_name'], $pdo);
    
    //display statement about success upload
    if(isset($_SESSION['success_upload'])){
        echo "<div class='alert alert-success'>".$_SESSION['success_upload']."</div>";
        unset($_SESSION['success_upload']);
    }
    unset($_SESSION['table_name']);
    
//display statement about error upload
} else if(isset($_SESSION['error_no_upload'])){
    echo "<div class='alert alert-danger'>".$_SESSION['error_no_upload']."</div>";
    unset($_SESSION['error_no_upload']);

//display statement about fill all fields
} else if(isset($_SESSION['error_empty'])){
    echo "<div class='alert alert-danger'>".$_SESSION['error_empty']."</div>";
    unset($_SESSION['error_empty']);
} 


?>

<h2>Zaimportuj plik CSV</h2>

<form enctype="multipart/form-data" action="<?php echo APP_PATH; ?>import_csv/api-csv.php" method="POST">
    <div class="form-group">
        <input type="file" id="file_csv" name="file_csv">
    </div>
    <input type="submit" class="btn btn-success" id="log" name="submit" value="Prześlij">
</form>

<?php
     
     foreach ($data_chart as $key => $value) {
        //set input data to chart   
        $dataPoints[] = array("y" => $data_chart[$key]['amount_person'], "label" => $data_chart[$key]['country']);

     }

     ?>

     <script>
    //script responsible for handling and display charts
     window.onload = function() {
    
   
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Ilość osób z poszczególnych krajów"
            },
            axisY: {
                title: "Liczba osób"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0.## osób",
                dataPoints: <?php echo json_encode(($dataPoints), JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

     }

     </script>
     </head>
     <body>
     <div id="chartContainer" style="height: 370px; width: 100%;"></div>
     <button id="clean_data" class="btn btn-info">Wyczyść dane</button>

     <!-- get the library canvasjs -->
     <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
     </body>
     </html>                              

<?php
// include footer template
require_once('../views/footer.html.php');
?>