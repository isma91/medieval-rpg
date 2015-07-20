/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, next*/
$(document).ready(function () {
    $('select#reponse').on('change', function () {
        "use strict";
        if (this.value !== 'aucun') {
            var i, reponses, choix;
            for (i = 1; i <= this.value; i = i + 1) {
                reponses = reponses + '<label for="answer ' + i + '">Réponse ' + i + '</label> <input type="text" name="answer ' + i + '" id="answer ' + i + '" placeholder="the cake is a lie" class="form-control" />';
            }
            choix = '<label for="choix">Choisisser la bonne réponse</label><select class="form-control" name="choix" id="choix">';
            for (i = 1; i <= this.value; i = i + 1) {
                choix = choix + '<option value="' + i + '">Réponse ' + i + '</option>';
            }
            choix = choix + '</select>';
            reponses = reponses.substr(9);
            $('div#answer').html(reponses);
            $('div#choix').html(choix);
        }
    });
});