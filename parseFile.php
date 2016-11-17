<?php

function parseFile($fileArray){
  $fileArrayLen = count($fileArray);
  //** Regular expression for extracting "Present"
  //**    from "Indeterminate or Suspicious Lung Nodules (Category 3-4B): Present"
  $regex_title = "/[iI]ndeterminate [oO]r [sS]uspicious [lL]ung [nN]odules\s?\([cC]ategory \d-\d[a-zA-z]\):\s?([a-zA-z]+)/";
  $startlineNo = -1;
  for ($lineNo=0; $lineNo < $fileArrayLen; $lineNo++) {
    $has_match_title = preg_match_all($regex_title, $fileArray[$lineNo], $matches_out_title);
    if ( $has_match_title ) {
      if( strtolower($matches_out_title[1][0])=="present"){
        $startlineNo = $lineNo;
      }
      break;
    }
  }

  //** Parse lines following "Indeterminate or Suspicious Lung Nodules (Category 3-4B): Present"
  if ( $startlineNo > -1 ) {
    $resultArray = array();
    $row = array();

    //** Regular expression for extracting "Solid", "right lower lobe"
    //**    from "Nodule number 1: Solid nodule in right lower lobe (2-50)".
    $regex_line1 = "/[nN]odule [nN]umber\s?\d+:\s?([\w\s]*)[nN]odule [iI]n\s?([\w\s]*)\((\d+)-(\d+)\).?/";
    //** Check every 4 lines
    //**    see if the line starts as "Nodule number"
    for ($nodulelineIdx=$startlineNo+1; $nodulelineIdx<$fileArrayLen; ) {
      $has_match_line1 = preg_match_all($regex_line1, $fileArray[$nodulelineIdx], $match_out_line1);
      if($has_match_line1){
        $row["consistency"] = strtolower(trim($match_out_line1[1][0]));
        $row["location"] = strtolower(trim($match_out_line1[2][0]));
        $row["ct_series"] = $match_out_line1[3][0];
        $row["ct_slice"] = $match_out_line1[4][0];
        // print_r($row["consistensy"]);

        //** Regular expression for extracting "13x9mm", "10 mm"
        //**    from "Size: 13 x 9 mm; mean diameter = 10 mm."
        $lineNo = $nodulelineIdx + 1;
        $regex_line2 = "/[sS]ize:\s?(\d+)\s?[x\*]\s?(\d+)\s?[mM]{2}\W\s?[mM]ean [dD]iameter\s?=\s?(\d+)\s?[mM]{2}.?/";
        $has_match_line2 = preg_match_all($regex_line2, $fileArray[$lineNo], $match_out_line2);
        if($has_match_line2){
          $row["size_width_mm"] = $match_out_line2[1][0];
          $row["size_height_mm"] = $match_out_line2[2][0];
          $row["mean_diameter_mm"] = $match_out_line2[3][0];
          // echo "<pre>";
          // print_r($row);
          // echo "</pre>";
        }
        else{
          $row["size_width_mm"] = NULL;
          $row["size_height_mm"] = NULL;
          $row["mean_diameter_mm"] = NULL;
        }

        //** Regular expression for extracting "Stable"
        //**    from "Evolution: Stable"
        $lineNo = $lineNo + 1;
        $regex_line3 = "/[eE]volution:\s?([\w\s]+)/";
        $has_match_line3 = preg_match_all($regex_line3, $fileArray[$lineNo], $match_out_line3);
        if($match_out_line3){
          $row["evolution"] = strtolower(trim($match_out_line3[1][0]));
          // echo "<pre>";
          // print_r($row);
          // echo "</pre>";
        }
        else{
          $row["evolution"] = NULL;
        }

        //** Regular expression for extracting "4A"
        //**    from "LungRADS Nodule Category: 4A"
        $lineNo = $lineNo + 1;
        $regex_line4 = "/[lL]ung[rR][aA][dD][sS] [nN]odule [cC]ategory:\s?(\d+[a-zA-Z]?)/";
        $has_match_line4 = preg_match_all($regex_line4, $fileArray[$lineNo], $match_out_line4);
        if($has_match_line4){
          $row["lung_rads_category"] = strtolower($match_out_line4[1][0]);
        }
        else{
          $row["lung_rads_category"] = NULL;
        }
        $resultArray[] = $row;
        $nodulelineIdx+=4;
      }
      else{
        break;
      } //** End if match line1
    } //** End for

    // echo "<pre>";
    // print_r($resultArray);
    // echo "</pre>";

    return $resultArray;

  } //** End if startlineNo>-1
} //** End function parseFile()

?>
