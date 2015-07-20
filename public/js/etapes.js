/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, next*/
$(document).ready(function()
{
    var url, allEnigmes, valueAllEnigmes, keyAllEnigmes, i, j, k, l, m, allPNJ, idPNJ, namePNJ, HPPNJ, ADPNJ, APPNJ, armorPNJ, MRPNJ, peneArmorPNJ, peneMRPNJ, picturePNJ, levelPNJ, n, o, allItem, p, q, idItem, nameItem, r;
    allItem = $('div#item').html();
    url = $('div#url').html();
    allItem = allItem.split(':');
    for (p = 0; p < allItem.length; p = p + 1) {
        allItem[p] = allItem[p].trim();
        if (allItem[p] === "") {
            allItem.splice(p, 1);
        }
    }
    for (q = 0; q < allItem.length; q = q + 1) {
        idItem = idItem + allItem[q].substr(0, allItem[q].match(/\|/)['index']) + '|';
        allItem[q] = allItem[q].substr(allItem[q].match(/\|/)['index'] + 1);
        nameItem = nameItem + allItem[q] + '|';
    }
    idItem = idItem.substr(9);
    nameItem = nameItem.substr(9);
    idItem = idItem.split('|');
    nameItem = nameItem.split('|');
    for (r = 0; r < allItem.length; r = r + 1) {
        idItem[r] = idItem[r].trim();
        nameItem[r] = nameItem[r].trim();
        if (idItem[r] === "") {
            idItem.splice(r, 1);
        }
        if (nameItem[r] === "") {
            nameItem.splice(r, 1);
        }
    }
    if (idItem[idItem.length - 1] === "") {
        idItem.splice(idItem.length - 1, 1);
    }
    if (nameItem[nameItem.length - 1] === "") {
        nameItem.splice(nameItem.length - 1, 1);
    }
    allEnigmes = $('div#enigme').html();
    allEnigmes = allEnigmes.split(':');
    for (i = 0; i < allEnigmes.length; i = i + 1) {
        allEnigmes[i] = allEnigmes[i].trim();
        if (allEnigmes[i] === "") {
            allEnigmes.splice(i, 1);
        }
    }
    for (k = 0; k < allEnigmes.length; k = k + 1) {
        valueAllEnigmes = valueAllEnigmes + allEnigmes[k].substr(allEnigmes[k].match(/\|/)['index']);
        keyAllEnigmes = keyAllEnigmes + allEnigmes[k].substr(0, allEnigmes[k].match(/\|/)['index']) + '|';
    }
    keyAllEnigmes = keyAllEnigmes.substr(9);
    keyAllEnigmes = keyAllEnigmes.split('|');
    valueAllEnigmes = valueAllEnigmes.substr(9);
    valueAllEnigmes = valueAllEnigmes.split('|');
    for (l = 0; l < valueAllEnigmes.length; l = l + 1) {
        valueAllEnigmes[l] = valueAllEnigmes[l].trim();
        if (valueAllEnigmes[l] === "") {
            valueAllEnigmes.splice(l, 1);
        }
    }
    for (m = 0; m < keyAllEnigmes.length; m = m + 1) {
        keyAllEnigmes[m] = keyAllEnigmes[m].trim();
        if (keyAllEnigmes[m] === "") {
            keyAllEnigmes.splice(m, 1);
        }
    }
    allPNJ = $('div#pnj').html();
    allPNJ = allPNJ.split(':');
    for (j = 0; j < allPNJ.length; j = j + 1) {
        allPNJ[j] = allPNJ[j].trim();
        if (allPNJ[j] === "") {
            allPNJ.splice(j, 1);
        }
    }
    for (n = 0; n < allPNJ.length; n = n + 1) {
        idPNJ = idPNJ + allPNJ[n].substr(0, allPNJ[n].match(/\|/)['index']) + '|';
        allPNJ[n] = allPNJ[n].substr(allPNJ[n].match(/\|/)['index'] + 1);
        namePNJ = namePNJ + allPNJ[n].substr(0, allPNJ[n].match(/\|/)['index']) + '|';
        allPNJ[n] = allPNJ[n].substr(allPNJ[n].match(/\|/)['index'] + 1);
        HPPNJ = HPPNJ + allPNJ[n].substr(0, allPNJ[n].match(/\|/)['index']) + '|';
        allPNJ[n] = allPNJ[n].substr(allPNJ[n].match(/\|/)['index'] + 1);
        ADPNJ = ADPNJ + allPNJ[n].substr(0, allPNJ[n].match(/\|/)['index']) + '|';
        allPNJ[n] = allPNJ[n].substr(allPNJ[n].match(/\|/)['index'] + 1);
        APPNJ = APPNJ + allPNJ[n].substr(0, allPNJ[n].match(/\|/)['index']) + '|';
        allPNJ[n] = allPNJ[n].substr(allPNJ[n].match(/\|/)['index'] + 1);
        armorPNJ = armorPNJ + allPNJ[n].substr(0, allPNJ[n].match(/\|/)['index']) + '|';
        allPNJ[n] = allPNJ[n].substr(allPNJ[n].match(/\|/)['index'] + 1);
        MRPNJ = MRPNJ + allPNJ[n].substr(0, allPNJ[n].match(/\|/)['index']) + '|';
        allPNJ[n] = allPNJ[n].substr(allPNJ[n].match(/\|/)['index'] + 1);
        peneArmorPNJ = peneArmorPNJ + allPNJ[n].substr(0, allPNJ[n].match(/\|/)['index']) + '|';
        allPNJ[n] = allPNJ[n].substr(allPNJ[n].match(/\|/)['index'] + 1);
        peneMRPNJ = peneMRPNJ + allPNJ[n].substr(0, allPNJ[n].match(/\|/)['index']) + '|';
        allPNJ[n] = allPNJ[n].substr(allPNJ[n].match(/\|/)['index'] + 1);
        picturePNJ = picturePNJ + allPNJ[n].substr(0, allPNJ[n].match(/\|/)['index']) + '|';
        allPNJ[n] = allPNJ[n].substr(allPNJ[n].match(/\|/)['index'] + 1);
        levelPNJ = levelPNJ + allPNJ[n] + '|';
    }
    idPNJ = idPNJ.substr(9);
    namePNJ = namePNJ.substr(9);
    HPPNJ = HPPNJ.substr(9);
    ADPNJ = ADPNJ.substr(9);
    APPNJ = APPNJ.substr(9);
    armorPNJ = armorPNJ.substr(9);
    MRPNJ = MRPNJ.substr(9);
    peneArmorPNJ = peneArmorPNJ.substr(9);
    peneMRPNJ = peneMRPNJ.substr(9);
    picturePNJ = picturePNJ.substr(9);
    levelPNJ = levelPNJ.substr(9);
    idPNJ = idPNJ.split('|');
    namePNJ = namePNJ.split('|');
    HPPNJ = HPPNJ.split('|');
    ADPNJ = ADPNJ.split('|');
    APPNJ = APPNJ.split('|');
    armorPNJ = armorPNJ.split('|');
    MRPNJ = MRPNJ.split('|');
    peneArmorPNJ = peneArmorPNJ.split('|');
    peneMRPNJ = peneMRPNJ.split('|');
    picturePNJ = picturePNJ.split('|');
    levelPNJ = levelPNJ.split('|');
    for (o = 0; o < idPNJ.length; o = o + 1) {
        idPNJ[o] = idPNJ[o].trim();
        namePNJ[o] = namePNJ[o].trim();
        HPPNJ[o] = HPPNJ[o].trim();
        ADPNJ[o] = ADPNJ[o].trim();
        APPNJ[o] = APPNJ[o].trim();
        armorPNJ[o] = armorPNJ[o].trim();
        MRPNJ[o] = MRPNJ[o].trim();
        peneArmorPNJ[o] = peneArmorPNJ[o].trim();
        peneMRPNJ[o] = peneMRPNJ[o].trim();
        picturePNJ[o] = picturePNJ[o].trim();
        levelPNJ[o] = levelPNJ[o].trim();
        if (idPNJ[o] === "") {
            idPNJ.splice(o, 1);
        }
        if (namePNJ[o] === "") {
            namePNJ.splice(o, 1);
        }
        if (HPPNJ[o] === "") {
            HPPNJ.splice(o, 1);
        }
        if (ADPNJ[o] === "") {
            ADPNJ.splice(o, 1);
        }
        if (APPNJ[o] === "") {
            APPNJ.splice(o, 1);
        }
        if (armorPNJ[o] === "") {
            armorPNJ.splice(o, 1);
        }
        if (MRPNJ[o] === "") {
            MRPNJ.splice(o, 1);
        }
        if (peneArmorPNJ[o] === "") {
            peneArmorPNJ.splice(o, 1);
        }
        if (peneMRPNJ[o] === "") {
            peneMRPNJ.splice(o, 1);
        }
        if (picturePNJ[o] === "") {
            picturePNJ.splice(o, 1);
        }
        if (levelPNJ[o] === "") {
            levelPNJ.splice(o, 1);
        }
    }
    $('select#choix').on('change', function () {
        "use strict";
        if (this.value != 'aucun') {
            var i, j, k, l, etape, enigme, pnj, displayPNJ, item;
            enigme = '<div class="form-group"><label>Choix question</label>';
            pnj = '<div class="form-group"><label>Choix PNJ</label>';
            item = '<div class="form-group"><label>Choix Item donner à la fin de la quête :</label><select class="form-control" name="item">';
            for (j = 0; j < allItem.length; j = j + 1) {
                item = item + '<option value="' + idItem[j] + '">' + nameItem[j] + '</option>';
            }
            item = item + '</select></div>';
            for (k = 0; k < allEnigmes.length; k = k + 1) {
                enigme = enigme + '<option value="' + keyAllEnigmes[k] + '">' + valueAllEnigmes[k] + '</option>';
            }
            for (l = 0; l < allPNJ.length; l = l + 1) {
                displayPNJ = displayPNJ + '<div class="list-group-item"><h3 class="list-group-item-heading">' + namePNJ[l] + '</h3><img class="img-thumbnail img-circle img-responsive avatar" src="' + url + picturePNJ[l] + '" alt="' + namePNJ[l] + '"><p class="list-group-item-text">HP : ' + HPPNJ[l] + '</p><p class="list-group-item-text">AD : ' + ADPNJ[l] + '</p><p class="list-group-item-text">AP : ' + APPNJ[l] + '</p><p class="list-group-item-text">Armure : ' + armorPNJ[l] + '</p><p class="list-group-item-text">Résistence magique : ' + MRPNJ[l] + '</p><p class="list-group-item-text">Pénétration Armure : ' + peneArmorPNJ[l] + '</p><p class="list-group-item-text">Pénétration magique : ' + peneMRPNJ[l] + '</p><p class="list-group-item-text">Level : ' + levelPNJ[l] + '</p></div>';
                pnj = pnj + '<option value="' + idPNJ[l] + '">' + namePNJ[l] + '</option>';
            }
            pnj = pnj + '</div>';
            for (i = 1; i <= this.value; i = i + 1) {
                etape = etape + '<div class="form-group" id="etape"><label for="nameEtape ' + i + '">Nom Etape ' + i + '</label> <input type="text" name="nameEtape ' + i + '" id="nameEtape ' + i + '" placeholder="nom etape" class="form-control" /></div><label for="enigme ' + i + '">La question pour l\'étape ' + i + '</label>' + '<select class="form-control" name="enigme ' + i + '">' + enigme + '</select><label for="PNJ ' + i + '">Le PNJ pour l\'étape ' + i + '</label>' + '<select class="form-control" name="PNJ ' + i + '">' + pnj + '</select> ';
            }
            enigme = enigme + '</div>';
            displayPNJ = displayPNJ.substr(9);
            etape = etape.substr(9);
            $('div#etape').html(etape);
            $('div#allPNJ').html(displayPNJ);
            $('div#allItem').html(item);
        } else {
            $('div#etape').html('');
        }
    });
});