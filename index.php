<?php
/*
** JS-Scan v1.0 | Stay up to date with tools & updates on zseano.com!
** Code written by Sean R (@zseano) & Karl R

** Licensed under The MIT License
** Redistributions of files must retain the above text.
*/

ini_set('max_execution_time', 900); // customize how you see fit.
ob_implicit_flush(true);
error_reporting(0);

const URL_FILE = "JS-output.txt";

function loadData($fileName)
{
    $contents = file($fileName);
    
    if ($contents === false)
    {
        $last_error = error_get_last();
        
        if ($last_error != null)
        {
            throw new Exception($last_error['message']);
        }
        else
        {
            throw new Exception('Unknown error');
        }
    }
    
    $who = ".js urls";
    printf("<font color='orange'>»»</font> Loaded <font color='cyan'>%d %s</font> from %s!<br>", count($contents), $who, $fileName);
    
    return $contents;
}

function processUrls($urls)
{
    foreach ($urls as $url) {
    $output = "";

    $usingInputScanner="yes";

    if ($usingInputScanner == "no") {
        $foundAt = "Not specified";
        $url = strip_carriage_returns($url);
    } else {
        $foundAt = GetBetween($url, "found@","|"); // where was this .js file found?
        $url = GetBetween($url, "|","|"); // grab .js file (between | |)
        $url = strip_carriage_returns($url);
    }

    $input = file_get_contents($url);

    // array of strings to look for
    // currently looks for "url:'/urlhere' and url:"/urlhere" - feel free to modify!
    $a = ['|url:"/(.*)"|U', "|url:'/(.*)'|U"];

    echo "<font color='#46FF06'><b>".$url."</b></font> (seen on ".$foundAt.")<br>";
    foreach($a as $pattern) {
        preg_match_all($pattern,$input,$matches);
        $numMatches = count($matches[0]);

        for ($i = 0; $i < $numMatches; $i++) {
          $output .= "<font color='orange'>»»</font> ".htmlentities($matches[0][$i], ENT_QUOTES, "UTF-8")."<br>";
        }
    }
    $output = implode('<br>',array_unique(explode('<br>', $output)));
    echo $output;
    echo "<br><br>";
    forceFlush();
    $input = "";
    $matches = "";
}
    // Save stuff here?

    

}

function strip_carriage_returns($string)
{
    return str_replace(array("\n\r", "\n", "\r"), '', $string);
}

?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title>zScanner v1.0 by zseano</title>
    <link rel="stylesheet" href="style/styles.css">
    <style type="text/css">
        hr.style1 {
            border-top: 3px double #8c8b8b;
        }
    </style>
   </head>
 <body>
 <div class="wrapper">
 <div id="header">
    <div class="wrapper">
        <center><h2>JS-Scan v1.0 by zseano</h2></center>
    </div>
 </div>
  <div style="margin-top:150px; padding-right:50px; padding-left:50px; padding-bottom:30px; padding-top:30px; border: thin solid green">
<?php
$run="0";
$run=$_GET['run'];
if ($run == '1') {
    $urls = loadData(URL_FILE);
    echo "<br><hr class='style1'>";
    processUrls($urls);
} else {
 ?>
    A tool designed to scrape a list of .js urls and extract all urls found. You can modify the regex in the 
    <font color="cyan">processUrls()</font> function, which is located in this file. 
    At the moment it just includes url:"/string" and url:'/string'.
    <br><br>Data is loaded from JS-output.txt in the root directory. You can use InputScanner to scrape .js urls.<br><br>
    <hr class='style1'>
    <form action="index.php" method="GET">
    <?php $urls = loadData(URL_FILE);
    ?>
    <br>
    Currently this script does not output anything, hence the visual view of urls found. You are free to modify this code to output how you want.
    <br><br>
    <input type="hidden" name="run" value="1">
    <input type="submit" value="Run scanner"><br><br>
</form>
<?php } ?>
</div>
<br>

<?php
function forceFlush() {    
    ob_start(); 
    ob_end_clean(); 
    flush(); 
    ob_end_flush(); 
} 

function GetBetween($content,$start,$end){
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}
  

?>

