<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'UsersController@accueil');

Route::get('accueil', 'UsersController@accueil');

Route::get('inscription', 'UsersController@inscription');

Route::get('connexion', 'UsersController@connexion');

Route::post('inscription', 'UsersController@ajout');

Route::post('connexion', 'UsersController@verif');

Route::get('deco', 'UsersController@deco');

Route::post('deco', 'UsersController@deco');

Route::get('panelMaster', 'UsersController@panelMaster');

Route::post('panelMaster', 'UsersController@panelMaster');

Route::get('profilMaster', 'UsersController@profilMaster');

Route::post('profilMaster', 'UsersController@profilMaster');

Route::get('panelPlayer', 'UsersController@panelPlayer');

Route::post('panelPlayer', 'UsersController@panelPlayer');

Route::get('profilPlayer', 'UsersController@profilPlayer');

Route::post('profilPlayer', 'UsersController@profilPlayer');

Route::post('updateProfilUser', 'UsersController@updateProfilUser');

Route::post('updateUserPass', 'UsersController@updateUserPass');

Route::get('itemAndPNJ', 'UsersController@itemAndPnj');

Route::post('itemAndPNJ', 'UsersController@itemAndPnj');

Route::get('addQuete', 'UsersController@addQuete');

Route::post('addQuete', 'UsersController@addQuete');

Route::get('addQuestionReponse', 'UsersController@addQuestionReponse');

Route::post('addQuestionReponse', 'UsersController@addQuestionReponse');

Route::get('addPNJ', 'UsersController@addPNJ');

Route::post('addPNJ', 'UsersController@addPNJ');

Route::post('ajoutQuestionReponse', 'UsersController@ajoutQuestionReponse');

Route::post('ajoutPNJ', 'UsersController@ajoutPNJ');

Route::get('PNJQuestionReponseItem', 'UsersController@PNJQuestionReponseItem');

Route::post('PNJQuestionReponseItem', 'UsersController@PNJQuestionReponseItem');

Route::get('addItem', 'UsersController@addItem');

Route::post('addItem', 'UsersController@addItem');

Route::post('ajoutItem', 'UsersController@ajoutItem');

Route::post('ajoutQuete', 'UsersController@ajoutQuete');

Route::get('allQuete', 'UsersController@allQuete');

Route::post('allQuete', 'UsersController@allQuete');

Route::get('addPersonnage', 'UsersController@addPersonnage');

Route::post('addPersonnage', 'UsersController@addPersonnage');

Route::post('ajoutPersonnage', 'UsersController@ajoutPersonnage');

Route::get('equipement', 'UsersController@equipement');

Route::post('equipement', 'UsersController@equipement');

Route::post('ajoutEquipement', 'UsersController@ajoutEquipement');

Route::get('goQuete', 'UsersController@goQuete');

Route::post('goQuete', 'UsersController@goQuete');

Route::get('quete/{idQuete}/{idEtape}', 'UsersController@quete');

Route::post('quete/{idQuete}/{idEtape}', 'UsersController@quete');

Route::get('goEtape', 'UsersController@etape');

Route::post('goEtape', 'UsersController@etape');

Route::post('reponse', 'UsersController@reponse');

Route::get('victory/{idQuete}/{idEtape}/{idPerso}', 'UsersController@victory');

Route::post('victory/{idQuete}/{idEtape}/{idPerso}', 'UsersController@victory');

Route::get('defeat/{idQuete}/{idEtape}', 'UsersController@defeat');

Route::post('defeat/{idQuete}/{idEtape}', 'UsersController@defeat');

Route::get('addSkill', 'UsersController@addSkill');

Route::post('addSkill', 'UsersController@addSkill');

Route::post('ajoutSkill', 'UsersController@ajoutSkill');