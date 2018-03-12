<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* End of file mdl_yaz.php */
/* Location: ./application/modules/bibliografiak/models/mdl_yaz.php */

class Mdl_yaz extends CI_Model
{

	public $data = array(
		'cim' => '',
		'egyeb_cimek' => '',
		'szerzok' => '',
		'kiemelt_rendszavak' => '',
		'egyeb_rendszavak' => '',
		'testuleti_szerzo' => '',
		'kiadas_jelzes' => '',
		'lelohely' => '',
		'dok_stat' => '',
		'megjelenes' => '',
		'terjedelem' => '',
		'sorozat' => '',
		'kozos_megj' => '',
		'peldany_megj' => '',
		'isbn' => '',
		'kotes' => '',
		'gyari_szam' => '',
		'nemzetkozi_azonosito' => '',
		'feltuntett_ar' => '',
		'targyszavak' => '',
		'eto' => '',
		'targyi_mutato' => '',
		'kozos_sec_adatok' => '',
		'saj_spec_adat' => '',
		'csz' => '');

	function __construct()
	{
		parent::__construct();
	}

	function fetch_data_from_library($server, $syntax, $ccl_query, $offset=0, $limit=20)
	{
		//CONNECT

		// Server URL with port and database descriptor
#		$server = "z3950.obvsg.at:9991/ACC01";
#		$syntax = "mab";
		// for USMARC example uncomment next $server and $syntax defs
		// $server = "aleph.unibas.ch:9909/IDS_UTF";
		// $syntax = "usmarc";
		// Mapping CCL keywords to Bib-1-Attributes (allows convenient query formulation)

		//Használati attributumok (1)
	$fields = array(
	//				"personal_name" => "1=1",
	//				"corporate_name" => "1=2",
	//				"conference_name" => "1=3",
	/*kell*/		"title" => "1=4",
	//				"title_series" => "1=5",
	//				"title_uniform" => "1=6",
	/*kell*/		"isbn" => "1=7",
	//				"issn" => "1=8",
	//				"lC_card_number" => "1=9",
	//				"bnb_card_no" => "1=10",
	//				"bgf_number" => "1=11",
	//				"local_number" => "1=12",
	/*kell*/		"dewey_classification" => "1=13",
	//				"udc_classification" => "1=14",
	//				"bliss_classification" => "1=15",
	//				"lC_call_number" => "1=16",
	//				"nlm_call_number" => "1=17",
	//				"nal_call_number" => "1=18",
	//				"mos_call_number" => "1=19",
	//				"local_classification" => "1=20",
	/*kell*/		"subject_heading" => "1=21",
	//				"subject_rameau" => "1=22",
	//				"bdi_index_subject" => "1=23",
	//				"inspec_subject" => "1=24",
	//				"mesh_subject" => "1=25",
	//				"pa_subject" => "1=26",
	//				"lc_subject_heading" => "1=27",
	//				"rvm_subject_heading" => "1=28",
	//				"local_subject_index" => "1=29",
	//				"date" => "1=30",
	/*kell*/		"date_of_publication" => "1=31",
	//				"date_of_acquisition" => "1=32",
	//				"title_key" => "1=33",
	//				"title_collective" => "1=34",
	//				"title_parallel" => "1=35",
	//				"title_cover" => "1=36",
	//				"title_added_title_page" => "1=37",
	//				"title_caption" => "1=38",
	//				"title_running" => "1=39",
	//				"title_spine" => "1=40",
	//				"title_other_variant" => "1=41",
	//				"title_former" => "1=42",
	//				"title_abbreviated" => "1=43",
	//				"title_expanded" => "1=44",
	//				"subject_precis" => "1=45",
	//				"subject_rswk" => "1=46",
	//				"subject_subdivision" => "1=47",
	//				"no_natl_biblio" => "1=48",
	//				"no_legal_deposit" => "1=49",
	//				"no_govt_pub" => "1=50",
	//				"no_music_publisher" => "1=51",
	//				"number_db" => "1=52",
	//				"number_local_call" => "1=53",
	//				"code__language" => "1=54",
	//				"code__geographic_area" => "1=55",
	//				"code__institution" => "1=56",
	//				"name_and_title *" => "1=57",
	//				"name_geographic" => "1=58",
	//				"place_publication" => "1=59",
	//				"coden" => "1=60",
	//				"microform_generation" => "1=61",
	//				"abstract" => "1=62",
	//				"note" => "1=63",
	//				"author_title" => "1=1000",
	//				"record_type" => "1=1001",
	//				"name" => "1=1002",
	//				"author" => "1=1003",
	/*kell*/		"author_name_personal" => "1=1004",
	//				"author_name_corporate" => "1=1005",
	//				"author_name_conference" => "1=1006",
	//				"identifier__standard" => "1=1007",
	//				"subject__lC_children's" => "1=1008",
	//				"subject_name__personal" => "1=1009",
	//				"body_of_text" => "1=1010",
	//				"date_time_added_to_db" => "1=1011",
	//				"date_time_last_modified" => "1=1012",
	//				"authority_format_id" => "1=1013",
	//				"concept_text" => "1=1014",
	//				"concept_reference" => "1=1015",
	//				"any" => "1=1016",
	//				"server_choice" => "1=1017",
	/*kell*/		"publisher" => "1=1018",
	//				"record_source" => "1=1019",
	//				"editor" => "1=1020",
	//				"bib_level" => "1=1021",
	//				"geographic_class" => "1=1022",
	//				"indexed_by" => "1=1023",
	//				"map_scale" => "1=1024",
	//				"music_key" => "1=1025",
	//				"related_periodical" => "1=1026",
	//				"report_number" => "1=1027",
	//				"stock_number" => "1=1028",
	//				"thematic_number" => "1=1030",
	//				"material_type" => "1=1031",
	//				"doc_id" => "1=1032",
	//				"host_item" => "1=1033",
	/*kell*/		"content_type" => "1=1034");
	//				"anywhere" => "1=1035",
	//				"author_title_subject" => "1=1036");


		// establish connection and store session identifier,
		// credentials are an optional second parameter in format "<user>/<passwd>"
		$session = yaz_connect($server, array('charset' => 'UTF-8'));
		// check whether an error occurred
		if (yaz_error($session) != ""){
		    die("[{}]");//die("Error: " . yaz_error($session));
		}
		// configure desired result syntax (must be specified in Target Profile)
		yaz_syntax($session, $syntax);
		// configure YAZ's CCL parser with the mapping from above
		yaz_ccl_conf($session, $fields);
		// define a query using CCL (allowed operators are 'and', 'or', 'not')
		// available fields are the ones in $fields (again see Target Profile)
#		$ccl_query = "(wpe = Liggesmeyer) and (wpe = Peter)";
		// let YAZ parse the query and check for error
		if (!yaz_ccl_parse($session, $ccl_query, $ccl_result)){
		        die("[{}]");//die("The query could not be parsed.");
		} else{
		    // fetch RPN result from the parser
		    $rpn = $ccl_result["rpn"];
		    // do the actual query
		    yaz_search($session, "rpn", $rpn);
		    // wait blocks until the query is done
		    yaz_wait();
		    if (yaz_error($session) != ""){
		        die("[{}]");//die("Error: " . yaz_error($session));
		    }
		    // yaz_hits returns the amount of found records
		    if (yaz_hits($session) > 0){
#		        echo "Found some hits:<br>";
		        // yaz_record fetches a record from the current result set,
		        // so far I've only seen server supporting string format

		        //$item_number = yaz_hits($session);

		        $total_records = array();

		        for ($i=$offset; $i < $limit; $i++) { 

			        $result = yaz_record($session, $i, "string; charset=hunmarc,UTF-8");
#			        print("<pre>".$result."</pre>");
#			        echo "<br><br>";
			        // the parsing functions will be introduced later
			        if($syntax == "mab")
			            $parsedResult = $this->parse_mab_string($result);
			        else
			            $parsedResult = $this->parse_usmarc_string($result);

			        array_push($total_records, $parsedResult);
			        /*
			        if(sizeof($parsedResult) != 0)
			        {
			        	var_dump($parsedResult);		        	
			        }
					*/
			    }

		        if(!isset($total_records))
				{
					return "";
				}
				return $total_records;

		    } //else
		        //echo "No records found.";
		}		
	}

	//MAB

	function parse_mab_string($record){
	    $result = array();
	    // exchange some characters that are returned malformed (collected over time))
	    $record = $this->exchange_chars($record);
	    // split the returned fields at the record separator character
	    $record = explode(chr(0x001E),$record);
	    // cut of meta data of the record
	    $record[0] = substr($record[0], strpos($record[0],"h001") + 1);
	    // examine all fields and extract their contents, the last entry is always empty
	    for ($datnum = 0; $datnum <= count($record)-2; $datnum++){
	        $data = $record[$datnum];
	        // the first 4 chars are the field id
	        $field = substr($data,0,4);
	        if (!isset($result[$field]))
	            $result[$field] = array();
	        // the remaining substring is the field value
	        array_push($result[$field],substr($record[$datnum],4));
	    }
	    return $result;
	}
	 
	// the following helper function restores a collection of malformed characters,
	// it is based on nearly 3 years experience with several Z39.50 servers
	function exchange_chars($rep_string){
	    $bad_chars = array(chr(0x00C9)."o", chr(0x00C9)."O", chr(0x00C9)."a",
	                       chr(0x00C9)."A", chr(0x00C9)."u", chr(0x00C9)."U",
	                       chr(137), chr(136), chr(251) , chr(194)."a" ,
	                       chr(194)."i", chr(194)."e", chr(208)."c", chr(194)."E",
	                       chr(207)."c", chr(207)."s", chr(207)."S", chr(201)."i",
	                       chr(200)."e", chr(193)."e", chr(193)."a", chr(193)."i",
	                       chr(193)."o", chr(193)."u", chr(195)."u", chr(201)."e",
	                       chr(195).chr(194), "&amp;#263;", "Ã¤");
	    $rep_chars = array(     "&ouml;"  ,    "&Ouml;"    ,    "&auml;"    ,
	                            "&Auml;"  ,     "&uuml;"   ,     "&Uuml;"   ,
	                          ""   ,    ""   , "&szlig;",  "&aacute;"  , 
	                       "&iacute;"  , "&eacute;"  , "&ccedil;"  , "&Eacute;"  ,
	                       "&#269;"    , "&#353;"    , "&#352;"    , "&iuml;"    ,
	                       "&euml;"    , "&egrave;"  , "&agrave;"  , "&igrave;"  ,
	                       "oegrave;"  , "&ugrave;"  , "&ucirc;"   , "&euml;"    ,
	                       "&auml;"         , "&#263;"    , "&auml;");
	    return str_replace($bad_chars, $rep_chars, $rep_string);
	}


	//MARC

	function parse_usmarc_string($record){
	    $ret = array();
	    $ret['data'] = $record;
	    // there was a case where angle brackets interfered
	    $record = str_replace(array("<", ">"), array("",""), $record);
	    $record = $record;
	    // split the returned fields at their separation character (newline)
	    $record = explode("\n",$record);
	    //examine each line for wanted information (see USMARC spec for details)
	    foreach($record as $category){
	        // subfield indicators are preceded by a $ sign
	        $parts = explode("$", $category);
	        // remove leading and trailing spaces
	        array_walk($parts, array($this, "custom_trim"));
	        // the first value holds the field id,
	        // depending on the desired info a certain subfield value is retrieved
	        switch(substr($parts[0],0,3)){
	            case "008" : $ret["language"] = substr($parts[0],39,3); break;
	            case "015" : $ret["national_no"] = $this->get_subfield_value($parts,"a"); break;
	            case "020" : $ret["isbn"] = $this->get_subfield_value($parts,"a"); break;
	            case "022" : $ret["issn"] = $this->get_subfield_value($parts,"a"); break;	   
	            case "082" : $ret["eto"] = $this->get_subfield_value($parts,"a"); break;	            
	            case "100" : $ret["author"] = $this->get_subfield_value($parts,"a")." ".$this->get_subfield_value($parts,"j"); break;
	            case "245" : $ret["titel"] = $this->get_subfield_value($parts,"a");
	                         $ret["subtitel"] = $this->get_subfield_value($parts,"b"); break;
	            case "250" : $ret["edition"] = $this->get_subfield_value($parts,"a"); break;
	            case "260" : $ret["pub_date"] = $this->get_subfield_value($parts,"c");
	                         $ret["pub_place"] = $this->get_subfield_value($parts,"a");
	                         $ret["publisher"] = $this->get_subfield_value($parts,"b"); break;
	            case "300" : $ret["extent"] = $this->get_subfield_value($parts,"a");
	                         $ext_b = $this->get_subfield_value($parts,"b");
	                         $ret["extent"] .= ($ext_b != "") ? (" : " . $ext_b) : "";
	                         break;
	            case "365" : $ret["trade_price"] = $this->get_subfield_value($parts,"a"); break;
	            case "490" : $ret["series"] = $this->get_subfield_value($parts,"a"); break;
	            case "502" : $ret["diss_note"] = $this->get_subfield_value($parts,"a"); break;
	            case "514" : $ret["quality_note"] = $this->get_subfield_value($parts,"z"); break;
	            case "655" : $ret["genre"] = $this->get_subfield_value($parts,"a"); break;
	            case "700" : $ret["editor"] = $this->get_subfield_value($parts,"a"); break;
	        }
	    }
	    return $ret;
	}
	 
	// fetches the value of a certain subfield given its label
	function get_subfield_value($parts, $subfield_label){
	    $ret = "";
	    foreach ($parts as $subfield)
	        if(substr($subfield,0,1) == $subfield_label)
	            $ret = substr($subfield,2);
	    return $ret;
	}
	 
	// wrapper function for trim to pass it to array_walk
	function custom_trim(& $value, & $key){
	    $value = trim($value);
	}

}



//saját adatok
//cím,egyéb címek,szerzők,kiemelt rendszavak,egyéb rendszavak,testületi szerző,kiadás jelzés,lelőhely,dok stat,megjelenés,terjedelem,sorozat,közös megj.,példány megj.,ISBN,Kötés,gyári szám,nemzetközi azonosító,feltüntett ár,tárgyszavak,eto,tárgyi mutató,közös sec adatok,saj spec adat,csz
/*
001 - Control Number
	(Ellenőrzési szám)
003 - Control Number Identifier
	(Ellenőrzési szám azonosító)
005 - Date and Time of Latest Transaction
	(A legutóbbi tranzakció dátuma és ideje)
006 - Fixed-Length Data Elements - Additional Material Characteristics
	(Rögzített hosszúságú adat elemek - Járulékos Karakter Anyagok)
007 - Physical Description Fixed Field
	(Fizikai Részletek Rögzített Mező)
008 - Fixed-Length Data Elements
	(Rögzített Hosszúságú Adat Elemek)
010 - Library of Congress Control Number (NR)
	(A Kongresszusi Könyvtár Ellenőrző Száma (NR)) 
013 - Patent Control Information (R) 
	(Szabadalom Ellenőrző Szám (R))
015 - National Bibliography Number (R)
	(Nemzeti Bibliográfiai szám(R)) 
016 - National Bibliographic Agency Control Number (R)
	(Nemzeti Bibliográfiai Ügynökség Ellenőrző szám(R)) 
017 - Copyright or Legal Deposit Number (R) 
	(Szerzői jog vagy Jogi utalvány száma(R))
018 - Copyright Article-Fee Code (NR) 
	(Szerzői jogcím-díj kód (NR))
020 - International Standard Book Number (R)
	(Nemzetközi Szabványkönyv (R)) 
022 - International Standard Serial Number (R)
	(Nemzetközi szabványos sorozatszám (R)) 
024 - Other Standard Identifier (R) 
	(Egyéb szabványazonosító (R))
025 - Overseas Acquisition Number (R) 
026 - Fingerprint Identifier (R) 
027 - Standard Technical Report Number (R) 
028 - Publisher or Distributor Number (R) 
030 - CODEN Designation (R) 
031 - Musical Incipits Information (R) 
032 - Postal Registration Number (R) 
033 - Date/Time and Place of an Event (R) 
034 - Coded Cartographic Mathematical Data (R) 
035 - System Control Number (R) 
036 - Original Study Number for Computer Data Files (NR) 
037 - Source of Acquisition (R) 
038 - Record Content Licensor (NR) 
040 - Cataloging Source (NR) 
041 - Language Code (R) 
042 - Authentication Code (NR) 
043 - Geographic Area Code (NR) 
044 - Country of Publishing/Producing Entity Code (NR) 
045 - Time Period of Content (NR) 
046 - Special Coded Dates (R) 
047 - Form of Musical Composition Code (R) 
048 - Number of Musical Instruments or Voices Codes (R) 
050 - Library of Congress Call Number (R) 
051 - Library of Congress Copy, Issue, Offprint Statement (R) 
052 - Geographic Classification (R) 
055 - Classification Numbers Assigned in Canada (R) 
060 - National Library of Medicine Call Number (R) 
061 - National Library of Medicine Copy Statement (R) 
066 - Character Sets Present (NR) 
070 - National Agricultural Library Call Number (R) 
071 - National Agricultural Library Copy Statement (R) 
072 - Subject Category Code (R) 
074 - GPO Item Number (R) 
080 - Universal Decimal Classification Number (R) 
082 - Dewey Decimal Classification Number (R) 
083 - Additional Dewey Decimal Classification Number (R) 
084 - Other Classification Number (R) 
085 - Synthesized Classification Number Components (R) 
086 - Government Document Classification Number (R) 
088 - Report Number (R) 
09X - Local Call Numbers 
100 - Main Entry - Personal Name (NR)
110 - Main Entry - Corporate Name (NR)
111 - Main Entry - Meeting Name (NR)
130 - Main Entry - Uniform Title (NR)
210 - Abbreviated Title (R)
222 - Key Title (R)
240 - Uniform Title (NR)
242 - Translation of Title by Cataloging Agency (R)
243 - Collective Uniform Title (NR)
245 - Title Statement (NR)
246 - Varying Form of Title (R)
247 - Former Title (R)
250 - Edition Statement (R) 
254 - Musical Presentation Statement (NR) 
255 - Cartographic Mathematical Data (R) 
256 - Computer File Characteristics (NR) 
257 - Country of Producing Entity (R) 
258 - Philatelic Issue Data (R) 
260 - Publication, Distribution, etc. (Imprint) (R) 
263 - Projected Publication Date (NR) 
264 - Production, Publication, Distribution, Manufacture, and Copyright Notice (R) 
270 - Address (R) 
300 - Physical Description (R) 
306 - Playing Time (NR) 
307 - Hours, etc. (R) 
310 - Current Publication Frequency (NR) 
321 - Former Publication Frequency (R) 
336 - Content Type (R) 
337 - Media Type (R) 
338 - Carrier Type (R) 
340 - Physical Medium (R) 
342 - Geospatial Reference Data (R) 
343 - Planar Coordinate Data (R) 
344 - Sound Characteristics (R) 
345 - Projection Characteristics of Moving Image (R) 
346 - Video Characteristics (R) 
347 - Digital File Characteristics (R) 
348 - Format of Notated Music (R) 
351 - Organization and Arrangement of Materials (R) 
352 - Digital Graphic Representation (R) 
355 - Security Classification Control (R) 
357 - Originator Dissemination Control (NR) 
362 - Dates of Publication and/or Sequential Designation (R) 
363 - Normalized Date and Sequential Designation (R) 
365 - Trade Price (R) 
366 - Trade Availability Information (R) 
370 - Associated Place (R) 
377 - Associated Language (R) 
380 - Form of Work (R) 
381 - Other Distinguishing Characteristics of Work or Expression (R) 
382 - Medium of Performance (R) 
383 - Numeric Designation of Musical Work (R) 
384 - Key (NR) 
385 - Audience Characteristics (R) 
386 - Creator/Contributor Characteristics (R) 
388 - Time Period of Creation (R) 
490 - Series Statement (R)
500 - General Note (R)
501 - With Note (R)
502 - Dissertation Note (R)
504 - Bibliography, etc. Note (R)
505 - Formatted Contents Note (R)
506 - Restrictions on Access Note (R)
507 - Scale Note for Graphic Material (NR)
508 - Creation/Production Credits Note (R)
510 - Citation/References Note (R)
511 - Participant or Performer Note (R)
513 - Type of Report and Period Covered Note (R)
514 - Data Quality Note (NR)
515 - Numbering Peculiarities Note (R)
516 - Type of Computer File or Data Note (R)
518 - Date/Time and Place of an Event Note (R)
520 - Summary, etc. (R)
521 - Target Audience Note (R)
522 - Geographic Coverage Note (R)
524 - Preferred Citation of Described Materials Note (R)
525 - Supplement Note (R)
526 - Study Program Information Note (R)
530 - Additional Physical Form available Note (R)
533 - Reproduction Note (R)
534 - Original Version Note (R)
535 - Location of Originals/Duplicates Note (R)
536 - Funding Information Note (R)
538 - System Details Note (R)
540 - Terms Governing Use and Reproduction Note (R)
541 - Immediate Source of Acquisition Note (R)
542 - Information Relating to Copyright Status (R)
544 - Location of Other Archival Materials Note (R)
545 - Biographical or Historical Data (R)
546 - Language Note (R)
547 - Former Title Complexity Note (R)
550 - Issuing Body Note (R)
552 - Entity and Attribute Information Note (R)
555 - Cumulative Index/Finding Aids Note (R)
556 - Information About Documentation Note (R)
561 - Ownership and Custodial History (R)
562 - Copy and Version Identification Note (R)
563 - Binding Information (R)
565 - Case File Characteristics Note (R)
567 - Methodology Note (R)
580 - Linking Entry Complexity Note (R)
581 - Publications About Described Materials Note (R)
583 - Action Note (R)
584 - Accumulation and Frequency of Use Note (R)
585 - Exhibitions Note (R)
586 - Awards Note (R)
588 - Source of Description Note (R)
59X - Local Notes
600 - Subject Added Entry - Personal Name (R) 
610 - Subject Added Entry - Corporate Name (R) 
611 - Subject Added Entry - Meeting Name (R) 
630 - Subject Added Entry - Uniform Title (R) 
647 - Subject Added Entry - Named Event (R) 
648 - Subject Added Entry - Chronological Term (R) 
650 - Subject Added Entry - Topical Term (R) 
651 - Subject Added Entry - Geographic Name (R) 
653 - Index Term - Uncontrolled (R) 
654 - Subject Added Entry - Faceted Topical Terms (R) 
655 - Index Term - Genre/Form (R) 
656 - Index Term - Occupation (R) 
657 - Index Term - Function (R) 
658 - Index Term - Curriculum Objective (R) 
662 - Subject Added Entry - Hierarchical Place Name (R) 
69X - Local Subject Access Fields (R) 
700 - Added Entry - Personal Name (R) 
710 - Added Entry - Corporate Name (R) 
711 - Added Entry - Meeting Name (R) 
720 - Added Entry - Uncontrolled Name (R) 
730 - Added Entry - Uniform Title (R) 
740 - Added Entry - Uncontrolled Related/Analytical Title (R) 
751 - Added Entry - Geographic Name (R) 
752 - Added Entry - Hierarchical Place Name (R) 
753 - System Details Access to Computer Files (R) 
754 - Added Entry - Taxonomic Identification (R) 
758 - Resource Identifier (R) 
760 - Main Series Entry (R) 
762 - Subseries Entry (R) 
765 - Original Language Entry (R) 
767 - Translation Entry (R) 
770 - Supplement/Special Issue Entry (R) 
772 - Supplement Parent Entry (R) 
773 - Host Item Entry (R) 
774 - Constituent Unit Entry (R) 
775 - Other Edition Entry (R) 
776 - Additional Physical Form Entry (R) 
777 - Issued With Entry (R) 
780 - Preceding Entry (R) 
785 - Succeeding Entry (R) 
786 - Data Source Entry (R) 
787 - Other Relationship Entry (R) 
800 - Series Added Entry - Personal Name (R)
810 - Series Added Entry - Corporate Name (R)
811 - Series Added Entry - Meeting Name (R)
830 - Series Added Entry - Uniform Title (R)
*/

?>