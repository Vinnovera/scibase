<?php
/*
Template Name: Press RSS

*/

require_once(get_stylesheet_directory()."/components/XmlToRss.class.php");

$x = new XmlToRss();

$x->url('http://investors.scibase.se/afw/data/?type=press&issuer=scibase&lang=en&format=xml');
  $x->title('Press Releases from Scibase');
  $x->description('Syndicated from AlertIR');
  $x->item('/*/*/*/*');
  $x->map(array(
  	'title' => 'headline',
    'description' => 'body',  
    'pubDate'=>'published',
    'enclosure'=>'files',
));
$x->autoConvert();


?>