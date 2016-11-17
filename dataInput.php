<!DOCTYPE html>
<html lang="en">
  <head>

    <title>Nodule Data Extraction</title>
    <?php include 'htmlHead.php'; ?>

    <link rel="stylesheet" type="text/css" href="webStyle.css">

  </head>
  <body>

    <?php include 'htmlPlugins.php'; ?>

    <div class="container">
      <form class="" action="dataResult.php" id="fileForm" method="post" enctype="multipart/form-data">
        <br><br>
        <div class="row">
          <div class="col-md-offset-2 col-md-6">
            <div class="form-login">
              <h4>Extract Data Elements</h4>
              <table>
                <tr>
                  <td>
                    <input type="file" name="filename" id="filename" size="60">
                  </td>
                  <td>
                    <button class="btn btn-xs" id="removeFile" title="remove file">
                      <span class="glyphicon glyphicon-remove"></span></button>
                  </td>
                </tr>
                <tr>
                  <td>
                    </br>
                  </td>
                </tr>
                <tr>
                  <td>
                    <textarea class="form-control" name="filetext" id="filetext" cols="70" rows="10"
                        placeholder="Or Enter Text Here"></textarea>
                  </td>
                </tr>
                <tr>
                  <td>
                    </br>
                  </td>
                </tr>
              </table>
              <div class="wrapper">
                <button class="btn btn-primary btn-md" type="submit" id="submitBtn">
                  Extract <span class="glyphicon glyphicon-paste"></span></button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <script type="text/javascript">
      $(document).ready(function(){

        //** Add callback for file remove button
        $("#removeFile").on("click", function(event){
          event.preventDefault();
          $("#filename").wrap('<form>').closest('form').get(0).reset();
          $("#filename").unwrap();
        });

        //** Check form content before submit
        $("#fileForm").on("submit", function(event){
          var filename = $("#filename").val();
          var filetext = $("#filetext").val();
          if (filename.length!=0 && filetext.trim().length==0) {
            var fileExt = $("#filename").val().substring($("#filename").val().lastIndexOf('.')+1);
            if( fileExt != "txt" ){
              alert("Please choose a .txt file");
              event.preventDefault();
            }
          }
          else if(filename.length==0 && filetext.trim().length==0){
            alert("Please upload a file or enter text");
            event.preventDefault();
          }
          else if(filename.length!=0 && filetext.trim().length!=0){
            alert("Plaease either upload a file or enter text");
            event.preventDefault();
          }

        });

      });
    </script>
  </body>
</html>
