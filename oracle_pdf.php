<?php
include ('ezpdf/class.ezpdf.php');
//$strConnection = "Provider=OraOLEDB.Oracle; Data Source=GEO;User Id=gbi; Password=zomer;";

//$conn = new COM("ADODB.Connection") or die("Kan ADODB niet gebruiken"); 
//$conn->Open($strConnection);

if (isset($_GET['e'])) {
	$e = $_GET['e'];
	//$_SESSION["PDF"] = TRUE;
}
if (isset($_GET['p'])) {
	$p = $_GET['p'];
}

if (isset($e)) {
	switch ($e) {		
		case "@TEST":
			TEST();
			break;
		case "@SVG":		
			SVG();
			break;	
		case "@WELK":
			WELK();
			break;
		case "@SOORT":
			SOORT($p);
			break;		
	}
}
else {
	BASIS();
}


function WELK() {
$strConnection = "Provider=OraOLEDB.Oracle; Data Source=GEO;User Id=gbi; Password=zomer;";

$conn = new COM("ADODB.Connection") or die("Kan ADODB niet gebruiken"); 
$conn->Provider = "OraOLEDB.Oracle";
$conn->ConnectionString = "Data Source=GEO;User Id=gbi; Password=zomer;";
$conn->Open();

$sql_stmt = "select * from USER_TABLES";
$Recordset = $conn->Execute($sql_stmt);

while (!$Recordset->EOF) {
	print ($Recordset->Fields['TABLE_NAME']->Value);
	print ("<BR>");
	$Recordset->MoveNext();
}

$Recordset->Close();
unset($Recordset);
$conn->Close();
unset($conn);
}

function SOORT($p) {
$conn = new COM("ADODB.Connection") or die("Kan ADODB niet gebruiken"); 
$conn->Provider = "OraOLEDB.Oracle";
$conn->ConnectionString = "Data Source=GEO;User Id=gbi; Password=zomer;";
$conn->Open();

$sql_stmt = "SELECT SDO_UTIL.TO_WKTGEOMETRY(shape) FROM " & p;

$Recordset = $conn->Execute(sql_stmt);

while (!$Recordset->EOF) {
	print ($Recordset->Fields[0]->Value);
	print ("<BR>");
	$Recordset->MoveNext();
}

$Recordset->Close();
unset($Recordset);
$conn->Close();
unset($conn);
}

function BASIS() {
$conn = new COM("ADODB.Connection") or die("Kan ADODB niet gebruiken"); 
$conn->Provider = "OraOLEDB.Oracle";
$conn->ConnectionString = "Data Source=GEO;User Id=gbi; Password=zomer;";
$conn->Open();

$sql_stmt = " SELECT SDO_UTIL.TO_WKTGEOMETRY(SDO_AGGR_MBR(shape)) FROM AB_HIST_GEMEENTEGRENS_V";
$p = "";

$Recordset = $conn->Execute($sql_stmt);

while (!$Recordset->EOF) {
	$res = $Recordset->Fields[0]->Value;
	$lengte = strlen($res);
	$pol = strpos($res, "POLYGON");
	if ($pol >= 0) {
		$coord = substr($res,($pol + 10), ($lengte - 10 - 2));
	}
	//print ($coord);	
	//print ("<BR>");
	$Recordset->MoveNext();
}

$p = $coord . "|";

$Recordset->Close();
unset($Recordset);

$sql_stmt = "SELECT SDO_UTIL.TO_WKTGEOMETRY(shape) FROM AB_HIST_GEMEENTEGRENS_V";

$Recordset = $conn->Execute($sql_stmt);

while (!$Recordset->EOF) {
	$res = $Recordset->Fields[0]->Value;
	//print ($res . "<BR><BR>");
	$lengte = strlen($res);
	$pol = strpos($res, "POLYGON");
	if ($pol >= 0) {
		$coord = substr($res,($pol + 10), ($lengte - 10 - 2));
	}
	$p = $p . $coord . "|";
	$Recordset->MoveNext();
}

$Recordset->Close();
unset($Recordset);

$conn->Close();
unset($conn);

CREATEPDF($p);
/*


$sGeo = explode("|", $p);
$tokens = explode(",", $sGeo[0]);
$sMin = explode(" ", $tokens[0]);
$sMax = explode(" ", $tokens[2]);

$sMinX = $sMin[0];
$sMinY = $sMin[1];
  
print ("sMinX = " . $sMin[0]);
print ("sMinY = " . $sMin[1]);

for ($iRecord = 1; $iRecord < (count($sGeo) - 1); $iRecord++) {
	$tokens = explode(",", $sGeo[$iRecord]);
	print ($sGeo[$iRecord]);
	print ("<BR><BR>");
	$point = array();
	for ($gRecord = 0; $gRecord < count($tokens); $gRecord++) {
			$sPunt = explode(" ", $tokens[$gRecord]);
			if ($gRecord == 0) {
				$sX = $sPunt[0] - $sMinX;
				$sY = $sPunt[1] - $sMinY;
 				print ("gRecord = 0 ");
				print ($sX * 1000 / 350000);
 				print (" ");
				print ($sY * 1000 / 350000);
				print ("<BR>");
				$point[$gRecord] = ($sX * 1000 / 350000);
				$point[$gRecord + 1] = ($sY * 1000 / 350000);
			}
			elseif ($gRecord == (count($tokens) - 1)) {
				$sX = $sPunt[1] - $sMinX;
				$sY = $sPunt[2] - $sMinY;
				print ("gRecord = ubound(tokens) ");
				print ($sX * 1000 / 350000);
				print (" ");
				print ($sY *1000 / 350000);
				print ("<BR>");
				$point[$gRecord] = ($sX * 1000 / 350000);
				$point[$gRecord + 1] = ($sY * 1000 / 350000);
			}
			else {			
				$sX = $sPunt[1] - $sMinX;
				$sY = $sPunt[2]- $sMinY;
				print ($sX * 1000 / 350000);
				print (" ");
				print ($sY *1000 / 350000);
				print ("<BR>");
				$point[$gRecord] = ($sX * 1000 / 350000);
				$point[$gRecord + 1] = ($sY * 1000 / 350000);
			}
		}
	unset($point);
	}
*/
}

function SVG() {
print ("<embed src=\"?e=@SVG1\" width=\"100%\" height=\"100%\" type=\"image/svg-xml\">\n");
}

function SVG1() {
header("Content-type: image/svg-xml");
print ("<svg width=\"400\" height=\"400\" viewBox=\"0 0 1000 1000\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">\n");
print ("<rect x=\"10\" y=\"10\" width=\"100\" height=\"100\" fill=\"red\" stroke=\"blue\" stroke-width=\"3\"/>\n");
print ("</SVG>\n");
}

function CREATEPDF($p) {

$sGeo = explode("|", $p);
$tokens = explode(",", $sGeo[0]);
$sMin = explode(" ", $tokens[0]);
$sMax = explode(" ", $tokens[2]);

$sMinX = $sMin[0];
$sMinY = $sMin[1];

$oPDF = new Cezpdf('a4','portrait') or die("Kan PDFLib niet gebruiken"); 
$oPDF -> ezSetMargins(20,20,20,20);
$oPDF->openHere('Fit');

$ext1 = $sMax[1] - $sMin[0];
$ext2 = $sMax[2] - $sMin[1];

$oPDF->setLineStyle (2);
$oPDF->rectangle(20,20,(595.28 - 40),(841.89 -40));
  
for ($iRecord = 1; $iRecord < (count($sGeo) - 1); $iRecord++) {
	$oPDF->setLineStyle (0.1);
	$oPDF->setColor (1, 0, 0);
	$oPDF->setStrokeColor (0.5, 0.5, 0.5);
	$tokens = explode(",", $sGeo[$iRecord]);
	$point = array();
	$waarde = 0;
	//$waardex = (297.64);
	//$waardey = (420.945);
	//$waardex = 0;
	//$waardey = 0;
	for ($gRecord = 0; $gRecord < count($tokens); $gRecord++) {
		$sPunt = explode(" ", $tokens[$gRecord]);	
		if ($gRecord == 0) {
			$sX = $sPunt[0] - $sMinX;
			$sY = $sPunt[1] - $sMinY; 			
			$point[$waarde] = (($sX * 1000) / 0.3528 / 350000);
			$point[$waarde + 1] = (($sY * 1000) / 0.3528 / 350000);			
		}
		elseif ($gRecord == (count($tokens) - 1)) {
			$sX = $sPunt[1] - $sMinX;
			$sY = $sPunt[2] - $sMinY;
			$point[$waarde] = (($sX * 1000) / 0.3528 / 350000);
			$point[$waarde + 1] = (($sY * 1000) / 0.3528 / 350000);			
		}
		else {			
			$sX = $sPunt[1] - $sMinX;
			$sY = $sPunt[2]- $sMinY;
			$point[$waarde] = (($sX * 1000) / 0.3528 / 350000);
			$point[$waarde + 1] = (($sY * 1000) / 0.3528 / 350000);	
		}
		$waarde = $waarde + 2;
	}
	$oPDF->polygon($point,($waarde / 2),1);
	$oPDF->polygon($point,($waarde / 2));
	unset($point);
}
$oPDF->ezStream();
}
?>
