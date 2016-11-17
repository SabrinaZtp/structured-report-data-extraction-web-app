<?php

  function saveToDb($noduleInfoArray){
    $configStr = file_get_contents("config.json");
    $configStr_decode = json_decode($configStr, true);

    $serverName = $configStr_decode["serverName"];
    $dbName = $configStr_decode["dbName"];
    $dbUsername = $configStr_decode["dbUsername"];
    $dbPassword = $configStr_decode["dbPassword"];

    $errMsg = "";

    try{
      $conn = new PDO("sqlsrv:server=$serverName;Database=$dbName", $dbUsername, $dbPassword);
      $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e)
    {
      die($errMsg = $e->getMessage());
    }

    $noduleInfoArrayLen = count($noduleInfoArray);
    for ($rowIdx=0; $rowIdx < $noduleInfoArrayLen ; $rowIdx++) {
      $colNames = " (";
      $colParams = " (";
      $colLen = count($noduleInfoArray[$rowIdx]);
      $arrKeys = array_keys($noduleInfoArray[$rowIdx]);
      $paramArray = array();
      foreach ($arrKeys as $colIdx => $colName) {
        $colData = $noduleInfoArray[$rowIdx][$colName];
        if(!empty($colData)){
          if($colIdx == 0){
            $colNames .= $colName;
            $colParams .= ":" .$colName;
          }
          else{
            $colNames .= ", " .$colName;
            $colParams .= ", :" .$colName;
          }
          $paramArray[] = $colData;
        }
      }
      $colNames .= ")";
      $colParams .= ")";
      $sqlInsert = "INSERT INTO IndetSuspLungNodules"
                    .$colNames
                    ." VALUES"
                    .$colParams;
      $stmtInsert = $conn->prepare($sqlInsert);
      $stmtInsert->execute($paramArray);
    }

    if(empty($errMsg)){
      return TRUE;
    }
    else{
      return $errMsg;
    }

  }  //** end function saveToDb()

?>
