/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, next*/
$(document).ready(function()
{
    var skillPoint, viePerso, ADPerso, APPerso, armorPerso, MRPerso, peneArmorPerso, peneMRPerso, caracteristique;
    skillPoint = $('span#skillPoint').html();
    viePerso = $('span#HPPerso').html();
    ADPerso = $('span#ADPerso').html();
    APPerso = $('span#APPerso').html();
    armorPerso = $('span#armorPerso').html();
    MRPerso = $('span#MRPerso').html();
    peneArmorPerso = $('span#peneArmorPerso').html();
    peneMRPerso = $('span#peneMRPerso').html();
    $('button').click(function () {
        caracteristique = $(this).attr('id');
        caracteristique = caracteristique.replace("Point", "");
        console.log(caracteristique);
        if (caracteristique === "HP") {
            $('span#HPPerso').html(viePerso + 1);
            $('span#skillPoint').html(skillPoint - 1);
        }
        if (caracteristique === "AD") {
            $('span#ADPerso').html(ADPerso + 1);
            $('span#skillPoint').html(skillPoint - 1);
        }
        if (caracteristique === "AP") {
            $('span#APPerso').html(APPerso + 1);
            $('span#skillPoint').html(skillPoint - 1);
        }
        if (caracteristique === "armor") {
            $('span#armorPerso').html(armorPerso + 1);
            $('span#skillPoint').html(skillPoint - 1);
        }
        if (caracteristique === "MR") {
            $('span#MRPerso').html(MRPerso + 1);
            $('span#skillPoint').html(skillPoint - 1);
        }
        if (caracteristique === "peneArmor") {
            $('span#peneArmorPerso').html(peneArmorPerso + 1);
            $('span#skillPoint').html(skillPoint - 1);
        }
        if (caracteristique === "peneMR") {
            $('span#peneMRPerso').html(peneMRPerso + 1);
            $('span#skillPoint').html(skillPoint - 1);
        }
    })
});