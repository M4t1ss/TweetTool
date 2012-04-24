<?php
//Funkcija, kas iedala saòemto tekstu kâdâ no desmit kategorijâm
function klasifice($teksts){
	require_once("includes/uClassify.php");
	$uclassify = new uClassify();
	$uclassify->setReadApiKey('lM4DcjlmV0iw881Dm3Dl7XzaY');
	$uclassify->setWriteApiKey('5fkazcNINcFf7zdIAbq1Ve6106M');
	try {			
		$title = 'Topics';
		$resp = $uclassify->classify($teksts, 'Topics', 'uClassify');
		
		$Arts = $resp[0]['classification'][0]['p'];$Business = $resp[0]['classification'][1]['p'];
		$Computers = $resp[0]['classification'][2]['p'];$Games = $resp[0]['classification'][3]['p'];
		$Health = $resp[0]['classification'][4]['p'];$Home = $resp[0]['classification'][5]['p'];
		$Recreation = $resp[0]['classification'][6]['p'];$Science = $resp[0]['classification'][7]['p'];
		$Society = $resp[0]['classification'][8]['p'];$Sports = $resp[0]['classification'][9]['p'];
		if(max($Arts,$Business,$Computers,$Games,$Health,$Home,$Recreation,$Science,$Society,$Sports) == $Arts){
			return "Arts";
		}else if(max($Arts,$Business,$Computers,$Games,$Health,$Home,$Recreation,$Science,$Society,$Sports) == $Business){
			return "Business";
		}else if(max($Arts,$Business,$Computers,$Games,$Health,$Home,$Recreation,$Science,$Society,$Sports) == $Computers){
			return "Computer";
		}else if(max($Arts,$Business,$Computers,$Games,$Health,$Home,$Recreation,$Science,$Society,$Sports) == $Games){
			return "Games";
		}else if(max($Arts,$Business,$Computers,$Games,$Health,$Home,$Recreation,$Science,$Society,$Sports) == $Health){
			return "Health";
		}else if(max($Arts,$Business,$Computers,$Games,$Health,$Home,$Recreation,$Science,$Society,$Sports) == $Home){
			return "Home";
		}else if(max($Arts,$Business,$Computers,$Games,$Health,$Home,$Recreation,$Science,$Society,$Sports) == $Recreation){
			return "Recreation";
		}else if(max($Arts,$Business,$Computers,$Games,$Health,$Home,$Recreation,$Science,$Society,$Sports) == $Science){
			return "Science";
		}else if(max($Arts,$Business,$Computers,$Games,$Health,$Home,$Recreation,$Science,$Society,$Sports) == $Society){
			return "Society";
		}else if(max($Arts,$Business,$Computers,$Games,$Health,$Home,$Recreation,$Science,$Society,$Sports) == $Sports){
			return "Sport";
		}
	} catch (uClassifyException $e) {
		die($e->getMessage());
	}
}
//Funkcija, kas sagâdâ masîvu ar vârdu savienojumiem par konkrçto tçmu
function vardi($nosaukums){
	include_once("includes/arc2/ARC2.php");
	$parser = ARC2::getRDFParser();
	//Sâkumâ bez Category
	$parser->parse('http://dbpedia.org/data/'.$nosaukums.'.rdf');
	$triples = $parser->getSimpleIndex(0);
	foreach($triples as $triple){
		$nos = str_replace("http://dbpedia.org/resource/","",key($triples));
		$nosa = str_replace("_"," ",$nos);
		$nosa = str_replace("Category:","",$nosa);
		$nosa = preg_replace("/[^a-zA-Z\s]/", "", $nosa);
		if (substr($nosa, 0, 4)!="http") {
			//Te piemet klât masîvam...
			$vardi[] = $nosa;
		}
		next($triples);
	}
	//Tad ar Category
	if($nosaukums == "Recreation" || $nosaukums == "Home" || 
	$nosaukums == "Science" || $nosaukums == "Health" || 
	$nosaukums == "Arts" || $nosaukums == "Society" || 
	$nosaukums == "Games" || $nosaukums == "Business"){
		$parser->parse('http://dbpedia.org/data/Category:'.$nosaukums.'.rdf');
		$triples = $parser->getSimpleIndex(0);
		foreach($triples as $triple){
			$nos = str_replace("http://dbpedia.org/resource/","",key($triples));
			$nosa = str_replace("_"," ",$nos);
			$nosa = str_replace("Category:","",$nosa);
			$nosa = preg_replace("/[^a-zA-Z\s]/", "", $nosa);
			if (substr($nosa, 0, 4)!="http") {
				//Te piemet klât masîvam...
				$vardi[] = $nosa;
			}
			next($triples);
		}
	}
	return $vardi;
}
?>