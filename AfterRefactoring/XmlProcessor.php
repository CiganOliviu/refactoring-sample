<?php

interface ParsingRequirements {

	public function SourceAssignation ($Source);
}

class XMLDataProcessor implements ParsingRequirements {

	private string $FileSource;

	public function SourceAssignation ($Source) {

		$this->FileSource = $Source;
	} 

	private function OutputTrimData ($ValueToTrim) {

		echo(trim($ValueToTrim));
		echo("</br>");
	}

	private function ProcessXMLData ($Node) {

	  $Child = $Node -> childNodes;

	  foreach ($Child as $Element)

	    if ($Element -> nodeType == XML_TEXT_NODE) {

	      if (strlen(trim($Element->nodeValue)))
	      	$this->OutputTrimData($Element->nodeValue);

	    } else if ($Element -> nodeType == XML_ELEMENT_NODE)
	      $this->ProcessXMLData($Element);
	}

	public function SetupProcess ($DOM) {

		$DOM->load($this->FileSource);

		$root = $DOM->documentElement;

		$this->ProcessXMLData($root);
	}
}

$Processor = new XMLDataProcessor();

$Processor->SourceAssignation("../Data/contest.xml");

$DOM = new DOMDocument();

$Processor->SetupProcess($DOM);

?>
