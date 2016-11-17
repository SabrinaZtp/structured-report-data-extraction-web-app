<!DOCTYPE html>
<html lang="en">
  <head>

    <title>Data Extraction Result</title>
    <?php include 'htmlHead.php'; ?>

  </head>
  <body>

    <?php include 'htmlPlugins.php'; ?>

    <?php

      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);

      $filetext = $_POST["filetext"];
      $filepath = $_FILES["filename"]["tmp_name"];

      //** Read file into array
      if (empty($filepath)) {
        //** split text into lines
        $fileArray = explode("\n", $filetext);
        //** remove blank lines
        $fileArray = array_values(array_filter($fileArray, "trim"));
      }
      elseif (empty($filetext)){
        $fileArray = file($filepath, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
      }
      else{

      }

      //** Extract required data from array
      include 'parseFile.php';
      $resultArray = parseFile($fileArray);

      if(count($resultArray)>0){
        //** Save to database
        include 'saveToDb.php';
        $returnMsg = saveToDb($resultArray);
        if($returnMsg !== TRUE){
          echo $returnMsg;
        }

        //** Generate table body html string
        include 'generateHtmlStr.php';
        $tbodyHtmlStr = generateHtmlStr($resultArray);
      }
      else{
        $tbodyHtmlStr = "";
      }
    ?>

    <div class="container">

      <div>
        </br></br>
      </div>

      <div class="panel panel-default" id="resultPanel">

        <div class="panel-heading">
          <h4>Extracted Data Elements</h4>
        </div>

        <div class="panel-body">

          <table class="table table-striped" id="resultTable">
            <thead>
              <th>Consistency</th>
              <th>Location</th>
              <th>Size</th>
              <th>Mean Diameter</th>
              <th>Evolution</th>
              <th>Lung RADS Category</th>
            </thead>
            <tbody>
              <!--Use generated html string-->
              <?php echo $tbodyHtmlStr; ?>
            </tbody>
          </table>

          <div class="hidden" id="noResult">
            <p>No data element extracted</p>
          </div>

        </div> <!--End panel body-->

      </div> <!--End panel-->

      <button class="btn btn-primary btn-md" type="button" name="gobackBtn" id="gobackBtn">
        Do Another Extraction <span class="glyphicon glyphicon-paste"></span>
      </button>

    </div> <!--End container-->

    <script>

      $(document).ready(function(){

        //** Control content presentation in panel
        if( $("#resultPanel tbody").text().trim().length<1 ){
          $("#noResult").removeClass("hidden");
          $("#resultTable").addClass("hidden");
        }
        else{
          $("#noResult").addClass("hidden");
          $("#resultTable").removeClass("hidden");
        }

        //** Callback for button
        $("#gobackBtn").on("click", function(event){
          //** Redirect to data input page
          var currentLocation = window.location.href;
          var dataInputLocation = currentLocation.substring(0, currentLocation.lastIndexOf('/')+1)+"dataInput.php";
          window.location = dataInputLocation;
        });

      }); //** End document.ready()

    </script>

  </body>
</html>
