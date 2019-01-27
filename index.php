<?php
require('./extract-cookies.php'); // require the file from above...
if (isset($_FILES['file'])) {
    $inputName = $_FILES['file']['tmp_name'];
    $contents = file_get_contents($inputName);
    $outputName = 'cookies.json';
    $convertContents = extractCookies($contents);
    file_put_contents($outputName, json_encode($convertContents));
    if (file_exists($outputName)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($outputName).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($outputName));
      
        readfile($outputName);
        unlink($outputName);
      
        exit;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Convert Cookies from "txt" to "json" format</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet" />
    
</head>

<body>

<!-- 
  ****************************************
  Contest Entry for Treehouse:
  "Design a Contact Form"
  Submitted by Lisa Wagner
  ****************************************
-->

<div id="contact-form">
	<div>
		<h1>Nice to Meet You!</h1> 
		<h4>Welcome to the Cookies Extractor</h4> 
	</div>
		<p id="failure">Oopsie...Cookies not Extract.</p>  
		<p id="success">Your Cookies was extracted successfully. Thank you!</p>

		<form method="POST" 
   		style="padding: 20px"
 enctype="multipart/form-data">
            
		<div>
		<label class="btn btn-lg btn-block btn-secondary">
                <input type="file" id="file" name="file" hidden>
                Browse File
            </label>
			  <div style="margin-top:20px">		           
		      <button name="submit" type="submit" id="submit" >Convert to Json</button> 
			</div>
			</div>
		 

	</div>
           
        </form>
		

  
</body>
</html>