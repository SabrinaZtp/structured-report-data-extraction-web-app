<?php

//** Generate table body html string
function generateHtmlStr($resultArray){

  $resultArrayLen = count($resultArray);
  $tbodyHtmlStr = "";
  for ($rowIdx=0; $rowIdx < $resultArrayLen; $rowIdx++) {
    $rowData = $resultArray[$rowIdx];
    $tbodyHtmlStr_tr = <<<EOT
      <tr>
        <td>{$rowData["consistency"]}</td>
        <td>{$rowData["location"]} ({$rowData["ct_series"]}-{$rowData["ct_slice"]})</td>
        <td>{$rowData["size_width_mm"]} x {$rowData["size_height_mm"]} mm</td>
        <td>{$rowData["mean_diameter_mm"]} mm</td>
        <td>{$rowData["evolution"]}</td>
        <td>{$rowData["lung_rads_category"]}</td>
      </tr>
EOT;
    $tbodyHtmlStr .= $tbodyHtmlStr_tr;
  }  //** End for row index

  return $tbodyHtmlStr;

}
?>
