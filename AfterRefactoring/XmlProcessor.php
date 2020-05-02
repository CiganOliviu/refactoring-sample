<?php

class XMLDataProcessor {
	
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
		
		$DOM->load("../Data/contest.xml");
		
		$root = $DOM->documentElement;
		
		$this->ProcessXMLData($root);
	}
}

$Processor = new XMLDataProcessor();

$DOM = new DOMDocument();

$Processor->SetupProcess($DOM);

?>
