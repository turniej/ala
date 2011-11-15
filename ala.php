#!/usr/bin/php
<?php
// "Ała!"
// Wiersze z czasowników w dialogach
// wymaga obecności w cwd katalogu pliku wersy.db wygenerowanego skryptem 'inicjalizuj.sh'
//
// michal.szota@gmail.com
// 9.10.2011

/*
    Copyright (C) 2011 Michał Szota

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as
    published by the Free Software Foundation, either version 3 of the
    License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// init

mb_internal_encoding("UTF-8");
mb_regex_encoding("UTF-8");
$pustaki="(:|\n|;| |,|\.|\-|!|…|\?|—)";


$zrodlo=file_get_contents("wersy.db");

$zrodlo=explode("\n",$zrodlo);

$wyr=array();
$czasowniki=array();
$zdania=array();

shuffle($zrodlo);

foreach ($zrodlo as $z) {
	if (preg_match('/—[^—]+—\s([a-zA-ZłąćźńóśćężŁĄĆŹŃÓŚĆĘŻ]{4,20}).*[^—].*/ui',$z,$wyr)) {
		
		if (preg_match('/(ła)$/ui',$wyr[1])) array_push($czasowniki,mb_strtolower($wyr[1]));
		
	}
	
	if ($c<20 && preg_match('/([^—]+!)/ui',$z,$wyr)) {
		if (strlen($wyr[0])<60) {
			$c++;
			array_push($zdania,preg_replace('/[^a-złąćźńóśćęż,\.\?! ]/ui','',mb_strtolower($wyr[0])));
		}
	}
}

$czasowniki=array_unique($czasowniki);


for ($i=0;$i<=mt_rand(2,3);$i++) {
	for ($j=0;$j<=mt_rand(1,3);$j++) {
		$wiersz.=trim($czasowniki[array_rand($czasowniki)]);	

		$wiersz.=", ";		
		if (!mt_rand(0,2)) $wiersz.="\n";
	}

	
	$wiersz.="\n".trim($zdania[array_rand($zdania)])."\n\n";
	
}

$wierszo=explode("\n",$wiersz);

foreach ($wierszo as $w) {
	echo mb_ucfirst($w)."\n";
}


function mb_ucfirst($string) {
	$string = mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
	return $string;
}