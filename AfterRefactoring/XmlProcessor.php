<?php

class FileDataSource {

	public string $FileSource;
}

interface ParsingRequirements {

	public function SourceAssignation ($Source, FileDataSource $DataSource);
}

class XMLDataProcessor implements ParsingRequirements {

	private function OutputTrimData ($ValueToTrim) {

		echo(trim($ValueToTrim));
		echo("</br>");
	}

	private function ProcessXMLData ($Node) {

	  $Child = $Node -> childNodes;

	  foreach ($Child as $Element)

	    if ($Element -> nodeType == XML_TEXT_NODE) {

	      if (strlen(trim($Element->nodeValue)))
	      	$this -> OutputTrimData($Element->nodeValue);

	    } else if ($Element -> nodeType == XML_ELEMENT_NODE)
	      $this -> ProcessXMLData($Element);
	}

	public function SourceAssignation ($Source, FileDataSource $DataSource) {

		$DataSource->FileSource = $Source;
	} 

	public function SetupProcess ($DOM, FileDataSource $DataSource) {

		$DOM -> load($DataSource->FileSource);

		$root = $DOM->documentElement;

		$this -> ProcessXMLData($root);
	}
}

$Processor = new XMLDataProcessor ();
$DataSource = new FileDataSource ();
$Processor -> SourceAssignation("../Data/contest.xml", $DataSource);

$DOM = new DOMDocument();

$Processor -> SetupProcess($DOM, $DataSource);

?>
