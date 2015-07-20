/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, next*/
$(document).ready(function()
{
	var allEnigmes, allPersonnages, idPersonnages, argentPersonnage, allTruePersonnages, idItem, levelItem, prixItem, partieItem, trueLevelItem, truePrixItem, truePartieItem, i, j, k, l, m, n, o, p, q, r, s, argentPerso, argentRestant;
	allTruePersonnages = [];
	trueLevelItem = [];
	truePrixItem = [];
	truePartieItem = [];
	allItem = $('div#items').html();
	allPersonnages = $('div#characters').html();
	allItem = allItem.split(':');
	allPersonnages = allPersonnages.split(':');
	for (i = 0; i < allItem.length; i = i + 1) {
		allItem[i] = allItem[i].trim();
		if (allItem[i] == "") {
			allItem.splice(i, 1);
		}
	}
	for (j = 0; j < allPersonnages.length; j = j + 1) {
		allPersonnages[j] = allPersonnages[j].trim();
		if (allPersonnages[j] == "") {
			allPersonnages.splice(j, 1);
		}
	}
	for (k = 0; k < allPersonnages.length; k = k + 1) {
		idPersonnages = idPersonnages + allPersonnages[k].substr(0, allPersonnages[k].match(/\|/)['index']) + '|';
		argentPersonnage = argentPersonnage + allPersonnages[k].substr(allPersonnages[k].match(/\|/)['index']);
	}
	idPersonnages = idPersonnages.substr(9);
	idPersonnages = idPersonnages.split('|');
	argentPersonnage = argentPersonnage.substr(9);
	argentPersonnage = argentPersonnage.split('|');
	for (l = 0; l < idPersonnages.length; l = l + 1) {
		idPersonnages[l] = idPersonnages[l].trim();
		if (idPersonnages[l] == "") {
			idPersonnages.splice(l, 1);
		}
	}
	for (m = 0; m < argentPersonnage.length; m = m + 1) {
		argentPersonnage[m] = argentPersonnage[m].trim();
		if (argentPersonnage[m] == "") {
			argentPersonnage.splice(m, 1);
		}
	}
	for (n = 0; n < allItem.length; n = n + 1) {
		idItem = idItem + allItem[n].substr(0, allItem[n].match(/\|/)['index']) + '|';
		allItem[n] = allItem[n].substr(allItem[n].match(/\|/)['index'] + 1);
		levelItem = levelItem + allItem[n].substr(0, allItem[n].match(/\|/)['index']) + '|';
		allItem[n] = allItem[n].substr(allItem[n].match(/\|/)['index'] + 1);
		prixItem = prixItem + allItem[n].substr(0, allItem[n].match(/\|/)['index']) + '|';
		allItem[n] = allItem[n].substr(allItem[n].match(/\|/)['index'] + 1);
		partieItem = partieItem + allItem[n] + '|';
	}
	idItem = idItem.substr(9);
	idItem = idItem.split('|');
	levelItem = levelItem.substr(9);
	levelItem = levelItem.split('|');
	prixItem = prixItem.substr(9);
	prixItem = prixItem.split('|');
	partieItem = partieItem.substr(9);
	partieItem = partieItem.split('|');
	for (o = 0; o < idItem.length; o = o + 1) {
		idItem[o] = idItem[o].trim();
		levelItem[o] = levelItem[o].trim();
		prixItem[o] = prixItem[o].trim();
		partieItem[o] = partieItem[o].trim();
		if (idItem[o] == "") {
			idItem.splice(o, 1);
		}
		if (levelItem[o] == "") {
			levelItem.splice(o, 1);
		}
		if (prixItem[o] == "") {
			prixItem.splice(o, 1);
		}
		if (partieItem[o] == "") {
			partieItem.splice(o, 1);
		}
	}
	for (p = 0; p < idPersonnages.length; p = p + 1) {
		allTruePersonnages[idPersonnages[p]] = argentPersonnage[p];
	}
	for (q = 0; q < idItem.length; q = q + 1) {
		trueLevelItem[idItem[q]] = levelItem[q];
	}
	for (r = 0; r < idItem.length; r = r + 1) {
		truePrixItem[idItem[r]] = prixItem[r];
	}
	for (s = 0; s < idItem.length; s = s + 1) {
		truePartieItem[idItem[s]] = partieItem[s];
	}
	console.log(allTruePersonnages, trueLevelItem, truePrixItem, truePartieItem);
	$('select#personnage').on('change', function (event) {
		$('div#argentPersonnage').html('Ce personnage à ' + allTruePersonnages[this.value]);
	});
	$('select#equipement').on('change', function (event) {
		$('div#argentItem').html('Cet item coute ' + truePrixItem[this.value] + ' et elle est de level ' + trueLevelItem[this.value]);
	});
});