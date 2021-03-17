<?php

class FileDataSource {

	public string $FileSource;
}

interface ParsingRequirements {

	public function SourceAssignation ($Source, FileDataSource $DataSource);
}

class XMLDataProcessor implements ParsingRequirements {

	private function OutputTrimData ($ValueToTrim): void {

		echo(trim($ValueToTrim));
		echo("</br>");
	}

	/**
	 * @param $Element
	 */
	private function GetDataIfElementIsNodeValue($Element): void
	{
		if (strlen(trim($Element->nodeValue)))
			$this->OutputTrimData($Element->nodeValue);
	}

	private function ProcessXMLData ($Node): void {

	  $Child = $Node -> childNodes;

	  foreach ($Child as $Element)

	    if ($Element -> nodeType == XML_TEXT_NODE)
			$this->GetDataIfElementIsNodeValue($Element);

		else if ($Element -> nodeType == XML_ELEMENT_NODE)
	      $this -> ProcessXMLData($Element);
	}

	public function SourceAssignation ($Source, FileDataSource $DataSource): void {

		$DataSource->FileSource = $Source;
	} 

	public function SetupProcess ($DOM, FileDataSource $DataSource): void {

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
