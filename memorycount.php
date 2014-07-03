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
<?php



	$code=$_POST['code'];
	$code=replacestr($code);

	preg_match_all("/(int|float|double|char|long|short)\s[a-zA-Z_]?[a-zA-Z0-9_]*[=\d\s]*[,]*.*/",$code,$array);
	//preg_match_all(";(int|float|double)\s([a-zA-Z_]?[a-zA-Z0-9_]*[=\d\s]*)([,]*).*;",$code,$array);
	//	print_r ($array[0]) ;echo '<br>';
		//print_r ($array[1]) ;echo '<br>';
	//echo 'dskdjskds';
	
	/* Count the size of variables */
	$len=count($array[1]);
	//echo $len;
	$size=0; $totalvar=0;
	for($I=0;$I<$len;$I++)
	{
		if($array[1][$I]=="")
			break;
				/* Count no of , in array */
			$noofc=0;
			$l=strlen($array[0][$I]);
			for($J=0;$J<$l;$J++)
				if($array[0][$I][$J]==',')
					$noofc++;
//			echo ' found ' .$noofc .' comma for .' . $array[1][$I] . ' datatype '. datatype_size($array[1][$I]).'<br>';
			$noofc++; // Add 1 because there is one starting variable without comma //
			$size=$size + $noofc * datatype_size($array[1][$I]);
			$totalvar=$totalvar+$noofc++;
				
			
	}

	
	
	/* donot count datatype of main function */
	$datatypes=array("int","float","double","char","long","short");
	foreach($datatypes as $datatype)
		if(preg_match("/$datatype\smain()/",$code))
		{
			$totalvar--;
			$size=$size-datatype_size($datatype);
		}
	
	echo '<br>No of variables : ' . $totalvar . '<br>Total Size: ' . $size . ' bytes';
	
	
	
	



?>
