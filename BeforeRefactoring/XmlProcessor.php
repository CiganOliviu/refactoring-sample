<?php
function process ($node) {
  $child = $node -> childNodes;
  foreach ($child as $element) {
    if ($element -> nodeType == XML_TEXT_NODE) {
      if (strlen(trim($element->nodeValue))) {
        echo(trim($element->nodeValue));
        echo("<br>");
      }
    } else if ($element -> nodeType == XML_ELEMENT_NODE) {
      process($element);
    }
  }
}

$dom = new DOMDocument();
$dom->load("../Data/contest.xml");
$root = $dom->documentElement;
process($root);
?>
