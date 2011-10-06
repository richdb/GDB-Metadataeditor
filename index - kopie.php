<?php
/*
 * ----------------------------------------------------------------------------- 
 * GDB - Metadata Geografische Gegevens         
 * ----------------------------------------------------------------------------- 
 *        
 *      Copyright 2008 Provincie Drenthe
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */
 

// Gebruik adodb.inc.php  voor connectie met de database en 
// class.ezpdf.php voor het genereren van PDF bestanden

// Wijziging begin 2010 (Richard de Bruin)
// Toevoegingen voor gereedmaken nederlandse metadata versie 1.2
// - UUID velden
// - Verwijzingen XSL sheets

// Wijziging 16-11-2010 (RIchard de Bruin)
// - Aanpassen gegevens schaal voor validatie Geonovum (1000 ipvp 1.000, etc)
// - Aanpassen datumveld notatie van DD-MM-YYYY in YYYY-MM-DD
// 

// Wijziging 14-12-2010 (Richard de Bruin)
// - Toevoegen extra trefwoord veld voor het PGR op basis van Beleidsterrein


require("adodb/adodb.inc.php");
include ("ezpdf/class.ezpdf.php");
include("arcservice/arcservice_class.php");
include("arcservice/class.uuid.php");

session_start();

//pad waar dit bestand staat
$BASEPATH = dirname(__FILE__)."\\";

//$db en $dsn worden als variabele gebruikt voor toegang tot de database
$db = ADONewConnection('access');
$dsn = "Driver={Microsoft Access Driver (*.mdb)};Dbq=".$BASEPATH."..\databases\gdb_database.mdb;Uid=;Pwd=;";

if (!$dsn){
	Error_handler("Fout in database connectie", $dsn);        
	exit();
}

if (isset($_GET['e'])) {
	$e = $_GET['e'];
	//$_SESSION["PDF"] = TRUE;
}
if (isset($_GET['p'])) {
	$p = $_GET['p'];
}

if (isset($e)) {
	switch ($e) {		
		case "@GBI":
			F_GBI($p);
			break;
		case "@GBIEXEC":		
			F_GBIEXEC($p);
			break;
		case "@PRINT":
			F_PRINT($p);
			break;
		case "@EXPORT":
			F_EXPORT($p);
			break;
		case "@TEST":
			F_TEST();
			break;
	}
}
else {
	F_GBIEXEC("MENU");
}

function F_TEST() {

$sha1  = UUID::generate(UUID::UUID_NAME_SHA1, UUID::FMT_STRING, 'stiltegeb_12', 'www.drenthe.info');

print ($sha1);

$sAdress = $_SERVER['REMOTE_ADDR'];
$sGemAdress = $_SERVER['HTTP_X_FORWARDED_FOR'];
print ($sAdress);
print ($sGemAdress);
//global $db, $dsn;

//$db->Connect($dsn); 
//$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	
//print $query;
//$tokens = explode("|", $p);
//$sAction = $tokens[0];
	
//$SQL = "SELECT DATASET_TITEL, DATACODE FROM DATASET ORDER BY DATASET_TITEL";
//$presult = $db->Execute($SQL);
//while (!$presult->EOF) {
	//$alt = $presult->fields[0];
	//$datacode = $presult->fields[1];
	//179de120-c94f-11de-80ed-393932320000
	
	//if ($alt <> "") {
		//$str = UUID::generate(UUID::UUID_RANDOM, UUID::FMT_STRING);
		//$sha1  = UUID::generate(UUID::UUID_NAME_SHA1, UUID::FMT_STRING, 'provincie drenthe', 'www.drenthe.info');
		//$str = UUID::generate(UUID::UUID_TIME, UUID::FMT_STRING, "9922");
		//F_SELECTRECORD("UPDATE DATASET SET UUID = '" . $sha1 . "' WHERE DATACODE= " . $datacode);
		//F_SELECTRECORD("UPDATE DATASET SET VERSIE_METASTD = 'Nederlandse metadatastandaard voor geografie 1.2' WHERE DATACODE= " . $datacode);
		
		//F_CREATERECORD("INSERT INTO DATASET (UUID) VALUES ('" . $sha1 . "')");	
		//print "$sha1\n";
		//print "$str\n";
		//print "<BR>\n";
	//}
	//$presult->MoveNext();

//1109
//1236
	
//for ($i = 1109; $i < 1237; $i++) {
//F_SELECTRECORD("UPDATE GEOGRAFISCH SET SCHAAL = '1000' WHERE SCHAAL = '1.000'");
//F_SELECTRECORD("UPDATE GEOGRAFISCH SET SCHAAL = '10000' WHERE SCHAAL = '10.000'");
//F_SELECTRECORD("UPDATE GEOGRAFISCH SET SCHAAL = '100000' WHERE SCHAAL = '100.000'");
//F_SELECTRECORD("UPDATE GEOGRAFISCH SET SCHAAL = '25000' WHERE SCHAAL = '25.000'");
//F_SELECTRECORD("UPDATE GEOGRAFISCH SET SCHAAL = '250000' WHERE SCHAAL = '250.000'");
//F_SELECTRECORD("UPDATE GEOGRAFISCH SET SCHAAL = '50000' WHERE SCHAAL = '50.000'");
//F_SELECTRECORD("UPDATE GEOGRAFISCH SET SCHAAL = '750000' WHERE SCHAAL = '750.000'");
//F_SELECTRECORD("UPDATE GEOGRAFISCH SET SCHAAL = '1000000' WHERE SCHAAL = '1.000.000'");

	//F_SELECTRECORD("UPDATE DATASET SET VEILIGHEID = 'niet toegankelijk' WHERE DATACODE= " . $i);	
//}	
//print ("klaar");
	
	
	
//}


/*
$sRecords = F_SELECTRECORD("SELECT ALT_TITEL FROM DATASET WHERE TYPE = 1 ORDER BY ALT_TITEL");
	
if ($sRecords <> "") {
	$aRecords = explode("|", $sRecords);
}
	
if (isset($aRecords)) {
		
	for ($iRecord = 0; $iRecord < count($aRecords) ; $iRecord++) {
		$sRecord = $aRecords[$iRecord];
		$aRecord = explode("^", $sRecord);
		$sDatacode = $aRecord[0];
		$sAlt = explode(".", $sDatacode);
		print ($sAlt[1] . ",");		
	}
}

*/

/*global $db, $dsn;
//global $dbh;
$sSQL = "SELECT a.DATACODE, a.DATASET_TITEL, a.ALT_TITEL, a.NAAM, a.FYSIEKE_LOCATIE ,b.IMSCODE
FROM DATASET AS a INNER JOIN GEOGRAFISCH AS b ON a.DATACODE = b.DATACODE
WHERE (((a.DATACODE)=[b].[DATACODE]))
ORDER BY a.DATASET_TITEL";
//$result = $dbh->Query($sSQL);
//while ($row = $result->Fetch(PDO::FETCH_ASSOC)){
	//print ($row[DATACODE]."<BR>");	
//}
$db->Connect($dsn); 

$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	
$result = $db->Execute($sSQL);

if ($result == false) {		
	die ('error');
}

print ("<TABLE WIDTH=\"100%\">"); 	
while (!$result->EOF) {
	$a = $result->fields[0];
	$b = $result->fields[1];
	$c = $result->fields[2];
	$d = $result->fields[3];
	$e = $result->fields[4];
	$p = $result->fields[5];	
	if ($p == "") {
		print ("<TR>");
		print ("<TD WIDTH=\"3%\">". $result->fields[0] . "</TD>");
		print ("<TD WIDTH=\"20%\">" . $result->fields[1] . "</TD>");
		print ("<TD WIDTH=\"15%\">" . $result->fields[2] . "</TD>");
		print ("<TD WIDTH=\"20%\">". $result->fields[3] . "</TD>");
		print ("<TD>" . $result->fields[4] . "</TD>");
		print ("</TR>");
	}	
	$result->MoveNext();	
}
print ("</TABLE>");	
*/
}

function F_EXPORT($p) {
global $db, $dsn;
F_STYLE();

$db->Connect($dsn); 

$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	
//print $query;

$tokens = explode("|", $p);
$sAction = $tokens[0];
if (count($tokens) >= 2) {
	$sDatacodeSel = $tokens[1];	
}

if (@$_SESSION["GBIMUTEREN"] == TRUE) {

if ($sAction == "PDFOPENBAAR") {

	print("<div id=\"nav_path\">\n");
	print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > <a href=\"?e=@GBI&p=EXPORT\">Exporteren</a> > Exporteren PDF openbare datasets </span>\n");
	print("</div>\n");
	print("<BR><BR><BR>\n");
	print("<CENTER>\n");	
		
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"600px\" ID=\"kopbegin\">\n");
	print("<CENTER>Exporteren PDF openbare gegevens</CENTER>\n");
	print("</TD></TR></TABLE></CENTER>\n");
	print("<BR>\n");	
		
	print("<CENTER>\n");
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD ALIGN=\"LEFT\" VALIGN=\"MIDDLE\" WIDTH=\"600px\">\n");

	$sRecords = F_SELECTRECORD("SELECT DATACODE, DATASET_TITEL, ALT_TITEL FROM DATASET WHERE TYPE = 1 ORDER BY DATASET_TITEL");
		
	
	if ($sRecords <> "") {
		$aRecords = explode("|", $sRecords);
	}
	
	if (isset($aRecords)) {
		
		for ($iRecord = 0; $iRecord < count($aRecords) ; $iRecord++) {
			
			
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sDatacode     = $aRecord[0];
			$sTitel = $aRecord[1];
			$sAltTitel = $aRecord[2];
						
			print ("PDF $sTitel opgeslagen<BR>");

			$pdf = & new Cezpdf('a4','portrait');
			$pdf -> ezSetMargins(50,70,50,50);
				
				// een lijn boven en onder op alle pagina's
			$all = $pdf->openObject();
			$pdf->saveState();
			$pdf->setStrokeColor(0,0,0,1);
			$pdf->line(20,40,578,40);
			$pdf->line(20,822,578,822);
			$pdf->addText(21,34,6,'Geografische Metagegevens | Provincie Drenthe');
			$pdf->restoreState();
			$pdf->closeObject();

			$pdf->addObject($all,'all');
				
			$pdf->ezSetDy(-100);
				
			$mainFont = './fonts/Arial.afm';
			$bdFont = './fonts/Times-Bold.afm';
				
				//selecteer een font
			$pdf->selectFont($mainFont);
				
			$pdf->saveState();
			$pdf->setColor(0.04,0.58,0.99);
			$pdf->setLineStyle(601.89);
			$pdf->setStrokeColor(0.882,0.913,0.964);
			$pdf->ellipse(0,601.89,297.64, 601.89);
			//$pdf->filledRectangle(0,601.89,595.28,100);		
			$pdf->restoreState();		
				
			$pdf->saveState();
			$pdf->setColor(1,1,1);
			
			$pdf->restoreState();
			$pdf->setColor(1,1,1);
			$pdf->filledRectangle(0,701.89,595.28,200);		
			$pdf->saveState();
				
			$sCode = F_SELECTRECORD("SELECT DATASET_TITEL FROM DATASET WHERE DATACODE = " . $sDatacode);
						
			$pdf->setColor(0.04,0.58,0.99);
			$pdf->filledRectangle(0,601.89,595.28,100);		
			$pdf->setColor(1,1,1);
			$pdf->ezText("Overzicht metagegevens",22,array('justification'=>'centre'));
			$pdf->ezText("$sCode\n",22,array('justification'=>'centre'));
			$pdf->restoreState();		
				
			$pdf->addJpegFromFile('./images/drenthe.jpg',370,750,196.5,29);
						
			$pdf->saveState();
			$pdf->setColor(0.04,0.58,0.99);
			$pdf->filledRectangle(0,100,595.28,30);		
			$pdf->restoreState();
				
			$pdf->setColor(1,1,1);
			$pdf->ezSety(125);
			$datum = date("j-m-Y");
			$pdf->ezText("Versie: $datum",18,array('justification'=>'right'));
				
			$pdf->saveState();
			$pdf->setColor(0,0.478,0.741);
			$pdf->filledRectangle(0,0,20,841.89);		
			$pdf->restoreState();	
				
			$pdf->addJpegFromFile('./images/wapen.jpg',520,50,54.2,39.2);		
			
			$pdf->setColor(0,0,0);
			
			$pdf->ezNewPage();
				
				
			//Algemeen
			$pdf->selectFont($bdFont);
			$pdf->ezText("Algemeen:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$sCode = F_SELECTRECORD("SELECT OMSCHRIJVING_CODE FROM DATASET WHERE DATACODE = " . $sDatacode);
			$datatabel = array(
				array('omschr'=>'Titel dataset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "DATASET_TITEL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Alternatieve titel:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "ALT_TITEL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Omschrijving dataset:','waarde'=>F_GBIPDFTEXT("MEMOTABEL" . "|" . "TEKST" . "|" . "CODE=" . $sCode)),
				array('omschr'=>'Algemene opmerking:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "OPMERKING" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Referentie datum:','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "BRONDATUM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Brondatum:','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "OPBOUWDATUM" . "|" . "DATACODE=" . $sDatacode)),			
				array('omschr'=>'Bronvermelding:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "BRONVERMELDING" . "|" . "DATACODE=" . $sDatacode)),			
				array('omschr'=>'Opbouwmethode:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "OPBOUWMETHODE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Gebeurtenis:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "ACTIE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Status:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "STATUS" . "|" . "DATACODE=" . $sDatacode))
				);
					
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
			$sTrefwoorden = F_SELECTRECORD("SELECT TREFTEXT.TREFWOORD FROM TREFCODE INNER JOIN TREFTEXT ON TREFCODE.TREFCODE = TREFTEXT.TREFCODE WHERE TREFCODE.DATACODE=" . $sDatacode . " ORDER BY TREFTEXT.TREFWOORD");
			$sTref = str_replace("|", ", ", $sTrefwoorden);
				
			//Inhoud
			$pdf->selectFont($bdFont);
			$pdf->ezText("Inhoud:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$sContactpersoon = F_SELECTRECORD("SELECT CONTACTPERSOON FROM DATASET WHERE DATACODE = " . $sDatacode);
			$datatabel = array(
				array('omschr'=>'Contactpersoon inhoud:','waarde'=>F_GBIPDFTEXT("CONTACT" . "|" . "CONTACTPERSOON" . "|" . "CONTACT_ID=" . $sContactpersoon)),
				array('omschr'=>'Beleidsterrein:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "BELEIDSVELD" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Team:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "TEAM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Thema:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "THEMA" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Gebruiksbeperking:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "GEBRUIKSBEPERKING" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Veiligheidsrestricties:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "VEILIGHEID" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Toegangsrestricties:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "JURIDISCH" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Copyright:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "COPYRIGHT" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Herzienings frequentie:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "BIJHOUDING" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Toepassingsschaal:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "SCHAAL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Contact leverancier:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "CONTACT_LEVERANCIER" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Trefwoorden:','waarde'=>$sTref),
				array('omschr'=>'Dekking (begin datum):','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "DEKKING_BEGIN" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Dekking (eind datum):','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "DEKKING_EIND" . "|" . "DATACODE=" . $sDatacode))
				//array('omschr'=>'Taal dataset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "TAAL" . "|" . "DATACODE=" . $sDatacode)),
				//array('omschr'=>'Karakterset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "KARAKTERSET" . "|" . "DATACODE=" . $sDatacode))
				);
					
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
			//Specifiek	
			$pdf->selectFont($bdFont);
			$pdf->ezText("Specifiek:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$sGebied = F_SELECTRECORD( "SELECT DEELGEBIED FROM GEOGRAFISCH WHERE DATACODE = "  . $sDatacode);
								
			$datatabel = array(
				array('omschr'=>'Geografisch gebied:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "DEELGEBIED" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Aanvullende informatie:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "AANVUL_INFO" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Ruimtelijk schema:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "RSCHEMA" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Bestandsnaam:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "NAAM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Fysieke locatie:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "FYSIEKE_LOCATIE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Datatype:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "DATATYPE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Geometrie:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "GEOMETRIE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Nauwkeurigheid:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "POS_NAUWKEURIGHEID" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Kwaliteitsbeschrijving:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "KWALITEIT_BESCH" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Minimale x-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MIN_X" . "|" . "GEBIED='" . $sGebied . "'")),
				array('omschr'=>'Maximale x-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MAX_X" . "|" . "GEBIED='" . $sGebied . "'")),
				array('omschr'=>'Minimale y-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MIN_Y" . "|" . "GEBIED='" . $sGebied . "'")),
				array('omschr'=>'Maximale y-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MAX_Y" . "|" . "GEBIED='" . $sGebied . "'"))
				);
				
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
			$sItem = F_SELECTRECORD( "SELECT STD_ITEM FROM GEOGRAFISCH WHERE DATACODE = "  . $sDatacode);
			$sCode = F_SELECTRECORD( "SELECT ITEMDEFINITIE FROM ITEMS WHERE ITEMS.DATACODE = " . $sDatacode . " AND ITEMS.ITEMNAAM = '" . $sItem . "'");
			$sDefitem = F_SELECTRECORD( "SELECT ITEMDEFINITIE FROM ITEMS WHERE DATACODE= " . $sDatacode . " AND ITEMNAAM = '" . $sItem . "'");		
			$sItemrec = F_SELECTRECORD("SELECT VOLGNR, ITEMNAAM, ITEMDEFINITIE FROM ITEMS WHERE DATACODE=" . $sDatacode . " ORDER BY VOLGNR");
			$sItemrecs = str_replace("|", "\n", $sItemrec);
			$sItemrecss = str_replace("^", " ", $sItemrecs);
				
			$datatabel = array(						
				array('omschr'=>'Standaarditem:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "STD_ITEM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Definitie standaarditem:','waarde'=>$sDefitem),			
				array('omschr'=>'Items:','waarde'=>$sItemrecss)
				);
			
			$pdf->selectFont($bdFont);
			$pdf->ezText("Items:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
				//metadata
			$sMetapersoon = F_SELECTRECORD("SELECT METAPERSOON FROM DATASET WHERE DATACODE = " . $sDatacode);
			$sGeopersoon = F_SELECTRECORD("SELECT GEOLOKET FROM DATASET WHERE DATACODE = " . $sDatacode);
			$datatabel = array(
				array('omschr'=>'Contactpersoon inhoud:','waarde'=>F_GBIPDFTEXT("CONTACT" . "|" . "CONTACTPERSOON" . "|" . "CONTACT_ID=" . $sMetapersoon)),
				array('omschr'=>'Datum opbouw:','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "INVOERDATUM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Taal dataset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "TAAL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Karakterset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "KARAKTERSET" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Metadatastandaard:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "METADATASTD" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Versie metadatastandaard:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "VERSIE_METASTD" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Code referentiesysteem:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "CODE_REF" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Organisatie referentiesysteem:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "ORG_NAMESPACE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Contactpersoon distributie:','waarde'=>F_GBIPDFTEXT("CONTACT" . "|" . "CONTACTPERSOON" . "|" . "CONTACT_ID=" . $sGeopersoon))			
				);
			
			$pdf->selectFont($bdFont);
			$pdf->ezText("Metadata:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));				
				
			//$pdf->ezStream();	
			$pdfcode = $pdf->ezOutput();
			$fp=fopen('../metadata/' . $sAltTitel . '.pdf','wb');
			fwrite($fp,$pdfcode);
			fclose($fp);
		}		
	}
print("<BR>\n");
print(count($aRecords) . " succesvol datasets als PDF opgeslagen. Klik <A HREF=\"?e=@GBI&p=EXPORT\"> hier</A> voor administratieve taken");
print("<BR>\n");
print("<BR>\n");	
}

if ($sAction == "PDFDATASET") {

	$sRecords = F_SELECTRECORD("SELECT DATACODE, DATASET_TITEL, ALT_TITEL FROM DATASET WHERE DATACODE = " . $sDatacodeSel);
		
	
	if ($sRecords <> "") {
		$aRecords = explode("|", $sRecords);
	}
	
	if (isset($aRecords)) {
		
		for ($iRecord = 0; $iRecord < count($aRecords) ; $iRecord++) {
			
			
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sDatacode     = $aRecord[0];
			$sTitel = $aRecord[1];
			$sAltTitel = $aRecord[2];
						
			print ("PDF $sTitel opgeslagen<BR>");

			$pdf = & new Cezpdf('a4','portrait');
			$pdf -> ezSetMargins(50,70,50,50);
				
				// een lijn boven en onder op alle pagina's
			$all = $pdf->openObject();
			$pdf->saveState();
			$pdf->setStrokeColor(0,0,0,1);
			$pdf->line(20,40,578,40);
			$pdf->line(20,822,578,822);
			$pdf->addText(21,34,6,'Geografische Metagegevens | Provincie Drenthe');
			$pdf->restoreState();
			$pdf->closeObject();

			$pdf->addObject($all,'all');
				
			$pdf->ezSetDy(-100);
				
			$mainFont = './fonts/Arial.afm';
			$bdFont = './fonts/Times-Bold.afm';
				
				//selecteer een font
			$pdf->selectFont($mainFont);
				
			$pdf->saveState();
			$pdf->setColor(0.04,0.58,0.99);
			$pdf->setLineStyle(601.89);
			$pdf->setStrokeColor(0.882,0.913,0.964);
			$pdf->ellipse(0,601.89,297.64, 601.89);
			//$pdf->filledRectangle(0,601.89,595.28,100);		
			$pdf->restoreState();		
				
			$pdf->saveState();
			$pdf->setColor(1,1,1);
			
			$pdf->restoreState();
			$pdf->setColor(1,1,1);
			$pdf->filledRectangle(0,701.89,595.28,200);		
			$pdf->saveState();
				
			$sCode = F_SELECTRECORD("SELECT DATASET_TITEL FROM DATASET WHERE DATACODE = " . $sDatacode);
						
			$pdf->setColor(0.04,0.58,0.99);
			$pdf->filledRectangle(0,601.89,595.28,100);		
			$pdf->setColor(1,1,1);
			$pdf->ezText("Overzicht metagegevens",22,array('justification'=>'centre'));
			$pdf->ezText("$sCode\n",22,array('justification'=>'centre'));
			$pdf->restoreState();		
				
			$pdf->addJpegFromFile('./images/drenthe.jpg',370,750,196.5,29);
						
			$pdf->saveState();
			$pdf->setColor(0.04,0.58,0.99);
			$pdf->filledRectangle(0,100,595.28,30);		
			$pdf->restoreState();
				
			$pdf->setColor(1,1,1);
			$pdf->ezSety(125);
			$datum = date("j-m-Y");
			$pdf->ezText("Versie: $datum",18,array('justification'=>'right'));
				
			$pdf->saveState();
			$pdf->setColor(0,0.478,0.741);
			$pdf->filledRectangle(0,0,20,841.89);		
			$pdf->restoreState();	
				
			$pdf->addJpegFromFile('./images/wapen.jpg',520,50,54.2,39.2);		
			
			$pdf->setColor(0,0,0);
			
			$pdf->ezNewPage();
				
				
			//Algemeen
			$pdf->selectFont($bdFont);
			$pdf->ezText("Algemeen:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$sCode = F_SELECTRECORD("SELECT OMSCHRIJVING_CODE FROM DATASET WHERE DATACODE = " . $sDatacode);
			$datatabel = array(
				array('omschr'=>'Titel dataset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "DATASET_TITEL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Alternatieve titel:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "ALT_TITEL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Omschrijving dataset:','waarde'=>F_GBIPDFTEXT("MEMOTABEL" . "|" . "TEKST" . "|" . "CODE=" . $sCode)),
				array('omschr'=>'Algemene opmerking:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "OPMERKING" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Referentie datum:','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "BRONDATUM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Brondatum:','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "OPBOUWDATUM" . "|" . "DATACODE=" . $sDatacode)),			
				array('omschr'=>'Bronvermelding:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "BRONVERMELDING" . "|" . "DATACODE=" . $sDatacode)),			
				array('omschr'=>'Opbouwmethode:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "OPBOUWMETHODE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Gebeurtenis:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "ACTIE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Status:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "STATUS" . "|" . "DATACODE=" . $sDatacode))
				);
					
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
			$sTrefwoorden = F_SELECTRECORD("SELECT TREFTEXT.TREFWOORD FROM TREFCODE INNER JOIN TREFTEXT ON TREFCODE.TREFCODE = TREFTEXT.TREFCODE WHERE TREFCODE.DATACODE=" . $sDatacode . " ORDER BY TREFTEXT.TREFWOORD");
			$sTref = str_replace("|", ", ", $sTrefwoorden);
				
			//Inhoud
			$pdf->selectFont($bdFont);
			$pdf->ezText("Inhoud:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$sContactpersoon = F_SELECTRECORD("SELECT CONTACTPERSOON FROM DATASET WHERE DATACODE = " . $sDatacode);
			$datatabel = array(
				array('omschr'=>'Contactpersoon inhoud:','waarde'=>F_GBIPDFTEXT("CONTACT" . "|" . "CONTACTPERSOON" . "|" . "CONTACT_ID=" . $sContactpersoon)),
				array('omschr'=>'Beleidsterrein:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "BELEIDSVELD" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Team:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "TEAM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Thema:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "THEMA" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Gebruiksbeperking:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "GEBRUIKSBEPERKING" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Veiligheidsrestricties:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "VEILIGHEID" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Toegangsrestricties:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "JURIDISCH" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Copyright:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "COPYRIGHT" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Herzienings frequentie:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "BIJHOUDING" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Toepassingsschaal:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "SCHAAL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Contact leverancier:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "CONTACT_LEVERANCIER" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Trefwoorden:','waarde'=>$sTref),
				array('omschr'=>'Dekking (begin datum):','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "DEKKING_BEGIN" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Dekking (eind datum):','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "DEKKING_EIND" . "|" . "DATACODE=" . $sDatacode))
				//array('omschr'=>'Taal dataset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "TAAL" . "|" . "DATACODE=" . $sDatacode)),
				//array('omschr'=>'Karakterset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "KARAKTERSET" . "|" . "DATACODE=" . $sDatacode))
				);
					
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
			//Specifiek	
			$pdf->selectFont($bdFont);
			$pdf->ezText("Specifiek:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$sGebied = F_SELECTRECORD( "SELECT DEELGEBIED FROM GEOGRAFISCH WHERE DATACODE = "  . $sDatacode);
								
			$datatabel = array(
				array('omschr'=>'Geografisch gebied:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "DEELGEBIED" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Aanvullende informatie:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "AANVUL_INFO" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Ruimtelijk schema:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "RSCHEMA" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Bestandsnaam:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "NAAM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Fysieke locatie:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "FYSIEKE_LOCATIE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Datatype:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "DATATYPE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Geometrie:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "GEOMETRIE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Nauwkeurigheid:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "POS_NAUWKEURIGHEID" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Kwaliteitsbeschrijving:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "KWALITEIT_BESCH" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Minimale x-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MIN_X" . "|" . "GEBIED='" . $sGebied . "'")),
				array('omschr'=>'Maximale x-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MAX_X" . "|" . "GEBIED='" . $sGebied . "'")),
				array('omschr'=>'Minimale y-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MIN_Y" . "|" . "GEBIED='" . $sGebied . "'")),
				array('omschr'=>'Maximale y-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MAX_Y" . "|" . "GEBIED='" . $sGebied . "'"))
				);
				
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
			$sItem = F_SELECTRECORD( "SELECT STD_ITEM FROM GEOGRAFISCH WHERE DATACODE = "  . $sDatacode);
			$sCode = F_SELECTRECORD( "SELECT ITEMDEFINITIE FROM ITEMS WHERE ITEMS.DATACODE = " . $sDatacode . " AND ITEMS.ITEMNAAM = '" . $sItem . "'");
			$sDefitem = F_SELECTRECORD( "SELECT ITEMDEFINITIE FROM ITEMS WHERE DATACODE= " . $sDatacode . " AND ITEMNAAM = '" . $sItem . "'");		
			$sItemrec = F_SELECTRECORD("SELECT VOLGNR, ITEMNAAM, ITEMDEFINITIE FROM ITEMS WHERE DATACODE=" . $sDatacode . " ORDER BY VOLGNR");
			$sItemrecs = str_replace("|", "\n", $sItemrec);
			$sItemrecss = str_replace("^", " ", $sItemrecs);
				
			$datatabel = array(						
				array('omschr'=>'Standaarditem:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "STD_ITEM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Definitie standaarditem:','waarde'=>$sDefitem),			
				array('omschr'=>'Items:','waarde'=>$sItemrecss)
				);
			
			$pdf->selectFont($bdFont);
			$pdf->ezText("Items:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
				//metadata
			$sMetapersoon = F_SELECTRECORD("SELECT METAPERSOON FROM DATASET WHERE DATACODE = " . $sDatacode);
			$sGeopersoon = F_SELECTRECORD("SELECT GEOLOKET FROM DATASET WHERE DATACODE = " . $sDatacode);
			$datatabel = array(
				array('omschr'=>'Contactpersoon inhoud:','waarde'=>F_GBIPDFTEXT("CONTACT" . "|" . "CONTACTPERSOON" . "|" . "CONTACT_ID=" . $sMetapersoon)),
				array('omschr'=>'Datum opbouw:','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "INVOERDATUM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Taal dataset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "TAAL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Karakterset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "KARAKTERSET" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Metadatastandaard:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "METADATASTD" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Versie metadatastandaard:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "VERSIE_METASTD" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Code referentiesysteem:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "CODE_REF" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Organisatie referentiesysteem:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "ORG_NAMESPACE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Contactpersoon distributie:','waarde'=>F_GBIPDFTEXT("CONTACT" . "|" . "CONTACTPERSOON" . "|" . "CONTACT_ID=" . $sGeopersoon))			
				);
			
			$pdf->selectFont($bdFont);
			$pdf->ezText("Metadata:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));				
				
			//$pdf->ezStream();	
			$pdfcode = $pdf->ezOutput();
			$fp=fopen('../metadata/' . $sAltTitel . '.pdf','wb');
			fwrite($fp,$pdfcode);
			fclose($fp);
		}		
	}
print($DatacodeSel. " succesvol als PDF opgeslagen. Klik <A HREF=\"?e=@GBI&p=DATASETEDIT|" . $sDatacodeSel . "\"> hier</A> voor om terug te gaan naar dataset gegevens");
print("<BR>\n");
print("<BR>\n");	
}

if ($sAction == "PDFITEMS") {
	print("<div id=\"nav_path\">\n");
	print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > <a href=\"?e=@GBI&p=EXPORT\">Exporteren</a> > Exporteren PDF beschrijving items </span>\n");
	print("</div>\n");
	print("<BR><BR><BR>\n");
	print("<CENTER>\n");	
		
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"600px\" ID=\"kopbegin\">\n");
	print("<CENTER>Exporteren PDF beschrijving items</CENTER>\n");
	print("</TD></TR></TABLE></CENTER>\n");
	print("<BR>\n");	
		
	print("<CENTER>\n");
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD ALIGN=\"LEFT\" VALIGN=\"MIDDLE\" WIDTH=\"600px\">\n");

	$sRecords = F_SELECTRECORD("SELECT DATACODE, DATASET_TITEL, ALT_TITEL FROM DATASET WHERE TYPE = 1 ORDER BY DATASET_TITEL");
		
	
	if ($sRecords <> "") {
		$aRecords = explode("|", $sRecords);
	}
	
	if (isset($aRecords)) {
		
		for ($iRecord = 0; $iRecord < count($aRecords) ; $iRecord++) {
			
			
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sDatacode     = $aRecord[0];
			$sTitel = $aRecord[1];
			$sAltTitel = $aRecord[2];
						
			print ("PDF $sTitel opgeslagen<BR>");

			$pdf = & new Cezpdf('a4','portrait');
			$pdf -> ezSetMargins(50,70,50,50);
				
				// een lijn boven en onder op alle pagina's
			$all = $pdf->openObject();
			$pdf->saveState();
			$pdf->setStrokeColor(0,0,0,1);
			$pdf->line(20,40,578,40);
			$pdf->line(20,822,578,822);
			$pdf->addText(21,34,6,'Geografische Metagegevens | Provincie Drenthe');
			$pdf->restoreState();
			$pdf->closeObject();

			$pdf->addObject($all,'all');
				
			$pdf->ezSetDy(-100);
				
			$mainFont = './fonts/Arial.afm';
			$bdFont = './fonts/Times-Bold.afm';
				
				//selecteer een font
			$pdf->selectFont($mainFont);
				
			$pdf->saveState();
			$pdf->setColor(0.04,0.58,0.99);
			$pdf->setLineStyle(601.89);
			$pdf->setStrokeColor(0.882,0.913,0.964);
			$pdf->ellipse(0,601.89,297.64, 601.89);
			//$pdf->filledRectangle(0,601.89,595.28,100);		
			$pdf->restoreState();		
				
			$pdf->saveState();
			$pdf->setColor(1,1,1);
			
			$pdf->restoreState();
			$pdf->setColor(1,1,1);
			$pdf->filledRectangle(0,701.89,595.28,200);		
			$pdf->saveState();
				
			$sCode = F_SELECTRECORD("SELECT DATASET_TITEL FROM DATASET WHERE DATACODE = " . $sDatacode);
						
			$pdf->setColor(0.04,0.58,0.99);
			$pdf->filledRectangle(0,601.89,595.28,100);		
			$pdf->setColor(1,1,1);
			$pdf->ezText("Overzicht items",22,array('justification'=>'centre'));
			$pdf->ezText("$sCode\n",22,array('justification'=>'centre'));
			$pdf->restoreState();		
				
			$pdf->addJpegFromFile('./images/drenthe.jpg',370,750,196.5,29);
						
			$pdf->saveState();
			$pdf->setColor(0.04,0.58,0.99);
			$pdf->filledRectangle(0,100,595.28,30);		
			$pdf->restoreState();
				
			$pdf->setColor(1,1,1);
			$pdf->ezSety(125);
			$datum = date("j-m-Y");
			$pdf->ezText("Versie: $datum",18,array('justification'=>'right'));
				
			$pdf->saveState();
			$pdf->setColor(0,0.478,0.741);
			$pdf->filledRectangle(0,0,20,841.89);		
			$pdf->restoreState();	
				
			$pdf->addJpegFromFile('./images/wapen.jpg',520,50,54.2,39.2);		
			
			$pdf->setColor(0,0,0);
			
			$pdf->ezNewPage();
				
			
			$sItemRecords = F_SELECTRECORD("SELECT a.VOLGNR, a.ITEMNAAM, a.ITEMDEFINITIE, a.EENHEID, b.TEKST FROM ITEMS a, MEMOTABEL b WHERE a.DOMEIN = b.CODE AND DATACODE =" . $sDatacode . " ORDER BY VOLGNR");
	
    		unset($aItemRecords);
			if ($sItemRecords <> "") {
				$aItemRecords = explode("|", $sItemRecords);
			}
	
			if (isset($aItemRecords)) {
				for ($iItemRecord = 0; $iItemRecord < count($aItemRecords); $iItemRecord++) {
					$sItemRecord = $aItemRecords[$iItemRecord];
					$aItemRecord = explode("^", $sItemRecord);
					$sVolgnr     = $aItemRecord[0];
					$sKolomnaam = $aItemRecord[1];
					$sKolomdef = $aItemRecord[2];
					$sEenheid = $aItemRecord[3];
					$sTekst = $aItemRecord[4];
					
					$sWaarde = F_SELECTRECORD("SELECT DOMEIN FROM ITEMS WHERE DATACODE = " . $sDatacode . " AND VOLGNR = " . $sVolgnr);

					$pdf->selectFont($mainFont);
					
					$datatabel = array(
						array('omschr'=>'Nr:','waarde'=>$sVolgnr),
						array('omschr'=>'Itemnaam:','waarde'=>$sKolomnaam),
						array('omschr'=>'Itemdefinitie:','waarde'=>$sKolomdef),
						array('omschr'=>'Eenheid:','waarde'=>$sEenheid),
						array('omschr'=>'Waarden:','waarde'=>$sTekst)						
						);
							
					$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
					array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
					'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
					'xOrientation'=>'right','fontsize'=>12,
					'cols'=>array('omschr'=>array('width'=>132))));
						
					$pdf->ezText("",10,array('justification'=>'centre'));
				}
			}
						
			//$pdf->ezStream();	
			$pdfcode = $pdf->ezOutput();
			$fp=fopen('../metadata/' . 'CODE_' . $sAltTitel . '.pdf','wb');
			fwrite($fp,$pdfcode);
			fclose($fp);
		}		
	}
	print("<BR>\n");
	print(count($aRecords) . " succesvol datasets als PDF opgeslagen. Klik <A HREF=\"?e=@GBI&p=EXPORT\"> hier</A> voor administratieve taken");
	print("<BR>\n");
	print("<BR>\n");
} 

if ($sAction == "PDFITEMSDATASET") {
	
	$sRecords = F_SELECTRECORD("SELECT DATACODE, DATASET_TITEL, ALT_TITEL FROM DATASET WHERE DATACODE = " . $sDatacodeSel);
		
	
	if ($sRecords <> "") {
		$aRecords = explode("|", $sRecords);
	}
	
	if (isset($aRecords)) {
		
		for ($iRecord = 0; $iRecord < count($aRecords) ; $iRecord++) {
			
			
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sDatacode     = $aRecord[0];
			$sTitel = $aRecord[1];
			$sAltTitel = $aRecord[2];
						
			print ("PDF $sTitel opgeslagen<BR>");

			$pdf = & new Cezpdf('a4','portrait');
			$pdf -> ezSetMargins(50,70,50,50);
				
				// een lijn boven en onder op alle pagina's
			$all = $pdf->openObject();
			$pdf->saveState();
			$pdf->setStrokeColor(0,0,0,1);
			$pdf->line(20,40,578,40);
			$pdf->line(20,822,578,822);
			$pdf->addText(21,34,6,'Geografische Metagegevens | Provincie Drenthe');
			$pdf->restoreState();
			$pdf->closeObject();

			$pdf->addObject($all,'all');
				
			$pdf->ezSetDy(-100);
				
			$mainFont = './fonts/Arial.afm';
			$bdFont = './fonts/Times-Bold.afm';
				
				//selecteer een font
			$pdf->selectFont($mainFont);
				
			$pdf->saveState();
			$pdf->setColor(0.04,0.58,0.99);
			$pdf->setLineStyle(601.89);
			$pdf->setStrokeColor(0.882,0.913,0.964);
			$pdf->ellipse(0,601.89,297.64, 601.89);
			//$pdf->filledRectangle(0,601.89,595.28,100);		
			$pdf->restoreState();		
				
			$pdf->saveState();
			$pdf->setColor(1,1,1);
			
			$pdf->restoreState();
			$pdf->setColor(1,1,1);
			$pdf->filledRectangle(0,701.89,595.28,200);		
			$pdf->saveState();
				
			$sCode = F_SELECTRECORD("SELECT DATASET_TITEL FROM DATASET WHERE DATACODE = " . $sDatacode);
						
			$pdf->setColor(0.04,0.58,0.99);
			$pdf->filledRectangle(0,601.89,595.28,100);		
			$pdf->setColor(1,1,1);
			$pdf->ezText("Overzicht items",22,array('justification'=>'centre'));
			$pdf->ezText("$sCode\n",22,array('justification'=>'centre'));
			$pdf->restoreState();		
				
			$pdf->addJpegFromFile('./images/drenthe.jpg',370,750,196.5,29);
						
			$pdf->saveState();
			$pdf->setColor(0.04,0.58,0.99);
			$pdf->filledRectangle(0,100,595.28,30);		
			$pdf->restoreState();
				
			$pdf->setColor(1,1,1);
			$pdf->ezSety(125);
			$datum = date("j-m-Y");
			$pdf->ezText("Versie: $datum",18,array('justification'=>'right'));
				
			$pdf->saveState();
			$pdf->setColor(0,0.478,0.741);
			$pdf->filledRectangle(0,0,20,841.89);		
			$pdf->restoreState();	
				
			$pdf->addJpegFromFile('./images/wapen.jpg',520,50,54.2,39.2);		
			
			$pdf->setColor(0,0,0);
			
			$pdf->ezNewPage();
				
			
			$sItemRecords = F_SELECTRECORD("SELECT a.VOLGNR, a.ITEMNAAM, a.ITEMDEFINITIE, a.EENHEID, b.TEKST FROM ITEMS a, MEMOTABEL b WHERE a.DOMEIN = b.CODE AND DATACODE =" . $sDatacode . " ORDER BY VOLGNR");
	
    		unset($aItemRecords);
			if ($sItemRecords <> "") {
				$aItemRecords = explode("|", $sItemRecords);
			}
	
			if (isset($aItemRecords)) {
				for ($iItemRecord = 0; $iItemRecord < count($aItemRecords); $iItemRecord++) {
					$sItemRecord = $aItemRecords[$iItemRecord];
					$aItemRecord = explode("^", $sItemRecord);
					$sVolgnr     = $aItemRecord[0];
					$sKolomnaam = $aItemRecord[1];
					$sKolomdef = $aItemRecord[2];
					$sEenheid = $aItemRecord[3];
					$sTekst = $aItemRecord[4];
					
					$sWaarde = F_SELECTRECORD("SELECT DOMEIN FROM ITEMS WHERE DATACODE = " . $sDatacode . " AND VOLGNR = " . $sVolgnr);

					$pdf->selectFont($mainFont);
					
					$datatabel = array(
						array('omschr'=>'Nr:','waarde'=>$sVolgnr),
						array('omschr'=>'Itemnaam:','waarde'=>$sKolomnaam),
						array('omschr'=>'Itemdefinitie:','waarde'=>$sKolomdef),
						array('omschr'=>'Eenheid:','waarde'=>$sEenheid),
						array('omschr'=>'Waarden:','waarde'=>$sTekst)						
						);
							
					$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
					array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
					'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
					'xOrientation'=>'right','fontsize'=>12,
					'cols'=>array('omschr'=>array('width'=>132))));
						
					$pdf->ezText("",10,array('justification'=>'centre'));
				}
			}
						
			//$pdf->ezStream();	
			$pdfcode = $pdf->ezOutput();
			$fp=fopen('../metadata/' . 'CODE_' . $sAltTitel . '.pdf','wb');
			fwrite($fp,$pdfcode);
			fclose($fp);
		}		
	}
	
	print($DatacodeSel. " succesvol als PDF opgeslagen. Klik <A HREF=\"?e=@GBI&p=DATASETEDIT|" . $sDatacodeSel . "\"> hier</A> voor om terug te gaan naar dataset gegevens");
	print("<BR>\n");
	print("<BR>\n");
}

if ($sAction == "XMLOPENBAAR") {
	print("<div id=\"nav_path\">\n");
	print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > <a href=\"?e=@GBI&p=EXPORT\">Exporteren</a> > Exporteren XML openbare datasets </span>\n");
	print("</div>\n");
	print("<BR><BR><BR>\n");
	print("<CENTER>\n");	
		
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"600px\" ID=\"kopbegin\">\n");
	print("<CENTER>Exporteren XML openbare gegevens</CENTER>\n");
	print("</TD></TR></TABLE></CENTER>\n");
	print("<BR>\n");	
		
	print("<CENTER>\n");
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD ALIGN=\"LEFT\" VALIGN=\"MIDDLE\" WIDTH=\"600px\">\n");

	$sRecords = F_SELECTRECORD("SELECT DATACODE, DATASET_TITEL, ALT_TITEL FROM DATASET WHERE TYPE = 1 ORDER BY DATASET_TITEL");
			
	if ($sRecords <> "") {
		$aRecords = explode("|", $sRecords);
	}
	
	if (isset($aRecords)) {
		
		for ($iRecord = 0; $iRecord < count($aRecords) ; $iRecord++) {
			
			
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sDatacode  = $aRecord[0];
			$sTitel = $aRecord[1];
			$sAltTitel = $aRecord[2];
						
			print ("PDF $sTitel opgeslagen<BR>");
			
			$SQL = F_SELECTRECORD("SELECT a.DATASET_TITEL, a.ALT_TITEL, a.NAAM, a.OPMERKING, a.GEOLOKET, a.CONTACT_LEVERANCIER, a.ORG_NAMESPACE, a.CODE_REF, a.VERSIE_METASTD, a.METADATASTD, 
			a.INVOERDATUM, a.METAPERSOON, a.DEKKING_BEGIN, a.DEKKING_EIND, c.STD_ITEM, c.POS_NAUWKEURIGHEID, a.KWALITEIT_BESCH, a.RSCHEMA, a.DATATYPE, a.FYSIEKE_LOCATIE, a.AANVUL_INFO, 
			a.OPBOUWDATUM, a.ACTIE, c.DEELGEBIED, a.BIJHOUDING, a.TAAL, a.KARAKTERSET, a.COPYRIGHT, a.TEAM, a.JURIDISCH, a.STATUS, a.VEILIGHEID, a.GEBRUIKSBEPERKING, a.THEMA, 
			a.BELEIDSVELD, a.CONTACTPERSOON, a.BRONDATUM, a.GEOLOKET, c.OPBOUWMETHODE, c.BRONVERMELDING, c.SCHAAL, c.GEOMETRIE, b.TEKST, a.UUIDBRON, a.UUID FROM DATASET a, MEMOTABEL b, GEOGRAFISCH c WHERE a.OMSCHRIJVING_CODE = b.CODE AND a.DATACODE = c.DATACODE AND a.DATACODE = " . $sDatacode);
			
			if ($SQL <> "") {
				$aSQL = explode("^", $SQL);
			}			
			
			$sFile = "../metadata/" .$sAltTitel . ".xml";
			$sFh = fopen($sFile, 'w');
			fwrite($sFh, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
			//fwrite($sFh, "<metadata>\n");
			//fwrite($sFh, "<MD_Metadata xmlns:gml=\"http://www.opengis.net/gml\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:gco=\"http://www.isotc211.org/2005/gco\" xsi:schemaLocation=\" http://www.isotc211.org/2005/gmd http://schemas.opengis.net/iso/19139/20060504/gmd/gmd.xsd \" xmlns=\"http://www.isotc211.org/2005/gmd\">\n");			
			fwrite($sFh, "<gmd:MD_Metadata xmlns:gmx=\"http://www.isotc211.org/2005/gmx\"\n");
			fwrite($sFh, "xmlns:srv=\"http://www.isotc211.org/2005/srv\" xmlns:gml=\"http://www.opengis.net/gml\"\n");
			fwrite($sFh, "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n");
			fwrite($sFh, "xmlns:gmd=\"http://www.isotc211.org/2005/gmd\" xmlns:gco=\"http://www.isotc211.org/2005/gco\"\n");
			fwrite($sFh, "xmlns:gsr=\"http://www.isotc211.org/2005/gsr\" xmlns:xlink=\"http://www.w3.org/1999/xlink\"\n");
			fwrite($sFh, "xsi:schemaLocation=\"http://www.isotc211.org/2005/gmd http://schemas.opengis.net/iso/19139/20060504/gmd/gmd.xsd\">\n");
			
			fwrite($sFh, "<gmd:fileIdentifier>\n");
			fwrite($sFh, "<gco:CharacterString xmlns:srv=\"http://www.isotc211.org/2005/srv\">" . $aSQL[44] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fileIdentifier>\n");
			fwrite($sFh, "<gmd:language>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[25] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:language>\n");
			fwrite($sFh, "<gmd:characterSet>\n");
			fwrite($sFh, "<gmd:MD_CharacterSetCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_CharacterSetCode\" codeListValue=\"" . $aSQL[26] . "\"/>\n");
			fwrite($sFh, "</gmd:characterSet>\n");
			fwrite($sFh, "<gmd:hierarchyLevel>\n");
			fwrite($sFh, "<gmd:MD_ScopeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ScopeCode\" codeListValue=\"" . $aSQL[16] . "\" />\n");
			fwrite($sFh, "</gmd:hierarchyLevel>\n");
			fwrite($sFh, "<gmd:hierarchyLevelName>\n");
			fwrite($sFh, "</gmd:hierarchyLevelName>\n");
			fwrite($sFh, "<gmd:contact>\n");			
			fwrite($sFh, "<gmd:CI_ResponsibleParty>\n");
			fwrite($sFh, "<gmd:individualName>\n");
			$sWaarde = F_SELECTRECORD("SELECT CONTACTPERSOON FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:individualName>\n");
			fwrite($sFh, "<gmd:organisationName>\n");
			$sWaarde = F_SELECTRECORD("SELECT ORGANISATIE FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:organisationName>\n");
			fwrite($sFh, "<gmd:positionName>\n");
			fwrite($sFh, "<gco:CharacterString>Auteur</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:positionName>\n");
			fwrite($sFh, "<gmd:contactInfo>\n");
			fwrite($sFh, "<gmd:CI_Contact>\n");
			fwrite($sFh, "<gmd:phone>\n");
			fwrite($sFh, "<gmd:CI_Telephone>\n");
			fwrite($sFh, "<gmd:voice>\n");
			$sWaarde = F_SELECTRECORD("SELECT TELEFOON FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:voice>\n");
			fwrite($sFh, "<gmd:facsimile>\n");
			$sWaarde = F_SELECTRECORD("SELECT FAX FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:facsimile>\n");
			fwrite($sFh, "</gmd:CI_Telephone>\n");
			fwrite($sFh, "</gmd:phone>\n");
			fwrite($sFh, "<gmd:address>\n");
			fwrite($sFh, "<gmd:CI_Address>\n");
			fwrite($sFh, "<gmd:deliveryPoint>\n");
			$sWaarde = F_SELECTRECORD("SELECT ADRES FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:deliveryPoint>\n");
			fwrite($sFh, "<gmd:city>\n");
			$sWaarde = F_SELECTRECORD("SELECT PLAATS FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:city>\n");
			fwrite($sFh, "<gmd:administrativeArea>\n");
			$sWaarde = F_SELECTRECORD("SELECT GEBIED FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:administrativeArea>\n");
			fwrite($sFh, "<gmd:postalCode>\n");
			$sWaarde = F_SELECTRECORD("SELECT POSTCODE FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:postalCode>\n");
			fwrite($sFh, "<gmd:country>\n");
			$sWaarde = F_SELECTRECORD("SELECT LAND FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:country>\n");
			fwrite($sFh, "<gmd:electronicMailAddress>\n");
			$sWaarde = F_SELECTRECORD("SELECT EMAIL FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:electronicMailAddress>\n");
			fwrite($sFh, "</gmd:CI_Address>\n");
			fwrite($sFh, "</gmd:address>\n");
			fwrite($sFh, "<gmd:onlineResource>\n");
			fwrite($sFh, "<gmd:CI_OnlineResource>\n");
			fwrite($sFh, "<gmd:linkage>\n");
			$sWaarde = F_SELECTRECORD("SELECT URL FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gmd:URL>" . $sWaarde . "</gmd:URL>\n");
			fwrite($sFh, "</gmd:linkage>\n");
			fwrite($sFh, "</gmd:CI_OnlineResource>\n");
			fwrite($sFh, "</gmd:onlineResource>\n");
			fwrite($sFh, "</gmd:CI_Contact>\n");
			fwrite($sFh, "</gmd:contactInfo>\n");
			fwrite($sFh, "<gmd:role>\n");
			fwrite($sFh, "<gmd:CI_RoleCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_RoleCode\" codeListValue=\"author\"/> \n");
			fwrite($sFh, "</gmd:role>\n");
			fwrite($sFh, "</gmd:CI_ResponsibleParty>\n");
			fwrite($sFh, "</gmd:contact>\n");
			fwrite($sFh, "<gmd:dateStamp>\n");
			$dt = strtotime($aSQL[10]);
			$corrected_date=BST_finder($dt);	
			$sRecordValue = date("Y-m-d", $corrected_date);
			fwrite($sFh, "<gco:Date>" . $sRecordValue . "</gco:Date>\n");
			fwrite($sFh, "</gmd:dateStamp>\n");
			fwrite($sFh, "<gmd:metadataStandardName>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[9] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:metadataStandardName>\n");
			fwrite($sFh, "<gmd:metadataStandardVersion>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[8] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:metadataStandardVersion>\n");
			fwrite($sFh, "<gmd:referenceSystemInfo>\n");
			fwrite($sFh, "<gmd:MD_ReferenceSystem>\n");
			fwrite($sFh, "<gmd:referenceSystemIdentifier>\n");
			fwrite($sFh, "<gmd:RS_Identifier>\n");
			fwrite($sFh, "<gmd:code>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[7] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:code>\n");
			fwrite($sFh, "<gmd:codeSpace>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[6] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:codeSpace>\n");
			fwrite($sFh, "</gmd:RS_Identifier>\n");
			fwrite($sFh, "</gmd:referenceSystemIdentifier>\n");
			fwrite($sFh, "</gmd:MD_ReferenceSystem>\n");
			fwrite($sFh, "</gmd:referenceSystemInfo>\n");
			fwrite($sFh, "<gmd:identificationInfo>\n");
			fwrite($sFh, "<gmd:MD_DataIdentification>\n");
			fwrite($sFh, "<gmd:citation>\n");
			fwrite($sFh, "<gmd:CI_Citation>\n");
			fwrite($sFh, "<gmd:title>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[0] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:title>\n");
			fwrite($sFh, "<gmd:alternateTitle>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[1] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:alternateTitle>\n");
			fwrite($sFh, "<gmd:date>\n");
			fwrite($sFh, "<gmd:CI_Date>\n");
			fwrite($sFh, "<gmd:date>\n");
			$dt = strtotime($aSQL[36]);
			$corrected_date=BST_finder($dt);	
			$sRecordValue = date("Y-m-d", $corrected_date);
			fwrite($sFh, "<gco:Date>" . $sRecordValue . "</gco:Date>\n");
			fwrite($sFh, "</gmd:date>\n");
			fwrite($sFh, "<gmd:dateType>\n");
			if ($aSQL[22] == '') {
				fwrite($sFh, "<gmd:CI_DateTypeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_DateTypeCode\" codeListValue=\"creation\"/>\n");
			}
			if ($aSQL[22] == 'creatie') {
				fwrite($sFh, "<gmd:CI_DateTypeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_DateTypeCode\" codeListValue=\"creation\"/>\n");
			}
			if ($aSQL[22] == 'publicatie') {
				fwrite($sFh, "<gmd:CI_DateTypeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_DateTypeCode\" codeListValue=\"publication\"/>\n");
			}
			if ($aSQL[22] == 'revisie') {
				fwrite($sFh, "<gmd:CI_DateTypeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_DateTypeCode\" codeListValue=\"revision\"/>\n");
			}
			fwrite($sFh, "</gmd:dateType>\n");
			fwrite($sFh, "</gmd:CI_Date>\n");
			fwrite($sFh, "</gmd:date>\n");
			fwrite($sFh, "<gmd:edition>\n");
			fwrite($sFh, "</gmd:edition>\n");
			fwrite($sFh, "<gmd:identifier>\n");
            fwrite($sFh, "<gmd:MD_Identifier>\n");
            fwrite($sFh, "<gmd:code>\n");
            fwrite($sFh, "<gco:CharacterString>" . $aSQL[43] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:code>\n");
            fwrite($sFh, "</gmd:MD_Identifier>\n");
			fwrite($sFh, "</gmd:identifier>\n");			
			fwrite($sFh, "</gmd:CI_Citation>\n");
			fwrite($sFh, "</gmd:citation>\n");
			fwrite($sFh, "<gmd:abstract>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[42] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:abstract>\n");
			fwrite($sFh, "<gmd:purpose>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[34] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:purpose>\n");
			fwrite($sFh, "<gmd:status>\n");
			if ($aSQL[30] == '') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"underDevelopment\"/>\n");
			}
			if ($aSQL[30] == 'compleet') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"completed\"/>\n");
			}
			if ($aSQL[30] == 'historisch archief') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"historicalArchive\"/>\n");
			}
			if ($aSQL[30] == 'niet relevant') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"obsolete\"/>\n");
			}
			if ($aSQL[30] == 'continu geactualiseerd') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"onGoing\"/>\n");
			}
			if ($aSQL[30] == 'gepland') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"planned\"/>\n");
			}
			if ($aSQL[30] == 'actualisatie vereist') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"required\"/>\n");
			}
			if ($aSQL[30] == 'in ontwikkeling') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"underDevelopment\"/>\n");
			}			
			fwrite($sFh, "</gmd:status>\n");
			fwrite($sFh, "<gmd:pointOfContact>\n");
			fwrite($sFh, "<gmd:CI_ResponsibleParty>\n");
			fwrite($sFh, "<gmd:individualName>\n");
			$sWaarde = F_SELECTRECORD("SELECT CONTACTPERSOON FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:individualName>\n");
			fwrite($sFh, "<gmd:organisationName>\n");
			$sWaarde = F_SELECTRECORD("SELECT ORGANISATIE FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:organisationName>\n");
			fwrite($sFh, "<gmd:positionName>\n");
			fwrite($sFh, "<gco:CharacterString>Auteur</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:positionName>\n");
			fwrite($sFh, "<gmd:contactInfo>\n");
			fwrite($sFh, "<gmd:CI_Contact>\n");
			fwrite($sFh, "<gmd:phone>\n");
			fwrite($sFh, "<gmd:CI_Telephone>\n");
			fwrite($sFh, "<gmd:voice>\n");
			$sWaarde = F_SELECTRECORD("SELECT TELEFOON FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:voice>\n");
			fwrite($sFh, "<gmd:facsimile>\n");
			$sWaarde = F_SELECTRECORD("SELECT FAX FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:facsimile>\n");
			fwrite($sFh, "</gmd:CI_Telephone>\n");
			fwrite($sFh, "</gmd:phone>\n");
			fwrite($sFh, "<gmd:address>\n");
			fwrite($sFh, "<gmd:CI_Address>\n");
			fwrite($sFh, "<gmd:deliveryPoint>\n");
			$sWaarde = F_SELECTRECORD("SELECT ADRES FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:deliveryPoint>\n");
			fwrite($sFh, "<gmd:city>\n");
			$sWaarde = F_SELECTRECORD("SELECT PLAATS FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:city>\n");
			fwrite($sFh, "<gmd:administrativeArea>\n");
			$sWaarde = F_SELECTRECORD("SELECT GEBIED FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:administrativeArea>\n");
			fwrite($sFh, "<gmd:postalCode>\n");
			$sWaarde = F_SELECTRECORD("SELECT POSTCODE FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:postalCode>\n");
			fwrite($sFh, "<gmd:country>\n");
			$sWaarde = F_SELECTRECORD("SELECT LAND FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:country>\n");
			fwrite($sFh, "<gmd:electronicMailAddress>\n");
			$sWaarde = F_SELECTRECORD("SELECT EMAIL FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:electronicMailAddress>\n");
			fwrite($sFh, "</gmd:CI_Address>\n");
			fwrite($sFh, "</gmd:address>\n");
			fwrite($sFh, "<gmd:onlineResource>\n");
			fwrite($sFh, "<gmd:CI_OnlineResource>\n");
			fwrite($sFh, "<gmd:linkage>\n");
			$sWaarde = F_SELECTRECORD("SELECT URL FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gmd:URL>" . $sWaarde . "</gmd:URL>\n");
			fwrite($sFh, "</gmd:linkage>\n");
			fwrite($sFh, "</gmd:CI_OnlineResource>\n");
			fwrite($sFh, "</gmd:onlineResource>\n");
			fwrite($sFh, "</gmd:CI_Contact>\n");
			fwrite($sFh, "</gmd:contactInfo>\n");
			fwrite($sFh, "<gmd:role>\n");
			fwrite($sFh, "<gmd:CI_RoleCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_RoleCode\" codeListValue=\"pointOfContact\"/> \n");
			fwrite($sFh, "</gmd:role>\n");
			fwrite($sFh, "</gmd:CI_ResponsibleParty>\n");
			fwrite($sFh, "</gmd:pointOfContact>\n");
			fwrite($sFh, "<gmd:resourceMaintenance>\n");
			fwrite($sFh, "<gmd:MD_MaintenanceInformation>\n");
			fwrite($sFh, "<gmd:maintenanceAndUpdateFrequency>\n");
			fwrite($sFh, "</gmd:maintenanceAndUpdateFrequency>\n");
			fwrite($sFh, "</gmd:MD_MaintenanceInformation>\n");
			fwrite($sFh, "</gmd:resourceMaintenance>\n");
			fwrite($sFh, "<gmd:graphicOverview>\n");
			fwrite($sFh, "<gmd:MD_BrowseGraphic>\n");
			fwrite($sFh, "<gmd:fileName>\n");			
			
			$plaatje = explode(".", $aSQL[1]);
			$splaatje = $plaatje[1];			
			fwrite($sFh, "<gco:CharacterString>http://www.drenthe.info/kaarten/website/metadata/thumbs/" . $splaatje . ".jpg</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fileName>\n");
			fwrite($sFh, "<gmd:fileDescription>\n"); 
            fwrite($sFh, "<gco:CharacterString>thumbnail</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fileDescription>\n");
			fwrite($sFh, "<gmd:fileType>\n");
            fwrite($sFh, "<gco:CharacterString>jpg</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fileType>\n");
			fwrite($sFh, "</gmd:MD_BrowseGraphic>\n");
			fwrite($sFh, "</gmd:graphicOverview>\n");
			fwrite($sFh, "<gmd:graphicOverview>\n");
			fwrite($sFh, "<gmd:MD_BrowseGraphic>\n");
			fwrite($sFh, "<gmd:fileName>\n");
            fwrite($sFh, "<gco:CharacterString>http://www.drenthe.info/kaarten/website/metadata/thumbs/" . $splaatje . ".jpg</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fileName>\n");
			fwrite($sFh, "<gmd:fileDescription>\n");
			fwrite($sFh, "<gco:CharacterString>large_thumbnail</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fileDescription>\n");
			fwrite($sFh, "<gmd:fileType>\n");
			fwrite($sFh, "<gco:CharacterString>jpg</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fileType>\n");			
			fwrite($sFh, "</gmd:MD_BrowseGraphic>\n");			
			fwrite($sFh, "</gmd:graphicOverview>\n");
			fwrite($sFh, "<gmd:descriptiveKeywords>\n");
			fwrite($sFh, "<gmd:MD_Keywords>\n");
			
			
			/*
			if ($aSQL[34] == 'Ruimtelijke ordening en volkshuisvesting') {
				fwrite($sFh, "<gmd:keyword>\n");
				fwrite($sFh, "<gco:CharacterString>Ruimtelijke ontwikkeling en volkshuisvesting</gco:CharacterString>\n");
				fwrite($sFh, "</gmd:keyword>\n");						
			}
			
			if ($aSQL[34] == 'Algemeen bestuur') {
				fwrite($sFh, "<gmd:keyword>\n");
				fwrite($sFh, "<gco:CharacterString>Bestuur en Politiek</gco:CharacterString>\n");
				fwrite($sFh, "</gmd:keyword>\n");						
			}
			
			if ($aSQL[34] == 'Archeologie') {
				fwrite($sFh, "<gmd:keyword>\n");
				fwrite($sFh, "<gco:CharacterString>Bestuur en Politiek</gco:CharacterString>\n");
				fwrite($sFh, "</gmd:keyword>\n");						
			}
			*/
			
			$SQL = "SELECT TREFTEXT.TREFWOORD FROM TREFCODE INNER JOIN TREFTEXT ON TREFCODE.TREFCODE = TREFTEXT.TREFCODE WHERE TREFCODE.DATACODE= " . $sDatacode . " ORDER BY TREFTEXT.TREFWOORD";
			$trefresult = $db->Execute($SQL);
			while (!$trefresult->EOF) {	
				fwrite($sFh, "<gmd:keyword>\n");
                $treftext = $trefresult->fields[0];
				if ($treftext == '') {
					fwrite($sFh, "<gco:CharacterString></gco:CharacterString>\n");
				}
				else {
					fwrite($sFh, "<gco:CharacterString>" . $treftext . "</gco:CharacterString>\n");
				}
				fwrite($sFh, "</gmd:keyword>\n");			
				$trefresult->MoveNext();
			}			
			fwrite($sFh, "<gmd:thesaurusName>\n");
			fwrite($sFh, "<gmd:CI_Citation>\n");
			fwrite($sFh, "<gmd:title>\n");
			fwrite($sFh, "<gco:CharacterString>Trefwoordenlijst provincie Drenthe</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:title>\n");
			fwrite($sFh, "<gmd:date>\n");			
			fwrite($sFh, "<gmd:CI_Date>\n");
            fwrite($sFh, "<gmd:date>\n");
            fwrite($sFh, "<gco:Date>2008-01-01</gco:Date>\n");
            fwrite($sFh, "</gmd:date>\n");
            fwrite($sFh, "<gmd:dateType>\n");
            fwrite($sFh, "<gmd:CI_DateTypeCode\n");
            fwrite($sFh, "codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_DateTypeCode\"\n");
            fwrite($sFh, "codeListValue=\"publication\"/>\n");
            fwrite($sFh, "</gmd:dateType>\n");
            fwrite($sFh, "</gmd:CI_Date>\n");			
			fwrite($sFh, "</gmd:date>\n");
			fwrite($sFh, "</gmd:CI_Citation>\n");			
			fwrite($sFh, "</gmd:thesaurusName>\n");
			fwrite($sFh, "</gmd:MD_Keywords>\n");
			fwrite($sFh, "</gmd:descriptiveKeywords>\n");
			
			// Verwijderd ivm Geonovum checker
			//fwrite($sFh, "<gmd:resourceSpecificUsage>\n");
			//fwrite($sFh, "<gmd:MD_Usage>\n");
			//fwrite($sFh, "<gmd:specificUsage>\n");
			//fwrite($sFh, "<gco:CharacterString>Dit bestand biedt een detailniveau dat uitstekend geschikt is voor midden- en kleinschalige toepassingen.</gco:CharacterString>\n");
			//fwrite($sFh, "</gmd:specificUsage>\n");
			//fwrite($sFh, "</gmd:MD_Usage>\n");
			//fwrite($sFh, "</gmd:resourceSpecificUsage>\n");
			
			
			fwrite($sFh, "<gmd:resourceConstraints>\n");
			fwrite($sFh, "<gmd:MD_LegalConstraints>\n");
			fwrite($sFh, "<gmd:useLimitation>\n");			
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[32] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:useLimitation>\n");
			fwrite($sFh, "<gmd:accessConstraints>\n");
			if ($aSQL[29] == '') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"copyright\"/>\n");
			}
			if ($aSQL[29] == 'copyright') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"copyright\"/>\n");
			}
			if ($aSQL[29] == 'patent') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"patent\"/>\n");
			}
			if ($aSQL[29] == 'patent in wording') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"patentPending\"/>\n");
			}
			if ($aSQL[29] == 'merknaam') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"trademark\"/>\n");
			}
			if ($aSQL[29] == 'licentie') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"license\"/>\n");
			}
			if ($aSQL[29] == 'intellectueel eigendom') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"intellectualPropertyRights\"/>\n");
			}
			if ($aSQL[29] == 'niet toegankelijk') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"restricted\"/>\n");
			}
			if ($aSQL[29] == 'anders') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"otherRestrictions\"/>\n");
			}			
			fwrite($sFh, "</gmd:accessConstraints>\n");
			fwrite($sFh, "<gmd:useConstraints>\n");
			if ($aSQL[29] == '') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"copyright\"/>\n");
			}
			if ($aSQL[29] == 'copyright') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"copyright\"/>\n");
			}
			if ($aSQL[29] == 'patent') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"patent\"/>\n");
			}
			if ($aSQL[29] == 'patent in wording') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"patentPending\"/>\n");
			}
			if ($aSQL[29] == 'merknaam') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"trademark\"/>\n");
			}
			if ($aSQL[29] == 'licentie') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"license\"/>\n");
			}
			if ($aSQL[29] == 'intellectueel eigendom') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"intellectualPropertyRights\"/>\n");
			}
			if ($aSQL[29] == 'niet toegankelijk') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"restricted\"/>\n");
			}
			if ($aSQL[29] == 'anders') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"otherRestrictions\"/>\n");
			}			
			fwrite($sFh, "</gmd:useConstraints>\n");
			fwrite($sFh, "</gmd:MD_LegalConstraints>\n");
			fwrite($sFh, "</gmd:resourceConstraints>\n");
			fwrite($sFh, "<gmd:resourceConstraints>\n");
			fwrite($sFh, "<gmd:MD_LegalConstraints>\n");
			fwrite($sFh, "<gmd:otherConstraints>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[27] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:otherConstraints>\n");
			fwrite($sFh, "</gmd:MD_LegalConstraints>\n");
			fwrite($sFh, "</gmd:resourceConstraints>\n");
			fwrite($sFh, "<gmd:spatialRepresentationType>\n");
			if ($aSQL[17] == 'tekstTabel') {
				fwrite($sFh, "<gmd:MD_SpatialRepresentationTypeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_SpatialRepresentationTypeCode\" codeListValue=\"textTable\"/>\n");
			}
			else {
				fwrite($sFh, "<gmd:MD_SpatialRepresentationTypeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_SpatialRepresentationTypeCode\" codeListValue=\"" . $aSQL[17] . "\"/>\n");
			}
			fwrite($sFh, "</gmd:spatialRepresentationType>\n");
			fwrite($sFh, "<gmd:spatialResolution>\n");
			fwrite($sFh, "<gmd:MD_Resolution>\n");
			fwrite($sFh, "<gmd:equivalentScale>\n");
			fwrite($sFh, "<gmd:MD_RepresentativeFraction>\n");
			fwrite($sFh, "<gmd:denominator>\n");
			fwrite($sFh, "<gco:Integer>" . $aSQL[40] . "</gco:Integer>\n");
			fwrite($sFh, "</gmd:denominator>\n");
			fwrite($sFh, "</gmd:MD_RepresentativeFraction>\n");
			fwrite($sFh, "</gmd:equivalentScale>\n");
			fwrite($sFh, "</gmd:MD_Resolution>\n");
			fwrite($sFh, "</gmd:spatialResolution>\n");
			fwrite($sFh, "<gmd:language>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[25] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:language>\n");
			fwrite($sFh, "<gmd:characterSet>\n");
			fwrite($sFh, "<gmd:MD_CharacterSetCode codeList=\"./resources/codeList.xml#MD_CharacterSetCode\" codeListValue=\"utf8\" />\n");
			fwrite($sFh, "</gmd:characterSet>\n");
			fwrite($sFh, "<gmd:topicCategory>\n");
			if ($aSQL[33] == 'landbouw en veeteelt') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>farming</gmd:MD_TopicCategoryCode> \n");								
			}
			if ($aSQL[33] == 'biota') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>biota</gmd:MD_TopicCategoryCode> \n");												
			}
			if ($aSQL[33] == 'grenzen') {				
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>boundaries</gmd:MD_TopicCategoryCode> \n");												
			}
			if ($aSQL[33] == 'klimatologie, meteologie en atmosfeer') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>climatologyMeteorologyAtmosphere</gmd:MD_TopicCategoryCode> \n");																
			}
			if ($aSQL[33] == 'economie') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>economy</gmd:MD_TopicCategoryCode> \n");																				
			}
			if ($aSQL[33] == 'hoogte') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>elevation</gmd:MD_TopicCategoryCode> \n");																								
			}
			if ($aSQL[33] == 'natuur en milieu') {				
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>environment</gmd:MD_TopicCategoryCode> \n");				
			}
			if ($aSQL[33] == 'geowetenschappelijke data') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>geoscientificInformation</gmd:MD_TopicCategoryCode> \n");				
			}
			if ($aSQL[33] == 'gezondheid') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>health</gmd:MD_TopicCategoryCode> \n");						
			}
			if ($aSQL[33] == 'refentie materiaal aardbedekking') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>imageryBaseMapsEarthCover</gmd:MD_TopicCategoryCode> \n");					
			}
			if ($aSQL[33] == 'militair') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>intelligenceMilitary</gmd:MD_TopicCategoryCode> \n");				
			}
			if ($aSQL[33] == 'binnenwater') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>inlandWaters</gmd:MD_TopicCategoryCode> \n");			
			}
			if ($aSQL[33] == 'locatie') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>location</gmd:MD_TopicCategoryCode> \n");	
			}
			if ($aSQL[33] == 'oceanen') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>oceans</gmd:MD_TopicCategoryCode> \n");					
			}
			if ($aSQL[33] == 'planning kadaster') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>planningCadastre</gmd:MD_TopicCategoryCode> \n");				
			}
			if ($aSQL[33] == 'maatschappij') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>society</gmd:MD_TopicCategoryCode> \n");				
			}
			if ($aSQL[33] == '(civiele) structuren') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>structure</gmd:MD_TopicCategoryCode> \n");				
			}
			if ($aSQL[33] == 'transport') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>transportation</gmd:MD_TopicCategoryCode> \n");						
			}
			if ($aSQL[33] == 'nutsbedrijven communicatie') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>utilitiesCommunication</gmd:MD_TopicCategoryCode> \n");					
			}			
			fwrite($sFh, "</gmd:topicCategory>\n");
			fwrite($sFh, "<gmd:extent>\n");
			fwrite($sFh, "<gmd:EX_Extent>\n");
			fwrite($sFh, "<gmd:description>\n");
			fwrite($sFh, "</gmd:description>\n");
			fwrite($sFh, "<gmd:geographicElement>\n");
			fwrite($sFh, "<gmd:EX_GeographicBoundingBox>\n");
			
			$temp = $aSQL[23];
			
			if ($temp <> "") {
				$minx = F_SELECTRECORD("SELECT MIN_X FROM GEBIED WHERE GEBIED = '" . $temp . "'");
				$maxx = F_SELECTRECORD("SELECT MAX_X FROM GEBIED WHERE GEBIED = '" . $temp . "'");
				$miny = F_SELECTRECORD("SELECT MIN_Y FROM GEBIED WHERE GEBIED = '" . $temp . "'");
				$maxy = F_SELECTRECORD("SELECT MAX_Y FROM GEBIED WHERE GEBIED = '" . $temp . "'");
				fwrite($sFh, "<gmd:westBoundLongitude>\n");
				fwrite($sFh, "<gco:Decimal>" . $minx . "</gco:Decimal>\n");
				fwrite($sFh, "</gmd:westBoundLongitude>\n");
				fwrite($sFh, "<gmd:eastBoundLongitude>\n");
				fwrite($sFh, "<gco:Decimal>" . $maxx . "</gco:Decimal>\n");
				fwrite($sFh, "</gmd:eastBoundLongitude>\n");
				fwrite($sFh, "<gmd:southBoundLatitude>\n");
				fwrite($sFh, "<gco:Decimal>" . $miny . "</gco:Decimal>\n");
				fwrite($sFh, "</gmd:southBoundLatitude>\n");
				fwrite($sFh, "<gmd:northBoundLatitude>\n");
				fwrite($sFh, "<gco:Decimal>" . $maxy . "</gco:Decimal>\n");
				fwrite($sFh, "</gmd:northBoundLatitude>\n");				
			}
			else {
				fwrite($sFh, "<gmd:westBoundLongitude>\n");
				fwrite($sFh, "<gco:Decimal></gco:Decimal>\n");
				fwrite($sFh, "</gmd:westBoundLongitude>\n");
				fwrite($sFh, "<gmd:eastBoundLongitude>\n");
				fwrite($sFh, "<gco:Decimal></gco:Decimal>\n");
				fwrite($sFh, "</gmd:eastBoundLongitude>\n");
				fwrite($sFh, "<gmd:southBoundLatitude>\n");
				fwrite($sFh, "<gco:Decimal></gco:Decimal>\n");
				fwrite($sFh, "</gmd:southBoundLatitude>\n");
				fwrite($sFh, "<gmd:northBoundLatitude>\n");
				fwrite($sFh, "<gco:Decimal></gco:Decimal>\n");
				fwrite($sFh, "</gmd:northBoundLatitude>\n");							
			}	
			fwrite($sFh, "</gmd:EX_GeographicBoundingBox>\n");
			fwrite($sFh, "</gmd:geographicElement>\n");
			fwrite($sFh, "<gmd:geographicElement>\n");
			fwrite($sFh, "<gmd:EX_GeographicDescription>\n");
			fwrite($sFh, "<gmd:geographicIdentifier>\n");
			fwrite($sFh, "<gmd:MD_Identifier>\n");
			fwrite($sFh, "<gmd:code>\n");
			fwrite($sFh, "<gco:CharacterString>Provincie Drenthe</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:code>\n");
			fwrite($sFh, "</gmd:MD_Identifier>\n");
			fwrite($sFh, "</gmd:geographicIdentifier>\n");
			fwrite($sFh, "</gmd:EX_GeographicDescription>\n");
			fwrite($sFh, "</gmd:geographicElement>\n");
			fwrite($sFh, "<gmd:temporalElement>\n");
			fwrite($sFh, "<gmd:EX_TemporalExtent>\n");
			fwrite($sFh, "<gmd:extent>\n");
			fwrite($sFh, "<gml:TimePeriod gml:id=\"N10259\">\n");
			fwrite($sFh, "<gml:begin>\n");
			fwrite($sFh, "<gml:TimeInstant gml:id=\"N1025E\">\n");
			if ($aSQL[12] <> '') {
				$dt = strtotime($aSQL[12]);
				$corrected_date=BST_finder($dt);	
				$sRecordValue = date("Y-m-d", $corrected_date);
				fwrite($sFh, "<gml:timePosition>" . $sRecordValue . "</gml:timePosition>\n");
			}
			else {
				fwrite($sFh, "<gml:timePosition/>\n");
			}
			fwrite($sFh, "</gml:TimeInstant>\n");
			fwrite($sFh, "</gml:begin>\n");
			fwrite($sFh, "<gml:end>\n");
			fwrite($sFh, "<gml:TimeInstant gml:id=\"N10267\">\n");
			if ($aSQL[13] <> '') {			
				$dt = strtotime($aSQL[13]);
				$corrected_date=BST_finder($dt);	
				$sRecordValue = date("Y-m-d", $corrected_date);
				fwrite($sFh, "<gml:timePosition>" . $sRecordValue . "</gml:timePosition>\n");
			}
			else {
				fwrite($sFh, "<gml:timePosition/>\n");
			}
			fwrite($sFh, "</gml:TimeInstant>\n");
			fwrite($sFh, "</gml:end>\n");
			fwrite($sFh, "</gml:TimePeriod>\n");
			fwrite($sFh, "</gmd:extent>\n");
			fwrite($sFh, "</gmd:EX_TemporalExtent>\n");
			fwrite($sFh, "</gmd:temporalElement>\n");
			fwrite($sFh, "</gmd:EX_Extent>\n");
			fwrite($sFh, "</gmd:extent>\n");
			fwrite($sFh, "<gmd:supplementalInformation>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[39] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:supplementalInformation>\n");
			fwrite($sFh, "</gmd:MD_DataIdentification>\n");
			fwrite($sFh, "</gmd:identificationInfo>\n");
			fwrite($sFh, "<gmd:distributionInfo>\n");
			fwrite($sFh, "<gmd:MD_Distribution>\n");
			fwrite($sFh, "<gmd:distributionFormat>\n");
			fwrite($sFh, "<gmd:MD_Format>\n");
			fwrite($sFh, "<gmd:name>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[18] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:name>\n");
			fwrite($sFh, "<gmd:version>\n");
			fwrite($sFh, "<gco:CharacterString>9.2</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:version>\n");
			fwrite($sFh, "</gmd:MD_Format>\n");
			fwrite($sFh, "</gmd:distributionFormat>\n");
			fwrite($sFh, "<gmd:distributor>\n");
			fwrite($sFh, "<gmd:MD_Distributor>\n");
			fwrite($sFh, "<gmd:distributorContact>\n");
			fwrite($sFh, "<gmd:CI_ResponsibleParty>\n");
			fwrite($sFh, "<gmd:individualName>\n");
			$sWaarde = F_SELECTRECORD("SELECT CONTACTPERSOON FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:individualName>\n");
			fwrite($sFh, "<gmd:organisationName>\n");
			$sWaarde = F_SELECTRECORD("SELECT ORGANISATIE FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:organisationName>\n");
			fwrite($sFh, "<gmd:positionName>\n");
			fwrite($sFh, "<gco:CharacterString>Auteur</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:positionName>\n");
			fwrite($sFh, "<gmd:contactInfo>\n");
			fwrite($sFh, "<gmd:CI_Contact>\n");
			fwrite($sFh, "<gmd:phone>\n");
			fwrite($sFh, "<gmd:CI_Telephone>\n");
			fwrite($sFh, "<gmd:voice>\n");
			$sWaarde = F_SELECTRECORD("SELECT TELEFOON FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:voice>\n");
			fwrite($sFh, "<gmd:facsimile>\n");
			$sWaarde = F_SELECTRECORD("SELECT FAX FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:facsimile>\n");
			fwrite($sFh, "</gmd:CI_Telephone>\n");
			fwrite($sFh, "</gmd:phone>\n");
			fwrite($sFh, "<gmd:address>\n");
			fwrite($sFh, "<gmd:CI_Address>\n");
			fwrite($sFh, "<gmd:deliveryPoint>\n");
			$sWaarde = F_SELECTRECORD("SELECT ADRES FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:deliveryPoint>\n");
			fwrite($sFh, "<gmd:city>\n");
			$sWaarde = F_SELECTRECORD("SELECT PLAATS FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:city>\n");
			fwrite($sFh, "<gmd:administrativeArea>\n");
			$sWaarde = F_SELECTRECORD("SELECT GEBIED FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:administrativeArea>\n");
			fwrite($sFh, "<gmd:postalCode>\n");
			$sWaarde = F_SELECTRECORD("SELECT POSTCODE FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:postalCode>\n");
			fwrite($sFh, "<gmd:country>\n");
			$sWaarde = F_SELECTRECORD("SELECT LAND FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:country>\n");
			fwrite($sFh, "<gmd:electronicMailAddress>\n");
			$sWaarde = F_SELECTRECORD("SELECT EMAIL FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:electronicMailAddress>\n");
			fwrite($sFh, "</gmd:CI_Address>\n");
			fwrite($sFh, "</gmd:address>\n");
			fwrite($sFh, "<gmd:onlineResource>\n");
			fwrite($sFh, "<gmd:CI_OnlineResource>\n");
			fwrite($sFh, "<gmd:linkage>\n");
			$sWaarde = F_SELECTRECORD("SELECT URL FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gmd:URL>" . $sWaarde . "</gmd:URL>\n");
			fwrite($sFh, "</gmd:linkage>\n");
			fwrite($sFh, "</gmd:CI_OnlineResource>\n");
			fwrite($sFh, "</gmd:onlineResource>\n");
			fwrite($sFh, "</gmd:CI_Contact>\n");
			fwrite($sFh, "</gmd:contactInfo>\n");
			fwrite($sFh, "<gmd:role>\n");
			fwrite($sFh, "<gmd:CI_RoleCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_RoleCode\" codeListValue=\"owner\">owner</gmd:CI_RoleCode>\n");
			fwrite($sFh, "</gmd:role>\n");
			fwrite($sFh, "</gmd:CI_ResponsibleParty>\n");
			fwrite($sFh, "</gmd:distributorContact>\n");
			fwrite($sFh, "<gmd:distributionOrderProcess>\n");
			fwrite($sFh, "<gmd:MD_StandardOrderProcess>\n");
			fwrite($sFh, "<gmd:fees>\n");
			fwrite($sFh, "<gco:CharacterString>Gratis</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fees>\n");
			fwrite($sFh, "<gmd:orderingInstructions>\n");
			fwrite($sFh, "<gco:CharacterString>Neem contact op met Provincie Drenthe</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:orderingInstructions>\n");
			fwrite($sFh, "<gmd:turnaround>\n");
			fwrite($sFh, "<gco:CharacterString />\n");
			fwrite($sFh, "</gmd:turnaround>\n");
			fwrite($sFh, "</gmd:MD_StandardOrderProcess>\n");
			fwrite($sFh, "</gmd:distributionOrderProcess>\n");
			fwrite($sFh, "</gmd:MD_Distributor>\n");
			fwrite($sFh, "</gmd:distributor>\n");			
			fwrite($sFh, "<gmd:transferOptions>\n");
			fwrite($sFh, "<gmd:MD_DigitalTransferOptions>\n");
			fwrite($sFh, "<gmd:onLine>\n");
			fwrite($sFh, "<gmd:CI_OnlineResource>\n");
			fwrite($sFh, "<gmd:linkage>\n");
			fwrite($sFh, "<gmd:URL>http://www.drenthe.info/kaarten/wmsconnector/com.esri.wms.Esrimap?&amp;ServiceName=GDB_Geoportaal&amp;</gmd:URL>\n");
			fwrite($sFh, "</gmd:linkage>\n");
			fwrite($sFh, "<gmd:protocol>\n");
			fwrite($sFh, "<gco:CharacterString>OGC:WMS</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:protocol>\n");
			fwrite($sFh, "<gmd:name>\n");
			$sImsid = explode(".", $aSQL[1]);
			fwrite($sFh, "<gco:CharacterString>" . $sImsid[1] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:name>\n");
			fwrite($sFh, "<gmd:description gco:nilReason=\"missing\">\n");
			fwrite($sFh, "<gco:CharacterString/>\n");
			fwrite($sFh, "</gmd:description>\n");			
			fwrite($sFh, "</gmd:CI_OnlineResource>\n");
			fwrite($sFh, "</gmd:onLine>\n");
			//fwrite($sFh, "<gmd:unitsOfDistribution>\n");
			//fwrite($sFh, "</gmd:unitsOfDistribution>\n");
			fwrite($sFh, "</gmd:MD_DigitalTransferOptions>\n");
			fwrite($sFh, "</gmd:transferOptions>\n");			
			fwrite($sFh, "</gmd:MD_Distribution>\n");
			fwrite($sFh, "</gmd:distributionInfo>\n");
			fwrite($sFh, "<gmd:dataQualityInfo>\n");
			fwrite($sFh, "<gmd:DQ_DataQuality>\n");
			fwrite($sFh, "<gmd:scope>\n");
			fwrite($sFh, "<gmd:DQ_Scope>\n");
			fwrite($sFh, "<gmd:level>\n");
			fwrite($sFh, "<gmd:MD_ScopeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ScopeCode\" codeListValue=\"dataset\">dataset</gmd:MD_ScopeCode>\n");
			fwrite($sFh, "</gmd:level>\n");
			fwrite($sFh, "</gmd:DQ_Scope>\n");
			fwrite($sFh, "</gmd:scope>\n");
			fwrite($sFh, "<gmd:lineage>\n");
			fwrite($sFh, "<gmd:LI_Lineage>\n");
			fwrite($sFh, "<gmd:statement>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[39] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:statement>\n");
			fwrite($sFh, "<gmd:source>\n");
			fwrite($sFh, "<gmd:LI_Source>\n");
			fwrite($sFh, "<gmd:description>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[40] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:description>\n");
			fwrite($sFh, "</gmd:LI_Source>\n");
			fwrite($sFh, "</gmd:source>\n");			
			fwrite($sFh, "</gmd:LI_Lineage>\n");
			fwrite($sFh, "</gmd:lineage>\n");
			fwrite($sFh, "</gmd:DQ_DataQuality>\n");
			fwrite($sFh, "</gmd:dataQualityInfo>\n");
			fwrite($sFh, "</gmd:MD_Metadata>\n");
			
			fclose($sFh);
			print ("XML $sTitel met succes opgeslagen<BR>");
		
		}
	}
print("<BR>\n");
print(count($aRecords) . " succesvol datasets als XML opgeslagen. Klik <A HREF=\"?e=@GBI&p=EXPORT\"> hier</A> voor exporteren");
print("<BR>\n");
print("<BR>\n");	
}

if ($sAction == "XMLDATASET") {
	
	$sRecords = F_SELECTRECORD("SELECT DATACODE, DATASET_TITEL, ALT_TITEL FROM DATASET WHERE DATACODE = " . $sDatacodeSel);
					
	if ($sRecords <> "") {
		$aRecords = explode("|", $sRecords);
	}
	
	if (isset($aRecords)) {
		
		for ($iRecord = 0; $iRecord < count($aRecords) ; $iRecord++) {
			
			
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sDatacode  = $aRecord[0];
			$sTitel = $aRecord[1];
			$sAltTitel = $aRecord[2];
						
			print ("PDF $sTitel opgeslagen<BR>");
			
			$SQL = F_SELECTRECORD("SELECT a.DATASET_TITEL, a.ALT_TITEL, a.NAAM, a.OPMERKING, a.GEOLOKET, a.CONTACT_LEVERANCIER, a.ORG_NAMESPACE, a.CODE_REF, a.VERSIE_METASTD, a.METADATASTD, a.INVOERDATUM, a.METAPERSOON, a.DEKKING_BEGIN, a.DEKKING_EIND, c.STD_ITEM, c.POS_NAUWKEURIGHEID, a.KWALITEIT_BESCH, a.RSCHEMA, a.DATATYPE, a.FYSIEKE_LOCATIE, a.AANVUL_INFO, a.OPBOUWDATUM, a.ACTIE, c.DEELGEBIED, a.BIJHOUDING, a.TAAL, a.KARAKTERSET, a.COPYRIGHT, a.TEAM, a.JURIDISCH, a.STATUS, a.VEILIGHEID, a.GEBRUIKSBEPERKING, a.THEMA, a.BELEIDSVELD, a.CONTACTPERSOON, a.BRONDATUM, a.GEOLOKET, c.OPBOUWMETHODE, c.BRONVERMELDING, c.SCHAAL, c.GEOMETRIE, b.TEKST, a.UUIDBRON, a.UUID FROM DATASET a, MEMOTABEL b, GEOGRAFISCH c WHERE a.OMSCHRIJVING_CODE = b.CODE AND a.DATACODE = c.DATACODE AND a.DATACODE = " . $sDatacode);
			
			if ($SQL <> "") {
				$aSQL = explode("^", $SQL);
			}			
			
			$sFile = "../metadata/" .$sAltTitel . ".xml";
			$sFh = fopen($sFile, 'w');
			fwrite($sFh, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
			//fwrite($sFh, "<metadata>\n");
			//fwrite($sFh, "<MD_Metadata xmlns:gml=\"http://www.opengis.net/gml\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:gco=\"http://www.isotc211.org/2005/gco\" xsi:schemaLocation=\" http://www.isotc211.org/2005/gmd http://schemas.opengis.net/iso/19139/20060504/gmd/gmd.xsd \" xmlns=\"http://www.isotc211.org/2005/gmd\">\n");			
			fwrite($sFh, "<gmd:MD_Metadata xmlns:gmx=\"http://www.isotc211.org/2005/gmx\"\n");
			fwrite($sFh, "xmlns:srv=\"http://www.isotc211.org/2005/srv\" xmlns:gml=\"http://www.opengis.net/gml\"\n");
			fwrite($sFh, "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n");
			fwrite($sFh, "xmlns:gmd=\"http://www.isotc211.org/2005/gmd\" xmlns:gco=\"http://www.isotc211.org/2005/gco\"\n");
			fwrite($sFh, "xmlns:gsr=\"http://www.isotc211.org/2005/gsr\" xmlns:xlink=\"http://www.w3.org/1999/xlink\"\n");
			fwrite($sFh, "xsi:schemaLocation=\"http://www.isotc211.org/2005/gmd http://schemas.opengis.net/iso/19139/20060504/gmd/gmd.xsd\">\n");

			
			fwrite($sFh, "<gmd:fileIdentifier>\n");
			fwrite($sFh, "<gco:CharacterString xmlns:srv=\"http://www.isotc211.org/2005/srv\">" . $aSQL[44] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fileIdentifier>\n");
			fwrite($sFh, "<gmd:language>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[25] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:language>\n");
			fwrite($sFh, "<gmd:characterSet>\n");
			fwrite($sFh, "<gmd:MD_CharacterSetCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_CharacterSetCode\" codeListValue=\"" . $aSQL[26] . "\"/>\n");
			fwrite($sFh, "</gmd:characterSet>\n");
			fwrite($sFh, "<gmd:hierarchyLevel>\n");
			fwrite($sFh, "<gmd:MD_ScopeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ScopeCode\" codeListValue=\"" . $aSQL[16] . "\" />\n");
			fwrite($sFh, "</gmd:hierarchyLevel>\n");
			fwrite($sFh, "<gmd:hierarchyLevelName>\n");
			fwrite($sFh, "</gmd:hierarchyLevelName>\n");
			fwrite($sFh, "<gmd:contact>\n");			
			fwrite($sFh, "<gmd:CI_ResponsibleParty>\n");
			fwrite($sFh, "<gmd:individualName>\n");
			$sWaarde = F_SELECTRECORD("SELECT CONTACTPERSOON FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:individualName>\n");
			fwrite($sFh, "<gmd:organisationName>\n");
			$sWaarde = F_SELECTRECORD("SELECT ORGANISATIE FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:organisationName>\n");
			fwrite($sFh, "<gmd:positionName>\n");
			fwrite($sFh, "<gco:CharacterString>Auteur</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:positionName>\n");
			fwrite($sFh, "<gmd:contactInfo>\n");
			fwrite($sFh, "<gmd:CI_Contact>\n");
			fwrite($sFh, "<gmd:phone>\n");
			fwrite($sFh, "<gmd:CI_Telephone>\n");
			fwrite($sFh, "<gmd:voice>\n");
			$sWaarde = F_SELECTRECORD("SELECT TELEFOON FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:voice>\n");
			fwrite($sFh, "<gmd:facsimile>\n");
			$sWaarde = F_SELECTRECORD("SELECT FAX FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:facsimile>\n");
			fwrite($sFh, "</gmd:CI_Telephone>\n");
			fwrite($sFh, "</gmd:phone>\n");
			fwrite($sFh, "<gmd:address>\n");
			fwrite($sFh, "<gmd:CI_Address>\n");
			fwrite($sFh, "<gmd:deliveryPoint>\n");
			$sWaarde = F_SELECTRECORD("SELECT ADRES FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:deliveryPoint>\n");
			fwrite($sFh, "<gmd:city>\n");
			$sWaarde = F_SELECTRECORD("SELECT PLAATS FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:city>\n");
			fwrite($sFh, "<gmd:administrativeArea>\n");
			$sWaarde = F_SELECTRECORD("SELECT GEBIED FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:administrativeArea>\n");
			fwrite($sFh, "<gmd:postalCode>\n");
			$sWaarde = F_SELECTRECORD("SELECT POSTCODE FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:postalCode>\n");
			fwrite($sFh, "<gmd:country>\n");
			$sWaarde = F_SELECTRECORD("SELECT LAND FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:country>\n");
			fwrite($sFh, "<gmd:electronicMailAddress>\n");
			$sWaarde = F_SELECTRECORD("SELECT EMAIL FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:electronicMailAddress>\n");
			fwrite($sFh, "</gmd:CI_Address>\n");
			fwrite($sFh, "</gmd:address>\n");
			fwrite($sFh, "<gmd:onlineResource>\n");
			fwrite($sFh, "<gmd:CI_OnlineResource>\n");
			fwrite($sFh, "<gmd:linkage>\n");
			$sWaarde = F_SELECTRECORD("SELECT URL FROM CONTACT WHERE CONTACT_ID = " . $aSQL[11]);
			fwrite($sFh, "<gmd:URL>" . $sWaarde . "</gmd:URL>\n");
			fwrite($sFh, "</gmd:linkage>\n");
			fwrite($sFh, "</gmd:CI_OnlineResource>\n");
			fwrite($sFh, "</gmd:onlineResource>\n");
			fwrite($sFh, "</gmd:CI_Contact>\n");
			fwrite($sFh, "</gmd:contactInfo>\n");
			fwrite($sFh, "<gmd:role>\n");
			fwrite($sFh, "<gmd:CI_RoleCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_RoleCode\" codeListValue=\"author\"/> \n");
			fwrite($sFh, "</gmd:role>\n");
			fwrite($sFh, "</gmd:CI_ResponsibleParty>\n");
			fwrite($sFh, "</gmd:contact>\n");
			fwrite($sFh, "<gmd:dateStamp>\n");
			$dt = strtotime($aSQL[10]);
			$corrected_date=BST_finder($dt);	
			$sRecordValue = date("Y-m-d", $corrected_date);
			fwrite($sFh, "<gco:Date>" . $sRecordValue . "</gco:Date>\n");
			fwrite($sFh, "</gmd:dateStamp>\n");
			fwrite($sFh, "<gmd:metadataStandardName>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[9] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:metadataStandardName>\n");
			fwrite($sFh, "<gmd:metadataStandardVersion>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[8] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:metadataStandardVersion>\n");
			fwrite($sFh, "<gmd:referenceSystemInfo>\n");
			fwrite($sFh, "<gmd:MD_ReferenceSystem>\n");
			fwrite($sFh, "<gmd:referenceSystemIdentifier>\n");
			fwrite($sFh, "<gmd:RS_Identifier>\n");
			fwrite($sFh, "<gmd:code>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[7] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:code>\n");
			fwrite($sFh, "<gmd:codeSpace>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[6] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:codeSpace>\n");
			fwrite($sFh, "</gmd:RS_Identifier>\n");
			fwrite($sFh, "</gmd:referenceSystemIdentifier>\n");
			fwrite($sFh, "</gmd:MD_ReferenceSystem>\n");
			fwrite($sFh, "</gmd:referenceSystemInfo>\n");
			fwrite($sFh, "<gmd:identificationInfo>\n");
			fwrite($sFh, "<gmd:MD_DataIdentification>\n");
			fwrite($sFh, "<gmd:citation>\n");
			fwrite($sFh, "<gmd:CI_Citation>\n");
			fwrite($sFh, "<gmd:title>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[0] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:title>\n");
			fwrite($sFh, "<gmd:alternateTitle>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[1] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:alternateTitle>\n");
			fwrite($sFh, "<gmd:date>\n");
			fwrite($sFh, "<gmd:CI_Date>\n");
			fwrite($sFh, "<gmd:date>\n");
			$dt = strtotime($aSQL[36]);
			$corrected_date=BST_finder($dt);	
			$sRecordValue = date("Y-m-d", $corrected_date);
			fwrite($sFh, "<gco:Date>" . $sRecordValue . "</gco:Date>\n");
			fwrite($sFh, "</gmd:date>\n");
			fwrite($sFh, "<gmd:dateType>\n");
			if ($aSQL[22] == '') {
				fwrite($sFh, "<gmd:CI_DateTypeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_DateTypeCode\" codeListValue=\"creation\"/>\n");
			}
			if ($aSQL[22] == 'creatie') {
				fwrite($sFh, "<gmd:CI_DateTypeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_DateTypeCode\" codeListValue=\"creation\"/>\n");
			}
			if ($aSQL[22] == 'publicatie') {
				fwrite($sFh, "<gmd:CI_DateTypeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_DateTypeCode\" codeListValue=\"publication\"/>\n");
			}
			if ($aSQL[22] == 'revisie') {
				fwrite($sFh, "<gmd:CI_DateTypeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_DateTypeCode\" codeListValue=\"revision\"/>\n");
			}
			fwrite($sFh, "</gmd:dateType>\n");
			fwrite($sFh, "</gmd:CI_Date>\n");
			fwrite($sFh, "</gmd:date>\n");
			fwrite($sFh, "<gmd:edition>\n");
			fwrite($sFh, "</gmd:edition>\n");
			fwrite($sFh, "<gmd:identifier>\n");
            fwrite($sFh, "<gmd:MD_Identifier>\n");
            fwrite($sFh, "<gmd:code>\n");
            fwrite($sFh, "<gco:CharacterString>" . $aSQL[43] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:code>\n");
            fwrite($sFh, "</gmd:MD_Identifier>\n");
			fwrite($sFh, "</gmd:identifier>\n");			
			fwrite($sFh, "</gmd:CI_Citation>\n");
			fwrite($sFh, "</gmd:citation>\n");
			fwrite($sFh, "<gmd:abstract>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[42] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:abstract>\n");
			fwrite($sFh, "<gmd:purpose>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[34] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:purpose>\n");
			fwrite($sFh, "<gmd:status>\n");
			if ($aSQL[30] == '') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"underDevelopment\"/>\n");
			}
			if ($aSQL[30] == 'compleet') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"completed\"/>\n");
			}
			if ($aSQL[30] == 'historisch archief') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"historicalArchive\"/>\n");
			}
			if ($aSQL[30] == 'niet relevant') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"obsolete\"/>\n");
			}
			if ($aSQL[30] == 'continu geactualiseerd') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"onGoing\"/>\n");
			}
			if ($aSQL[30] == 'gepland') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"planned\"/>\n");
			}
			if ($aSQL[30] == 'actualisatie vereist') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"required\"/>\n");
			}
			if ($aSQL[30] == 'in ontwikkeling') {
				fwrite($sFh, "<gmd:MD_ProgressCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ProgressCode\" codeListValue=\"underDevelopment\"/>\n");
			}			
			fwrite($sFh, "</gmd:status>\n");
			fwrite($sFh, "<gmd:pointOfContact>\n");
			fwrite($sFh, "<gmd:CI_ResponsibleParty>\n");
			fwrite($sFh, "<gmd:individualName>\n");
			$sWaarde = F_SELECTRECORD("SELECT CONTACTPERSOON FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:individualName>\n");
			fwrite($sFh, "<gmd:organisationName>\n");
			$sWaarde = F_SELECTRECORD("SELECT ORGANISATIE FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:organisationName>\n");
			fwrite($sFh, "<gmd:positionName>\n");
			fwrite($sFh, "<gco:CharacterString>Auteur</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:positionName>\n");
			fwrite($sFh, "<gmd:contactInfo>\n");
			fwrite($sFh, "<gmd:CI_Contact>\n");
			fwrite($sFh, "<gmd:phone>\n");
			fwrite($sFh, "<gmd:CI_Telephone>\n");
			fwrite($sFh, "<gmd:voice>\n");
			$sWaarde = F_SELECTRECORD("SELECT TELEFOON FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:voice>\n");
			fwrite($sFh, "<gmd:facsimile>\n");
			$sWaarde = F_SELECTRECORD("SELECT FAX FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:facsimile>\n");
			fwrite($sFh, "</gmd:CI_Telephone>\n");
			fwrite($sFh, "</gmd:phone>\n");
			fwrite($sFh, "<gmd:address>\n");
			fwrite($sFh, "<gmd:CI_Address>\n");
			fwrite($sFh, "<gmd:deliveryPoint>\n");
			$sWaarde = F_SELECTRECORD("SELECT ADRES FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:deliveryPoint>\n");
			fwrite($sFh, "<gmd:city>\n");
			$sWaarde = F_SELECTRECORD("SELECT PLAATS FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:city>\n");
			fwrite($sFh, "<gmd:administrativeArea>\n");
			$sWaarde = F_SELECTRECORD("SELECT GEBIED FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:administrativeArea>\n");
			fwrite($sFh, "<gmd:postalCode>\n");
			$sWaarde = F_SELECTRECORD("SELECT POSTCODE FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:postalCode>\n");
			fwrite($sFh, "<gmd:country>\n");
			$sWaarde = F_SELECTRECORD("SELECT LAND FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:country>\n");
			fwrite($sFh, "<gmd:electronicMailAddress>\n");
			$sWaarde = F_SELECTRECORD("SELECT EMAIL FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:electronicMailAddress>\n");
			fwrite($sFh, "</gmd:CI_Address>\n");
			fwrite($sFh, "</gmd:address>\n");
			fwrite($sFh, "<gmd:onlineResource>\n");
			fwrite($sFh, "<gmd:CI_OnlineResource>\n");
			fwrite($sFh, "<gmd:linkage>\n");
			$sWaarde = F_SELECTRECORD("SELECT URL FROM CONTACT WHERE CONTACT_ID = " . $aSQL[35]);
			fwrite($sFh, "<gmd:URL>" . $sWaarde . "</gmd:URL>\n");
			fwrite($sFh, "</gmd:linkage>\n");
			fwrite($sFh, "</gmd:CI_OnlineResource>\n");
			fwrite($sFh, "</gmd:onlineResource>\n");
			fwrite($sFh, "</gmd:CI_Contact>\n");
			fwrite($sFh, "</gmd:contactInfo>\n");
			fwrite($sFh, "<gmd:role>\n");
			fwrite($sFh, "<gmd:CI_RoleCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_RoleCode\" codeListValue=\"pointOfContact\"/> \n");
			fwrite($sFh, "</gmd:role>\n");
			fwrite($sFh, "</gmd:CI_ResponsibleParty>\n");
			fwrite($sFh, "</gmd:pointOfContact>\n");
			fwrite($sFh, "<gmd:resourceMaintenance>\n");
			fwrite($sFh, "<gmd:MD_MaintenanceInformation>\n");
			fwrite($sFh, "<gmd:maintenanceAndUpdateFrequency>\n");
			fwrite($sFh, "</gmd:maintenanceAndUpdateFrequency>\n");
			fwrite($sFh, "</gmd:MD_MaintenanceInformation>\n");
			fwrite($sFh, "</gmd:resourceMaintenance>\n");
			fwrite($sFh, "<gmd:graphicOverview>\n");
			fwrite($sFh, "<gmd:MD_BrowseGraphic>\n");
			fwrite($sFh, "<gmd:fileName>\n");			
			
			$plaatje = explode(".", $aSQL[1]);
			$splaatje = $plaatje[1];			
			fwrite($sFh, "<gco:CharacterString>http://www.drenthe.info/kaarten/website/metadata/thumbs/" . $splaatje . ".jpg</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fileName>\n");
			fwrite($sFh, "<gmd:fileDescription>\n"); 
            fwrite($sFh, "<gco:CharacterString>thumbnail</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fileDescription>\n");
			fwrite($sFh, "<gmd:fileType>\n");
            fwrite($sFh, "<gco:CharacterString>jpg</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fileType>\n");
			fwrite($sFh, "</gmd:MD_BrowseGraphic>\n");
			fwrite($sFh, "</gmd:graphicOverview>\n");
			fwrite($sFh, "<gmd:graphicOverview>\n");
			fwrite($sFh, "<gmd:MD_BrowseGraphic>\n");
			fwrite($sFh, "<gmd:fileName>\n");
            fwrite($sFh, "<gco:CharacterString>http://www.drenthe.info/kaarten/website/metadata/thumbs/" . $splaatje . ".jpg</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fileName>\n");
			fwrite($sFh, "<gmd:fileDescription>\n");
			fwrite($sFh, "<gco:CharacterString>large_thumbnail</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fileDescription>\n");
			fwrite($sFh, "<gmd:fileType>\n");
			fwrite($sFh, "<gco:CharacterString>jpg</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fileType>\n");			
			fwrite($sFh, "</gmd:MD_BrowseGraphic>\n");			
			fwrite($sFh, "</gmd:graphicOverview>\n");
			fwrite($sFh, "<gmd:descriptiveKeywords>\n");
			fwrite($sFh, "<gmd:MD_Keywords>\n");
			
			$SQL = "SELECT TREFTEXT.TREFWOORD FROM TREFCODE INNER JOIN TREFTEXT ON TREFCODE.TREFCODE = TREFTEXT.TREFCODE WHERE TREFCODE.DATACODE= " . $sDatacode . " ORDER BY TREFTEXT.TREFWOORD";
			$trefresult = $db->Execute($SQL);
			while (!$trefresult->EOF) {	
				fwrite($sFh, "<gmd:keyword>\n");
                $treftext = $trefresult->fields[0];
				if ($treftext == '') {
					fwrite($sFh, "<gco:CharacterString></gco:CharacterString>\n");
				}
				else {
					fwrite($sFh, "<gco:CharacterString>" . $treftext . "</gco:CharacterString>\n");
				}
				fwrite($sFh, "</gmd:keyword>\n");			
				$trefresult->MoveNext();
			}			
			fwrite($sFh, "<gmd:thesaurusName>\n");
			fwrite($sFh, "<gmd:CI_Citation>\n");
			fwrite($sFh, "<gmd:title>\n");
			fwrite($sFh, "<gco:CharacterString>Trefwoordenlijst provincie Drenthe</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:title>\n");
			fwrite($sFh, "<gmd:date>\n");			
			fwrite($sFh, "<gmd:CI_Date>\n");
            fwrite($sFh, "<gmd:date>\n");
            fwrite($sFh, "<gco:Date>2008-01-01</gco:Date>\n");
            fwrite($sFh, "</gmd:date>\n");
            fwrite($sFh, "<gmd:dateType>\n");
            fwrite($sFh, "<gmd:CI_DateTypeCode\n");
            fwrite($sFh, "codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_DateTypeCode\"\n");
            fwrite($sFh, "codeListValue=\"publication\"/>\n");
            fwrite($sFh, "</gmd:dateType>\n");
            fwrite($sFh, "</gmd:CI_Date>\n");			
			fwrite($sFh, "</gmd:date>\n");
			fwrite($sFh, "</gmd:CI_Citation>\n");			
			fwrite($sFh, "</gmd:thesaurusName>\n");
			fwrite($sFh, "</gmd:MD_Keywords>\n");
			fwrite($sFh, "</gmd:descriptiveKeywords>\n");
			
			// Verwijderd ivm Geonovum checker
			//fwrite($sFh, "<gmd:resourceSpecificUsage>\n");
			//fwrite($sFh, "<gmd:MD_Usage>\n");
			//fwrite($sFh, "<gmd:specificUsage>\n");
			//fwrite($sFh, "<gco:CharacterString>Dit bestand biedt een detailniveau dat uitstekend geschikt is voor midden- en kleinschalige toepassingen.</gco:CharacterString>\n");
			//fwrite($sFh, "</gmd:specificUsage>\n");
			//fwrite($sFh, "</gmd:MD_Usage>\n");
			//fwrite($sFh, "</gmd:resourceSpecificUsage>\n");
			
			
			fwrite($sFh, "<gmd:resourceConstraints>\n");
			fwrite($sFh, "<gmd:MD_LegalConstraints>\n");
			fwrite($sFh, "<gmd:useLimitation>\n");			
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[32] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:useLimitation>\n");
			fwrite($sFh, "<gmd:accessConstraints>\n");
			if ($aSQL[29] == '') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"copyright\"/>\n");
			}
			if ($aSQL[29] == 'copyright') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"copyright\"/>\n");
			}
			if ($aSQL[29] == 'patent') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"patent\"/>\n");
			}
			if ($aSQL[29] == 'patent in wording') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"patentPending\"/>\n");
			}
			if ($aSQL[29] == 'merknaam') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"trademark\"/>\n");
			}
			if ($aSQL[29] == 'licentie') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"license\"/>\n");
			}
			if ($aSQL[29] == 'intellectueel eigendom') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"intellectualPropertyRights\"/>\n");
			}
			if ($aSQL[29] == 'niet toegankelijk') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"restricted\"/>\n");
			}
			if ($aSQL[29] == 'anders') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"otherRestrictions\"/>\n");
			}			
			fwrite($sFh, "</gmd:accessConstraints>\n");
			fwrite($sFh, "<gmd:useConstraints>\n");
			if ($aSQL[29] == '') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"copyright\"/>\n");
			}
			if ($aSQL[29] == 'copyright') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"copyright\"/>\n");
			}
			if ($aSQL[29] == 'patent') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"patent\"/>\n");
			}
			if ($aSQL[29] == 'patent in wording') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"patentPending\"/>\n");
			}
			if ($aSQL[29] == 'merknaam') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"trademark\"/>\n");
			}
			if ($aSQL[29] == 'licentie') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"license\"/>\n");
			}
			if ($aSQL[29] == 'intellectueel eigendom') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"intellectualPropertyRights\"/>\n");
			}
			if ($aSQL[29] == 'niet toegankelijk') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"restricted\"/>\n");
			}
			if ($aSQL[29] == 'anders') {
				fwrite($sFh, "<gmd:MD_RestrictionCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_RestrictionCode\" codeListValue=\"otherRestrictions\"/>\n");
			}			
			fwrite($sFh, "</gmd:useConstraints>\n");
			fwrite($sFh, "</gmd:MD_LegalConstraints>\n");
			fwrite($sFh, "</gmd:resourceConstraints>\n");
			fwrite($sFh, "<gmd:resourceConstraints>\n");
			fwrite($sFh, "<gmd:MD_LegalConstraints>\n");
			fwrite($sFh, "<gmd:otherConstraints>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[27] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:otherConstraints>\n");
			fwrite($sFh, "</gmd:MD_LegalConstraints>\n");
			fwrite($sFh, "</gmd:resourceConstraints>\n");
			fwrite($sFh, "<gmd:spatialRepresentationType>\n");
			if ($aSQL[17] == 'tekstTabel') {
				fwrite($sFh, "<gmd:MD_SpatialRepresentationTypeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_SpatialRepresentationTypeCode\" codeListValue=\"textTable\"/>\n");
			}
			else {
				fwrite($sFh, "<gmd:MD_SpatialRepresentationTypeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_SpatialRepresentationTypeCode\" codeListValue=\"" . $aSQL[17] . "\"/>\n");
			}
			fwrite($sFh, "</gmd:spatialRepresentationType>\n");
			fwrite($sFh, "<gmd:spatialResolution>\n");
			fwrite($sFh, "<gmd:MD_Resolution>\n");
			fwrite($sFh, "<gmd:equivalentScale>\n");
			fwrite($sFh, "<gmd:MD_RepresentativeFraction>\n");
			fwrite($sFh, "<gmd:denominator>\n");
			fwrite($sFh, "<gco:Integer>" . $aSQL[40] . "</gco:Integer>\n");
			fwrite($sFh, "</gmd:denominator>\n");
			fwrite($sFh, "</gmd:MD_RepresentativeFraction>\n");
			fwrite($sFh, "</gmd:equivalentScale>\n");
			fwrite($sFh, "</gmd:MD_Resolution>\n");
			fwrite($sFh, "</gmd:spatialResolution>\n");
			fwrite($sFh, "<gmd:language>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[25] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:language>\n");
			fwrite($sFh, "<gmd:characterSet>\n");
			fwrite($sFh, "<gmd:MD_CharacterSetCode codeList=\"./resources/codeList.xml#MD_CharacterSetCode\" codeListValue=\"utf8\" />\n");
			fwrite($sFh, "</gmd:characterSet>\n");
			fwrite($sFh, "<gmd:topicCategory>\n");
			if ($aSQL[33] == 'landbouw en veeteelt') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>farming</gmd:MD_TopicCategoryCode> \n");								
			}
			if ($aSQL[33] == 'biota') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>biota</gmd:MD_TopicCategoryCode> \n");												
			}
			if ($aSQL[33] == 'grenzen') {				
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>boundaries</gmd:MD_TopicCategoryCode> \n");												
			}
			if ($aSQL[33] == 'klimatologie, meteologie en atmosfeer') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>climatologyMeteorologyAtmosphere</gmd:MD_TopicCategoryCode> \n");																
			}
			if ($aSQL[33] == 'economie') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>economy</gmd:MD_TopicCategoryCode> \n");																				
			}
			if ($aSQL[33] == 'hoogte') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>elevation</gmd:MD_TopicCategoryCode> \n");																								
			}
			if ($aSQL[33] == 'natuur en milieu') {				
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>environment</gmd:MD_TopicCategoryCode> \n");				
			}
			if ($aSQL[33] == 'geowetenschappelijke data') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>geoscientificInformation</gmd:MD_TopicCategoryCode> \n");				
			}
			if ($aSQL[33] == 'gezondheid') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>health</gmd:MD_TopicCategoryCode> \n");						
			}
			if ($aSQL[33] == 'refentie materiaal aardbedekking') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>imageryBaseMapsEarthCover</gmd:MD_TopicCategoryCode> \n");					
			}
			if ($aSQL[33] == 'militair') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>intelligenceMilitary</gmd:MD_TopicCategoryCode> \n");				
			}
			if ($aSQL[33] == 'binnenwater') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>inlandWaters</gmd:MD_TopicCategoryCode> \n");			
			}
			if ($aSQL[33] == 'locatie') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>location</gmd:MD_TopicCategoryCode> \n");	
			}
			if ($aSQL[33] == 'oceanen') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>oceans</gmd:MD_TopicCategoryCode> \n");					
			}
			if ($aSQL[33] == 'planning kadaster') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>planningCadastre</gmd:MD_TopicCategoryCode> \n");				
			}
			if ($aSQL[33] == 'maatschappij') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>society</gmd:MD_TopicCategoryCode> \n");				
			}
			if ($aSQL[33] == '(civiele) structuren') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>structure</gmd:MD_TopicCategoryCode> \n");				
			}
			if ($aSQL[33] == 'transport') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>transportation</gmd:MD_TopicCategoryCode> \n");						
			}
			if ($aSQL[33] == 'nutsbedrijven communicatie') {
				fwrite($sFh, "<gmd:MD_TopicCategoryCode>utilitiesCommunication</gmd:MD_TopicCategoryCode> \n");					
			}			
			fwrite($sFh, "</gmd:topicCategory>\n");
			fwrite($sFh, "<gmd:extent>\n");
			fwrite($sFh, "<gmd:EX_Extent>\n");
			fwrite($sFh, "<gmd:description>\n");
			fwrite($sFh, "</gmd:description>\n");
			fwrite($sFh, "<gmd:geographicElement>\n");
			fwrite($sFh, "<gmd:EX_GeographicBoundingBox>\n");
			
			$temp = $aSQL[23];
			
			if ($temp <> "") {
				$minx = F_SELECTRECORD("SELECT MIN_X FROM GEBIED WHERE GEBIED = '" . $temp . "'");
				$maxx = F_SELECTRECORD("SELECT MAX_X FROM GEBIED WHERE GEBIED = '" . $temp . "'");
				$miny = F_SELECTRECORD("SELECT MIN_Y FROM GEBIED WHERE GEBIED = '" . $temp . "'");
				$maxy = F_SELECTRECORD("SELECT MAX_Y FROM GEBIED WHERE GEBIED = '" . $temp . "'");
				fwrite($sFh, "<gmd:westBoundLongitude>\n");
				fwrite($sFh, "<gco:Decimal>" . $minx . "</gco:Decimal>\n");
				fwrite($sFh, "</gmd:westBoundLongitude>\n");
				fwrite($sFh, "<gmd:eastBoundLongitude>\n");
				fwrite($sFh, "<gco:Decimal>" . $maxx . "</gco:Decimal>\n");
				fwrite($sFh, "</gmd:eastBoundLongitude>\n");
				fwrite($sFh, "<gmd:southBoundLatitude>\n");
				fwrite($sFh, "<gco:Decimal>" . $miny . "</gco:Decimal>\n");
				fwrite($sFh, "</gmd:southBoundLatitude>\n");
				fwrite($sFh, "<gmd:northBoundLatitude>\n");
				fwrite($sFh, "<gco:Decimal>" . $maxy . "</gco:Decimal>\n");
				fwrite($sFh, "</gmd:northBoundLatitude>\n");				
			}
			else {
				fwrite($sFh, "<gmd:westBoundLongitude>\n");
				fwrite($sFh, "<gco:Decimal></gco:Decimal>\n");
				fwrite($sFh, "</gmd:westBoundLongitude>\n");
				fwrite($sFh, "<gmd:eastBoundLongitude>\n");
				fwrite($sFh, "<gco:Decimal></gco:Decimal>\n");
				fwrite($sFh, "</gmd:eastBoundLongitude>\n");
				fwrite($sFh, "<gmd:southBoundLatitude>\n");
				fwrite($sFh, "<gco:Decimal></gco:Decimal>\n");
				fwrite($sFh, "</gmd:southBoundLatitude>\n");
				fwrite($sFh, "<gmd:northBoundLatitude>\n");
				fwrite($sFh, "<gco:Decimal></gco:Decimal>\n");
				fwrite($sFh, "</gmd:northBoundLatitude>\n");							
			}	
			fwrite($sFh, "</gmd:EX_GeographicBoundingBox>\n");
			fwrite($sFh, "</gmd:geographicElement>\n");
			fwrite($sFh, "<gmd:geographicElement>\n");
			fwrite($sFh, "<gmd:EX_GeographicDescription>\n");
			fwrite($sFh, "<gmd:geographicIdentifier>\n");
			fwrite($sFh, "<gmd:MD_Identifier>\n");
			fwrite($sFh, "<gmd:code>\n");
			fwrite($sFh, "<gco:CharacterString>Provincie Drenthe</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:code>\n");
			fwrite($sFh, "</gmd:MD_Identifier>\n");
			fwrite($sFh, "</gmd:geographicIdentifier>\n");
			fwrite($sFh, "</gmd:EX_GeographicDescription>\n");
			fwrite($sFh, "</gmd:geographicElement>\n");
			fwrite($sFh, "<gmd:temporalElement>\n");
			fwrite($sFh, "<gmd:EX_TemporalExtent>\n");
			fwrite($sFh, "<gmd:extent>\n");
			fwrite($sFh, "<gml:TimePeriod gml:id=\"N10259\">\n");
			fwrite($sFh, "<gml:begin>\n");
			fwrite($sFh, "<gml:TimeInstant gml:id=\"N1025E\">\n");
			if ($aSQL[12] <> '') {
				$dt = strtotime($aSQL[12]);
				$corrected_date=BST_finder($dt);	
				$sRecordValue = date("Y-m-d", $corrected_date);
				fwrite($sFh, "<gml:timePosition>" . $sRecordValue . "</gml:timePosition>\n");
			}
			else {
				fwrite($sFh, "<gml:timePosition/>\n");
			}
			fwrite($sFh, "</gml:TimeInstant>\n");
			fwrite($sFh, "</gml:begin>\n");
			fwrite($sFh, "<gml:end>\n");
			fwrite($sFh, "<gml:TimeInstant gml:id=\"N10267\">\n");
			if ($aSQL[13] <> '') {			
				$dt = strtotime($aSQL[13]);
				$corrected_date=BST_finder($dt);	
				$sRecordValue = date("Y-m-d", $corrected_date);
				fwrite($sFh, "<gml:timePosition>" . $sRecordValue . "</gml:timePosition>\n");
			}
			else {
				fwrite($sFh, "<gml:timePosition/>\n");
			}
			fwrite($sFh, "</gml:TimeInstant>\n");
			fwrite($sFh, "</gml:end>\n");
			fwrite($sFh, "</gml:TimePeriod>\n");
			fwrite($sFh, "</gmd:extent>\n");
			fwrite($sFh, "</gmd:EX_TemporalExtent>\n");
			fwrite($sFh, "</gmd:temporalElement>\n");
			fwrite($sFh, "</gmd:EX_Extent>\n");
			fwrite($sFh, "</gmd:extent>\n");
			fwrite($sFh, "<gmd:supplementalInformation>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[39] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:supplementalInformation>\n");
			fwrite($sFh, "</gmd:MD_DataIdentification>\n");
			fwrite($sFh, "</gmd:identificationInfo>\n");
			fwrite($sFh, "<gmd:distributionInfo>\n");
			fwrite($sFh, "<gmd:MD_Distribution>\n");
			fwrite($sFh, "<gmd:distributionFormat>\n");
			fwrite($sFh, "<gmd:MD_Format>\n");
			fwrite($sFh, "<gmd:name>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[18] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:name>\n");
			fwrite($sFh, "<gmd:version>\n");
			fwrite($sFh, "<gco:CharacterString>9.2</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:version>\n");
			fwrite($sFh, "</gmd:MD_Format>\n");
			fwrite($sFh, "</gmd:distributionFormat>\n");
			fwrite($sFh, "<gmd:distributor>\n");
			fwrite($sFh, "<gmd:MD_Distributor>\n");
			fwrite($sFh, "<gmd:distributorContact>\n");
			fwrite($sFh, "<gmd:CI_ResponsibleParty>\n");
			fwrite($sFh, "<gmd:individualName>\n");
			$sWaarde = F_SELECTRECORD("SELECT CONTACTPERSOON FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:individualName>\n");
			fwrite($sFh, "<gmd:organisationName>\n");
			$sWaarde = F_SELECTRECORD("SELECT ORGANISATIE FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:organisationName>\n");
			fwrite($sFh, "<gmd:positionName>\n");
			fwrite($sFh, "<gco:CharacterString>Auteur</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:positionName>\n");
			fwrite($sFh, "<gmd:contactInfo>\n");
			fwrite($sFh, "<gmd:CI_Contact>\n");
			fwrite($sFh, "<gmd:phone>\n");
			fwrite($sFh, "<gmd:CI_Telephone>\n");
			fwrite($sFh, "<gmd:voice>\n");
			$sWaarde = F_SELECTRECORD("SELECT TELEFOON FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:voice>\n");
			fwrite($sFh, "<gmd:facsimile>\n");
			$sWaarde = F_SELECTRECORD("SELECT FAX FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:facsimile>\n");
			fwrite($sFh, "</gmd:CI_Telephone>\n");
			fwrite($sFh, "</gmd:phone>\n");
			fwrite($sFh, "<gmd:address>\n");
			fwrite($sFh, "<gmd:CI_Address>\n");
			fwrite($sFh, "<gmd:deliveryPoint>\n");
			$sWaarde = F_SELECTRECORD("SELECT ADRES FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:deliveryPoint>\n");
			fwrite($sFh, "<gmd:city>\n");
			$sWaarde = F_SELECTRECORD("SELECT PLAATS FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:city>\n");
			fwrite($sFh, "<gmd:administrativeArea>\n");
			$sWaarde = F_SELECTRECORD("SELECT GEBIED FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:administrativeArea>\n");
			fwrite($sFh, "<gmd:postalCode>\n");
			$sWaarde = F_SELECTRECORD("SELECT POSTCODE FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:postalCode>\n");
			fwrite($sFh, "<gmd:country>\n");
			$sWaarde = F_SELECTRECORD("SELECT LAND FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:country>\n");
			fwrite($sFh, "<gmd:electronicMailAddress>\n");
			$sWaarde = F_SELECTRECORD("SELECT EMAIL FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gco:CharacterString>" . $sWaarde . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:electronicMailAddress>\n");
			fwrite($sFh, "</gmd:CI_Address>\n");
			fwrite($sFh, "</gmd:address>\n");
			fwrite($sFh, "<gmd:onlineResource>\n");
			fwrite($sFh, "<gmd:CI_OnlineResource>\n");
			fwrite($sFh, "<gmd:linkage>\n");
			$sWaarde = F_SELECTRECORD("SELECT URL FROM CONTACT WHERE CONTACT_ID = " . $aSQL[4]);
			fwrite($sFh, "<gmd:URL>" . $sWaarde . "</gmd:URL>\n");
			fwrite($sFh, "</gmd:linkage>\n");
			fwrite($sFh, "</gmd:CI_OnlineResource>\n");
			fwrite($sFh, "</gmd:onlineResource>\n");
			fwrite($sFh, "</gmd:CI_Contact>\n");
			fwrite($sFh, "</gmd:contactInfo>\n");
			fwrite($sFh, "<gmd:role>\n");
			fwrite($sFh, "<gmd:CI_RoleCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#CI_RoleCode\" codeListValue=\"owner\">owner</gmd:CI_RoleCode>\n");
			fwrite($sFh, "</gmd:role>\n");
			fwrite($sFh, "</gmd:CI_ResponsibleParty>\n");
			fwrite($sFh, "</gmd:distributorContact>\n");
			fwrite($sFh, "<gmd:distributionOrderProcess>\n");
			fwrite($sFh, "<gmd:MD_StandardOrderProcess>\n");
			fwrite($sFh, "<gmd:fees>\n");
			fwrite($sFh, "<gco:CharacterString>Gratis</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:fees>\n");
			fwrite($sFh, "<gmd:orderingInstructions>\n");
			fwrite($sFh, "<gco:CharacterString>Neem contact op met Provincie Drenthe</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:orderingInstructions>\n");
			fwrite($sFh, "<gmd:turnaround>\n");
			fwrite($sFh, "<gco:CharacterString />\n");
			fwrite($sFh, "</gmd:turnaround>\n");
			fwrite($sFh, "</gmd:MD_StandardOrderProcess>\n");
			fwrite($sFh, "</gmd:distributionOrderProcess>\n");
			fwrite($sFh, "</gmd:MD_Distributor>\n");
			fwrite($sFh, "</gmd:distributor>\n");			
			fwrite($sFh, "<gmd:transferOptions>\n");
			fwrite($sFh, "<gmd:MD_DigitalTransferOptions>\n");
			fwrite($sFh, "<gmd:onLine>\n");
			fwrite($sFh, "<gmd:CI_OnlineResource>\n");
			fwrite($sFh, "<gmd:linkage>\n");
			fwrite($sFh, "<gmd:URL>http://www.drenthe.info/kaarten/wmsconnector/com.esri.wms.Esrimap?&amp;ServiceName=GDB_Geoportaal&amp;</gmd:URL>\n");
			fwrite($sFh, "</gmd:linkage>\n");
			fwrite($sFh, "<gmd:protocol>\n");
			fwrite($sFh, "<gco:CharacterString>OGC:WMS</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:protocol>\n");
			fwrite($sFh, "<gmd:name>\n");
			$sImsid = explode(".", $aSQL[1]);
			fwrite($sFh, "<gco:CharacterString>" . $sImsid[1] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:name>\n");
			fwrite($sFh, "<gmd:description gco:nilReason=\"missing\">\n");
			fwrite($sFh, "<gco:CharacterString/>\n");
			fwrite($sFh, "</gmd:description>\n");			
			fwrite($sFh, "</gmd:CI_OnlineResource>\n");
			fwrite($sFh, "</gmd:onLine>\n");
			//fwrite($sFh, "<gmd:unitsOfDistribution>\n");
			//fwrite($sFh, "</gmd:unitsOfDistribution>\n");
			fwrite($sFh, "</gmd:MD_DigitalTransferOptions>\n");
			fwrite($sFh, "</gmd:transferOptions>\n");			
			fwrite($sFh, "</gmd:MD_Distribution>\n");
			fwrite($sFh, "</gmd:distributionInfo>\n");
			fwrite($sFh, "<gmd:dataQualityInfo>\n");
			fwrite($sFh, "<gmd:DQ_DataQuality>\n");
			fwrite($sFh, "<gmd:scope>\n");
			fwrite($sFh, "<gmd:DQ_Scope>\n");
			fwrite($sFh, "<gmd:level>\n");
			fwrite($sFh, "<gmd:MD_ScopeCode codeList=\"http://www.isotc211.org/2005/resources/codeList.xml#MD_ScopeCode\" codeListValue=\"dataset\">dataset</gmd:MD_ScopeCode>\n");
			fwrite($sFh, "</gmd:level>\n");
			fwrite($sFh, "</gmd:DQ_Scope>\n");
			fwrite($sFh, "</gmd:scope>\n");
			fwrite($sFh, "<gmd:lineage>\n");
			fwrite($sFh, "<gmd:LI_Lineage>\n");
			fwrite($sFh, "<gmd:statement>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[39] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:statement>\n");
			fwrite($sFh, "<gmd:source>\n");
			fwrite($sFh, "<gmd:LI_Source>\n");
			fwrite($sFh, "<gmd:description>\n");
			fwrite($sFh, "<gco:CharacterString>" . $aSQL[40] . "</gco:CharacterString>\n");
			fwrite($sFh, "</gmd:description>\n");
			fwrite($sFh, "</gmd:LI_Source>\n");
			fwrite($sFh, "</gmd:source>\n");			
			fwrite($sFh, "</gmd:LI_Lineage>\n");
			fwrite($sFh, "</gmd:lineage>\n");
			fwrite($sFh, "</gmd:DQ_DataQuality>\n");
			fwrite($sFh, "</gmd:dataQualityInfo>\n");
			fwrite($sFh, "</gmd:MD_Metadata>\n");
			//fwrite($sFh, "</metadata>\n");
			
			fclose($sFh);
			print ("XML $sTitel met succes opgeslagen<BR>");
		
		}
	}
print($DatacodeSel. " succesvol als XML opgeslagen. Klik <A HREF=\"?e=@GBI&p=DATASETEDIT|" . $sDatacodeSel . "\"> hier</A> voor om terug te gaan naar dataset gegevens");
print("<BR>\n");
print("<BR>\n");
}

if ($sAction == "DDEOPENBAAR") {
	print("<div id=\"nav_path\">\n");
	print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > <a href=\"?e=@GBI&p=EXPORT\">Exporteren</a> > Exporteren DDE XML openbare gegevens </span>\n");
	print("</div>\n");
	print("<BR><BR><BR>\n");
	print("<CENTER>\n");	
		
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"600px\" ID=\"kopbegin\">\n");
	print("<CENTER>Exporteren DDE XML openbare gegevens</CENTER>\n");
	print("</TD></TR></TABLE></CENTER>\n");
	print("<BR>\n");	
		
	print("<CENTER>\n");
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD ALIGN=\"LEFT\" VALIGN=\"MIDDLE\" WIDTH=\"600px\">\n");

	$sRecords = F_SELECTRECORD("SELECT DATACODE, DATASET_TITEL, ALT_TITEL FROM DATASET WHERE TYPE = 1 ORDER BY ALT_TITEL");
			
	if ($sRecords <> "") {
		$aRecords = explode("|", $sRecords);
	}
	
	if (isset($aRecords)) {
		$sFile = "../metadata/DDEDownloadConfig.xml";
		$sFh = fopen($sFile, 'w');
		fwrite($sFh, "<ddeDownloader ddeServerUrl=\"http://www.drenthe.info/kaarten/cgi-bin/DDE/spatialDirect.pl\" \n");
		fwrite($sFh, "maxDownloadSize_mB=\"15\" \n");
		fwrite($sFh, "adminEMail=\"giscartografie@drenthe.nl\" \n");
		fwrite($sFh, "mailSmtpHost=\"172.30.4.94\" \n");
		fwrite($sFh, "resultExpiration_dys=\"2\">\n");
		fwrite($sFh, "<ddeLayers>\n");		
		for ($iRecord = 0; $iRecord < count($aRecords) ; $iRecord++) {			
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sDatacode  = $aRecord[0];
			$sTitel = $aRecord[1];
			$sAltTitel = $aRecord[2];
			if ($sAltTitel <> "") {
				fwrite($sFh, "<ddeLayer>\n");
				fwrite($sFh, "<label>" . $sAltTitel . "</label>\n");
				fwrite($sFh, "<ddeName>" . $sAltTitel . "_GEOPORTAAL</ddeName>\n");
				fwrite($sFh, "<ddeServerUrl>http://paros/cgi-bin/DDE/spatialDirect.pl</ddeServerUrl>\n");
				fwrite($sFh, "<additionalData>\n");
				fwrite($sFh, "<dataUrl>\n");
				fwrite($sFh, "<url>http://paros/website/metadata/" . $sAltTitel . ".pdf</url>\n");
				fwrite($sFh, "</dataUrl>\n");
				fwrite($sFh, "<dataUrl>\n");
				fwrite($sFh, "<url>http://paros/website/metadata/" . $sAltTitel . ".xml</url>\n");
				fwrite($sFh, "</dataUrl>\n");
				fwrite($sFh, "<dataUrl>\n");
				fwrite($sFh, "<url>http://paros/website/metadata/" . "CODE_" . $sAltTitel . ".pdf</url>\n");
				fwrite($sFh, "</dataUrl>\n");
				fwrite($sFh, "<dataUrl>\n");
				fwrite($sFh, "<url>http://paros/website/metadata/leesmij.txt</url>\n");
				fwrite($sFh, "</dataUrl>\n");
				fwrite($sFh, "</additionalData>\n");
				fwrite($sFh, "<dataService>GDB_Geoportaal</dataService>\n");
				$sImsid = explode(".", $sAltTitel);
				fwrite($sFh, "<dataLayerId>" . $sImsid[1] . "</dataLayerId>\n");
				fwrite($sFh, "</ddeLayer>\n");				
			}
			else {
				print($sTitel . " heeft geen alternatieve titel, dataset niet toegevoegd.<BR>\n");
			}
		}
		fwrite($sFh, "</ddeLayers>\n");
		fwrite($sFh, "</ddeDownloader>\n");
		fclose($sFh);
		print("<BR>\n");
		print(count($aRecords) . " succesvol aan XML bestand toegevoegd. Klik <A HREF=\"../metadata/DDEDownloadConfig.xml\" TARGET=\"_blank\"> hier</A> voor het bestand.\n");		
	}
}

if ($sAction == "IMSOPENBAAR") {
	print("<div id=\"nav_path\">\n");
	print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > <a href=\"?e=@GBI&p=EXPORT\">Exporteren</a> > Exporteren AXL openbare gegevens </span>\n");
	print("</div>\n");
	print("<BR><BR><BR>\n");
	print("<CENTER>\n");	
		
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"600px\" ID=\"kopbegin\">\n");
	print("<CENTER>Exporteren AXL openbare gegevens</CENTER>\n");
	print("</TD></TR></TABLE></CENTER>\n");
	print("<BR>\n");	
		
	print("<CENTER>\n");
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD ALIGN=\"LEFT\" VALIGN=\"MIDDLE\" WIDTH=\"600px\">\n");

	$sFile = "../metadata/GDB_Geoportaal_open.axl";
	$sFh = fopen($sFile, 'w');
	fwrite($sFh, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n");
	fwrite($sFh, "<ARCXML version=\"1.1\">\n");
	fwrite($sFh, "<CONFIG>\n");
	fwrite($sFh, "<ENVIRONMENT>\n");
	fwrite($sFh, "<LOCALE country=\"NL\" language=\"nl\" variant=\"\"/>\n");
	fwrite($sFh, "<UIFONT color=\"0,0,0\" name=\"SansSerif\" size=\"12\" style=\"regular\"/>\n");
	fwrite($sFh, "<SCREEN dpi=\"96\"/>\n");
	fwrite($sFh, "</ENVIRONMENT>\n");
	fwrite($sFh, "<MAP>\n");
	fwrite($sFh, "<PROPERTIES>\n");
	fwrite($sFh, "<ENVELOPE minx=\"201527,78125\" miny=\"514663,0\" maxx=\"280406,052631579\" maxy=\"580198,0\" name=\"Initial_Extent\"/>\n");
	fwrite($sFh, "<MAPUNITS units=\"meters\"/>\n");
	fwrite($sFh, "<FILTERCOORDSYS id=\"28992\"/>\n");
	fwrite($sFh, "<FEATURECOORDSYS id=\"28992\"/>\n");
	fwrite($sFh, "</PROPERTIES>\n");
	fwrite($sFh, "<WORKSPACES>\n");
	fwrite($sFh, "<SDEWORKSPACE name=\"GBI\" server=\"CHIOS\" instance=\"port:5151\" database=\"\" user=\"GISUSER\" encrypted=\"true\" password=\"ARORKEQVLEFBSWON\" geoindexdir=\"C:\\DOCUME~1\\ronny\\LOCALS~1\\Temp\\1\"/>\n");
	fwrite($sFh, "</WORKSPACES>\n");		
	
	$sRecords = F_SELECTRECORD("SELECT a.DATACODE, a.DATASET_TITEL, a.ALT_TITEL, b.GEOMETRIE, b.IMSCODE, a.COPYRIGHT FROM DATASET a, GEOGRAFISCH b WHERE a.DATACODE = b.DATACODE AND a.TYPE = 1 AND b.GEOMETRIE = 'raster' ORDER BY a.ALT_TITEL");
			
	if ($sRecords <> "") {
		$aRecords = explode("|", $sRecords);
	}
	
	if (isset($aRecords)) {
		for ($iRecord = 0; $iRecord < count($aRecords) ; $iRecord++) {			
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sSoort  = $aRecord[3];			
			
			if ($sSoort == "raster") {
				$sWaarde = $aRecord[2];
				$sImscode = $aRecord[4];
				$sCopy = $aRecord[5];
				if ($sWaarde <> "") {
					if ($sImscode <> "") {
					$sImsid = explode(".", $sWaarde);
					fwrite($sFh, "<LAYER type=\"image\" name=\"\" visible=\"false\" id=\"" . $sImsid[1] . "\">\n");
					fwrite($sFh, "<COORDSYS id=\"28992\"/>\n");
					fwrite($sFh, "<DATASET name=\"" . $sWaarde . ".RASTER\" workspace=\"GBI\"/>\n");
					fwrite($sFh, $sImscode . "\n");
					fwrite($sFh, "</LAYER>\n");
					}
					else {
					$sImsid = explode(".", $sWaarde);
					fwrite($sFh, "<LAYER type=\"image\" name=\"\" visible=\"false\" id=\"" . $sImsid[1] . "\">\n");
					fwrite($sFh, "<COORDSYS id=\"28992\"/>\n");
					fwrite($sFh, "<DATASET name=\"" . $sWaarde . ".RASTER\" workspace=\"GBI\"/>\n");					
					fwrite($sFh, "</LAYER>\n");
					}
				}
				else {
					print($aRecord[1] . " heeft geen alternatieve titel, dataset niet toegevoegd.<BR>\n");
				}
			}
		}
	}
		
	$sRecords = F_SELECTRECORD("SELECT a.DATACODE, a.DATASET_TITEL, a.ALT_TITEL, b.GEOMETRIE, b.IMSCODE, a.COPYRIGHT FROM DATASET a, GEOGRAFISCH b WHERE a.DATACODE = b.DATACODE AND a.TYPE = 1 AND b.GEOMETRIE = 'vlakken' ORDER BY a.ALT_TITEL");
			
	if ($sRecords <> "") {
		$aRecords = explode("|", $sRecords);
	}
	
	if (isset($aRecords)) {
		for ($iRecord = 0; $iRecord < count($aRecords) ; $iRecord++) {			
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sSoort  = $aRecord[3];			
			
			if ($sSoort == "vlakken") {
				$sWaarde = $aRecord[2];
				$sImscode = $aRecord[4];
				$sCopy = $aRecord[5];
				if ($sWaarde <> "") {
					if ($sImscode <> "") {
					$sImsid = explode(".", $sWaarde);
					fwrite($sFh, "<LAYER type=\"featureclass\" name=\"\" visible=\"false\" id=\"" . $sImsid[1] . "\">\n");
					fwrite($sFh, "<COORDSYS id=\"28992\"/>\n");
					fwrite($sFh, "<DATASET name=\"" . $sWaarde . "\" type=\"polygon\" workspace=\"GBI\"/>\n");
					fwrite($sFh, $sImscode . "\n");
					fwrite($sFh, "</LAYER>\n");
					}
					else {
					$sImsid = explode(".", $sWaarde);
					fwrite($sFh, "<LAYER type=\"featureclass\" name=\"\" visible=\"false\" id=\"" . $sImsid[1] . "\">\n");
					fwrite($sFh, "<COORDSYS id=\"28992\"/>\n");
					fwrite($sFh, "<DATASET name=\"" . $sWaarde . "\" type=\"polygon\" workspace=\"GBI\"/>\n");										
					fwrite($sFh, "<SIMPLERENDERER>\n");
					fwrite($sFh, "<SIMPLEPOLYGONSYMBOL boundarytransparency=\"1,0\" filltransparency=\"1,0\" filltype=\"gray\" fillcolor=\"0,0,153\" boundarycaptype=\"round\" boundarycolor=\"0,0,153\"/>\n");
					fwrite($sFh, "</SIMPLERENDERER>\n");
					fwrite($sFh, "</LAYER>\n");
					}
				}
				else {
					print($aRecord[1] . " heeft geen alternatieve titel, dataset niet toegevoegd.<BR>\n");
				}
			}
		}
	}
	
	$sRecords = F_SELECTRECORD("SELECT a.DATACODE, a.DATASET_TITEL, a.ALT_TITEL, b.GEOMETRIE, b.IMSCODE, a.COPYRIGHT FROM DATASET a, GEOGRAFISCH b WHERE a.DATACODE = b.DATACODE AND a.TYPE = 1 AND b.GEOMETRIE = 'lijnen' ORDER BY a.ALT_TITEL");
			
	if ($sRecords <> "") {
		$aRecords = explode("|", $sRecords);
	}
	
	if (isset($aRecords)) {
		for ($iRecord = 0; $iRecord < count($aRecords) ; $iRecord++) {			
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sSoort  = $aRecord[3];			
			
			if ($sSoort == "lijnen") {
				$sWaarde = $aRecord[2];
				$sImscode = $aRecord[4];
				$sCopy = $aRecord[5];
				if ($sWaarde <> "") {
					if ($sImscode <> "") {
					$sImsid = explode(".", $sWaarde);
					fwrite($sFh, "<LAYER type=\"featureclass\" name=\"\" visible=\"false\" id=\"" . $sImsid[1] . "\">\n");
					fwrite($sFh, "<COORDSYS id=\"28992\"/>\n");
					fwrite($sFh, "<DATASET name=\"" . $sWaarde . "\" type=\"line\" workspace=\"GBI\"/>\n");					
					fwrite($sFh, $sImscode . "\n");
					fwrite($sFh, "</LAYER>\n");	
					}
					else {
					$sImsid = explode(".", $sWaarde);
					fwrite($sFh, "<LAYER type=\"featureclass\" name=\"\" visible=\"false\" id=\"" . $sImsid[1] . "\">\n");
					fwrite($sFh, "<COORDSYS id=\"28992\"/>\n");
					fwrite($sFh, "<DATASET name=\"" . $sWaarde . "\" type=\"line\" workspace=\"GBI\"/>\n");					
					fwrite($sFh, "<SIMPLERENDERER>\n");
					fwrite($sFh, "<SIMPLEMARKERSYMBOL color=\"0,0,0\" width=\"10\" />\n");
					fwrite($sFh, "</SIMPLERENDERER>\n");
					fwrite($sFh, "</LAYER>\n");					
					}
				}
				else {
					print($aRecord[1] . " heeft geen alternatieve titel, dataset niet toegevoegd.<BR>\n");
				}
			}
		}
	}
	
	$sRecords = F_SELECTRECORD("SELECT a.DATACODE, a.DATASET_TITEL, a.ALT_TITEL, b.GEOMETRIE, b.IMSCODE, a.COPYRIGHT FROM DATASET a, GEOGRAFISCH b WHERE a.DATACODE = b.DATACODE AND a.TYPE = 1 AND b.GEOMETRIE = 'punten' ORDER BY a.ALT_TITEL");
			
	if ($sRecords <> "") {
		$aRecords = explode("|", $sRecords);
	}
	
	if (isset($aRecords)) {
		for ($iRecord = 0; $iRecord < count($aRecords) ; $iRecord++) {			
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sSoort  = $aRecord[3];			
			
			if ($sSoort == "punten") {
				$sWaarde = $aRecord[2];
				$sImscode = $aRecord[4];
				$sCopy = $aRecord[5];
				if ($sWaarde <> "") {
					if ($sImscode <> "") {
					$sImsid = explode(".", $sWaarde);
					fwrite($sFh, "<LAYER type=\"featureclass\" name=\"\" visible=\"false\" id=\"" . $sImsid[1] . "\">\n");
					fwrite($sFh, "<COORDSYS id=\"28992\"/>\n");
					fwrite($sFh, "<DATASET name=\"" . $sWaarde . "\" type=\"point\" workspace=\"GBI\"/>\n");
					fwrite($sFh, $sImscode . "\n");
					fwrite($sFh, "</LAYER>\n");	
					}
					else {
					$sImsid = explode(".", $sWaarde);
					fwrite($sFh, "<LAYER type=\"featureclass\" name=\"\" visible=\"false\" id=\"" . $sImsid[1] . "\">\n");
					fwrite($sFh, "<COORDSYS id=\"28992\"/>\n");
					fwrite($sFh, "<DATASET name=\"" . $sWaarde . "\" type=\"point\" workspace=\"GBI\"/>\n");
					fwrite($sFh, "<SIMPLERENDERER>\n");
					fwrite($sFh, "<SIMPLEMARKERSYMBOL antialiasing=\"false\" color=\"40,40,40\" overlap=\"true\" outline=\"0,0,0\" transparency=\"1\" type=\"circle\" usecentroid=\"true\" width=\"6\"/>\n");
					fwrite($sFh, "</SIMPLERENDERER>\n");
					fwrite($sFh, "</LAYER>\n");	
					}					
				}
				else {
					print($aRecord[1] . " heeft geen alternatieve titel, dataset niet toegevoegd.<BR>\n");
				}
			}			
		}
	}
		
	fwrite($sFh, "</MAP>\n");
	fwrite($sFh, "</CONFIG>\n");
	fwrite($sFh, "</ARCXML>\n");
	fclose($sFh);
	print("<BR>\n");
	print("XML bestand succesvol aangemaakt. Klik <A HREF=\"../metadata/GDB_Geoportaal_open.axl\" TARGET=\"_blank\"> hier</A> voor het bestand.\n");			
}

if ($sAction == "LEGENDOPENBAAR") {
	print("<div id=\"nav_path\">\n");
	print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > <a href=\"?e=@GBI&p=EXPORT\">Exporteren</a> > Exporteren AXL openbare gegevens </span>\n");
	print("</div>\n");
	print("<BR><BR><BR>\n");
	print("<CENTER>\n");	
		
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"600px\" ID=\"kopbegin\">\n");
	print("<CENTER>Exporteren AXL openbare gegevens</CENTER>\n");
	print("</TD></TR></TABLE></CENTER>\n");
	print("<BR>\n");	
		
	print("<CENTER>\n");
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD ALIGN=\"LEFT\" VALIGN=\"MIDDLE\" WIDTH=\"600px\">\n");

	$sRecords = F_SELECTRECORD("SELECT DATACODE, DATASET_TITEL, ALT_TITEL FROM DATASET WHERE TYPE = 1 AND VEILIGHEID = 'vrij toegankelijk' ORDER BY ALT_TITEL");
			
	if ($sRecords <> "") {
		$aRecords = explode("|", $sRecords);
	}
	
	if (isset($aRecords)) {
		$sFile = "../metadata/legend.xml";
		$sFh = fopen($sFile, 'w');
		fwrite($sFh, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
		fwrite($sFh, "<FLAMINGO xmlns:fmc=\"fmc\">\n");
		fwrite($sFh, "<fmc:Legend id=\"legend\" symbolpath=\"../gbitest/\" shadowsymbols=\"false\" top=\"10\" bottom=\"200\" right=\"180\" backgroundcolor=\"#FFFFFF\" listento=\"map\">\n");
		fwrite($sFh, "<group label=\"Datasets\" open=\"true\" hideallbuton=\"true\">\n");		
		for ($iRecord = 0; $iRecord < count($aRecords) ; $iRecord++) {			
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sDatacode  = $aRecord[0];
			$sTitel = $aRecord[1];
			$sAltTitel = $aRecord[2];
			if ($sAltTitel <> "") {
				fwrite($sFh, "<item label=\"\" canhide=\"false\" listento=\"geoportaal." . $sAltTitel . "\">\n");
				fwrite($sFh, "<symbol label=\"" . $sTitel . "\" />\n");
				fwrite($sFh, "</item>\n");
			}
			else {
				print($aRecord[1] . " heeft geen alternatieve titel, dataset niet toegevoegd.<BR>\n");
			}
		}
		fwrite($sFh, "</group>\n");
		fwrite($sFh, "</fmc:Legend>\n");
		fwrite($sFh, "</FLAMINGO>\n");	
		fclose($sFh);
		print("<BR>\n");
		print(count($aRecords) . " succesvol aan XML bestand toegevoegd. Klik <A HREF=\"../metadata/legend.xml\" TARGET=\"_blank\"> hier</A> voor het bestand.\n");		
	}
}

if ($sAction == "IDGENEREREN") {
	$sRecords = F_SELECTRECORD("SELECT a.ALT_TITEL FROM DATASET a WHERE a.TYPE = 1 ORDER BY a.ALT_TITEL");
			
	if ($sRecords <> "") {
		$aRecords = explode("|", $sRecords);
	}
	
	if (isset($aRecords)) {
		for ($iRecord = 0; $iRecord < count($aRecords) ; $iRecord++) {			
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sWaarde = $aRecord[0];
			if ($sWaarde <> "") {			
				$sImsid = explode(".", $sWaarde);
				print ($sImsid[1] . ",");
			}						
		}
	}
}

}
else {
	print("<BR>\n");
	print("U bent niet ingelogd. Klik <A HREF=\"?e=@GBIEXEC&p=MENU\"> hier</A> om u aan te melden.\n");	
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
}
print("<BR>\n");
print("<BR>\n");
F_ENDSTYLE();

}

function F_GBIEXEC($p) {
$tokens = explode("|", $p);
$sCommand = $tokens[0];

F_STYLE();

if ($sCommand == "LOGIN") {
	$sPW =  @$_POST["PW"];
	if ($sPW == "mooi") {
		$_SESSION["GBIMUTEREN"] = TRUE;
	}
	else {
		$_SESSION["GBIMUTEREN"] = FALSE;
	}	
	$sCommand = "MENU";
}

if ($sCommand == "LOGOUT") {
	$_SESSION["GBIMUTEREN"] = FALSE;
	$sCommand = "MENU";
}

if ($sCommand == "MENU") {	
	global $link;
	print("<BR><BR><BR>\n");
	print("<CENTER>\n");
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"600px\" CLASS=\"kopbegin\">\n");
	print("<CENTER><H4>GDB Metadata Editor</H4></CENTER>\n");
	print("</TD></TR></TABLE></CENTER>\n");
	print("<BR>\n");
	
	print("<CENTER>\n");
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD VALIGN=\"LEFT\" ALIGN=\"LEFT\" WIDTH=\"600px\">\n");
	if (@$_SESSION["GBIMUTEREN"] == TRUE) {
		print("<LI><A HREF='?e=@GBI&p=NEWDATASET'>Dataset aanmaken</A><BR><BR>\n");
		print("<LI><A HREF=\"?e=@GBI&p=DATASETLIST|DATASET.DATASET_TITEL\">Lijst van alle datasets</A><BR><BR>\n");
		print("<FORM NAME=FRMQUERY METHOD=POST ACTION=\"?e=@GBI&p=DATASETLIST\">\n");
		print("<LI>Zoeken naar&nbsp;&nbsp;<INPUT SIZE=30 TYPE=TEXT NAME='KEYWORDS'>\n");
		print("&nbsp;&nbsp;<input id=submit type=submit value=Zoek name=submit></input>\n");
		print("</FORM>\n");	
		print("<BR>\n");
		print("<BR>\n");
		print("<LI><A HREF='?e=@GBI&p=AFDRUK'>Afdrukopties</A><BR><BR>\n");
		print("<LI><A HREF='?e=@GBI&p=ADMIN'>Administratieve taken</A><BR><BR>\n");
		print("<LI><A HREF='?e=@GBI&p=EXPORT'>Exporteren Geo-Portaal</A><BR><BR>\n");		
	}
	
	if (!@$_SESSION["GBIMUTEREN"] == TRUE) {
       print("<FORM NAME=FRMQUERY METHOD=POST ACTION=\"?e=@GBIEXEC&p=LOGIN\">\n");
       print("<LI>Inloggen (muteren) <INPUT SIZE=12 TYPE=PASSWORD NAME='PW'>\n");
       print("&nbsp;&nbsp;<input id=submit type=submit value=Ok name=submit></input>\n");
       print("</FORM>\n");
	}
    else {
       print("<LI><A HREF=\"?e=@GBIEXEC&p=LOGOUT\">Uitloggen</A>\n");
    }	
	
	print("<BR><BR><I>Vragen of opmerkingen? Stuur een email naar <A HREF=mailto:r.debruin@drenthe.nl>r.debruin@drenthe.nl</A>.</I>\n");
	
	print $link;
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");	
	
	print("</TD></TR></TABLE>\n");
	print("</CENTER>\n");
	print("</DIV>\n");
	F_ENDSTYLE();
}

if ($sCommand == "UPDATEMORE") {
	$sTable = $tokens[1];
	$sField = $tokens[2];
	$sWhereOne = $tokens[3];
	$sWhereTwo = $tokens[4];
	$sValue = $tokens[5];	
	
	F_SELECTRECORD("UPDATE " . $sTable . " SET " . $sField . " = '" . $sValue . "' WHERE DATACODE= " . $sWhereOne . " AND ITEMNAAM = '" . $sWhereTwo . "'");
}

if ($sCommand == "UPDATE") {
	$sTable = $tokens[1];
	$sField = $tokens[2];
	$sWhere = $tokens[3];
	$sValue = $tokens[4];	
	F_SELECTRECORD("UPDATE " . $sTable . " SET " . $sField . " = '" . $sValue . "' WHERE " . $sWhere);
	//print ("<SCRIPT>");
	//print ("parent.document.location.reload();");
	//print ("</SCRIPT>");	
}

if ($sCommand == "DELETE") {
	$sTable = $tokens[1];
	$sWhere = $tokens[2];
	$sSQL = "DELETE FROM " . $sTable . " WHERE " . $sWhere;
    F_SELECTRECORD ($sSQL);
	//print ("<SCRIPT>");
	//print ("parent.document.location.reload();");
	//print ("</SCRIPT>");
}

if ($sCommand == "INSERT") {
	$sTable = $tokens[1];
	$sFieldName = $tokens[2];
	$sFieldValue = $tokens[3];  
	$sSQL = "INSERT INTO " . $sTable . "(" . $sFieldName . ") VALUES (" . $sFieldValue . ")";
    F_SELECTRECORD ($sSQL);
	//print ("<SCRIPT>");
	//print ("parent.document.location.reload();");
	//print ("</SCRIPT>");
}

if ($sCommand == "LINK") {
   $sTable = $tokens[1];
   $sField1 = $tokens[2];
   $sField2 = $tokens[3];
   $sValue1 = $tokens[4];
   $sValue2 = $tokens[5];  
   $sSQL = "INSERT INTO " . $sTable . "(" . $sField1 . "," . $sField2 . ") VALUES (" . $sValue1 . "," . $sValue2 . ")";
   F_SELECTRECORD ($sSQL);
   //print ("<SCRIPT>");
   //print ("parent.document.location.reload();");
   //print ("</SCRIPT>");
}

if ($sCommand == "INSERTITEM") {
	$sWaarde = $tokens[1];	
	$sVolgnr = F_SELECTRECORD("SELECT MAX(VOLGNR) FROM ITEMS WHERE DATACODE = " . $sWaarde);
	$sDomein = F_SELECTRECORD("SELECT MAX(CODE) FROM MEMOTABEL");
	$sVolgnr = $sVolgnr + 1;
	$sDomein = $sDomein + 1;
	$sSQL = "INSERT INTO ITEMS (DATACODE, VOLGNR, DOMEIN) VALUES ('" . $sWaarde . "', '" . $sVolgnr . "', '" . $sDomein . "')"; 
	F_SELECTRECORD ($sSQL);
	$sSQL = "INSERT INTO MEMOTABEL (CODE) VALUES ('" . $sDomein . "')";
	F_SELECTRECORD ($sSQL);
	print ("<SCRIPT>");
	print ("parent.document.location.reload();");
	//print ("parent.document.location.href = ();");
	print ("</SCRIPT>");
}

if ($sCommand == "DELETEITEM") {
	$sWaarde = $tokens[1];
	$sVolgnr = $tokens[2];
	$sSQL = "SELECT DOMEIN FROM ITEMS WHERE DATACODE = ". $sWaarde . " AND VOLGNR = " . $sVolgnr;
	$sDomein = F_SELECTRECORD($sSQL);
	$sSQL = "DELETE FROM ITEMS WHERE DATACODE = " . $sWaarde . " AND VOLGNR = " . $sVolgnr;
	F_SELECTRECORD ($sSQL);
	$sSQL = "DELETE FROM MEMOTABEL WHERE CODE = " . $sDomein;	
	print ("<SCRIPT>");
	print ("parent.document.location.reload();");
	print ("</SCRIPT>");
} 

}

function F_GBI($p) {
//global $DBCON;
global $db, $dsn;

$tokens = explode("|", $p);
$sAction = $tokens[0];

F_STYLE();

if (@$_SESSION["GBIMUTEREN"] == TRUE) {

if ($sAction == "CREATETREFWOORD") {
	$sFilterValueTref = @$_POST["NEWTREF"];
	if ($sFilterValueTref <> "" AND $sFilterValueTref <> NULL) {
		print("<div id=\"nav_path\">\n");
		print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > Toevoegen trefwoord </span>\n");
		print("</div>\n");
		print("<BR><BR><BR>\n");
		print("<CENTER>\n");	
		
		print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
		print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"600px\" ID=\"kopbegin\">\n");
		print("<CENTER>Toevoegen trefwoord</CENTER>\n");
		print("</TD></TR></TABLE></CENTER>\n");
		print("<BR>\n");	
		
		print("<CENTER>\n");
		print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
		print("<TR><TD ALIGN=\"LEFT\" VALIGN=\"MIDDLE\" WIDTH=\"600px\">\n");
		
		$sMax = F_SELECTRECORD("SELECT MAX(TREFCODE) FROM TREFTEXT");
		$sMax = $sMax + 1;
		F_CREATERECORD("INSERT INTO TREFTEXT (TREFCODE, TREFWOORD) VALUES ('" . $sMax . "', '" . $sFilterValueTref . "')");	
		
		print ("Trefwoord " . $sFilterValueTref . " met succes toegevoegd.<BR>");
		print ("<A HREF='?e=@GBI&p=ADMIN'>Terug naar administratieve taken</A>");	
		
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		
		print("</TD></TR></TABLE>\n");
		print("</CENTER>\n");			
	}
}

if ($sAction == "DELETEDATASET") {
	if (count($tokens) >= 2) {
		$sDatacode = $tokens[1];
	}
	print("<div id=\"nav_path\">\n");
	print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > Verwijderen dataset </span>\n");
	print("</div>\n");
	print("<BR><BR><BR>\n");
	print("<CENTER>\n");	
	
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"600px\" ID=\"kopbegin\">\n");
	print("<CENTER>Verwijderen dataset</CENTER>\n");
	print("</TD></TR></TABLE></CENTER>\n");
	print("<BR>\n");	
	
	print("<CENTER>\n");
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD ALIGN=\"LEFT\" VALIGN=\"MIDDLE\" WIDTH=\"600px\">\n");
	
	$sNaam = F_SELECTRECORD("SELECT DATASET_TITEL FROM DATASET WHERE DATACODE = " . $sDatacode);
	$sOmCode = F_SELECTRECORD("SELECT OMSCHRIJVING_CODE FROM DATASET WHERE DATACODE = " . $sDatacode);
	$sType = F_SELECTRECORD("SELECT TYPE FROM DATASET WHERE DATACODE = " . $sDatacode);
	F_DELETERECORD("DELETE FROM DATASET WHERE DATACODE = " . $sDatacode);
	
	if ($sType == 1) {
		F_DELETERECORD("DELETE FROM GEOGRAFISCH WHERE DATACODE = " . $sDatacode);		
	}
	
	F_DELETERECORD("DELETE FROM MEMOTABEL WHERE CODE = " . $sOmCode);
	
	if ($sType == 1) {
		$sSQL = "SELECT DOMEIN FROM ITEMS WHERE DATACODE = " . $sDatacode;
		unset($aRecords);
		$sRecords = F_SELECTRECORD($sSQL);
		$aRecords = explode("|", $sRecords);
		for ($iRecord = 0; $iRecord < count($aRecords); $iRecord++) {
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			F_DELETERECORD("DELETE FROM MEMOTABEL WHERE CODE = " . $aRecord[0]);					
			}	
		F_DELETERECORD("DELETE FROM ITEMS WHERE DATACODE = " . $sDatacode);
	}
	
	F_DELETERECORD("DELETE FROM TREFCODE WHERE DATACODE = " .  $sDatacode);
	
	
	print ("Dataset " . $sNaam . " met succes verwijderd.<BR>");
	print ("<A HREF='?e=@GBI&p=DATASETLIST|DATASET.DATASET_TITEL'>Terug naar lijst met datasets</A>");	
	
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	
	print("</TD></TR></TABLE>\n");
	print("</CENTER>\n");		
}

if ($sAction == "THUMBNAIL") {
	if (count($tokens) >= 2) {
		$sDatacode = $tokens[1];
	}
	print("<div id=\"nav_path\">\n");
	print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > Maken van thumbnail dataset </span>\n");
	print("</div>\n");
	print("<BR><BR><BR>\n");
	print("<CENTER>\n");	
	
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"600px\" ID=\"kopbegin\">\n");
	print("<CENTER>Maken van thumbnail dataset</CENTER>\n");
	print("</TD></TR></TABLE></CENTER>\n");
	print("<BR>\n");	
	
	print("<CENTER>\n");
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD ALIGN=\"LEFT\" VALIGN=\"MIDDLE\" WIDTH=\"600px\">\n");
	
	$sAlttitel = F_SELECTRECORD("SELECT ALT_TITEL FROM DATASET WHERE DATACODE = " . $sDatacode);
	$sImsid = explode(".", $sAlttitel);
	$sAlttitel = $sImsid[1];			
	
	$sarxml = new ArcService("paros", "GDB_Geoportaal");
	copy($sarxml->ImageLaag($sAlttitel),'../metadata/thumbs/' . $sAlttitel . '.jpg');		
	copy($sarxml->Legend($sAlttitel),'../metadata/legenda/' . $sAlttitel . '.jpg');	
	
	print ("Thumbnail van dataset " . $sAlttitel . " met succes aangemaakt.<BR>");
	print ("<A HREF='?e=@GBI&p=DATASETLIST|DATASET.DATASET_TITEL'>Terug naar lijst met datasets</A>");	
	
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	
	print("</TD></TR></TABLE>\n");
	print("</CENTER>\n");		
}

if ($sAction == "CREATEDATASET") {
	$sFilterValueNew = @$_POST["NEW"];
	$sFilterValueSNew = @$_POST["SNEW"];
	$sFilterValueCopy = @$_POST["COPY"];
	$sFilterValueNCopy = @$_POST["NCOPY"];
			
	if ($sFilterValueNew <> "" AND $sFilterValueNew <> NULL AND $sFilterValueSNew <> "" AND $sFilterValueSNew <> NULL ) {
		print("<div id=\"nav_path\">\n");
		print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > Dataset aanmaken </span>\n");
		print("</div>\n");
		print("<BR><BR><BR>\n");
		print("<CENTER>\n");	
		
		print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
		print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"600px\" ID=\"kopbegin\">\n");
		print("<CENTER>Dataset aanmaken</CENTER>\n");
		print("</TD></TR></TABLE></CENTER>\n");
		print("<BR>\n");	
		
		print("<CENTER>\n");
		print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
		print("<TR><TD ALIGN=\"LEFT\" VALIGN=\"MIDDLE\" WIDTH=\"600px\">\n");
		
		$sMax = F_SELECTRECORD("SELECT MAX(DATACODE) FROM DATASET");
		$sMax = $sMax + 1;
		$sMaxTekst = F_SELECTRECORD("SELECT MAX(CODE) FROM MEMOTABEL");
		$sMaxTekst = $sMaxTekst + 1;
		if ($sFilterValueSNew == "Dataset") {
			$sSoortType = 1;
		}
		elseif ($sFilterValueSNew == "CD/DVD") {
			$sSoortType = 2;
		}
		else {
			$sSoortType = 3;
		}
		
		//genereren van fileidentifier UUID (ISO nr. 207)
		$sha1  = UUID::generate(UUID::UUID_NAME_SHA1, UUID::FMT_STRING, $sFilterValueNew, 'www.drenthe.info');
		//generenen van bronidentifier UUID (ISO nr. 2)
		$sha2  = UUID::generate(UUID::UUID_NAME_SHA1, UUID::FMT_STRING, 'provincie drenthe', 'www.drenthe.info');
		
		F_CREATERECORD("INSERT INTO DATASET (DATACODE, DATASET_TITEL, OMSCHRIJVING_CODE, TYPE, TAAL, KARAKTERSET, METADATASTD, VERSIE_METASTD, CODE_REF, ORG_NAMESPACE, UUIDBRON, UUID) VALUES ('" . $sMax . "', '" . $sFilterValueNew . "', '" . $sMaxTekst .  "', '" . $sSoortType .  "', 'dut', 'utf8', 'ISO 19115', 'Nederlandse metadata profiel op ISO 19115 voor geografie 1.2', '28992', 'EPSG', '" . $sha2 . "', '" . $sha1 . "')");
				
		if ($sSoortType == 1) {
			F_CREATERECORD("INSERT INTO GEOGRAFISCH (DATACODE) VALUES ('" . $sMax . "')");
		}
		
		F_CREATERECORD("INSERT INTO MEMOTABEL (CODE) VALUES ('" . $sMaxTekst .  "')");
		
		$sMaxTekst = $sMaxTekst + 1;
		if ($sSoortType == 1) {
			F_CREATERECORD("INSERT INTO ITEMS (DATACODE, VOLGNR, DOMEIN) VALUES ('" . $sMax . "', '1', '" . $sMaxTekst . "')");
			F_CREATERECORD("INSERT INTO MEMOTABEL (CODE) VALUES ('" . $sMaxTekst .  "')");			
		}
		
		print ("Dataset " . $sFilterValueNew . " met succes aangemaakt.<BR>");
		print ("<A HREF='?e=@GBI&p=DATASETEDIT|" . $sMax . "'>Klik hier om de metagegevens van de dataset te bewerken</A>");	
				
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		
		print("</TD></TR></TABLE>\n");
		print("</CENTER>\n");		
	}

	if ($sFilterValueCopy <> "" AND $sFilterValueCopy <> NULL AND $sFilterValueNCopy <> "" AND $sFilterValueNCopy <> NULL ) {
		print("<div id=\"nav_path\">\n");
		print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > Dataset kopie&#235;ren </span>\n");
		print("</div>\n");
		print("<BR><BR><BR>\n");
		print("<CENTER>\n");	
		
		print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
		print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"600px\" ID=\"kopbegin\">\n");
		print("<CENTER>Dataset kopie&#235;ren</CENTER>\n");
		print("</TD></TR></TABLE></CENTER>\n");
		print("<BR>\n");	
		
		print("<CENTER>\n");
		print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
		print("<TR><TD ALIGN=\"LEFT\" VALIGN=\"MIDDLE\" WIDTH=\"600px\">\n");
		
		$sMax = F_SELECTRECORD("SELECT MAX(DATACODE) FROM DATASET");
		$sMax = $sMax + 1;
		$sMaxTekst = F_SELECTRECORD("SELECT MAX(CODE) FROM MEMOTABEL");
		$sMaxTekst = $sMaxTekst + 1;
		$sType = F_SELECTRECORD("SELECT TYPE FROM DATASET WHERE DATACODE = " . $sFilterValueCopy);
		
		if ($sType == 1 ) {
			$sSQL = "SELECT a.ORGANISATIECODE, a.ALT_TITEL, a.NAAM, a.FYSIEKE_LOCATIE, a.EIGENAAR, a.CONTACTPERSOON, a.METAPERSOON, a.GEOLOKET, a.BELEIDSVELD, a.TEAM, a.INVOERDATUM, a.GROUPCODE, a.EDITGROUP, a.BITMAP, a.RSCHEMA, a.DATATYPE, a.TYPE, a.GEBRUIKSBEPERKING, a.VEILIGHEID, a.COPYRIGHT, a.STATUS, a.CONTACT_LEVERANCIER, a.BRONDATUM, a.OPBOUWDATUM, a.ACTIE, a.BIJHOUDING, a.OPMERKING, a.THEMA, a.TAAL, a.KARAKTERSET, a.AANVUL_INFO, a.KWALITEIT_BESCH, a.JURIDISCH, a.METADATASTD, a.VERSIE_METASTD, a.CODE_REF, a.ORG_NAMESPACE, a.DEKKING_BEGIN, a.DEKKING_EIND, b.SCHAAL, b.BRONVERMELDING, b.OPBOUWMETHODE, b.DEELGEBIED, b.LEGENDA_FILE, b.GEOMETRIE, b.POS_NAUWKEURIGHEID, b.MINSCHAAL, b.MAXSCHAAL, b.STD_ITEM, c.TEKST FROM DATASET a, GEOGRAFISCH b, MEMOTABEL c WHERE a.OMSCHRIJVING_CODE = c.CODE AND a.DATACODE = b.DATACODE AND a.DATACODE = " . $sFilterValueCopy;
		
			unset($aRecords);
			$sRecords = F_SELECTRECORD($sSQL);
			
			if ($sRecords <> "") {
				$aRecords = explode("^", $sRecords);
				
				if ($aRecords[37] == "") {
					$aRecords[37] = '1980-1-1';
				}
				
				if ($aRecords[38] == "") {
					$aRecords[38] = '1980-1-1';
				}
				
				//genereren van fileidentifier UUID (ISO nr. 2)
				$sha1  = UUID::generate(UUID::UUID_NAME_SHA1, UUID::FMT_STRING, $sFilterValueNCopy, 'www.drenthe.info');
				//generenen van bronidentifier UUID (ISO nr. 2)
				$sha2  = UUID::generate(UUID::UUID_NAME_SHA1, UUID::FMT_STRING, 'provincie drenthe', 'www.drenthe.info');
				
				$sSQL = "INSERT INTO DATASET (DATACODE, ORGANISATIECODE, DATASET_TITEL, ALT_TITEL, OMSCHRIJVING_CODE, NAAM, FYSIEKE_LOCATIE, EIGENAAR, CONTACTPERSOON, METAPERSOON, GEOLOKET, BELEIDSVELD, TEAM, INVOERDATUM, GROUPCODE, EDITGROUP, BITMAP, RSCHEMA, DATATYPE, TYPE, GEBRUIKSBEPERKING, VEILIGHEID, COPYRIGHT, STATUS, CONTACT_LEVERANCIER, BRONDATUM, OPBOUWDATUM, ACTIE, BIJHOUDING, OPMERKING, THEMA, TAAL, KARAKTERSET, AANVUL_INFO, KWALITEIT_BESCH, JURIDISCH, METADATASTD, VERSIE_METASTD, CODE_REF, ORG_NAMESPACE, DEKKING_BEGIN, DEKKING_EIND, UUIDBRON, UUID) VALUES ('" . $sMax . "', '" . $aRecords[0] . "', '" . $sFilterValueNCopy . "', '" .  $aRecords[1] . "', '" . $sMaxTekst . "', '" . $aRecords[2] . "', '" . $aRecords[3] . "', '" . $aRecords[4] . "', '" . $aRecords[5] . "', '" . $aRecords[6] . "', '" .  $aRecords[7] . "', '" . $aRecords[8] . "', '" . $aRecords[9] . "', '" . $aRecords[10] . "', '" . $aRecords[11] . "', '" . $aRecords[12] . "', '" . $aRecords[13] . "', '" . $aRecords[14] . "', '" . $aRecords[15] . "', '" . $aRecords[16] . "', '" . $aRecords[17] .  "', '" . $aRecords[18] . "', '" . $aRecords[19] . "', '" . $aRecords[20] . "', '" . $aRecords[21] . "', '" . $aRecords[22] . "', '" .  $aRecords[23] . "', '" . $aRecords[24] . "', '" . $aRecords[25] . "', '" . $aRecords[26] . "', '" . $aRecords[27] . "', '" . $aRecords[28] . "', '" . $aRecords[29] . "', '" . $aRecords[30] . "', '" . $aRecords[31] . "', '" . $aRecords[32] . "', '" . $aRecords[33] . "', '" . $aRecords[34] . "', '" . $aRecords[35] . "', '" . $aRecords[36] . "', '" . $aRecords[37] . "', '" . $aRecords[38] . "', '" . $sha2 . "', '" . $sha1 . "')";
			
				F_CREATERECORD($sSQL);
				
				if ($aRecords[46] == "") {
					$aRecords[46] = 0;
				}
				
				if ($aRecords[47] == "") {
					$aRecords[47] = 0;
				}
				
				if ($aRecords[16] == "1") {
					$sSQL = "INSERT INTO GEOGRAFISCH (DATACODE, SCHAAL, BRONVERMELDING, OPBOUWMETHODE, DEELGEBIED, LEGENDA_FILE, GEOMETRIE, POS_NAUWKEURIGHEID, MINSCHAAL, MAXSCHAAL,  STD_ITEM) VALUES ('" . $sMax . "', '" . $aRecords[39] . "', '" . $aRecords[40] . "', '" . $aRecords[41] .  "', '" . $aRecords[42] .  "', '" . $aRecords[43] . "', '" . $aRecords[44] . "', '" . $aRecords[45] . "', '" . $aRecords[46] . "', '" . $aRecords[47] . "', '" . $aRecords[48] .  "')";
					F_CREATERECORD($sSQL);			
				}
				
				$sSQL = "INSERT INTO MEMOTABEL (CODE, TEKST) VALUES (" . $sMaxTekst . ", '" .  $aRecords[49] . "')";
				F_CREATERECORD($sSQL);
				
				if ($aRecords[16] == "1") {
					$sSQL = "SELECT VOLGNR, ITEMNAAM, ITEMDEFINITIE, EENHEID, DOMEIN, CDF_FILE FROM ITEMS WHERE DATACODE = " . $sFilterValueCopy . " ORDER BY VOLGNR";
					unset($bRecords);
					$sbRecords = F_SELECTRECORD($sSQL);
					$bRecords = explode("|", $sbRecords);
					
					for ($ibRecord = 0; $ibRecord < count($bRecords); $ibRecord++) {
						$sbRecord = $bRecords[$ibRecord];
						$bRecord = explode("^", $sbRecord);
						$sMaxTekst = $sMaxTekst + 1;
						
						$sSQL = "INSERT INTO ITEMS (DATACODE, VOLGNR, ITEMNAAM, ITEMDEFINITIE, EENHEID, DOMEIN, CDF_FILE) VALUES ('" . $sMax . "', '" . $bRecord[0] . "', '" . $bRecord[1] . "', '" . $bRecord[2] . "', '" . $bRecord[3] . "', '" . $sMaxTekst . "', '" . $bRecord[5] . "')";
						F_CREATERECORD($sSQL);
						
						F_CREATERECORD("INSERT INTO MEMOTABEL (CODE) VALUES ('" . $sMaxTekst .  "')");
					}			
				}
				
				if ($aRecords[16] == "1") {
					$sSQL = "SELECT TREFCODE FROM TREFCODE WHERE DATACODE = " . $sFilterValueCopy;
					unset($bRecords);
					$sbRecords = F_SELECTRECORD($sSQL);
					$bRecords = explode("|", $sbRecords);
					
					for ($ibRecord = 0; $ibRecord < count($bRecords); $ibRecord++) {
						$sbRecord = $bRecords[$ibRecord];
						$bRecord = explode("^", $sbRecord);
						
						$sSQL = "INSERT INTO TREFCODE (DATACODE, TREFCODE) VALUES (" . $sMax . ", " . $bRecord[0] . ")";
						F_CREATERECORD($sSQL);
					}				
				}			
			}
		}
		
		if ($sType == 2 OR $sType == 3) {
			$sSQL = "SELECT a.ORGANISATIECODE, a.ALT_TITEL, a.NAAM, a.FYSIEKE_LOCATIE, a.EIGENAAR, a.CONTACTPERSOON, a.METAPERSOON, a.GEOLOKET, a.BELEIDSVELD, a.TEAM, a.INVOERDATUM, a.GROUPCODE, a.EDITGROUP, a.BITMAP, a.RSCHEMA, a.DATATYPE, a.TYPE, a.GEBRUIKSBEPERKING, a.VEILIGHEID, a.COPYRIGHT, a.STATUS, a.CONTACT_LEVERANCIER, a.BRONDATUM, a.OPBOUWDATUM, a.ACTIE, a.BIJHOUDING, a.OPMERKING, a.THEMA, a.TAAL, a.KARAKTERSET, a.AANVUL_INFO, a.KWALITEIT_BESCH, a.JURIDISCH, a.METADATASTD, a.VERSIE_METASTD, a.CODE_REF, a.ORG_NAMESPACE, a.DEKKING_BEGIN, a.DEKKING_EIND, c.TEKST FROM DATASET a, MEMOTABEL c WHERE a.OMSCHRIJVING_CODE = c.CODE AND a.DATACODE = " . $sFilterValueCopy;
			
			unset($aRecords);
			$sRecords = F_SELECTRECORD($sSQL);
						
			if ($sRecords <> "") {
				$aRecords = explode("^", $sRecords);
				
				if ($aRecords[37] == "") {
					$aRecords[37] = '1980-1-1';
				}
				
				if ($aRecords[38] == "") {
					$aRecords[38] = '1980-1-1';
				}
				
				//genereren van fileidentifier UUID (ISO nr. 2)
				$sha1  = UUID::generate(UUID::UUID_NAME_SHA1, UUID::FMT_STRING, $sFilterValueNCopy, 'www.drenthe.info');
				//generenen van bronidentifier UUID (ISO nr. 2)
				$sha2  = UUID::generate(UUID::UUID_NAME_SHA1, UUID::FMT_STRING, 'provincie drenthe', 'www.drenthe.info');
				
				$sSQL = "INSERT INTO DATASET (DATACODE, ORGANISATIECODE, DATASET_TITEL, ALT_TITEL, OMSCHRIJVING_CODE, NAAM, FYSIEKE_LOCATIE, EIGENAAR, CONTACTPERSOON, METAPERSOON, GEOLOKET, BELEIDSVELD, TEAM, INVOERDATUM, GROUPCODE, EDITGROUP, BITMAP, RSCHEMA, DATATYPE, TYPE, GEBRUIKSBEPERKING, VEILIGHEID, COPYRIGHT, STATUS, CONTACT_LEVERANCIER, BRONDATUM, OPBOUWDATUM, ACTIE, BIJHOUDING, OPMERKING, THEMA, TAAL, KARAKTERSET, AANVUL_INFO, KWALITEIT_BESCH, JURIDISCH, METADATASTD, VERSIE_METASTD, CODE_REF, ORG_NAMESPACE, DEKKING_BEGIN, DEKKING_EIND, UUIDBRON, UUID) VALUES ('" . $sMax . "', '" . $aRecords[0] . "', '" . $sFilterValueNCopy . "', '" .  $aRecords[1] . "', '" . $sMaxTekst . "', '" . $aRecords[2] . "', '" . $aRecords[3] . "', '" . $aRecords[4] . "', '" . $aRecords[5] . "', '" . $aRecords[6] . "', '" .  $aRecords[7] . "', '" . $aRecords[8] . "', '" . $aRecords[9] . "', '" . $aRecords[10] . "', '" . $aRecords[11] . "', '" . $aRecords[12] . "', '" . $aRecords[13] . "', '" . $aRecords[14] . "', '" . $aRecords[15] . "', '" . $aRecords[16] . "', '" . $aRecords[17] .  "', '" . $aRecords[18] . "', '" . $aRecords[19] . "', '" . $aRecords[20] . "', '" . $aRecords[21] . "', '" . $aRecords[22] . "', '" .  $aRecords[23] . "', '" . $aRecords[24] . "', '" . $aRecords[25] . "', '" . $aRecords[26] . "', '" . $aRecords[27] . "', '" . $aRecords[28] . "', '" . $aRecords[29] . "', '" . $aRecords[30] . "', '" . $aRecords[31] . "', '" . $aRecords[32] . "', '" . $aRecords[33] . "', '" . $aRecords[34] . "', '" . $aRecords[35] . "', '" . $aRecords[36] . "', '" . $aRecords[37] . "', '" . $aRecords[38] . "', '" . $sha2 . "', '" . $sha1 ."')";
			
				F_CREATERECORD($sSQL);				
							
				$sSQL = "INSERT INTO MEMOTABEL (CODE, TEKST) VALUES ('" . $sMaxTekst . "', '" .  $aRecords[39] . "')";
							
				F_CREATERECORD($sSQL);								
			}	
		}
		print ("Dataset " . $sFilterValueNCopy . " met succes aangemaakt.<BR>");
		print ("<A HREF='?e=@GBI&p=DATASETEDIT|" . $sMax . "'>Klik hier om de metagegevens van de dataset te bewerken</A>");	
				
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		
		print("</TD></TR></TABLE>\n");
		print("</CENTER>\n");
	}
}	

if ($sAction == "DATASETLIST") {
	print("<div id=\"nav_path\">\n");
	print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > Lijst van alle datasets </span>\n");
	print("</div>\n");
	print("<BR>\n");
	print("<CENTER>\n");
	print("<TABLE WIDTH=\"90%\" CELLPADDING=\"5\" CELLSPACING=\"0\" CLASS=\"randtabel\">\n");
	print("<TR><TD ID=\"kopbegin\">Totaal overzicht datasets</TD></TR>\n");
	print("</TABLE>\n");
	print("</CENTER>\n");
	print("<BR>\n");
	                          
    $sOrder = "DATASET.DATASET_TITEL";
	if (count($tokens) >= 2) {
		$sOrder = $tokens[1];
	}
    
	//$sWhere = "DATASET.DATACODE >= 0";
	
	$sFilterValue = @$_POST["KEYWORDS"];
	
	if ($sFilterValue <> "" AND $sFilterValue <> NULL) {
		print("<CENTER>\n");
		print("Gevonden datasets die voldoen aan uw zoekopdracht: <B>" . $sFilterValue . "</B>.<BR><BR>\n");
		print("</CENTER>\n");
		
		$sWhere = "DATASET.DATASET_TITEL LIKE '%" . $sFilterValue . "%' OR MEMOTABEL.TEKST Like '%" . $sFilterValue . "%' OR TREFTEXT.TREFWOORD LIKE '%" . $sFilterValue . "%'\n";
		$sSQL = "SELECT DISTINCT DATASET.DATACODE, DATASET.DATASET_TITEL FROM ((DATASET INNER JOIN MEMOTABEL ON DATASET.OMSCHRIJVING_CODE = MEMOTABEL.CODE) INNER JOIN TREFCODE ON DATASET.DATACODE = TREFCODE.DATACODE) INNER JOIN TREFTEXT 
	ON TREFCODE.TREFCODE = TREFTEXT.TREFCODE 
	WHERE " . $sWhere . " ORDER BY " . $sOrder;
		//$sWhere = "instr(DATASET.DATASET_TITEL, '" . $sFilterValue . "') OR instr(MEMOTABEL.TEKST, '" . $sFilterValue . "')\n";
	} 
	else {
	    $sSQL = "SELECT DISTINCT DATASET.DATACODE, DATASET.DATASET_TITEL FROM DATASET ORDER BY " . $sOrder;
	} 
	
	
	//$sSQL = "SELECT DISTINCT DATASET.DATACODE, DATASET.DATASET_TITEL, DATASET.EIGENAAR FROM DATASET, TREFCODE, TREFTEXT, MEMOTABEL WHERE TREFCODE.DATACODE = DATASET.DATACODE AND TREFCODE.TREFCODE = TREFTEXT.TREFCODE AND DATASET.DATACODE = MEMOTABEL.CODE AND " . $sWhere . " ORDER BY " . $sOrder;
	//$sSQL = "SELECT DISTINCT DATASET.DATACODE, DATASET.DATASET_TITEL FROM DATASET WHERE " . $sWhere . " ORDER BY " . $sOrder;
	
	//$sSQL = "SELECT DISTINCT DATASET.DATACODE, DATASET.DATASET_TITEL FROM ((DATASET INNER JOIN MEMOTABEL ON DATASET.OMSCHRIJVING_CODE = MEMOTABEL.CODE) INNER JOIN TREFCODE ON DATASET.DATACODE = TREFCODE.DATACODE) INNER JOIN TREFTEXT ON TREFCODE.TREFCODE = TREFTEXT.TREFCODE WHERE " . $sWhere . " ORDER BY " . $sOrder;
		
	//$sSQL = "SELECT DISTINCT DATASET.DATACODE, DATASET.DATASET_TITEL FROM DATASET INNER JOIN MEMOTABEL ON DATASET.OMSCHRIJVING_CODE = MEMOTABEL.CODE WHERE " . $sWhere . " ORDER BY " . $sOrder;
		
	//$sSQL = "SELECT DISTINCT DATASET.DATACODE, DATASET.DATASET_TITEL, DATASET.EIGENAAR FROM ((TREFCODE INNER JOIN DATASET ON TREFCODE.DATACODE = DATASET.DATACODE) INNER JOIN TREFTEXT ON TREFCODE.TREFCODE = TREFTEXT.TREFCODE) INNER JOIN MEMOTABEL ON DATASET.DATACODE = MEMOTABEL.CODE WHERE " . $sWhere . " ORDER BY " . $sOrder;
		
	$sRecords = F_SELECTRECORD($sSQL);

	$aRecords = explode("|", $sRecords);	
	
	print("<CENTER>\n");
	print("<TABLE WIDTH=\"90%\" CELLPADDING=\"5\" CELLSPACING=\"0\" ID=\"randtabel\">\n");
	print("<TR><TD WIDTH=\"10%\" ID=\"randkop\"><A HREF='?e=@GBI&p=DATASETLIST|DATASET.DATACODE'>Datacode</A></TD><TD WIDTH=\"85%\" ID=\"randkop\"><A HREF='?e=@GBI&p=DATASETLIST|DATASET.DATASET_TITEL'>Titel dataset</A></TD><TD WIDTH=\"2%\" ID=\"randkop\"></TD><TD WIDTH=\"2%\" ID=\"randkop\"></TD></TR>\n");

	for ($iRecord = 0; $iRecord < count($aRecords); $iRecord++) {
		$sRecord = $aRecords[$iRecord];
		$aRecord = explode("^", $sRecord);
        print("<TR>\n");
        
		for ($iField = 0; $iField < count($aRecord); $iField++) {
			$sValue = $aRecord[$iField];
			if ($sValue == "") {
				$sValue = "-";
			}        
			if ($iField == 0) {
				print("<TD VALIGN=top ID=\"rand\"><A HREF='?e=@GBI&p=DATASETEDIT|" . $sValue . "'>" . $sValue . "</A></TD>\n");
				$sDC = $sValue;
			}
			else {
				print("<TD VALIGN=top ID=\"rand\">" . $sValue . "</TD>\n");
			}			
		}
	print("<TD VALIGN=top ID=\"rand\"><A HREF='?e=@GBI&p=DELETEDATASET" . "|" . $sDC . "'>");
	print("<IMG SRC='images\wissen1.png' ALT='Verwijderen dataset' BORDER=0 HEIGHT=20 WIDTH=20></A></TD>\n");
	print("<TD VALIGN=top ID=\"rand\"><A HREF='?e=@GBI&p=THUMBNAIL" . "|" . $sDC . "'>");
	print("<IMG SRC='images\globe.png' ALT='Maak een thumbnail' BORDER=0 HEIGHT=20 WIDTH=20></A></TD>\n");
	print("</TR>\n");
	}
	print("</TABLE>\n");
	print("</CENTER>\n");
	print("</BODY>\n");
}

if ($sAction == "DATASETEDIT") {
	//$sDatacode = "-1";
	if (count($tokens) >= 2) {
		$sDatacode = $tokens[1];
		$sType = F_SELECTRECORD("SELECT TYPE FROM DATASET WHERE DATACODE = " . $sDatacode);
	}
	
	$sFilterValueIms = @$_POST["txtIMSCODE"];
	if ($sFilterValueIms <> NULL) {
		F_SELECTRECORD("UPDATE GEOGRAFISCH SET IMSCODE = '" . $sFilterValueIms . "' WHERE DATACODE = " . $sDatacode);
	}
	
	if (@$_SESSION["GBIMUTEREN"] == TRUE) {
		if (count($tokens) > 3) {
			$_SESSION["GBIPRO"] = $tokens[2];
		}
		else {
			$_SESSION["GBIPRO"] = "";
		}
	}
    else {
		$_SESSION["GBIPRO"] = "RO";
	}
		
	print("<IFRAME ID='WAITFRAME' NAME='WAITFRAME' style='z-index:100; position: absolute; width=300px; height: 100px; top:40%; left:40%;' src='' frameBorder='0' scrolling='no' onload=\"initPopup();\"></IFRAME>\n");
	print("<BR>\n");
	
	print("<div id=\"nav_path\">\n");
	print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > <a href=\"index.php?e=@GBI&p=DATASETLIST|DATASET.DATASET_TITEL\"> Lijst van alle datasets </a> </span>\n");
	print("</div>\n");	
			
	print("<BR>\n");
	
	print("<CENTER>\n");
	print("<TABLE WIDTH=\"95%\" CELLPADDING=\"5\" CELLSPACING=\"0\" CLASS=\"randtabel\">\n");
	$naam = F_SELECTRECORD("SELECT DATASET_TITEL FROM DATASET WHERE DATACODE = " . $sDatacode);
	print("<TR><TD ID=\"kopbegin\">Gegevens dataset $naam</TD></TR>\n");
	print("</TABLE>\n");
	print("</CENTER>\n");
	print("<BR>\n");
	
	print("<CENTER>\n");
	print("<TABLE WIDTH=\"95%\" CELLPADDING=\"5\" CELLSPACING=\"0\" CLASS=\"randtabel\">\n");
	
	print("<TR><TD WIDTH=\"59%\"></TD><TD VALIGN=\"RIGHT\" WIDTH=\"12%\" ID=\"randkaartvol\"><A HREF='?e=@EXPORT&p=PDFDATASET|" . $sDatacode . "'> Exporteer PDF</A></TD><TD VALIGN=\"RIGHT\" WIDTH=\"12%\" ID=\"randkaartvol\"><A HREF='?e=@EXPORT&p=XMLDATASET|" . $sDatacode . "'>Exporteer XML</A></TD><TD VALIGN=\"RIGHT\" WIDTH=\"12%\" ID=\"randkaartvol\"><A HREF='?e=@EXPORT&p=PDFITEMSDATASET|" . $sDatacode . "'> Exporteer Items PDF</A></TD></TR>\n");
	print("</TABLE>\n");
	print("</CENTER>\n");
			
	print("<CENTER>\n");
	print("<TABLE WIDTH=95% cellpadding=5 CELLSPACING=\"3\" ID=\"randtabel2\">\n");
	print("<TR><TD COLSPAN=\"2\" ID=\"randeditkop\">Algemeen:</TD></TR>\n");
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Naam van de dataset, CD/DVD of Kaartservice', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\" >Titel dataset</TD><TD ID=\"randedit\">\n");
	print(F_GBITEXTBOX("DATASET" . "|" . "DATASET_TITEL" . "|" . "DATACODE=" . $sDatacode . "|90%"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Vertaling van de dataset titel in een andere taal of een aanvulling op de dataset titel (ondertitel). Wordt binnen de provincie gebruikt als dataset naam in de ruimtelijke dataset. Zie woordenlijst voor de naamgeving', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\" >Alternatieve titel</TD><TD ID=\"randedit\">\n");
	print(F_GBITEXTBOX("DATASET" . "|" . "ALT_TITEL" . "|" . "DATACODE=" . $sDatacode . "|90%"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Korte beschrijving van de inhoud van de dataset, CD/DVD of Kaartservice, CD/DVD of Kaartservice', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Omschrijving dataset</TD><TD ID=\"randedit\">\n");
	$sCode = F_SELECTRECORD("SELECT OMSCHRIJVING_CODE FROM DATASET WHERE DATACODE = " . $sDatacode);
	print(F_GBIMEMOBOX("MEMOTABEL" . "|" . "TEKST" . "|" . "CODE=" . $sCode));
    
	print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Algemene beschrijving of opmerking, betreffend de geschiedenis van een item in zoverre deze niet te plaatsen zijn in de overige kwaliteitsvelden. Dit kunnen ook beschrijvingen of opmerkingen zijn over de brongegevens en/of het productieproces.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\" >Algemene opmerking</TD><TD ID=\"randedit\">\n");
	print(F_GBIMEMOBOX("DATASET" . "|" . "OPMERKING" . "|" . "DATACODE=" . $sDatacode));
	print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Referentie datum van de dataset.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Referentie datum</TD><TD ID=\"randedit\">\n");
	print(F_GBITEXTDATEBOX("DATASET" . "|" . "BRONDATUM" . "|" . "DATACODE=" . $sDatacode . "|90%"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('De datum waar de laatste gebeurtenis betrekking op heeft.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Wijzigingsdatum</TD><TD ID=\"randedit\">\n");
	print(F_GBITEXTDATEBOX("DATASET" . "|" . "OPBOUWDATUM" . "|" . "DATACODE=" . $sDatacode . "|90%"));
    print("</TD></TR>\n");
	
	if ($sType == 1) {
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Dit veld kan gebruikt worden om een algemene beschrijving of opmerking te geven betreft de kwaliteit van de (verschillende) brongegevens.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Bronvermelding</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBIMEMOBOX("GEOGRAFISCH" . "|" . "BRONVERMELDING" . "|" . "DATACODE=" . $sDatacode ));
    print("</TD></TR>\n");	
	}
		
	if ($sType == 1) {
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Methode die gebruikt is om de brongegevens in te winnen.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Opbouwmethode</TD><TD ID=\"randedit\">\n");
	print(F_GBILISTBOXTYPE("GEOGRAFISCH" . "|" . "OPBOUWMETHODE" . "|" . "DATACODE=" . $sDatacode . "|" . "OPBOUWMETHODE"));
    print("</TD></TR>\n");
	}
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Gebeurtenis waar de wijzigingsdatum betrekking op heeft.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Gebeurtenis</TD><TD ID=\"randedit\">\n");
	print(F_GBILISTBOXTYPE("DATASET" . "|" . "ACTIE" . "|" . "DATACODE=" . $sDatacode . "|" . "ACTIE"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Status van de dataset.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Status</TD><TD ID=\"randedit\">\n");
	print(F_GBILISTBOXTYPE("DATASET" . "|" . "STATUS" . "|" . "DATACODE=" . $sDatacode . "|" . "STATUS"));
    print("</TD></TR>\n");
	print("</TABLE>\n");
	
	print("<TABLE WIDTH=95% cellpadding=5 ID=\"randtabel3\">\n");
	print("<TR><TD WIDTH=\"25%\" COLSPAN=\"2\"><BR></TD></TR>\n");
	print("</TABLE>\n");
	
	print("<TABLE WIDTH=95% cellpadding=5 CELLSPACING=\"3\" ID=\"randtabel2\">\n");
	print("<TR><TD COLSPAN=\"2\" ID=\"randeditkop\">Inhoud:</TD></TR>\n");
		
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Naam van de verantwoordelijke organisatie of persoon die inhoudelijk verantwoordelijk is voor deze dataset, CD/DVD of kaartservice.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Contactpersoon inhoud</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBILISTBOX("DATASET" . "|" . "CONTACTPERSOON" . "|" . "DATACODE=" . $sDatacode . "|" . "CONTACT"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Beleidsterrein waar de dataset, CD/DVD of kaartservice betrekking op heeft.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Beleidsterrein</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBILISTBOXTYPE("DATASET" . "|" . "BELEIDSVELD" . "|" . "DATACODE=" . $sDatacode . "|" . "BELEIDSTERREIN"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Naam van het verantwoordelijke team van de dataset, CD/DVD of kaartservice.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Team</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBILISTBOXTYPE("DATASET" . "|" . "TEAM" . "|" . "DATACODE=" . $sDatacode . "|" . "TEAM"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Hoofdthema van de dataset, CD/DVD of kaartservice.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Thema</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBILISTBOXTYPE("DATASET" . "|" . "THEMA" . "|" . "DATACODE=" . $sDatacode . "|" . "THEMA"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Toepassingen waarvoor de data niet geschikt is. Bijvoorbeeld: \'Niet te gebruiken voor navigatie.\' of \'Dataset niet gebruiken bij een schaal groter dan 1:50.000.\'', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Gebruiksbeperking</TD><TD ID=\"randedit\">\n");
	print(F_GBITEXTBOX("DATASET" . "|" . "GEBRUIKSBEPERKING" . "|" . "DATACODE=" . $sDatacode . "|90%"));
    print("</TD></TR>\n");	
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Beperkingen die op een dataset, CD/DVD of kaartservice zijn opgelegd.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Veligheidsrestricties</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBILISTBOXTYPE("DATASET" . "|" . "VEILIGHEID" . "|" . "DATACODE=" . $sDatacode . "|" . "BEPERKING"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Toegangseisen die er zorg voor dragen dat privacy of intellectueel eigendom gewaarborgd zijn en elke andere speciale beperkingen voor het verkrijgen van de metadata of data.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Toegangsrestricties</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBILISTBOXTYPE("DATASET" . "|" . "JURIDISCH" . "|" . "DATACODE=" . $sDatacode . "|" . "JURIDISCH"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Persoon of organisatie die eigenaar is van de dataset.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Copyright</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBITEXTBOX("DATASET" . "|" . "COPYRIGHT" . "|" . "DATACODE=" . $sDatacode . "|90%"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Frequentie waarmee de data herzien wordt.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Herzienings frequentie</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBILISTBOXTYPE("DATASET" . "|" . "BIJHOUDING" . "|" . "DATACODE=" . $sDatacode . "|" . "HERZIENING"));
    print("</TD></TR>\n");
	
	if ($sType == 1) {
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('De beoogde schaal waarop het bestand waarheidsgetrouw gebruikt mag worden. Dit moet een positief numeriek getal zijn.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Toepassingsschaal</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBILISTBOXTYPE("GEOGRAFISCH" . "|" . "SCHAAL" . "|" . "DATACODE=" . $sDatacode . "|" . "SCHAAL"));
    print("</TD></TR>\n");
	}
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Als de dataset, CD/DVD of kaartservice door een leverancier wordt geleverd, kunnen hier de gegevens van de desbetreffende  leverancier worden ingevuld.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Contact leverancier</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBIMEMOBOX("DATASET" . "|" . "CONTACT_LEVERANCIER" . "|" . "DATACODE=" . $sDatacode));
	print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Inhoudelijke geldigheid van de data, gespecificeerd naar begin- en eindatum.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Temporele dekking (begin)</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBITEXTDATEBOX("DATASET" . "|" . "DEKKING_BEGIN" . "|" . "DATACODE=" . $sDatacode . "|90%"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Inhoudelijke geldigheid van de data, gespecificeerd naar begin- en eindatum.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Temporele dekking (eind)</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBITEXTDATEBOX("DATASET" . "|" . "DEKKING_EIND" . "|" . "DATACODE=" . $sDatacode . "|90%"));
    print("</TD></TR>\n");	
		
	print("</TABLE>\n");
		
	print("<TABLE WIDTH=95% cellpadding=5 ID=\"randtabel3\">\n");
	print("<TR><TD WIDTH=\"25%\" COLSPAN=\"2\"><BR></TD></TR>\n");
	print("</TABLE>\n");
	
	print("<TABLE WIDTH=95% cellpadding=5 CELLSPACING=\"3\" ID=\"randtabel2\">\n");
	print("<TR><TD COLSPAN=\"2\" ID=\"randeditkop\">Specifiek:</TD></TR>\n");
	
	if ($sType == 1) {
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Gebied waarbinnen de dataset valt.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Geografisch gebied</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBILISTBOXTYPE("GEOGRAFISCH" . "|" . "DEELGEBIED" . "|" . "DATACODE=" . $sDatacode . "|" . "GEBIED"));
    print("</TD></TR>\n");
	}
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Methode die gebruikt wordt om de geografische informatie ruimtelijk te representeren.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Ruimtelijk schema</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBILISTBOXTYPE("DATASET" . "|" . "RSCHEMA" . "|" . "DATACODE=" . $sDatacode . "|" . "RSCHEMA"));
    print("</TD></TR>\n");	
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Aanvullende informatie over de data, bijvoorbeeld documentatie of handleiding.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Aanvullende informatie</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBITEXTBOX("DATASET" . "|" . "AANVUL_INFO" . "|" . "DATACODE=" . $sDatacode . "|90%"));
    print("</TD></TR>\n");	
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('De naam van de ArcGIS layerfile zoals deze voor de dataset is aangemaakt.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Bestandsnaam</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBITEXTBOX("DATASET" . "|" . "NAAM" . "|" . "DATACODE=" . $sDatacode . "|90%"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Map op de E: schijf waar het ArcGIS layerbestand is opgeslagen.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Fysieke locatie</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBITEXTBOX("DATASET" . "|" . "FYSIEKE_LOCATIE" . "|" . "DATACODE=" . $sDatacode . "|90%"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Het datatype van de dataset, zoals: gdb polygon feature class, gdb line feature class, etc..', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Datatype</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBILISTBOXTYPE("DATASET" . "|" . "DATATYPE" . "|" . "DATACODE=" . $sDatacode . "|" . "DATATYPE"));
    print("</TD></TR>\n");
	
	if ($sType == 1) {
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Soort van geometrie van de dataset, zoals vlakken, lijnen, punten, etc..', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Geometrie</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBITEXTBOX("GEOGRAFISCH" . "|" . "GEOMETRIE" . "|" . "DATACODE=" . $sDatacode . "|90%"));
    print("</TD></TR>\n");
	}
	
	if ($sType == 1) {
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Nauwkeurigheid waarmee de dataset is opgebouwd, dit kan zijn topografisch bij gebruik van topografische ondergrond.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Nauwkeurigheid</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBITEXTBOX("GEOGRAFISCH" . "|" . "POS_NAUWKEURIGHEID" . "|" . "DATACODE=" . $sDatacode . "|90%"));
    print("</TD></TR>\n");
	}
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Niveau (dataset, serie of service) waar de kwaliteitsbeschrijving betrekking op heeft.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Hi&#235;rarchieniveau:</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBILISTBOXTYPE("DATASET" . "|" . "KWALITEIT_BESCH" . "|" . "DATACODE=" . $sDatacode . "|" . "SCOPECODE"));
    print("</TD></TR>\n");

	print("<FORM NAME=FRMLEG METHOD=POST ACTION=\"?e=@GBI&p=DATASETEDIT|" . $sDatacode . "\">\n");
		
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('ArcIMS opmaakcode voor de dataset legenda.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Legenda Kaartviewer</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBIMEMOIMS("GEOGRAFISCH" . "|" . "IMSCODE" . "|" . "DATACODE=" . $sDatacode));
	print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\"></TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print("<input id=submit1 type=submit value='Legenda opslaan' name=submit1></input>\n");
	print("</TD></TR>\n");
	print("</FORM><BR>\n");	
	
	
	if ($sType == 1) {
	$sGebied = F_SELECTRECORD("SELECT DEELGEBIED FROM GEOGRAFISCH WHERE DATACODE = " . $sDatacode);
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\">Minimale x-co&#246;rdinaat:</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBITEXTBOXVAST("GEBIED" . "|" . "MIN_X" . "|" . "GEBIED= '" . $sGebied . "'"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\">Maximale x-co&#246;rdinaat:</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBITEXTBOXVAST("GEBIED" . "|" . "MAX_X" . "|" . "GEBIED= '" . $sGebied . "'"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\">Minimale y-co&#246;rdinaat:</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBITEXTBOXVAST("GEBIED" . "|" . "MIN_Y" . "|" . "GEBIED= '" . $sGebied . "'"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\">Maximale y-co&#246;rdinaat:</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBITEXTBOXVAST("GEBIED" . "|" . "MAX_Y" . "|" . "GEBIED= '" . $sGebied . "'"));
    print("</TD></TR>\n");	
	}
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('In het algemeen gebruikte woorden om een onderwerp te beschrijven.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Trefwoorden</TD><TD ALIGN=\"LEFT\">\n");
	print("<TABLE cellpadding=\"10\" width=\"100%\">\n");
	
	if (@$_SESSION["GBIPRO"] == "") {
		print("<TR><TD VALIGN=top>Gekoppeld</TD><TD VALIGN=top>Niet gekoppeld</TD></TR>\n");
	}
	else {
		print("<TR><TD VALIGN=top></TD><TD VALIGN=top></TD></TR>\n");
	}
	
	print("<TR><TD ID=\"randedit\" VALIGN=top>\n");
	$sTrefwoorden = F_SELECTRECORD("SELECT TREFTEXT.TREFCODE, TREFTEXT.TREFWOORD FROM TREFCODE INNER JOIN TREFTEXT ON TREFCODE.TREFCODE = TREFTEXT.TREFCODE WHERE TREFCODE.DATACODE=" . $sDatacode . " ORDER BY TREFTEXT.TREFWOORD");
	$aRecords = explode("|", $sTrefwoorden);
	if (@$_SESSION["GBIPRO"] == "") {
		print("<SELECT STYLE=" . "\"" . "{width: 300px}" . "\"" . " NAME=" . "PVVPS1" . " SIZE=5 ONKEYUP=" . "\"" . "if(event.keyCode==13 && this.selectedIndex >=0)  { execserver('?e=@GBIEXEC&p=DELETE" . "|" . "TREFCODE" . "|" . "TREFCODE=' + this.value + ' AND DATACODE=" .  $sDatacode . "'); var optObj = document.createElement('option'); optObj.text=this(selectedIndex).text; optObj.value=this(selectedIndex).value; PVVPS2.options.add(optObj); this.remove(this.selectedIndex);  } " . "\"" . ">\n");
	}
    
	for ($iRecord = 0; $iRecord < count($aRecords); $iRecord++) {
		$sRecord = $aRecords[$iRecord];
		$aRecord = explode("^", $sRecord);
		if (@$_SESSION["GBIPRO"] == "") {
			print( "<OPTION VALUE=" . "\"" . $aRecord[0] . "\"" . ">" . $aRecord[1] . "</OPTION>\n");
		}
		else {
			print($aRecord[1] . "<BR>\n");
		}
	}

	print("</SELECT>\n");
	     
	print("</TD><TD ID=\"randedit\" VALIGN=top>\n");
                 
	$sTrefwoorden = F_SELECTRECORD("SELECT TREFTEXT.TREFCODE, TREFTEXT.TREFWOORD FROM TREFTEXT ORDER BY TREFTEXT.TREFWOORD");

	$aRecords = explode("|", $sTrefwoorden);
	if (@$_SESSION["GBIPRO"] == "") {
		print("<SELECT STYLE=" . "\"" . "{width: 300px}" . "\"" . " NAME=" . "PVVPS2" . " SIZE=5 ONKEYUP=" . "\"" . "if(event.keyCode==13 && this.selectedIndex >=0)  { execserver('?e=@GBIEXEC&p=LINK" . "|" . "TREFCODE" . "|" . "TREFCODE" . "|" . "DATACODE" . "|" . "' + this.value + '" . "|" . $sDatacode . "'); var optObj = document.createElement('option'); optObj.text=this(selectedIndex).text; optObj.value=this(selectedIndex).value; PVVPS1.options.add(optObj); this.remove(this.selectedIndex);  } " . "\"" . ">\n");	
	}
	
	for ($iRecord = 0; $iRecord < count($aRecords); $iRecord++) {
		$sRecord = $aRecords[$iRecord];
		$aRecord = explode("^", $sRecord); 
		if (@$_SESSION["GBIPRO"] == "") {
			print( "<OPTION VALUE=" . "\"" . $aRecord[0] . "\"" . ">" . $aRecord[1] . "</OPTION>\n");
		}
	}                     
     
	if (@$_SESSION["GBIPRO"] == "") {
		print("</SELECT>\n");
	}
    print("</TD></TR></TABLE>\n");
    print("</TD></TR>\n");
	print("</TABLE>\n");
	
	if ($sType == 1) {
	print("<TABLE WIDTH=95% cellpadding=5 ID=\"randtabel3\">\n");
	print("<TR><TD WIDTH=\"25%\" COLSPAN=\"2\"><BR></TD></TR>\n");
	print("</TABLE>\n");
	
	print("<TABLE WIDTH=95% cellpadding=5 CELLSPACING=\"3\" ID=\"randtabel2\">\n");
	print("<TR><TD COLSPAN=\"2\" ID=\"randeditkop\">Items:</TD></TR>\n");	
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Standaarditem van de dataset.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Standaarditem</TD><TD ID=\"randedit\" ALIGN=\"LEFT\">\n");
	print(F_GBITEXTBOX("GEOGRAFISCH" . "|" . "STD_ITEM" . "|" . "DATACODE=" . $sDatacode . "|90%"));
    print("</TD></TR>\n");
	
	$sItem = F_SELECTRECORD( "SELECT STD_ITEM FROM GEOGRAFISCH WHERE DATACODE = "  . $sDatacode);
	$sCode = F_SELECTRECORD( "SELECT ITEMDEFINITIE FROM ITEMS WHERE ITEMS.DATACODE = " . $sDatacode . " AND ITEMS.ITEMNAAM = '" . $sItem . "'");
	
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('De items van een dataset, gebruik het plusje of kruisje voor het toevoegen of verwijderen van een item.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Items</TD><TD>\n");
	$sRecords = F_SELECTRECORD("SELECT a.VOLGNR, a.ITEMNAAM, a.ITEMDEFINITIE, a.EENHEID, b.TEKST FROM ITEMS a, MEMOTABEL b WHERE a.DOMEIN = b.CODE AND DATACODE =" . $sDatacode . " ORDER BY VOLGNR");
	//$sRecords = F_SELECTRECORD("SELECT VOLGNR, ITEMNAAM, ITEMDEFINITIE FROM ITEMS WHERE DATACODE=" . $sDatacode . " ORDER BY VOLGNR");
    
	unset($aRecords);
	if ($sRecords <> "") {
		$aRecords = explode("|", $sRecords);
	}
	
	print("<TABLE WIDTH=100% CELLSPACING=\"2\">\n");
	print("<TR><TD WIDTH=\"5%\" ALIGN=\"LEFT\" ID=\"randedit\">Nr</TD><TD WIDTH=\"15%\" ALIGN=\"LEFT\" ID=\"randedit\" onmouseover=\"Tip('Naam van een item.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Itemnaam</TD><TD WIDTH=\"20%\" ALIGN=\"LEFT\" ID=\"randedit\" onmouseover=\"Tip('Definitie van een item.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Itemdefinitie</TD><TD WIDTH=\"5%\" ALIGN=\"LEFT\" ID=\"randedit\" onmouseover=\"Tip('Eenheid van een item.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Eenheid</TD><TD WIDTH=\"50%\" ALIGN=\"LEFT\" ID=\"randedit\" onmouseover=\"Tip('Mogelijke waarden van een item.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Waarden</TD><TD ></TD></TR>\n");
	
	if (isset($aRecords)) {
		for ($iRecord = 0; $iRecord < count($aRecords); $iRecord++) {
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sVolgnr     = $aRecord[0];
			$sKolomnaam = $aRecord[1];
			$sKolomdef = $aRecord[2];
			$sEenheid = $aRecord[3];
			$sTekst = $aRecord[4];
			
			$sWaarde = F_SELECTRECORD("SELECT DOMEIN FROM ITEMS WHERE DATACODE = " . $sDatacode . " AND VOLGNR = " . $sVolgnr);
			
			print("<TR>\n");
			print("<TD ALIGN=\"LEFT\" VALIGN=top>" . F_GBITEXTBOX("ITEMS" . "|" . "VOLGNR" . "|" . "VOLGNR=" . $sVolgnr . " AND DATACODE=" . $sDatacode . "|60%") . "</TD><TD  ALIGN=\"LEFT\" VALIGN=top>" . F_GBITEXTBOX("ITEMS" ."|" . "ITEMNAAM" . "|" . "VOLGNR=" . $sVolgnr . " AND DATACODE=" . $sDatacode . "|90%") . "</TD><TD ALIGN=\"LEFT\" VALIGN=top>" . F_GBITEXTBOX("ITEMS" . "|" . "ITEMDEFINITIE" . "|" . "VOLGNR=" . $sVolgnr . " AND DATACODE=" . $sDatacode . "|95%") . "</TD><TD ALIGN=\"LEFT\" VALIGN=top>" . F_GBITEXTBOX("ITEMS" . "|" . "EENHEID" . "|" . "VOLGNR=" . $sVolgnr . " AND DATACODE=" . $sDatacode . "|80%") . "</TD><TD ALIGN=\"LEFT\" VALIGN=top>" . F_GBIMEMOBOX("MEMOTABEL" . "|" . "TEKST" . "|" . "CODE=" . $sWaarde) . "</TD><TD VALIGN=top ALIGN=\"LEFT\">\n");

			if (@$_SESSION["GBIPRO"] == "") {
				print("<A HREF='#' ONCLICK=\"execserver('?e=@GBIEXEC&p=DELETEITEM" . "|" . $sDatacode . "|" . $sVolgnr . "');\">");
				print("<IMG SRC='images\wissen1.png' ALT='Verwijderen item' BORDER=0 HEIGHT=20 WIDTH=20></A>\n");
			}
			print("</TD>\n");
			print("</TR>\n");
			print("</TR>\n");
		}
	}
                                
	if (@$_SESSION["GBIPRO"] == "") {
		print ("<TR><TD ALIGN=\"LEFT\">\n");
		print ("<A HREF='#' ONCLICK=" . "\"" . "execserver('?e=@GBIEXEC&p=INSERTITEM" . "|" . $sDatacode . "');" . "\"" . ">\n");
		print ("<IMG SRC='images\maak.png' ALT='Toevoegen item' BORDER=0 HEIGHT=20 WIDTH=20></A>\n");
		print ("</TD><TD></TD><TD></TD><TD></TD></TR>\n"); 
	}
	print("</TABLE>\n");
	print("</TD></TR>\n");
	print("</TABLE>\n");
	}
	
	print("<TABLE WIDTH=95% cellpadding=5 ID=\"randtabel3\">\n");
	print("<TR><TD WIDTH=\"25%\" COLSPAN=\"2\"><BR></TD></TR>\n");
	print("</TABLE>\n");
	
	print("<TABLE WIDTH=95% cellpadding=5 CELLSPACING=\"3\" ID=\"randtabel2\">\n");
	print("<TR><TD COLSPAN=\"2\" ID=\"randeditkop\">Metadata:</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Contactpersoon van de metagegevens van een dataset, CD/DVD of kaartservice.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Contactpersoon metadata</TD><TD ALIGN=\"LEFT\">\n");
	print(F_GBILISTBOXMETA("DATASET" . "|" . "METAPERSOON" . "|" . "DATACODE=" . $sDatacode . "|" . "CONTACT"));
	print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Datum waarop de metadata is gecre&#235;erd.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Metadata datum</TD><TD ID=\"randedit\">\n");
	print(F_GBITEXTDATEBOX("DATASET" . "|" . "INVOERDATUM" . "|" . "DATACODE=" . $sDatacode . "|90%"));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\">Taal dataset</TD><TD ID=\"randedit\" >\n");
	print(F_GBITEXTBOXVAST("DATASET" . "|" . "TAAL" . "|" . "DATACODE=" . $sDatacode));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\">Karakterset</TD><TD ID=\"randedit\" >\n");
	print(F_GBITEXTBOXVAST("DATASET" . "|" . "KARAKTERSET" . "|" . "DATACODE=" . $sDatacode));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\">Metadatastandaard</TD><TD ID=\"randedit\">\n");
	print(F_GBITEXTBOXVAST("DATASET" . "|" . "METADATASTD" . "|" . "DATACODE=" . $sDatacode));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\">Versie metadatastandaard</TD><TD ID=\"randedit\">\n");
	print(F_GBITEXTBOXVAST("DATASET" . "|" . "VERSIE_METASTD" . "|" . "DATACODE=" . $sDatacode));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\">Code referentiesysteem</TD><TD ID=\"randedit\">\n");
	print(F_GBITEXTBOXVAST("DATASET" . "|" . "CODE_REF" . "|" . "DATACODE=" . $sDatacode));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\">Organisatie referentiesysteem</TD><TD ID=\"randedit\">\n");
	print(F_GBITEXTBOXVAST("DATASET" . "|" . "ORG_NAMESPACE" . "|" . "DATACODE=" . $sDatacode));
    print("</TD></TR>\n");
	
	print("<TR><TD WIDTH=25% VALIGN=top ID=\"randedit\" onmouseover=\"Tip('Contactpersoon voor de distributie van een dataset, CD/DVD of kaartservice.', BGCOLOR, '#CCE3EF', WIDTH, 250)\" onmouseout=\"UnTip()\">Contactpersoon ditributie</TD><TD ALIGN=\"LEFT\">\n");
	print(F_GBILISTBOXGEO("DATASET" . "|" . "GEOLOKET" . "|" . "DATACODE=" . $sDatacode . "|" . "CONTACT"));
    print("</TD></TR>\n");
	
	print("</TABLE>\n");	
	print("</CENTER>\n");
	print("<BR>\n");
}

if ($sAction == "NEWDATASET") {
	print("<div id=\"nav_path\">\n");
	print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > Nieuwe dataset aanmaken </span>\n");
	print("</div>\n");
	print("<BR><BR><BR>\n");
	print("<CENTER>\n");	
	
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"600px\" ID=\"kopbegin\">\n");
	print("<CENTER>Nieuwe dataset aanmaken</CENTER>\n");
	print("</TD></TR></TABLE></CENTER>\n");
	print("<BR>\n");	
	
	print("<CENTER>\n");
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD ALIGN=\"LEFT\" VALIGN=\"MIDDLE\" WIDTH=\"600px\">\n");
	if (@$_SESSION["GBIMUTEREN"] == TRUE) {
		print("<FORM NAME=FRMNEW METHOD=POST ACTION=\"?e=@GBI&p=CREATEDATASET\">\n");
		print("<LI><B>Dataset aanmaken</B></A><BR><BR>\n");
		print("Titel dataset: <INPUT SIZE=70 TYPE=TEXT NAME='NEW'><BR><BR>\n");
		print("Type dataset: <SELECT NAME='SNEW'>\n");
		print("<OPTION>Dataset</OPTION>\n");
		print("<OPTION>CD/DVD</OPTION>\n");
		print("<OPTION>Service</OPTION></SELECT>\n");
		print("&nbsp;&nbsp;<input id=submit1 type=submit value=Aanmaken name=submit1></input>\n");
		print("</FORM>\n");
		print("<BR><BR>");
		print("<FORM NAME=FRMCOPY METHOD=POST ACTION=\"?e=@GBI&p=CREATEDATASET\">\n");
		print("<LI><B>Dataset kopie&euml;ren</B><BR><BR>");
		print("Titel dataset: <INPUT SIZE=70 TYPE=TEXT NAME='NCOPY'><BR><BR>\n");		
		$sQuery = F_SELECTRECORD("SELECT DATACODE, DATASET_TITEL FROM DATASET ORDER BY DATASET_TITEL");
		$aRecords = explode("|", $sQuery);		
		
		print ("<SELECT NAME='COPY'>\n");				
		for ($iRecord = 0; $iRecord < count($aRecords); $iRecord++) {
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sDC = $aRecord[0];
			$sDT = $aRecord[1];			
			print ("<OPTION VALUE=" . "\"" . $sDC . "\"" . ">" . $sDT . "</OPTION>\n");
			}			
		
		print ("</SELECT>\n");			
		print("<BR>\n");
		print("<BR>\n");
		print("<input id=submit type=submit value=Kopie&euml;ren name=submit></input>\n");
		print("</FORM>\n");			
	}	
	
	print("<BR>\n");
	print("<BR>\n");	
	
	print("</TD></TR></TABLE>\n");
	print("</CENTER>\n");	
}

if ($sAction == "AFDRUK") {
	print("<div id=\"nav_path\">\n");
	print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > Afdrukopties </span>\n");
	print("</div>\n");
	print("<BR><BR><BR>\n");
	print("<CENTER>\n");	
	
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"600px\" ID=\"kopbegin\">\n");
	print("<CENTER>Afdrukopties</CENTER>\n");
	print("</TD></TR></TABLE></CENTER>\n");
	print("<BR>\n");	
	
	print("<CENTER>\n");
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD ALIGN=\"LEFT\" VALIGN=\"MIDDLE\" WIDTH=\"600px\">\n");
	if (@$_SESSION["GBIMUTEREN"] == TRUE) {
		print("<LI><A HREF='?e=@PRINT&p=TOTAL' TARGET='_blank'>PDF met alle datasets</A><BR><BR>\n");
		print("<LI><A HREF='?e=@PRINT&p=OPENBAAR' TARGET='_blank'>PDF met openbare datasets</A><BR><BR>\n");
		print("<LI><A HREF='?e=@PRINT&p=NIETOPENBAAR' TARGET='_blank'>PDF met niet openbare datasets</A><BR><BR>\n");		
		print("<FORM NAME=FRMPRINT METHOD=POST ACTION=\"?e=@PRINT&p=DATASET\">\n");
		print("<LI>Selecteer een dataset &nbsp;&nbsp;");
		$sQuery = F_SELECTRECORD("SELECT DATACODE, DATASET_TITEL FROM DATASET ORDER BY DATASET_TITEL");
		$aRecords = explode("|", $sQuery);		
		
		print ("<SELECT NAME='PRINT'>\n");				
		for ($iRecord = 0; $iRecord < count($aRecords); $iRecord++) {
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sDC = $aRecord[0];
			$sDT = $aRecord[1];			
			print ("<OPTION VALUE=" . "\"" . $sDC . "\"" . ">" . $sDT . "</OPTION>\n");
			}			
		
		print ("</SELECT>\n");	

		print("<BR>\n");
		print("<BR>\n");			
		print("<input id=submit type=submit value=\"Maak PDF\" name=submit></input>\n");
		print("</FORM>\n");			
	}	
	
	print("<BR>\n");
	print("<BR>\n");	
	
	print("</TD></TR></TABLE>\n");
	print("</CENTER>\n");	
}


if ($sAction == "ADMIN") {
	print("<div id=\"nav_path\">\n");
	print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > Administratieve taken </span>\n");
	print("</div>\n");
	print("<BR><BR><BR>\n");
	print("<CENTER>\n");		
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"800px\" ID=\"kopbegin\">\n");
	print("<CENTER>Administratieve taken</CENTER>\n");
	print("</TD></TR></TABLE></CENTER>\n");
	print("<BR>\n");

	print("<CENTER>\n");
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD ALIGN=\"LEFT\" VALIGN=\"MIDDLE\" WIDTH=\"600px\">\n");
	if (@$_SESSION["GBIMUTEREN"] == TRUE) {
		print("<FORM NAME=FRMTREF METHOD=POST ACTION=\"?e=@GBI&p=CREATETREFWOORD\">\n");
		print("<LI><B>Trefwoord toevoegen</B></A><BR><BR>\n");
		print("Trefwoord: <INPUT SIZE=30 TYPE=TEXT NAME='NEWTREF'>\n");		
		print("&nbsp;&nbsp;<input id=submit1 type=submit value=Toevoegen name=submit1></input>\n");
		print("</FORM><BR>\n");		
		print("<LI><B>Kopie van database maken</B><BR><BR>\n");	
		print("<A HREF='http://paros/website/databases/gdb_database.mdb'>Database kopie&euml;ren</A><BR><BR>");		
	}
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	
	print("</TD></TR></TABLE>\n");
	print("</CENTER>\n");	
	
}

if ($sAction == "EXPORT") {
	print("<div id=\"nav_path\">\n");
	print("<span>> <a href=\"index.php\"> Hoofdmenu</a> > Exporteren Geo-Portaal </span>\n");
	print("</div>\n");
	print("<BR><BR><BR>\n");
	print("<CENTER>\n");		
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD VALIGN=\"MIDDLE\" WIDTH=\"800px\" ID=\"kopbegin\">\n");
	print("<CENTER>Exporteren Geo-Portaal</CENTER>\n");
	print("</TD></TR></TABLE></CENTER>\n");
	print("<BR>\n");

	print("<CENTER>\n");
	print("<TABLE BORDER=\"0\" CELLSPACING=\"10\">\n");
	print("<TR><TD ALIGN=\"LEFT\" VALIGN=\"MIDDLE\" WIDTH=\"600px\">\n");
	if (@$_SESSION["GBIMUTEREN"] == TRUE) {
		print("<LI><B>PDF</B><BR>\n");
		print("<A HREF='?e=@EXPORT&p=PDFOPENBAAR'>Exporteren PDF datasets</A><BR>\n");		
		print("<LI><B>XML</B><BR>\n");
		print("<A HREF='?e=@EXPORT&p=XMLOPENBAAR'>Exporteren XML datasets</A><BR>\n");
		print("<LI><B>PDF Items</B><BR>\n");
		print("<A HREF='?e=@EXPORT&p=PDFITEMS'>Exporteren PDF items datasets</A><BR>\n");		
		print("<LI><B>DDE config XML</B><BR>\n");
		print("<A HREF='?e=@EXPORT&p=DDEOPENBAAR'>Exporteren DDE XML gegevens</A><BR>\n");		
		print("<LI><B>AXL</B><BR>\n");
		print("<A HREF='?e=@EXPORT&p=IMSOPENBAAR'>Exporteren ArcIMS AXL gegevens</A><BR>\n");		
		print("<LI><B>Legend XML</B><BR>\n");
		print("<A HREF='?e=@EXPORT&p=LEGENDOPENBAAR'>Exporteren ArcIMS Legend XML gegevens</A><BR>\n");	
		print("<LI><B>ID's generen</B><BR>\n");
		print("<A HREF='?e=@EXPORT&p=IDGENEREREN'>ID's genereren</A><BR>\n");	
	}
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");	
	print("<BR>\n");
	print("<BR>\n");
	
	print("</TD></TR></TABLE>\n");
	print("</CENTER>\n");	
	
}

}
else {
	print("<BR>\n");
	print("U bent niet ingelogd. Klik <A HREF=\"?e=@GBIEXEC&p=MENU\"> hier</A> om u aan te melden.\n");	
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");
	print("<BR>\n");		
}

F_ENDSTYLE();
}

function F_PRINT($p) {
	global $db, $dsn;

	$db->Connect($dsn); 

	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	
	//print $query;

	$tokens = explode("|", $p);
	$sAction = $tokens[0];
	
	F_STYLE;
	
	if (@$_SESSION["GBIMUTEREN"] == TRUE) {
	
	if ($sAction == "TOTAL") {
		$pdf = & new Cezpdf('a4','portrait');
		$pdf -> ezSetMargins(50,70,50,50);
		
		// een lijn boven en onder op alle pagina's
		$all = $pdf->openObject();
		$pdf->saveState();
		$pdf->setStrokeColor(0,0,0,1);
		$pdf->line(20,40,578,40);
		$pdf->line(20,822,578,822);
		$pdf->addText(21,34,6,'Geografische Metagegevens | Provincie Drenthe');
		$pdf->restoreState();
		$pdf->closeObject();

		$pdf->addObject($all,'all');
		
		$pdf->ezSetDy(-100);
		
		$mainFont = './fonts/Arial.afm';
		$bdFont = './fonts/Times-Bold.afm';
		
		//selecteer een font
		$pdf->selectFont($mainFont);
		
		$pdf->saveState();
		$pdf->setColor(0.04,0.58,0.99);
		$pdf->setLineStyle(601.89);
		$pdf->setStrokeColor(0.882,0.913,0.964);
		$pdf->ellipse(0,601.89,297.64, 601.89);
		$pdf->restoreState();		
		
		$pdf->saveState();
		$pdf->setColor(1,1,1);
		
		$pdf->restoreState();
		$pdf->setColor(1,1,1);
		$pdf->filledRectangle(0,701.89,595.28,200);		
		$pdf->saveState();
		
		$pdf->setColor(0.04,0.58,0.99);
		$pdf->filledRectangle(0,601.89,595.28,100);		
		$pdf->setColor(1,1,1);
		$pdf->ezText("Overzicht metagegevens",30,array('justification'=>'centre'));
		$pdf->ezText("provincie Drenthe\n",30,array('justification'=>'centre'));
		$pdf->restoreState();		
		
		$pdf->addJpegFromFile('./images/drenthe.jpg',370,750,196.5,29);
				
		$pdf->saveState();
		$pdf->setColor(0.04,0.58,0.99);
		$pdf->filledRectangle(0,100,595.28,30);		
		$pdf->restoreState();
		
		$pdf->setColor(1,1,1);
		$pdf->ezSety(125);
		$datum = date("j-m-Y");
		$pdf->ezText("Versie: $datum",18,array('justification'=>'right'));
		
		$pdf->saveState();
		$pdf->setColor(0,0.478,0.741);
		$pdf->filledRectangle(0,0,20,841.89);		
		$pdf->restoreState();	
		
		$pdf->addJpegFromFile('./images/wapen.jpg',520,50,54.2,39.2);		
		
		$pdf->setColor(0,0,0);	
		
		$pdf->ezNewPage();	
		
		$sSQL = "SELECT DATACODE, DATASET_TITEL, OPMERKING, OPBOUWDATUM, ACTIE FROM DATASET ORDER BY DATASET_TITEL";
				
		$result = $db->Execute($sSQL);

		while (!$result->EOF) {			
			$sDatacode = $result->fields[0];
			
			$sCode = F_SELECTRECORD("SELECT OMSCHRIJVING_CODE FROM DATASET WHERE DATACODE = " . $sDatacode);
			
			$pdf->selectFont($bdFont);
			$pdf->ezText("Algemeen:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			
			$datatabel = array(
				array('omschr'=>'Titel dataset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "DATASET_TITEL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Alternatieve titel:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "ALT_TITEL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Omschrijving dataset:','waarde'=>F_GBIPDFTEXT("MEMOTABEL" . "|" . "TEKST" . "|" . "CODE=" . $sCode)),
				array('omschr'=>'Algemene opmerking:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "OPMERKING" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Referentie datum:','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "BRONDATUM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Brondatum:','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "OPBOUWDATUM" . "|" . "DATACODE=" . $sDatacode)),			
				array('omschr'=>'Bronvermelding:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "BRONVERMELDING" . "|" . "DATACODE=" . $sDatacode)),			
				array('omschr'=>'Opbouwmethode:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "OPBOUWMETHODE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Gebeurtenis:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "ACTIE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Status:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "STATUS" . "|" . "DATACODE=" . $sDatacode))
				);
					
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
			$sTrefwoorden = F_SELECTRECORD("SELECT TREFTEXT.TREFWOORD FROM TREFCODE INNER JOIN TREFTEXT ON TREFCODE.TREFCODE = TREFTEXT.TREFCODE WHERE TREFCODE.DATACODE=" . $sDatacode . " ORDER BY TREFTEXT.TREFWOORD");
			$sTref = str_replace("|", ", ", $sTrefwoorden);
				
			//Inhoud
			$pdf->selectFont($bdFont);
			$pdf->ezText("Inhoud:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$sContactpersoon = F_SELECTRECORD("SELECT CONTACTPERSOON FROM DATASET WHERE DATACODE = " . $sDatacode);
			$datatabel = array(
				array('omschr'=>'Contactpersoon inhoud:','waarde'=>F_GBIPDFTEXT("CONTACT" . "|" . "CONTACTPERSOON" . "|" . "CONTACT_ID=" . $sContactpersoon)),
				array('omschr'=>'Beleidsterrein:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "BELEIDSVELD" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Team:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "TEAM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Thema:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "THEMA" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Gebruiksbeperking:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "GEBRUIKSBEPERKING" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Veiligheidsrestricties:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "VEILIGHEID" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Toegangsrestricties:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "JURIDISCH" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Copyright:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "COPYRIGHT" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Herzienings frequentie:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "BIJHOUDING" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Toepassingsschaal:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "SCHAAL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Contact leverancier:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "CONTACT_LEVERANCIER" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Trefwoorden:','waarde'=>$sTref),
				array('omschr'=>'Dekking (begin datum):','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "DEKKING_BEGIN" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Dekking (eind datum):','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "DEKKING_EIND" . "|" . "DATACODE=" . $sDatacode))
				//array('omschr'=>'Taal dataset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "TAAL" . "|" . "DATACODE=" . $sDatacode)),
				//array('omschr'=>'Karakterset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "KARAKTERSET" . "|" . "DATACODE=" . $sDatacode))
				);
					
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
			//Specifiek	
			$pdf->selectFont($bdFont);
			$pdf->ezText("Specifiek:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$sGebied = F_SELECTRECORD( "SELECT DEELGEBIED FROM GEOGRAFISCH WHERE DATACODE = "  . $sDatacode);
								
			$datatabel = array(
				array('omschr'=>'Geografisch gebied:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "DEELGEBIED" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Aanvullende informatie:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "AANVUL_INFO" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Ruimtelijk schema:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "RSCHEMA" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Bestandsnaam:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "NAAM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Fysieke locatie:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "FYSIEKE_LOCATIE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Datatype:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "DATATYPE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Geometrie:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "GEOMETRIE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Nauwkeurigheid:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "POS_NAUWKEURIGHEID" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Kwaliteitsbeschrijving:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "KWALITEIT_BESCH" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Minimale x-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MIN_X" . "|" . "GEBIED='" . $sGebied . "'")),
				array('omschr'=>'Maximale x-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MAX_X" . "|" . "GEBIED='" . $sGebied . "'")),
				array('omschr'=>'Minimale y-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MIN_Y" . "|" . "GEBIED='" . $sGebied . "'")),
				array('omschr'=>'Maximale y-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MAX_Y" . "|" . "GEBIED='" . $sGebied . "'"))
				);
				
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
			$sItem = F_SELECTRECORD( "SELECT STD_ITEM FROM GEOGRAFISCH WHERE DATACODE = "  . $sDatacode);
			$sCode = F_SELECTRECORD( "SELECT ITEMDEFINITIE FROM ITEMS WHERE ITEMS.DATACODE = " . $sDatacode . " AND ITEMS.ITEMNAAM = '" . $sItem . "'");
			$sDefitem = F_SELECTRECORD( "SELECT ITEMDEFINITIE FROM ITEMS WHERE DATACODE= " . $sDatacode . " AND ITEMNAAM = '" . $sItem . "'");		
			$sItemrec = F_SELECTRECORD("SELECT VOLGNR, ITEMNAAM, ITEMDEFINITIE FROM ITEMS WHERE DATACODE=" . $sDatacode . " ORDER BY VOLGNR");
			$sItemrecs = str_replace("|", "\n", $sItemrec);
			$sItemrecss = str_replace("^", " ", $sItemrecs);
				
			$datatabel = array(						
				array('omschr'=>'Standaarditem:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "STD_ITEM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Definitie standaarditem:','waarde'=>$sDefitem),			
				array('omschr'=>'Items:','waarde'=>$sItemrecss)
				);
			
			$pdf->selectFont($bdFont);
			$pdf->ezText("Items:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
				//metadata
			$sMetapersoon = F_SELECTRECORD("SELECT METAPERSOON FROM DATASET WHERE DATACODE = " . $sDatacode);
			$sGeopersoon = F_SELECTRECORD("SELECT GEOLOKET FROM DATASET WHERE DATACODE = " . $sDatacode);
			$datatabel = array(
				array('omschr'=>'Contactpersoon inhoud:','waarde'=>F_GBIPDFTEXT("CONTACT" . "|" . "CONTACTPERSOON" . "|" . "CONTACT_ID=" . $sMetapersoon)),
				array('omschr'=>'Datum opbouw:','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "INVOERDATUM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Taal dataset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "TAAL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Karakterset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "KARAKTERSET" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Metadatastandaard:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "METADATASTD" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Versie metadatastandaard:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "VERSIE_METASTD" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Code referentiesysteem:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "CODE_REF" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Organisatie referentiesysteem:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "ORG_NAMESPACE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Contactpersoon distributie:','waarde'=>F_GBIPDFTEXT("CONTACT" . "|" . "CONTACTPERSOON" . "|" . "CONTACT_ID=" . $sGeopersoon))			
				);
			
			$pdf->selectFont($bdFont);
			$pdf->ezText("Metadata:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));				
			
			$result->MoveNext();

			if (!$result->EOF) {
				$pdf->ezNewPage();
			}			
		}	
		
		$pdf->ezStream();
	}
	
	if ($sAction == "OPENBAAR") {
		$pdf = & new Cezpdf('a4','portrait');
		$pdf -> ezSetMargins(50,70,50,50);
		
		// een lijn boven en onder op alle pagina's
		$all = $pdf->openObject();
		$pdf->saveState();
		$pdf->setStrokeColor(0,0,0,1);
		$pdf->line(20,40,578,40);
		$pdf->line(20,822,578,822);
		$pdf->addText(21,34,6,'Geografische Metagegevens | Provincie Drenthe');
		$pdf->restoreState();
		$pdf->closeObject();

		$pdf->addObject($all,'all');
		
		$pdf->ezSetDy(-100);
		
		$mainFont = './fonts/Arial.afm';
		$bdFont = './fonts/Times-Bold.afm';
		
		//selecteer een font
		$pdf->selectFont($mainFont);
		
		$pdf->saveState();
		$pdf->setColor(0.04,0.58,0.99);
		$pdf->setLineStyle(601.89);
		$pdf->setStrokeColor(0.882,0.913,0.964);
		$pdf->ellipse(0,601.89,297.64, 601.89);
		$pdf->restoreState();		
		
		$pdf->saveState();
		$pdf->setColor(1,1,1);
		
		$pdf->restoreState();
		$pdf->setColor(1,1,1);
		$pdf->filledRectangle(0,701.89,595.28,200);		
		$pdf->saveState();
		
		$pdf->setColor(0.04,0.58,0.99);
		$pdf->filledRectangle(0,601.89,595.28,100);		
		$pdf->setColor(1,1,1);
		$pdf->ezText("Overzicht openbare gegevens",30,array('justification'=>'centre'));
		$pdf->ezText("provincie Drenthe\n",30,array('justification'=>'centre'));
		$pdf->restoreState();		
		
		$pdf->addJpegFromFile('./images/drenthe.jpg',370,750,196.5,29);
				
		$pdf->saveState();
		$pdf->setColor(0.04,0.58,0.99);
		$pdf->filledRectangle(0,100,595.28,30);		
		$pdf->restoreState();
		
		$pdf->setColor(1,1,1);
		$pdf->ezSety(125);
		$datum = date("j-m-Y");
		$pdf->ezText("Versie: $datum",18,array('justification'=>'right'));
		
		$pdf->saveState();
		$pdf->setColor(0,0.478,0.741);
		$pdf->filledRectangle(0,0,20,841.89);		
		$pdf->restoreState();	
		
		$pdf->addJpegFromFile('./images/wapen.jpg',520,50,54.2,39.2);		
		
		$pdf->setColor(0,0,0);	
		
		$pdf->ezNewPage();	
		
		$sSQL = "SELECT DATACODE, DATASET_TITEL, OPMERKING, OPBOUWDATUM, ACTIE FROM DATASET WHERE VEILIGHEID = 'vrij toegankelijk' ORDER BY DATASET_TITEL";
				
		$result = $db->Execute($sSQL);

		while (!$result->EOF) {			
			$sDatacode = $result->fields[0];
			
			$sCode = F_SELECTRECORD("SELECT OMSCHRIJVING_CODE FROM DATASET WHERE DATACODE = " . $sDatacode);
						
			$pdf->selectFont($mainFont);
			
			$datatabel = array(
				array('omschr'=>'Titel dataset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "DATASET_TITEL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Alternatieve titel:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "ALT_TITEL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Omschrijving dataset:','waarde'=>F_GBIPDFTEXT("MEMOTABEL" . "|" . "TEKST" . "|" . "CODE=" . $sCode))				
				);
					
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));				
			
			$result->MoveNext();

			if (!$result->EOF) {
				//$pdf->ezNewPage();
			}			
		}	
		
		$pdf->ezStream();
	
	
	}
	
	if ($sAction == "NIETOPENBAAR") {
		$pdf = & new Cezpdf('a4','portrait');
		$pdf -> ezSetMargins(50,70,50,50);
		
		// een lijn boven en onder op alle pagina's
		$all = $pdf->openObject();
		$pdf->saveState();
		$pdf->setStrokeColor(0,0,0,1);
		$pdf->line(20,40,578,40);
		$pdf->line(20,822,578,822);
		$pdf->addText(21,34,6,'Geografische Metagegevens | Provincie Drenthe');
		$pdf->restoreState();
		$pdf->closeObject();

		$pdf->addObject($all,'all');
		
		$pdf->ezSetDy(-100);
		
		$mainFont = './fonts/Arial.afm';
		$bdFont = './fonts/Times-Bold.afm';
		
		//selecteer een font
		$pdf->selectFont($mainFont);
		
		$pdf->saveState();
		$pdf->setColor(0.04,0.58,0.99);
		$pdf->setLineStyle(601.89);
		$pdf->setStrokeColor(0.882,0.913,0.964);
		$pdf->ellipse(0,601.89,297.64, 601.89);
		$pdf->restoreState();		
		
		$pdf->saveState();
		$pdf->setColor(1,1,1);
		
		$pdf->restoreState();
		$pdf->setColor(1,1,1);
		$pdf->filledRectangle(0,701.89,595.28,200);		
		$pdf->saveState();
		
		$pdf->setColor(0.04,0.58,0.99);
		$pdf->filledRectangle(0,601.89,595.28,100);		
		$pdf->setColor(1,1,1);
		$pdf->ezText("Overzicht niet openbare gegevens",30,array('justification'=>'centre'));
		$pdf->ezText("provincie Drenthe\n",30,array('justification'=>'centre'));
		$pdf->restoreState();		
		
		$pdf->addJpegFromFile('./images/drenthe.jpg',370,750,196.5,29);
				
		$pdf->saveState();
		$pdf->setColor(0.04,0.58,0.99);
		$pdf->filledRectangle(0,100,595.28,30);		
		$pdf->restoreState();
		
		$pdf->setColor(1,1,1);
		$pdf->ezSety(125);
		$datum = date("j-m-Y");
		$pdf->ezText("Versie: $datum",18,array('justification'=>'right'));
		
		$pdf->saveState();
		$pdf->setColor(0,0.478,0.741);
		$pdf->filledRectangle(0,0,20,841.89);		
		$pdf->restoreState();	
		
		$pdf->addJpegFromFile('./images/wapen.jpg',520,50,54.2,39.2);		
		
		$pdf->setColor(0,0,0);	
		
		$pdf->ezNewPage();	
		
		$sSQL = "SELECT DATACODE, DATASET_TITEL, OPMERKING, OPBOUWDATUM, ACTIE FROM DATASET WHERE TYPE = 1 AND VEILIGHEID = 'niet toegankelijk' OR VEILIGHEID = 'vertrouwelijk' ORDER BY DATASET_TITEL";
				
		$result = $db->Execute($sSQL);

		while (!$result->EOF) {			
			$sDatacode = $result->fields[0];
			
			$sCode = F_SELECTRECORD("SELECT OMSCHRIJVING_CODE FROM DATASET WHERE DATACODE = " . $sDatacode);
						
			$pdf->selectFont($mainFont);
			
			$datatabel = array(
				array('omschr'=>'Titel dataset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "DATASET_TITEL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Alternatieve titel:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "ALT_TITEL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Omschrijving dataset:','waarde'=>F_GBIPDFTEXT("MEMOTABEL" . "|" . "TEKST" . "|" . "CODE=" . $sCode))				
				);
					
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));				
			
			$result->MoveNext();

			if (!$result->EOF) {
				//$pdf->ezNewPage();
			}			
		}	
		
		$pdf->ezStream();
	
	
	}
		
	if ($sAction == "DATASET") {
		$sFilterValuePrint = @$_POST["PRINT"];
		if ($sFilterValuePrint <> "" AND $sFilterValuePrint <> NULL ) {
			$pdf = & new Cezpdf('a4','portrait');
		$pdf -> ezSetMargins(50,70,50,50);
		
		// een lijn boven en onder op alle pagina's
		$all = $pdf->openObject();
		$pdf->saveState();
		$pdf->setStrokeColor(0,0,0,1);
		$pdf->line(20,40,578,40);
		$pdf->line(20,822,578,822);
		$pdf->addText(21,34,6,'Geografische Metagegevens | Provincie Drenthe');
		$pdf->restoreState();
		$pdf->closeObject();

		$pdf->addObject($all,'all');
		
		$pdf->ezSetDy(-100);
		
		$mainFont = './fonts/Arial.afm';
		$bdFont = './fonts/Times-Bold.afm';
		
		//selecteer een font
		$pdf->selectFont($mainFont);
		
		$pdf->saveState();
		$pdf->setColor(0.04,0.58,0.99);
		$pdf->setLineStyle(601.89);
		$pdf->setStrokeColor(0.882,0.913,0.964);
		$pdf->ellipse(0,601.89,297.64, 601.89);
		$pdf->restoreState();		
		
		$pdf->saveState();
		$pdf->setColor(1,1,1);
		
		$pdf->restoreState();
		$pdf->setColor(1,1,1);
		$pdf->filledRectangle(0,701.89,595.28,200);		
		$pdf->saveState();
		
		$pdf->setColor(0.04,0.58,0.99);
		$pdf->filledRectangle(0,601.89,595.28,100);		
		$pdf->setColor(1,1,1);
		$pdf->ezText("Overzicht metagegevens",30,array('justification'=>'centre'));
		$pdf->ezText("provincie Drenthe\n",30,array('justification'=>'centre'));
		$pdf->restoreState();		
		
		$pdf->addJpegFromFile('./images/drenthe.jpg',370,750,196.5,29);
				
		$pdf->saveState();
		$pdf->setColor(0.04,0.58,0.99);
		$pdf->filledRectangle(0,100,595.28,30);		
		$pdf->restoreState();
		
		$pdf->setColor(1,1,1);
		$pdf->ezSety(125);
		$datum = date("j-m-Y");
		$pdf->ezText("Versie: $datum",18,array('justification'=>'right'));
		
		$pdf->saveState();
		$pdf->setColor(0,0.478,0.741);
		$pdf->filledRectangle(0,0,20,841.89);		
		$pdf->restoreState();	
		
		$pdf->addJpegFromFile('./images/wapen.jpg',520,50,54.2,39.2);		
		
		$pdf->setColor(0,0,0);	
		
		$pdf->ezNewPage();	
		
		$sSQL = "SELECT DATACODE, DATASET_TITEL, OPMERKING, OPBOUWDATUM, ACTIE FROM DATASET WHERE DATACODE = $sFilterValuePrint ORDER BY DATASET_TITEL";
				
		$result = $db->Execute($sSQL);

		while (!$result->EOF) {			
			$sDatacode = $result->fields[0];
			
			$sCode = F_SELECTRECORD("SELECT OMSCHRIJVING_CODE FROM DATASET WHERE DATACODE = " . $sDatacode);
			
			$pdf->selectFont($bdFont);
			$pdf->ezText("Algemeen:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			
			$datatabel = array(
				array('omschr'=>'Titel dataset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "DATASET_TITEL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Alternatieve titel:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "ALT_TITEL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Omschrijving dataset:','waarde'=>F_GBIPDFTEXT("MEMOTABEL" . "|" . "TEKST" . "|" . "CODE=" . $sCode)),
				array('omschr'=>'Algemene opmerking:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "OPMERKING" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Referentie datum:','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "BRONDATUM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Brondatum:','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "OPBOUWDATUM" . "|" . "DATACODE=" . $sDatacode)),			
				array('omschr'=>'Bronvermelding:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "BRONVERMELDING" . "|" . "DATACODE=" . $sDatacode)),			
				array('omschr'=>'Opbouwmethode:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "OPBOUWMETHODE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Gebeurtenis:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "ACTIE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Status:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "STATUS" . "|" . "DATACODE=" . $sDatacode))
				);
					
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
			$sTrefwoorden = F_SELECTRECORD("SELECT TREFTEXT.TREFWOORD FROM TREFCODE INNER JOIN TREFTEXT ON TREFCODE.TREFCODE = TREFTEXT.TREFCODE WHERE TREFCODE.DATACODE=" . $sDatacode . " ORDER BY TREFTEXT.TREFWOORD");
			$sTref = str_replace("|", ", ", $sTrefwoorden);
				
			//Inhoud
			$pdf->selectFont($bdFont);
			$pdf->ezText("Inhoud:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$sContactpersoon = F_SELECTRECORD("SELECT CONTACTPERSOON FROM DATASET WHERE DATACODE = " . $sDatacode);
			$datatabel = array(
				array('omschr'=>'Contactpersoon inhoud:','waarde'=>F_GBIPDFTEXT("CONTACT" . "|" . "CONTACTPERSOON" . "|" . "CONTACT_ID=" . $sContactpersoon)),
				array('omschr'=>'Beleidsterrein:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "BELEIDSVELD" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Team:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "TEAM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Thema:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "THEMA" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Gebruiksbeperking:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "GEBRUIKSBEPERKING" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Veiligheidsrestricties:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "VEILIGHEID" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Toegangsrestricties:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "JURIDISCH" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Copyright:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "COPYRIGHT" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Herzienings frequentie:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "BIJHOUDING" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Toepassingsschaal:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "SCHAAL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Contact leverancier:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "CONTACT_LEVERANCIER" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Trefwoorden:','waarde'=>$sTref),
				array('omschr'=>'Dekking (begin datum):','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "DEKKING_BEGIN" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Dekking (eind datum):','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "DEKKING_EIND" . "|" . "DATACODE=" . $sDatacode))
				//array('omschr'=>'Taal dataset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "TAAL" . "|" . "DATACODE=" . $sDatacode)),
				//array('omschr'=>'Karakterset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "KARAKTERSET" . "|" . "DATACODE=" . $sDatacode))
				);
					
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
			//Specifiek	
			$pdf->selectFont($bdFont);
			$pdf->ezText("Specifiek:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$sGebied = F_SELECTRECORD( "SELECT DEELGEBIED FROM GEOGRAFISCH WHERE DATACODE = "  . $sDatacode);
								
			$datatabel = array(
				array('omschr'=>'Geografisch gebied:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "DEELGEBIED" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Aanvullende informatie:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "AANVUL_INFO" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Ruimtelijk schema:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "RSCHEMA" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Bestandsnaam:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "NAAM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Fysieke locatie:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "FYSIEKE_LOCATIE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Datatype:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "DATATYPE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Geometrie:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "GEOMETRIE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Nauwkeurigheid:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "POS_NAUWKEURIGHEID" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Kwaliteitsbeschrijving:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "KWALITEIT_BESCH" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Minimale x-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MIN_X" . "|" . "GEBIED='" . $sGebied . "'")),
				array('omschr'=>'Maximale x-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MAX_X" . "|" . "GEBIED='" . $sGebied . "'")),
				array('omschr'=>'Minimale y-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MIN_Y" . "|" . "GEBIED='" . $sGebied . "'")),
				array('omschr'=>'Maximale y-co&#246;rdinaat:','waarde'=>F_GBIPDFTEXT("GEBIED" . "|" . "MAX_Y" . "|" . "GEBIED='" . $sGebied . "'"))
				);
				
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
			$sItem = F_SELECTRECORD( "SELECT STD_ITEM FROM GEOGRAFISCH WHERE DATACODE = "  . $sDatacode);
			$sCode = F_SELECTRECORD( "SELECT ITEMDEFINITIE FROM ITEMS WHERE ITEMS.DATACODE = " . $sDatacode . " AND ITEMS.ITEMNAAM = '" . $sItem . "'");
			$sDefitem = F_SELECTRECORD( "SELECT ITEMDEFINITIE FROM ITEMS WHERE DATACODE= " . $sDatacode . " AND ITEMNAAM = '" . $sItem . "'");		
			$sItemrec = F_SELECTRECORD("SELECT VOLGNR, ITEMNAAM, ITEMDEFINITIE FROM ITEMS WHERE DATACODE=" . $sDatacode . " ORDER BY VOLGNR");
			$sItemrecs = str_replace("|", "\n", $sItemrec);
			$sItemrecss = str_replace("^", " ", $sItemrecs);
				
			$datatabel = array(						
				array('omschr'=>'Standaarditem:','waarde'=>F_GBIPDFTEXT("GEOGRAFISCH" . "|" . "STD_ITEM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Definitie standaarditem:','waarde'=>$sDefitem),			
				array('omschr'=>'Items:','waarde'=>$sItemrecss)
				);
			
			$pdf->selectFont($bdFont);
			$pdf->ezText("Items:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));
				
			$pdf->ezText("",10,array('justification'=>'centre'));
				
				//metadata
			$sMetapersoon = F_SELECTRECORD("SELECT METAPERSOON FROM DATASET WHERE DATACODE = " . $sDatacode);
			$sGeopersoon = F_SELECTRECORD("SELECT GEOLOKET FROM DATASET WHERE DATACODE = " . $sDatacode);
			$datatabel = array(
				array('omschr'=>'Contactpersoon inhoud:','waarde'=>F_GBIPDFTEXT("CONTACT" . "|" . "CONTACTPERSOON" . "|" . "CONTACT_ID=" . $sMetapersoon)),
				array('omschr'=>'Datum opbouw:','waarde'=>F_GBIPDFDATUM("DATASET" . "|" . "INVOERDATUM" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Taal dataset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "TAAL" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Karakterset:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "KARAKTERSET" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Metadatastandaard:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "METADATASTD" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Versie metadatastandaard:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "VERSIE_METASTD" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Code referentiesysteem:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "CODE_REF" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Organisatie referentiesysteem:','waarde'=>F_GBIPDFTEXT("DATASET" . "|" . "ORG_NAMESPACE" . "|" . "DATACODE=" . $sDatacode)),
				array('omschr'=>'Contactpersoon distributie:','waarde'=>F_GBIPDFTEXT("CONTACT" . "|" . "CONTACTPERSOON" . "|" . "CONTACT_ID=" . $sGeopersoon))			
				);
			
			$pdf->selectFont($bdFont);
			$pdf->ezText("Metadata:",14,array('justification'=>'left'));
			$pdf->selectFont($mainFont);
			$pdf->ezTable($datatabel, array('omschr'=>'','waarde'=>''),'',
			array('showHeadings'=>0,'showLines'=>1,'shaded'=>2,'shadeCol'=>array(0.921,0.956,0.980),
			'innerLineThickness'=>0,'shadeCol2'=>array(0.921,0.956,0.980),'xPos'=>'left','width'=>500,
			'xOrientation'=>'right','fontsize'=>12,
			'cols'=>array('omschr'=>array('width'=>132))));				
			
			$result->MoveNext();

			if (!$result->EOF) {
				$pdf->ezNewPage();
			}			
		}	
		
		$pdf->ezStream();
		}	
	}	
	}
	else {
		print("<BR>\n");
		print("U bent niet ingelogd. Klik <A HREF=\"?e=@GBIEXEC&p=MENU\"> hier</A> om u aan te melden.\n");	
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		print("<BR>\n");
		
	}
F_ENDSTYLE();
}

function F_GBIPDFTEXT($p) {
	$tokens = explode("|", $p);
	$sTable = $tokens[0];
	$sField = $tokens[1];
	$sWhere = $tokens[2];
	
	$sRecordValue = F_SELECTRECORD("SELECT " . $sField . " FROM " . $sTable . " WHERE " . $sWhere);
	
	$sRecordValue = $sRecordValue;
		
	$sRoContent = str_replace("^", " ", $sRecordValue);
	
	return $sRoContent;	
}

function F_GBIPDFDATUM($p) {
	$tokens = explode("|", $p);
	$sTable = $tokens[0];
	$sField = $tokens[1];
	$sWhere = $tokens[2];
	
	$sRecordValue = F_SELECTRECORD("SELECT " . $sField . " FROM " . $sTable . " WHERE " . $sWhere);
	
	$dt = strtotime($sRecordValue);
	//$corrected_date=BST_finder($dt);	
	$sTemp = date("d-m-Y", $dt);
		
	//$sRoContent = str_replace("^", " ", $sRecordValue);
	
	return $sTemp;	
}

function BST_finder ($dt) { 
    $BSTstart=strtotime("last Sunday",gmmktime(0,0,0,4,1)); // plus 3600 seconds to make it 1 a.m.
    $BSTend=strtotime("last Sunday",gmmktime(0,0,0,11,1));
    if ($dt>=$BSTstart and $dt<=$BSTend) {
        $dt=$dt;
    } 
    return $dt;
}

function F_GBITEXTDATEBOX($p) {
	$tokens = explode("|", $p);
	$sTable = $tokens[0];
	$sField = $tokens[1];
	$sWhere = $tokens[2];
	$sWidth = $tokens[3];
	
	$sRecordValue = F_SELECTRECORD("SELECT " . $sField . " FROM " . $sTable . " WHERE " . $sWhere);
	
	if (strtotime($sRecordValue) == TRUE)	{
		$dt = strtotime($sRecordValue);
		$corrected_date=BST_finder($dt);	
		$sRecordValue = date("d-m-Y", $corrected_date);
	}
	
	
	$sRoContent = str_replace("^", " ", $sRecordValue);
	
	$sBoxCode = "<INPUT STYLE='font-size: 13px; font-family: arial; border; groove; border-style: solid; border-width: 1px; border-color: #000000; width: " . $sWidth . "' TYPE=TEXT STYLE=" . "\"" . "{width: 200px; color: #000000}" . "\"" . " ID=txt" . $sField . " NAME=fld" . $sTable . "|" . $sField . " VALUE=" . "\"" . $sRecordValue . "\"" . " onchange=" . "\"" . "execserver('?e=@GBIEXEC&p=UPDATE" . "|" . $sTable . "|" . $sField . "|" . $sWhere . "|" . "' + this.value);" . "\"" . ">";
	
	if (@$_SESSION["GBIPRO"] != "") {
		return $sRoContent;
	}
	else {
		return $sBoxCode;
	}
}

function F_GBITEXTBOX($p) {
	$tokens = explode("|", $p);
	$sTable = $tokens[0];
	$sField = $tokens[1];
	$sWhere = $tokens[2];
	$sWidth = $tokens[3];
	
	$sRecordValue = F_SELECTRECORD("SELECT " . $sField . " FROM " . $sTable . " WHERE " . $sWhere);
		
	$sRoContent = str_replace("^", " ", $sRecordValue);
	
	$sBoxCode = "<INPUT STYLE='font-size: 13px; font-family: arial; border; groove; border-style: solid; border-width: 1px; border-color: #000000; width: " . $sWidth . "' TYPE=TEXT STYLE=" . "\"" . "{width: 200px; color: #000000}" . "\"" . " ID=txt" . $sField . " NAME=fld" . $sTable . "|" . $sField . " VALUE=" . "\"" . $sRoContent . "\"" . " onchange=" . "\"" . "execserver('?e=@GBIEXEC&p=UPDATE" . "|" . $sTable . "|" . $sField . "|" . $sWhere . "|" . "' + this.value);" . "\"" . ">";
	
	if (@$_SESSION["GBIPRO"] != "") {
		return $sRoContent;
	}
	else {
		return $sBoxCode;
	}
}

function F_GBIMEMOBOX($p) {
	$tokens = explode("|", $p);
	$sTable = $tokens[0];
	$sField = $tokens[1];
	$sWhere = $tokens[2];
	
	$sRecordValue = F_SELECTRECORD( "SELECT " . $sField . " FROM " . $sTable . " WHERE " . $sWhere);
		
	$sRoContent = $sRecordValue;
	$sBoxCode = "<TEXTAREA STYLE=\"font-size: 13px; font-family: arial; border; groove; border-style: solid; border-width: 1px; border-color: #000000; width: 90%\" STYLE=" . "\"". "{width: 200px; color: #000000}" . "\"" . " ID=txt" . $sField . " NAME=txt" . $sField . " COLS=\"22\" ROWS=\"5\" onchange=\"execserver('?e=@GBIEXEC&p=UPDATE" . "|" . $sTable . "|" . $sField . "|" . $sWhere . "|" . "' + this.value);\">" . $sRecordValue . "</TEXTAREA>";
	
	if (@$_SESSION["GBIPRO"] != "") {
		return $sRoContent;
	}
	else {
		return $sBoxCode;
	}
}

function F_GBIMEMOIMS($p) {
	$tokens = explode("|", $p);
	$sTable = $tokens[0];
	$sField = $tokens[1];
	$sWhere = $tokens[2];
	
	$sRecordValue = F_SELECTRECORD( "SELECT " . $sField . " FROM " . $sTable . " WHERE " . $sWhere);
		
	$sRoContent = $sRecordValue;
	$sBoxCode = "<TEXTAREA STYLE=\"font-size: 13px; font-family: arial; border; groove; border-style: solid; border-width: 1px; border-color: #000000; width: 90%\" STYLE=" . "\"". "{width: 200px; color: #000000}" . "\"" . " ID=txt" . $sField . " NAME=txt" . $sField . " COLS=\"22\" ROWS=\"5\" >" . $sRecordValue . "</TEXTAREA>";
	
	if (@$_SESSION["GBIPRO"] != "") {
		return $sRoContent;
	}
	else {
		return $sBoxCode;
	}
}


function F_GBIMEMOBOXMORE($p) {
	$tokens = explode("|", $p);
	$sTable = $tokens[0];
	$sField = $tokens[1];
	$sWhereOne = $tokens[2];
	$sWhereTwo = $tokens[3];
	
	
	
	$sRecordValue = F_SELECTRECORD( "SELECT " . $sField . " FROM " . $sTable . " WHERE DATACODE= " . $sWhereOne . " AND ITEMNAAM = '" . $sWhereTwo . "'");
		
	$sRoContent = $sRecordValue;
	$sBoxCode = "<TEXTAREA STYLE=\"font-size: 14px; font-family: verdana; border; groove; border-style: solid; border-width: 1px; border-color: #000000; width: 90%\" TYPE=\"TEXT\" STYLE=\"{width: 200px}\" ID=txt" . $sField . " NAME=txt" . $sField . " COLS=\"22\" ROWS=\"5\" onchange=\"execserver('?e=@GBIEXEC&p=UPDATEMORE" . "|" . $sTable . "|" . $sField . "|" . $sWhereOne . "|" . $sWhereTwo . "|" . "' + this.value);\">" . $sRecordValue . "</TEXTAREA>";
	
	if (@$_SESSION["GBIPRO"] != "") {
		return $sRoContent;
	}
	else {
		return $sBoxCode;
	}
}

function F_GBILISTBOXTYPE($p) {
	$tokens = explode("|", $p);
	$sTable = $tokens[0];
	$sField = $tokens[1];
	$sWhere = $tokens[2];
	$sLookup = $tokens[3];	
	
	$sRecordValue = F_SELECTRECORD( "SELECT " . $sField . " FROM " . $sTable . " WHERE " . $sWhere);
	
	if ($_SESSION["GBIPRO"] != "") {
		return $sRecordValue;
	}
	else {
		$sQuery = F_SELECTRECORD("SELECT * FROM " . $sLookup);
			
		$aRecords = explode("|", $sQuery);
		
		print ("<SELECT onchange=" . "\"" . "execserver('?e=@GBIEXEC&p=UPDATE" . "|" . $sTable . "|" . $sField . "|" . $sWhere . "|" . "' + this.value); " . "\"" . ">\n");
		print ("<OPTION VALUE=" . "\"" . "\"" . "></OPTION>\n");
		
		for ($iRecord = 0; $iRecord < count($aRecords); $iRecord++) {
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sSoort = $aRecord[0];
			
			if ($sRecordValue == $sSoort) {
				print ("<OPTION VALUE=" . "\"" . $sSoort . "\"" . " SELECTED>" . $sSoort . "</OPTION>\n");
			}
			else { 
				print ("<OPTION VALUE=" . "\"" . $sSoort . "\"" . ">" . $sSoort . "</OPTION>\n");
			}			
		}
		print ("</SELECT>\n");
	}
}

function F_GBILISTBOX($p) {
	$tokens = explode("|", $p);
	$sTable = $tokens[0];
	$sField = $tokens[1];
	$sWhere = $tokens[2];
	$sLookup = $tokens[3];
	
	$sRecordValue = F_SELECTRECORD( "SELECT " . $sField . " FROM " . $sTable . " WHERE " . $sWhere);
	
	if (@$_SESSION["GBIPRO"] != "") {
		$sQuery = F_SELECTRECORD("SELECT CONTACTPERSOON FROM " . $sLookup . " WHERE CONTACT_ID = " . $sRecordValue);
		return $sQuery;
	}
	else {	
		$sQuery = F_SELECTRECORD("SELECT CONTACT_ID, CONTACTPERSOON FROM " . $sLookup);
		$aRecords = explode("|", $sQuery);
		
		print ("<SELECT onchange=" . "\"" . "execserver('?e=@GBIEXEC&p=UPDATE" . "|" . $sTable . "|" . $sField . "|" . $sWhere . "|" . "' + this.value); " . "\"" . ">\n");
		print ("<OPTION VALUE=" . "\"" . "\"" . "></OPTION>\n");
		
		for ($iRecord = 0; $iRecord < count($aRecords); $iRecord++) {
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sId = $aRecord[0];
			$sSoort = $aRecord[1];
			
			if ($sRecordValue == $sId) {
				print ("<OPTION VALUE=" . "\"" . $sId . "\"" . " SELECTED>" . $sSoort . "</OPTION>\n"); 
			}
			else {
				print ("<OPTION VALUE=" . "\"" . $sId . "\"" . ">" . $sSoort . "</OPTION>\n");
			}			
		}
		print ("</SELECT>\n");
	}
}

function F_GBITEXTBOXVAST($p) {
	$tokens = explode("|", $p);
	$sTable = $tokens[0];
	$sField = $tokens[1];
	$sWhere = $tokens[2];
	
	$sRecordValue = F_SELECTRECORD("SELECT " . $sField . " FROM " . $sTable . " WHERE " . $sWhere);
	
	$sRoContent = $sRecordValue;
	$sBoxCode = "<INPUT STYLE='border; groove; border-style: solid; background-color: #FFFDE0; border-width: 1px; border-color: #000000; width: 90%' TYPE=TEXT STYLE=" . "\"" . "{width: 200px}" . "\"" . " ID=txt" . $sField . " NAME=fld" . $sTable . "|" . $sField . " VALUE=" . "\"" . $sRecordValue . "\"" . " READONLY>";
	
	if (@$_SESSION["GBIPRO"] != "") {
		return $sRoContent;
	}
	else {
		return $sBoxCode;
	}
}

function F_GBILISTBOXMETA($p) {
	$tokens = explode("|", $p);
	$sTable = $tokens[0];
	$sField = $tokens[1];
	$sWhere = $tokens[2];
	$sLookup = $tokens[3];	
	
	$sRecordValue = F_SELECTRECORD( "SELECT " . $sField . " FROM " . $sTable . " WHERE " . $sWhere);

	if (@$_SESSION["GBIPRO"] != "") {
		if ($sRecordValue == "") {
			return "-";
		}
		else {
			$sQuery = F_SELECTRECORD("SELECT CONTACTPERSOON FROM " . $sLookup . " WHERE CONTACT_ID = " . $sRecordValue);
			return $sQuery;			
		}
	}
	else {	
		$sQuery = F_SELECTRECORD("SELECT CONTACT_ID, CONTACTPERSOON FROM " . $sLookup);
		$aRecords = explode("|", $sQuery);
		
		print ("<SELECT onchange=" . "\"" . "execserver('?e=@GBIEXEC&p=UPDATE" . "|" . $sTable . "|" . $sField . "|" . $sWhere . "|" . "' + this.value); " . "\"" . ">\n");
		print ("<OPTION VALUE=" . "\"" . "\"" . "></OPTION>\n");
		
		for ($iRecord = 0; $iRecord < count($aRecords); $iRecord++) {
			
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sId = $aRecord[0];
			$sSoort = $aRecord[1];
			
			if ($sRecordValue == $sId) {
				print ("<OPTION VALUE=" . "\"" . $sId . "\"" . " SELECTED>" . $sSoort . "</OPTION>\n");
			}
			elseif ($sId == 54) {
				print ("<OPTION VALUE=" . "\"" . $sId . "\"" . ">" . $sSoort . "</OPTION>\n");
			}
			elseif ($sId == 15) {
				print ("<OPTION VALUE=" . "\"" . $sId . "\"" . ">" . $sSoort . "</OPTION>\n");
			}			
		}
		print ("</SELECT>\n");
	}
}

function F_GBILISTBOXGEO($p) {
	$tokens = explode("|", $p);
	$sTable = $tokens[0];
	$sField = $tokens[1];
	$sWhere = $tokens[2];
	$sLookup = $tokens[3];	
	
	$sRecordValue = F_SELECTRECORD( "SELECT " . $sField . " FROM " . $sTable . " WHERE " . $sWhere);
	
	if (@$_SESSION["GBIPRO"] != "") {
		if ($sRecordValue == "") {
			return "-";
		}
		else {
			$sQuery = F_SELECTRECORD("SELECT CONTACTPERSOON FROM " . $sLookup . " WHERE CONTACT_ID = " . $sRecordValue);
			return $sQuery;
		}
	}
	else {	
		$sQuery = F_SELECTRECORD("SELECT CONTACT_ID, CONTACTPERSOON FROM " . $sLookup);
		$aRecords = explode("|", $sQuery);
		
		print ("<SELECT onchange=" . "\"" . "execserver('?e=@GBIEXEC&p=UPDATE" . "|" . $sTable . "|" . $sField . "|" . $sWhere . "|" . "' + this.value);" . "\"" . ">\n");
		print ("<OPTION VALUE=" . "\"" . "\"" . "></OPTION>\n");
		
		for ($iRecord = 0; $iRecord < count($aRecords); $iRecord++) {
			$sRecord = $aRecords[$iRecord];
			$aRecord = explode("^", $sRecord);
			$sId = $aRecord[0];
			$sSoort = $aRecord[1];
			
			if ($sRecordValue == $sId) {
				print ("<OPTION VALUE=" . "\"" . $sId . "\"" . " SELECTED>" . $sSoort . "</OPTION>\n");
			}
			elseif ($sId == 36) {
				print ("<OPTION VALUE=" . "\"" . $sId . "\"" . ">" . $sSoort . "</OPTION>\n");
			}
			elseif ($sId == 68) {
				print ("<OPTION VALUE=" . "\"" . $sId . "\"" . ">" . $sSoort . "</OPTION>\n");
			}			
		}
		print ("</SELECT>\n");
	}
}

function F_DELETERECORD($p) {
	global $db, $dsn;
	$db->Connect($dsn); 
	$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
	$query = $p;	
	$result = $db->Execute($query);
	if ($result == false) {		
		die ('error');
	}
}

function F_CREATERECORD($p) {
	global $db, $dsn;
	$db->Connect($dsn); 
	$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
	$query = $p;	
	$result = $db->Execute($query);
	if ($result == false) {		
		die ('error');
	}
}

function F_SELECTRECORD($p) {
//global $DBCON;
global $db, $dsn;

$db->Connect($dsn); 

$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	
$query = $p;
//print $query;

$result = $db->Execute($query);

if ($result == false) {		
	die ('error');
}
 	
$res = "";


if (!$result->EOF) {
		$iCount = $result->FieldCount();
		$iCountMin1 = $iCount - 1;
}
	
	
while (!$result->EOF) {
	for ($iCol = 0; $iCol <= $iCountMin1; $iCol++) {
		$res = $res . $result->fields[$iCol];
		if ($iCol < $iCountMin1) {
			$res = $res . "^";
		}
	}
	$result->MoveNext();
	
	if (!$result->EOF) {
		$res = $res . "|";
	}
}	

return $res;		



/*
if ($objRst->recordcount() > 0) {
	$objRst->movefirst();
	if (!$objRst->EOF) {
		$iCount = $objRst->Fields->Count();
		$iCountMin1 = $iCount;
	}
			
	while (!$objRst->EOF) {
		for ($iCol = 0; $iCol < $iCountMin1; $iCol++) {
			$res = $res . $objRst->Fields[$iCol]->Value;
			//print $res;
			if ($iCol < $iCountMin1 - 1) { 
				$res = $res . "^";
			}
			
		}
		$objRst->Movenext();
				
		if (!$objRst->EOF) {
			$res = $res . "|";
		}
	}	
	return $res;
}
else {
	return "";
}
*/



}

function F_ISWRITABLE($p) {
$tokens = explode("|", $p);       
if ($_SESSION["GBIMUTEREN"] == TRUE) {
	return TRUE;
}
else {
	return FALSE;
}
}

function F_ENDSTYLE() {
print("</DIV>\n");
//print("<DIV id=\"footer\">Provincie Drenthe | Geoportaal\n");
print("<DIV id=\"footer\">\n");
print("<CENTER><IMG SRC=\"images/wapenklein.png\"></CENTER>\n");
//print("Layout based on <a href=\"http://www.yaml.de/\">YAML</a></div>\n");
print("</DIV>\n");
print("</DIV>\n");
print("</BODY>\n");
print("</HTML>\n");
}


function F_STYLE() {
print("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n");
print("<HTML XMLNS=\"http://www.w3.org/1999/xhtml\" xml:lang=\"nl\" lang=\"nl\">\n");
print("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"/>\n");
//print("<style type=\"text/css\" media=\"all\">@import \"style/style.css\";</style>\n");
print("<HEAD>\n");
print("<TITLE>GBI Meta-data | Provincie Drenthe</TITLE>\n");
print("<link href=\"css/geoportaal.css\" rel=\"stylesheet\" type=\"text/css\"/>\n");
//print("<!--[if lte IE 6]>\n");
print("<link href=\"css/patches/patch_my_layout.css\" rel=\"stylesheet\" type=\"text/css\"/>\n");
//print("<![endif]-->\n");

print("<SCRIPT LANGUAGE=JavaScript>\n");

print("function initPopup() {\n");
print(" var iframeEl = document.getElementById('WAITFRAME');\n");
print("iframeEl.style.display='none';\n");
print("}\n");
	 
print("function back(){\n");
print("var iframeEl = document.getElementById('WAITFRAME');\n");
print("iframeEl.style.display='none';\n");
print("}\n");

print("function execserver(ss) {\n");
print("WAITFRAME.document.location = ss;\n");
print("var iframeEl = document.getElementById('WAITFRAME');\n");
print("iframeEl.style.display='none';\n");
print("}\n");
	 
print("</SCRIPT>\n");
print("</HEAD>\n");
print("<BODY>\n");

print("<div id=\"page_margins\">\n");
print("<div id=\"page\">\n");
print("<div id=\"header\">\n");
print("<div id=\"topnav\">\n");
print("<a class=\"skip\" href=\"#navigation\" title=\"skip link\">Skip to the navigation</a><span class=\"hideme\">.</span>\n");
print("<a class=\"skip\" href=\"#content\" title=\"skip link\">Skip to the content</a><span class=\"hideme\">.</span>\n");
print("<span><a href=\"index.php\">Hoofdmenu</a></span> </div>\n");
print("</div>\n");

print("<div id=\"nav\"> <a id=\"navigation\" name=\"navigation\"></a>\n");
print("<div id=\"nav_main\">\n");
print("</div>\n");
print("</div>\n");

print("<div id=\"main\">\n");
print ("<BODY>\n");
print ("<SCRIPT TYPE=\"text/javascript\" SRC=\"js\wz_tooltip.js\"></SCRIPT>\n");
}

?>
