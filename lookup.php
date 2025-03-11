<?php
if(!empty($_POST['domain'])) {
	$domain = $_POST['domain'];
} else {
	$domain = '';
}

$whoisservers = array(
	"ac" => "whois.nic.ac", 
	"academy" => "whois.nic.academy",
	"ad" => "whois.ripe.net", 
	"ae" => "whois.nic.ae", 
	"aero"=>"whois.aero",
	"af" => "whois.nic.af", 
	"ag" => "whois.nic.ag", 
	"ai" => "whois.ai", 
	"al" => "whois.ripe.net", 
	"am" => "whois.amnic.net",  
	"app" => "whois.nic.google",
	"arpa" => "whois.iana.org",
	"as" => "whois.nic.as", 
	"asia" => "whois.nic.asia",
	"at" => "whois.nic.at", 
	"au" => "whois.aunic.net", 
	"ax" => "whois.ax", 
	"az" => "whois.ripe.net", 
	"be" => "whois.dns.be",
	"bg" => "whois.register.bg", 
	"bi" => "whois.nic.bi", 
	"biz" => "whois.biz",
	"biz" => "whois.neulevel.biz",
	"bj" => "whois.nic.bj", 
	"bn" => "whois.bn", 
	"bo" => "whois.nic.bo", 
	"br" => "whois.registro.br", 
	"bt" => "whois.netnames.net", 
	"by" => "whois.cctld.by", 
	"bz" => "whois.belizenic.bz", 
	"ca" => "whois.cira.ca", 
	"cat" => "whois.cat", 
	"cc" => "whois.nic.cc", 
	"ceo" => "whois.nic.ceo",
	"cd" => "whois.nic.cd", 
	"cf" => "whois.dot.cf", 
	"ch" => "whois.nic.ch", 
	"ci" => "whois.nic.ci", 
	"ck" => "whois.nic.ck", 
	"cl" => "whois.nic.cl", 
	"cloud" => "whois.nic.cloud",
	"club" => "whois.nic.club",
	"cn" => "whois.cnnic.net.cn",
	"co" => "whois.nic.co", 
	"cool" => "whois.nic.cool",
	"com" => "whois.verisign-grs.com",
	"coop" => "whois.nic.coop",
	"cx" => "whois.nic.cx", 
	"cz" => "whois.nic.cz", 
	"de" => "whois.denic.de", 
	"dk" => "whois.dk-hostmaster.dk", 
	"dm" => "whois.nic.dm", 
	"dz" => "whois.nic.dz", 
	"ec" => "whois.nic.ec",
	"edu" => "whois.educause.edu",
	"education" => "whois.nic.education",
	"ee" => "whois.eenet.ee", 
	"eg" => "whois.ripe.net", 
	"es" => "whois.nic.es", 
	"eu" => "whois.eu",
	"fi" => "whois.ficora.fi", 
	"fo" => "whois.nic.fo", 
	"fr" => "whois.nic.fr", 
	"game" => "whois.nic.game", 
	"gd" => "whois.nic.gd", 
	"gg" => "whois.gg", 
	"gi" => "whois2.afilias-grs.net", 
	"gl" => "whois.nic.gl", 
	"gold" => "whois.nic.gold",
	"gov" => "whois.nic.gov",
	"gratis" => "whois.nic.gratis", 
	"guru" => "whois.nic.guru",
	"gy" => "whois.registry.gy", 
	"hk" => "whois.hkirc.hk",
	"hn" => "whois.nic.hn", 
	"hospital" => "whois.nic.hospital", 
	"hotels" => "whois.nic.hotels", 
	"hr" => "whois.dns.hr", 
	"ht" => "whois.nic.ht", 
	"hu" => "whois.nic.hu", 
	"id" => "whois.pandi.or.id", 
	"xyz" => "whois.nic.xyz",
	"ie" => "whois.domainregistry.ie", 
	"il" => "whois.isoc.org.il", 
	"im" => "whois.nic.im", 
	"in" => "whois.inregistry.net", 
	"host" => "whois.nic.host",
	"info" => "whois.afilias.net",
	"int" => "whois.iana.org",
	"io" => "whois.nic.io", 
	"iq" => "whois.cmc.iq", 
	"ir" => "whois.nic.ir", 
	"is" => "whois.isnic.is", 
	"it" => "whois.nic.it", 
	"je" => "whois.je", 
	"jobs" => "jobswhois.verisign-grs.com",
	"jp" => "whois.jprs.jp", 
	"ke" => "whois.kenic.or.ke", 
	"kg" => "www.domain.kg", 
	"ki" => "whois.nic.ki", 
	"kr" => "whois.kr", 
	"kz" => "whois.nic.kz", 
	"la" => "whois.nic.la", 
	"li" => "whois.nic.li", 
	"live" => "whois.nic.live",
	"lt" => "whois.domreg.lt", 
	"ltd" => "whois.nic.ltd", 
	"loan" => "whois.nic.loan",
	"love" => "whois.nic.love",
	"lu" => "whois.dns.lu", 
	"lv" => "whois.nic.lv", 
	"ly" => "whois.nic.ly", 
	"ma" => "whois.iam.net.ma", 
	"map" => "whois.nic.google",
	"md" => "whois.nic.md", 
	"me" => "whois.nic.me", 
	"media" => "whois.nic.media", 
	"mg" => "whois.nic.mg", 
	"mil" => "whois.nic.mil",
	"ml" => "whois.dot.ml", 
	"mn" => "whois.nic.mn", 
	"mo" => "whois.monic.mo", 
	"mp" => "whois.nic.mp", 
	"ms" => "whois.nic.ms", 
	"mt" => "whois.ripe.net", 
	"meme" => "whois.nic.google",
	"mu" => "whois.nic.mu", 
	"music" => "whois.nic.music",
	"museum" => "whois.museum",
	"mobi" => "whois.nic.mobi",
	"monster" => "whois.nic.monster",
	"mx" => "whois.mx", 
	"my" => "whois.mynic.my", 
	"na" => "whois.na-nic.com.na", 
	"name" => "whois.nic.name",
	"nc" => "whois.nc", 
	"news" => "whois.nic.news", 
	"net" => "whois.verisign-grs.net",
	"network" => "whois.nic.network",
	"nf" => "whois.nic.nf", 
	"ng" => "whois.nic.net.ng", 
	"nl" => "whois.domain-registry.nl", 
	"no" => "whois.norid.no", 
	"nu" => "whois.nic.nu", 
	"nz" => "whois.srs.net.nz", 
	"ooo" => "whois.nic.ooo", 
	"om" => "whois.registry.om", 
	"one" => "whois.nic.one", 
	"online" => "whois.nic.online", 
	"org" => "whois.pir.org",
	"pe" => "kero.yachay.pe", 
	"pf" => "whois.registry.pf", 
	"pl" => "whois.dns.pl", 
	"pm" => "whois.nic.pm", 
	"post" => "whois.dotpostregistry.net",
	"pr" => "whois.nic.pr", 
	"press" => "whois.nic.press",
	"pro" => "whois.registrypro.pro",
	"pt" => "whois.dns.pt", 
	"pub" => "whois.nic.pub", 
	"pw" => "whois.nic.pw", 
	"qa" => "whois.registry.qa", 
	"re" => "whois.nic.re", 
	"ro" => "whois.rotld.ro", 
	"rs" => "whois.rnids.rs", 
	"ru" => "whois.tcinet.ru", 
	"sa" => "whois.nic.net.sa", 
	"sb" => "whois.nic.net.sb", 
	"sc" => "whois2.afilias-grs.net", 
	"se" => "whois.iis.se", 
	"search" => "whois.nic.google", 
	"security" => "whois.nic.security",
	"sg" => "whois.sgnic.sg", 
	"sh" => "whois.nic.sh", 
	"si" => "whois.arnes.si", 
	"shop" => "whois.nic.shop",
	"sk" => "whois.sk-nic.sk", 
	"sm" => "whois.nic.sm", 
	"sn" => "whois.nic.sn", 
	"so" => "whois.nic.so", 
	"space" => "whois.nic.space",
	"sport" => "whois.nic.sport",
	"st" => "whois.nic.st", 
	"store" => "whois.nic.store",
	"su" => "whois.tcinet.ru", 
	"support" => "whois.nic.support", 
	"sx" => "whois.sx", 
	"sy" => "whois.tld.sy", 
	"tc" => "whois.meridiantld.net", 
	"tech" => "whois.nic.tech",
	"technology" => "whois.nic.technology",
	"tel" => "whois.nic.tel",
	"tf" => "whois.nic.tf", 	
	"th" => "whois.thnic.co.th", 
	"tj" => "whois.nic.tj", 
	"tk" => "whois.dot.tk", 
	"tl" => "whois.nic.tl", 
	"tm" => "whois.nic.tm", 
	"tn" => "whois.ati.tn", 
	"to" => "whois.tonic.to", 
	"today" => "whois.nic.today",
	"top" => "whois.nic.top",
	"tp" => "whois.nic.tl", 
	"tr" => "whois.nic.tr", 
	"travel" => "whois.nic.travel",
	"tv" => "whois.nic.tv", 
	"tw" => "whois.twnic.net.tw", 
	"tz" => "whois.tznic.or.tz", 
	"ua" => "whois.ua", 
	"ug" => "whois.co.ug", 
	"uk" => "whois.nic.uk", 
	"us" => "whois.nic.us", 
	"uy" => "whois.nic.org.uy", 
	"uz" => "whois.cctld.uz", 
	"vip" => "whois.nic.vip", 
	"vc" => "whois2.afilias-grs.net", 
	"ve" => "whois.nic.ve", 
	"vg" => "whois.adamsnames.tc", 
	"wf" => "whois.nic.wf", 
	"wiki" => "whois.nic.wiki",
	"world" => "whois.nic.world",
	"work" => "whois.nic.work",
	"works" => "whois.nic.works",
	"wow" => "whois.nic.wow",
	"ws" => "whois.website.ws", 
	"xxx" => "whois.nic.xxx",
	"xyz" => "whois.nic.xyz",
	"yt" => "whois.nic.yt", 
	"yu" => "whois.ripe.net");

// Lookup Domain Name
function LookupDomainName($domain){
	global $whoisservers;
	$domain_parts = explode(".", $domain);
	$tld = strtolower(array_pop($domain_parts));
	$whoisserver = $whoisservers[$tld];
	if(!$whoisserver) {
		return "Error: No appropriate Whois server found for $domain domain!";
	}
	$result = getWhoisServerDetails($whoisserver, $domain);
	if(!$result) {
		return "Error: No results retrieved from $whoisserver server for $domain domain!";
	}
	else {
		while(strpos($result, "Whois Server:") !== FALSE){
			preg_match("/Whois Server: (.*)/", $result, $matches);
			$secondary = $matches[1];
			if($secondary) {
				$result = getWhoisServerDetails($secondary, $domain);
				$whoisserver = $secondary;
			}
		}
	}
	return "$domain domain lookup results from $whoisserver server:\n\n" . $result;
}
// Lookup Ip Address
function LookupIPAddress($ip) {
	$whoisservers = array(
		"whois.afrinic.net", // Africa - returns timeout error :-(
		"whois.lacnic.net", // Latin America and Caribbean - returns data for ALL locations worldwide :-)
		"whois.apnic.net", // Asia/Pacific only
		"whois.arin.net", // North America only
		"whois.ripe.net" // Europe, Middle East and Central Asia only
	);
	$results = array();
	foreach($whoisservers as $whoisserver) {
		$result = getWhoisServerDetails($whoisserver, $ip);
		if($result && !in_array($result, $results)) {
			$results[$whoisserver]= $result;
		}
	}
	foreach($results as $whoisserver=>$result) {
		$res .= "\n<strong>Lookup Results for " . $ip . " FROM " . $whoisserver . " server:\n</strong>" . $result;
	}
	return $res;
}
// validate IP Address
function ValidateIPAddress($ip) {
	$ipnums = explode(".", $ip);
	if(count($ipnums) != 4) {
		return false;
	}
	foreach($ipnums as $ipnum) {
		if(!is_numeric($ipnum) || ($ipnum > 255)) {
			return false;
		}
	}
	return $ip;
}
// Validate Domain Name
function ValidateDomainName($domain) {
	if(!preg_match("/^([-a-z0-9]{2,100})\.([a-z\.]{2,8})$/i", $domain)) {
		return false;
	}
	return $domain;
}

function getWhoisServerDetails($whoisserver, $domain) {
	$port = 43;
	$timeout = 10;
	$fp = @fsockopen($whoisserver, $port, $errno, $errstr, $timeout) or die("Socket Error " . $errno . " - " . $errstr);
	fputs($fp, $domain . "\r\n");
	$out = "";
	while(!feof($fp)){
		$out .= fgets($fp);
	}
	fclose($fp);

	$res = "";
	if((strpos(strtolower($out), "error") === FALSE) && (strpos(strtolower($out), "not allocated") === FALSE)) {
		$rows = explode("\n", $out);
		foreach($rows as $row) {
			$row = trim($row);
			if(($row != '') && ($row{0} != '#') && ($row{0} != '%')) {
				$res .= $row."\n";
			}
		}
	}
	return $res;
}

if($domain) {
	$domain = trim($domain);
	if(substr(strtolower($domain), 0, 7) == "http://") $domain = substr($domain, 7);
	if(substr(strtolower($domain), 0, 4) == "www.") $domain = substr($domain, 4);
	if(ValidateIPAddress($domain)) {
		echo " ";
		$result = LookupIPAddress($domain);
	}
	elseif(ValidateDomainName($domain)) {
		$result = LookupDomainName($domain);
	}
	
	else { 
		$result = "Invalid Input!";
	}
	header('Content-Type: application/json');
	echo "<pre>\n" . $result . "\n</pre>\n";
}
?>
