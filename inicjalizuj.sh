#!/bin/bash

# wyciagamy dobre dane z duzych plików
rm wersy.db

for i in txt-all/*

do

	FS=`wc -c <"$i"`
	
	if (($FS > 55000)); then
		echo $i": "$FS
		grep -h "^—.*—" "$i" >>wersy.db
	fi

done

echo "wersy.db wygenerowane. mozna odpalac skrypt php"

