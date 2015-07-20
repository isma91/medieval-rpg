/*jslint browser: true, node : true*/
/*jslint devel : true*/
/*global $, next*/
$(document).ready(function()
{
    var viePNJ, ADPNJ, APPNJ, armorPNJ, MRPNJ, peneArmorPNJ, peneMRPNJ, resistanceArmorPNJ, resistanceMRPNJ, viePerso, ADPerso, APPerso, armorPerso, MRPerso, peneArmorPerso, peneMRPerso, resistanceArmorPerso, resistanceMRPerso, type, degas, testDegasAD, testDegasAP, quete, etape, personnage;
    viePNJ = $('span#HPPNJ').html();
    ADPNJ = $('span#ADPNJ').html();
    APPNJ = $('span#APPNJ').html();
    armorPNJ = $('span#armorPNJ').html();
    MRPNJ = $('span#MRPNJ').html();
    peneArmorPNJ = $('span#peneArmorPNJ').html();
    peneMRPNJ = $('span#peneMRPNJ').html();
    viePerso = $('span#HPPerso').html();
    ADPerso = $('span#ADPerso').html();
    APPerso = $('span#APPerso').html();
    armorPerso = $('span#armorPerso').html();
    MRPerso = $('span#MRPerso').html();
    peneArmorPerso = $('span#peneArmorPerso').html();
    peneMRPerso = $('span#peneMRPerso').html();
    quete = $('#quete').val();
    etape = $('#etape').val();
    personnage = $('#personnage').val();
    if (viePNJ <= 0) {
        $('h3#play').html('Votre personnage a battu le PNJ !!');
        $('#attaque').addClass("disabled");
        window.location.href = "victory/" + quete + "/" + etape + "/" + personnage;
    }
    if (viePerso <= 0) {
        $('h3#play').html('Le PNJ a battu votre personnage !!');
        $('#attaque').addClass("disabled");
        window.location.href = "defeat/" + quete + "/" + etape;
    }
    $('#attaque').click(function () {
        $('#degas').filter(function (){
            type = this.value;
        }).prop('selected', true);
        if (type === "AD") {
            resistanceArmorPNJ = armorPNJ - peneArmorPerso;
            degas = ADPerso - resistanceArmorPNJ;
            if (degas <= 0) {
                degas = 0;
            }
            viePNJ = viePNJ - degas;
            $('h3#play').html('Votre personnage a fait ' + degas + ' dégas physique au PNJ !!');
            $('span#HPPNJ').html(viePNJ);
            $('#attaque').addClass("disabled");
            testDegasAD = ADPNJ - (armorPerso - peneArmorPNJ);
            testDegasAP = APPNJ - (MRPerso - peneMRPNJ);
            setTimeout(function(){
                $('#attaque').removeClass("disabled");
            }, 2000);
            if (testDegasAD > testDegasAP) {
                resistanceArmorPerso = armorPerso - peneArmorPNJ;
                degas = ADPNJ - resistanceArmorPerso;
                if (degas <= 0) {
                    degas = 0;
                }
                viePerso = viePerso - degas;
                $('h3#play').html('Le PNJ a fait ' + degas + ' dégas physique à votre personnage !!');
                $('span#HPPerso').html(viePerso);
            }
            if (testDegasAD < testDegasAP) {
                resistanceMRPerso = MRPerso - peneMRPNJ;
                degas = APPNJ - resistanceMRPerso;
                if (degas <= 0) {
                    degas = 0;
                }
                viePerso = viePerso - degas;
                $('h3#play').html('Le PNJ a fait ' + degas + ' dégas magiques à votre personnage !!');
                $('span#HPPerso').html(viePerso);
            }
            if (testDegasAD === testDegasAP) {
                resistanceArmorPerso = armorPerso - peneArmorPNJ;
                degas = ADPNJ - resistanceArmorPerso;
                if (degas <= 0) {
                    degas = 0;
                }
                viePerso = viePerso - degas;
                $('h3#play').html('Le PNJ a fait ' + degas + ' dégas physique à votre personnage !!');
                $('span#HPPerso').html(viePerso);
            }
            if (viePNJ <= 0) {
                $('h3#play').html('Votre personnage a battu le PNJ !!');
                $('#attaque').addClass("disabled");
                window.location.href = "victory/" + quete + "/" + etape + "/" + personnage;
            }
            if (viePerso <= 0) {
                $('h3#play').html('Le PNJ a battu votre personnage !!');
                $('#attaque').addClass("disabled");
                window.location.href = "defeat/" + quete + "/" + etape;
            }
        }
        if (type === "AP") {
            resistanceMRPNJ = MRPNJ - peneMRPerso;
            degas = APPerso - resistanceMRPNJ;
            if (degas <= 0) {
                degas = 0;
            }
            viePNJ = viePNJ - degas;
            $('span#HPPNJ').html(viePNJ);
            $('h3#play').html('Votre personnage a fait ' + degas + ' dégas magique au PNJ !!');
            $('#attaque').addClass("disabled");
            testDegasAD = ADPNJ - (armorPerso - peneArmorPNJ);
            testDegasAP = APPNJ - (MRPerso - peneMRPNJ);
            setTimeout(function(){
                $('#attaque').removeClass("disabled");
            }, 2000);
            if (testDegasAD > testDegasAP) {
                resistanceArmorPerso = armorPerso - peneArmorPNJ;
                degas = ADPNJ - resistanceArmorPerso;
                if (degas <= 0) {
                    degas = 0;
                }
                viePerso = viePerso - degas;
                $('h3#play').html('Le PNJ a fait ' + degas + ' dégas physique à votre personnage !!');
                $('span#HPPerso').html(viePerso);
            }
            if (testDegasAD < testDegasAP) {
                resistanceMRPerso = MRPerso - peneMRPNJ;
                degas = APPNJ - resistanceMRPerso;
                if (degas <= 0) {
                    degas = 0;
                }
                viePerso = viePerso - degas;
                $('h3#play').html('Le PNJ a fait ' + degas + ' dégas magiques à votre personnage !!');
                $('span#HPPerso').html(viePerso);
            }
            if (testDegasAD === testDegasAP) {
                resistanceArmorPerso = armorPerso - peneArmorPNJ;
                degas = ADPNJ - resistanceArmorPerso;
                if (degas <= 0) {
                    degas = 0;
                }
                viePerso = viePerso - degas;
                $('h3#play').html('Le PNJ a fait ' + degas + ' dégas physique à votre personnage !!');
                $('span#HPPerso').html(viePerso);
            }
            if (viePNJ <= 0) {
                $('h3#play').html('Votre personnage a battu le PNJ !!');
                $('#attaque').addClass("disabled");
                window.location.href = "victory/" + quete + "/" + etape + "/" + personnage;
            }
            if (viePerso <= 0) {
                $('h3#play').html('Le PNJ a battu votre personnage !!');
                $('#attaque').addClass("disabled");
                window.location.href = "defeat/" + quete + "/" + etape;
            }
        }
    });
});