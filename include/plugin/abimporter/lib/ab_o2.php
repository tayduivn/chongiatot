<?php
/********************************************************************************
DO NOT EDIT THIS FILE!

o2.pl contacts importer.

You may not reprint or redistribute this code without permission from Lunarsys Solutions.

Copyright 2009 Lunarsys Solutions. All Rights Reserved
WWW: http://www.lunarsys.com
********************************************************************************/
//include_once(dirname(__FILE__).'/abimporter.php');
if (!defined('__ABI')) die('Please include abi.php to use this importer!');

global $_OZ_SERVICES;
$_OZ_SERVICES['o2'] = array('type'=>'abi', 'label'=>'O2.pl', 'class'=>'O2Importer');

/////////////////////////////////////////////////////////////////////////////////////////
//O2Importer
/////////////////////////////////////////////////////////////////////////////////////////
//@api
class O2Importer extends WebRequestor {

	//@api
	function fetchContacts ($loginemail, $password) {

	 	$parts = $this->getEmailParts ($loginemail);
	 	$login = $parts[0];

		$form = new HttpForm;
		$form->addField("username", $login);
		$form->addField("password", $password);
		$form->addField("x", "0");
		$form->addField("y", "0");
		$form->addField("_authtrkcde", "{#TRKCDE#}");
		$postData = $form->buildPostData();
		$html = $this->httpPost("http://poczta.o2.pl/login.html", $postData);
		if (strpos($html,"class=\"errorMessage\"")!==false) {
		 	$this->close();
			return abi_set_error(_ABI_AUTHENTICATION_FAILED,'Bad user name or password');
		}
		
		$ssid = $this->cookiejar->getCookieValues($this->lastUrl, 'ssid');
		if (empty($ssid)) {
		 	$this->close();
			return abi_set_error(_ABI_FAILED,'Cannot find ssid cookie');
		}
		
		$form = new HttpForm;
		$form->addField("outputformat", "mozillawin");
		$postData = $form->buildPostData();
		$time = time()*1000 ; //& 0x7FFFFFFF;
		$location = "/a?cmd=export_addressbook&requestid=7&fmt=xml&upid=$time&xsfr-cookie=$ssid[0]";
		$html = $this->httpPost($location, $postData);
		
		// Nazwisko,Imi�,Faks s�u�bowy,Nazwa,Dodatkowy e-mail,Miasto
		// (dom),Telefon kom�rkowy,Nickname,Telefon domowy,Osobista strona sieci
		// Web,Uwagi,Podstawowy e-mail,Pager,Telefon s�u�bowy
		// ,,,test1,,,,test1,,,,test1@gmail.com,,
		// ,,,test2,,,,test2,,,,test2@gmail.com,,
		
		$al = array();
		$reader = new OzCsvReader($html,",");
		
		//Read header
		$cells = $reader->nextRow();
		if ($cells==false) {
			return abi_set_error(_ABI_FAILED,'Unexpected CSV. Missing header row.');
		}
		while (true) {
		 	$cells = $reader->nextRow();
		 	if ($cells==false) break;
		 	$email = trim($cells[11]);
		 	$name = $cells[3];
		 	if (abi_valid_email($email)) {
				$contact = new Contact($name,$email);
				$al[] = $contact;
			}
		}
		return $al;
	}	
}

//o2.pl
global $_DOMAIN_IMPORTERS;
$_DOMAIN_IMPORTERS["o2.pl"] = 'O2Importer';

?>