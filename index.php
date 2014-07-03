<?php
function replacestr($s)
{
$t='';
	$l=strlen($s);
echo chr(PHP_EOL);
	for($i=0;$i<$l;$i++)
	{
		if($s[$i]==';')
			$t=$t.PHP_EOL;
		else
			$t=$t.$s[$i];
	}
	return $t;
}

function datatype_size($s)
{
	switch($s)
	{
		case 'int':return 2;
		case 'float':return 4;
		case 'double':return 8;
		case 'char':return 1;
		case 'long':return 8;
		case 'short':return 2;
		
		
	}
}
?>
<html>
<head>
<title>Memory Consumption of your program</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/jquery.min.js"></script>

</head>
<body>

<textarea id="code" placeholder="Paste your C/C++ program here!" class="form-control" rows="20" name="code"></textarea><br>
<input type="submit" class="btn btn-primary" name="submit" value="Calculate memory consumtion" onclick='$.post( "memorycount.php", 
{
	code:  $("#code").val()
	
	
}


)
  .done(function( data ) {
   // alert( "Adding timestamp");
	$("#result").html(data);
  });

  '>
<div class="alert alert-success" id="result"></div>
<div class="alert alert-danger">Limitations: <br>It doesnot remove or detect errors in the program if any.<br>
								It doesnot count dyanamic memory.<br>
								It cannot count the size of objects of class or structure variables.


</div></body>
</html>
