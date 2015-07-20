<?php
/**
* UsersController.php
* 
* PHP Version 5.2
*
* @category Controleur
* @package  Controleur
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/dev/app/Http/Controllers/UsersController.php
*/

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use Validator;
use Input;
use App\User;
use Hash;
use Redirect;
use DB;
use Session;
use Auth;
use File;

/**
* Class User
*
* Class permettant d'ajouter les membres
* 
* PHP Version 5.2
*
* @category Controleur
* @package  Controleur
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/dev/app/Http/Controllers/UsersController.php
*/

class UsersController extends Controller
{
    /**
      * accueil
      *
      * Fonction accueil
      *
      * @return view; redirection vers le accueil
      */
    public function accueil ()
    {
        if (Auth::check()) {
            if (Auth::user()->droit == 'master') {
                return redirect()->action('UsersController@panelMaster'); 
            }
            elseif (Auth::user()->droit == 'player') {
                return redirect()->action('UsersController@panelPlayer');
            }
        }
        return view('user.accueil');
    }

    /**
      * Inscription
      *
      * Fonction ajout membre
      *
      * @return view; redirection vers le login
      */
    public function inscription ()
    {
        if (Auth::check()) {
            if (Auth::user()->droit == 'master') {
                return redirect()->action('UsersController@panelMaster'); 
            }
            elseif (Auth::user()->droit == 'player') {
                return redirect()->action('UsersController@panelPlayer');
            }
        }
        return view('user.inscription');
    }

    /**
      * Connexion
      *
      * Fonction login
      *
      * @return view; redirection vers le panel
      */
    public function connexion ()
    {
        if (Auth::check()) {
            Session::flash('messageDejaCo', 'Vous êtes déjà connecter !!!');
            if (Auth::user()->droit == 'master') {
                return redirect()->action('UsersController@panelMaster'); 
            }
            elseif (Auth::user()->droit == 'player') {
                return redirect()->action('UsersController@panelPlayer');
            }
        }
        return view('user.connexion');
    }

    /**
      * Ajout
      *
      * Fonction ajout membre
      *
      * @return view; redirection vers le login
      */
    public function ajout ()
    {
        $rules = array('name' => 'required', 'lastname' => 'required', 'name' => 'required', 'birthdate' => 'required', 'username' => array('required', 'unique:users,username'), 'email' => array('required', 'email', 'unique:users,email'), 'password' => array('required', 'min:5'));

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails()) {
            Session::flash('messageUserCreatedFailed', 'Inscription failed !!!');
            return redirect()->back();
        } else {
            $data = Request::all();
            $password = $data['password'];
            $password = Hash::make($password);
            $users = DB::table('users')->get();
            DB::table('users')->insert(['lastname' => $data['lastname'], 'name' => $data['name'], 'username' => $data['username'], 'password' => $password, 'birthdate' => $data['birthdate'], 'email' => $data['email'], 'remember_token' => $data['_token'], 'created_at' => DB::raw('now()'),  'bloquer' => 'non', 'droit' => 'player']);
            Session::flash('messageUserCreated', 'Inscription réussi !!!');
            return Redirect::to('inscription');
        }
    }

    /**
      * Verif
      *
      * Fonction login
      *
      * @return view; redirection vers le panel
      */
    public function verif ()
    {
        $data = Request::all();
        $pseudo = $data['username'];
        $pass = $data['password'];
        $droit = $data['droit'];
        if ($droit === "player") {
            if (Auth::attempt(array('username' => $pseudo, 'password' => $pass, 'bloquer' => 'non', 'droit' => 'player'))) {
                return redirect()->action('UsersController@panelPlayer');
            } else {
                Session::flash('messageVerif', 'Mauvais pseudo et/ou mot de passe et/ou user bloquer');
                return redirect()->back();
            }
        }
        if ($droit === "master") {
            if (Auth::attempt(array('username' => $pseudo, 'password' => $pass, 'bloquer' => 'non', 'droit' => 'master'))) {
                return redirect()->action('UsersController@panelMaster');
            } else {
                Session::flash('messageVerif', 'Mauvais pseudo et/ou mot de passe et/ou user bloquer');
                return redirect()->back();
            }
        }
    }

    /**
      * PanelMaster
      *
      * Fonction afficher le panel du master
      *
      * @return view; redirection vers le panel
      */
    public function panelMaster ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit == 'master') {
            $userPlayer = DB::table('users')->where('droit', 'player')->get();
            $userMaster = DB::table('users')->where('droit', 'master')->where('username', '!=', Auth::user()->username)->get();
            return view('user.panelMaster')->with('usersplayer', $userPlayer)->with('usersmaster', $userMaster);  
        }
    }

    /**
      * ProfilMaster
      *
      * Fonction afficher les detail du master
      *
      * @return view; redirection vers l'affichage du profil user
      */
    public function ProfilMaster ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        return view('user.profilMaster');
    }

    /**
      * PanelPlayer
      *
      * Fonction afficher le panel du player
      *
      * @return view; redirection vers le panel
      */
    public function panelPlayer ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        $yourPersonnages = DB::table('personnages')->where('idPlayer', Auth::user()->id)->get();
        return view('user.panelPlayer')->with('personnages', $yourPersonnages);
    }

    /**
      * ProfilPlayer
      *
      * Fonction afficher les detail du player
      *
      * @return view; redirection vers l'affichage du profil user
      */
    public function ProfilPlayer ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        return view('user.profilPlayer');
    }

    /**
      * UpdateProfilUser
      *
      * Fonction modifier profil user
      *
      * @return view; redirection vers le profil
      */
    public function updateProfilUser ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        $data = Request::all();
        $id = Auth::user()->id;
        if (empty($data['file'])) {
            DB::table('users')->where('id', $id)->update(['lastname' => $data['lastname'], 'name' => $data['name'], 'birthdate' => $data['birthdate'], 'email' => $data['email'], 'updated_at' => DB::raw('now()')]);
        } else {
            if (substr($data['file']->getClientMimeType(), 0, 5) == 'image') {
                $path = public_path().'/avatar/';
                $extension = strstr($data['file']->getClientMimeType(), '/');
                $extension = substr($extension, 1);
                $nameFile = str_replace(' ', '_', Auth::user()->username).'.'.$extension;
                if (File::exists($path) == false) {
                    File::makeDirectory($path, $mode = 0777, true);
                }
                $data['file']->move($path, $nameFile);
                DB::table('users')->where('id', $id)->update(['lastname' => $data['lastname'], 'name' => $data['name'], 'birthdate' => $data['birthdate'], 'picture' => $nameFile, 'email' => $data['email'], 'updated_at' => DB::raw('now()')]);
            } else {
                Session::flash('messagePasImage', 'Vous ne pouvez mettre que des images !!!');
                return redirect()->back();
            }
        }
        Session::flash('messageUpdateUser', 'Changement effectuer avec succes !!');
        return redirect()->back();
    }

    /**
      * UpdateUserPass
      *
      * Fonction modifier pass du player
      *
      * @return view; redirection vers le profil
      */
    public function updateUserPass ()
    {
        $data = Request::all();
        $currentPass = Auth::user()->password;
        $data['oldPassword'];
        if (Hash::check($data['oldPassword'], $currentPass) && Hash::check($data['newPassword'], $currentPass) == false) {
            $id = Auth::user()->id;
            $newPassword = Hash::make($data['newPassword']);
            DB::table('users')->where('id', $id)->update(['password' => $newPassword]);
            Session::flash('messagePass', 'Pass changer avec succès !!!');
            return redirect()->back();
        }
        if (Hash::check($data['oldPassword'], $currentPass) == false) {
            Session::flash('messageOldPass', 'Vous n\'avez pas bien ecrit votre pass actuel');
            return redirect()->back();
        }
        if (Hash::check($data['newPassword'], $currentPass)) {
            Session::flash('messageNewPass', 'Votre nouveau pass ne peut etre votre pass actuel');
            return redirect()->back();
        }
    }

    /**
      * ItemAndPNJ
      *
      * Fonction afficher les Items et le PNJ
      *
      * @return view; redirection vers l'affichage des items et pnj
      */
    public function itemAndPNJ ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        $allItems = DB::table('items')->orderBy('name', 'ASC')->get();
        return view('user.itemAndPnj')->with('items', $allItems);
    }

    /**
      * AddQuete
      *
      * Fonction afficher l'ajout de quete
      *
      * @return view; redirection vers l'affichage d'ajout de quete
      */
    public function addQuete ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'master') {
            return view('user.panelPlayer');
        }
        $yourPNJ = DB::table('pnjs')->where('idMaster', Auth::user()->id)->orderBy('name', 'ASC')->get();
        $yourquestionReponse = DB::table('questions')->where('idMaster', Auth::user()->id)->get();
        $allItems = DB::table('items')->where('level', '<=', Auth::user()->level)->get();
        return view('user.addQuete')->with('PNJ', $yourPNJ)->with('enigme', $yourquestionReponse)->with('items', $allItems);
    }

    /**
      * AddQuestionReponse
      *
      * Fonction afficher l'ajout des questions reponses
      *
      * @return view; redirection vers l'affichage d'ajout de question reponse
      */
    public function addQuestionReponse ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'master') {
            return view('user.panelPlayer');
        }
        return view('user.addQuestionReponse');
    }

    /**
      * AddPNJ
      *
      * Fonction afficher l'ajout des PNJ
      *
      * @return view; redirection vers l'affichage d'ajout de PNJ
      */
    public function addPNJ ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'master') {
            return view('user.panelPlayer');
        }
        return view('user.addPNJ');
    }

    /**
      * AjoutQuestionReponse
      *
      * Fonction ajout question reponse
      *
      * @return view; redirection vers l'ajout de question reponse
      */
    public function ajoutQuestionReponse ()
    {
        if (Auth::user()->droit == 'master') {
            $data = Request::all();
            $question = trim($data['question']);
            $nbReponse = $data['reponse'];
            if (empty($question)) {
                Session::flash('messageQuestionVide', 'Votre question ne doit pas être vide  !!!');
                return redirect()->back();
            }
            if ($nbReponse == 'aucun' || $nbReponse < 3) {
                Session::flash('messageAucunReponse', 'Vous devez ajouter au moins 3 réponse  !!!');
                return redirect()->back();
            }
            if ($nbReponse >= 3) {
                for ($i=1; $i <= $nbReponse; $i++) {
                    if (empty(trim($data['answer_'.$i]))) {
                        Session::flash('messageReponseEmpty', 'l\'une des réponses est vide !!!');
                    } else {
                        DB::table('questions')->insert(['ask' => $data['question'], 'idAnswer' => 0, 'idMaster' => Auth::user()->id, 'created_at' => DB::raw('now()')]);
                        $last_last_id = DB::getPdo()->lastInsertId();
                        for ($i=1; $i <= $nbReponse; $i++) { 
                            DB::table('reponses')->insert(['answer' => $data['answer_'.$i], 'idMaster' => Auth::user()->id, 'idAsk' => $last_last_id, 'created_at' => DB::raw('now()')]);
                        }
                        $theAnswer = DB::table('reponses')->where('answer', $data['answer_'.$data['choix']])->first();
                        DB::table('questions')->where('id', $last_last_id)->update(['idAnswer' => $theAnswer->id]);
                        DB::table('users')->where('id', Auth::user()->id)->update(['xp' => (Auth::user()->xp + 100), 'updated_at' => DB::raw('now()')]);
                        if (Auth::user()->xp == 400) {
                            DB::table('users')->where('id', Auth::user()->id)->update(['xp' => 0, 'level' => (Auth::user()->level + 1) , 'updated_at' => DB::raw('now()')]);
                            Session::flash('messageLevelUp', 'Vous passez level '.(Auth::user()->level + 1).' !!!');
                        }
                        Session::flash('messageQuestionReponseSuccess', 'Votre question et réponses ont été ajouter avec succès !!!');
                        return redirect()->back();
                    }
                }
            }
        }
    }

    /**
      * AjoutPNJ
      *
      * Fonction ajout de PNJ
      *
      * @return view; redirection vers l'ajout de PNJ
      */
    public function ajoutPNJ ()
    {
        if (Auth::user()->droit == 'master') {
            $data = Request::all();
            if (empty($data['name'])) {
                Session::flash('messageNameEmpty', 'Votre PNJ doit avoir un nom !!!');
                return redirect()->back();
            } else {
                if (empty($data['file'])) {
                    Session::flash('messageAvatarEmpty', 'Votre PNJ doit avoir un avatar !!!');
                    return redirect()->back();
                } else {
                    if (substr($data['file']->getClientMimeType(), 0, 5) != 'image') {
                        Session::flash('messageAvatarNoImage', 'L\'avatar de votre PNJ doit être une image !!!');
                        return redirect()->back();
                    } else {
                        $path = public_path().'/avatarPNJ/';
                        $extension = strstr($data['file']->getClientMimeType(), '/');
                        $extension = substr($extension, 1);
                        $nameFile = str_replace(' ', '_', $data['name']).'.'.$extension;
                        if (File::exists($path) == false) {
                            File::makeDirectory($path, $mode = 0777, true);
                        }
                        $data['file']->move($path, $nameFile);
                        DB::table('pnjs')->insert(['name' => $data['name'], 'HP' => $data['HP'], 'AD' => $data['AD'], 'AP' => $data['AP'], 'armor' => $data['armor'], 'MR' => $data['MR'], 'peneArmor' => $data['peneArmor'], 'peneMR' => $data['peneMR'], 'picture' => $nameFile, 'idMaster' => Auth::user()->id, 'level' => Auth::user()->level, 'created_at' => DB::raw('now()')]);
                        Session::flash('messagePNJSuccess', 'Votre PNJ a été créer avec success !!!');
                        return redirect()->back();
                    }
                }
            }
        }
    }

    /**
      * PNJQuestionReponseItem
      *
      * Fonction afficher les imtes, PNJ et enigmes cree par le master
      *
      * @return view; redirection vers l'affichage des items, PNJ et enigme du master
      */
    public function PNJQuestionReponseItem ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'master') {
            return view('user.panelPlayer');
        }
        $yourPNJ = DB::table('pnjs')->where('idMaster', Auth::user()->id)->orderBy('name', 'ASC')->get();
        $yourquestionReponse = DB::table('questions')->where('questions.idMaster', Auth::user()->id)->join('reponses', 'questions.idAnswer', '=', 'reponses.id')->get();
        return view('user.PNJQuestionReponseItem')->with('PNJ', $yourPNJ)->with('enigme', $yourquestionReponse);
    }

    /**
      * AddItem
      *
      * Fonction afficher l'ajout d'item
      *
      * @return view; redirection vers l'affichage d'ajout d'item
      */
    public function addItem ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'master') {
            return view('user.panelPlayer');
        }
        $items = DB::table('items')->get();
        return view('user.addItem')->with('items', $items);
    }

    /**
      * AjoutItem
      *
      * Fonction ajout de item
      *
      * @return view; redirection vers l'ajout de item
      */
    public function ajoutItem ()
    {
        if (Auth::user()->droit == 'master') {
            $data = Request::all();
            if (empty($data['name'])) {
                Session::flash('messageNameEmpty', 'Votre item doit avoir un nom !!!');
                return redirect()->back();
            } else {
                if (empty($data['file'])) {
                    Session::flash('messageAvatarEmpty', 'Votre item doit avoir un avatar !!!');
                    return redirect()->back();
                } else {
                    if (substr($data['file']->getClientMimeType(), 0, 5) != 'image') {
                        Session::flash('messageAvatarNoImage', 'L\'avatar de votre item doit être une image !!!');
                        return redirect()->back();
                    } else {
                        $path = public_path().'/items/';
                        $extension = strstr($data['file']->getClientMimeType(), '/');
                        $extension = substr($extension, 1);
                        $nameFile = str_replace(' ', '_', $data['name']).'.'.$extension;
                        if (File::exists($path) == false) {
                            File::makeDirectory($path, $mode = 0777, true);
                        }
                        $data['file']->move($path, $nameFile);
                        DB::table('items')->insert(['name' => $data['name'], 'HP' => $data['HP'], 'AD' => $data['AD'], 'AP' => $data['AP'], 'armor' => $data['armor'], 'MR' => $data['MR'], 'peneArmor' => $data['peneArmor'], 'peneMR' => $data['peneMR'], 'picture' => $nameFile, 'type' => $data['type'], 'partie' => $data['partie'], 'prix' => $data['prix'], 'level' => Auth::user()->level, 'created_at' => DB::raw('now()')]);
                        DB::table('users')->where('id', Auth::user()->id)->update(['xp' => (Auth::user()->xp + 100), 'updated_at' => DB::raw('now()')]);
                        if (Auth::user()->xp == 400) {
                            DB::table('users')->where('id', Auth::user()->id)->update(['xp' => 0, 'level' => (Auth::user()->level + 1) , 'updated_at' => DB::raw('now()')]);
                            Session::flash('messageLevelUp', 'Vous passez level '.(Auth::user()->level + 1).' !!!');
                        }
                        Session::flash('messagePNJSuccess', 'Votre item a été créer avec success !!!');
                        return redirect()->back();
                    }
                }
            }
        }
    }

    /**
      * AjoutQuete
      *
      * Fonction ajout de quete
      *
      * @return view; redirection vers l'ajout de quete
      */
    public function ajoutQuete ()
    {
        if (Auth::user()->droit == 'master') {
            $data = Request::all();
            if (empty($data['name'])) {
                Session::flash('messageNameEmpty', 'Votre item doit avoir un nom !!!');
                return redirect()->back();
            } else {
                if ($data['choix'] == 'aucun' || $data['choix'] < 3) {
                    Session::flash('messageAucunChoix', 'Vous devez ajouter au moins 3 étapes  !!!');
                    return redirect()->back();
                } else {
                    $tabIdEtape = [];
                    for ($i=1; $i <= $data['choix']; $i++) {
                        DB::table('etapes')->insert(['name' =>  $data['nameEtape_'.$i], 'idQuestion' => $data['enigme_'.$i], 'idPnj' => $data['PNJ_'.$i], 'level' => Auth::user()->level, 'xp' => (Auth::user()->level * 100), 'created_at' => DB::raw('now()')]);
                        $last_id = DB::getPdo()->lastInsertId();
                        array_push($tabIdEtape, $last_id);
                    }
                    $idEtapes = implode('|', $tabIdEtape);
                    DB::table('quetes')->insert(['name' => $data['name'], 'idEtapes' => $idEtapes, 'idItem' => $data['item'], 'created_at' => DB::raw('now()'), 'level' => Auth::user()->level, 'xp' => $data['xp'], 'idMaster' => Auth::user()->id]);
                    DB::table('users')->where('id', Auth::user()->id)->update(['xp' => (Auth::user()->xp + 100), 'updated_at' => DB::raw('now()')]);
                    if (Auth::user()->xp == 400) {
                        DB::table('users')->where('id', Auth::user()->id)->update(['xp' => 0, 'level' => (Auth::user()->level + 1) , 'updated_at' => DB::raw('now()')]);
                        Session::flash('messageLevelUp', 'Vous passez level '.(Auth::user()->level + 1).' !!!');
                    }
                    Session::flash('messageQueteSuccess', 'Quête ajouter avec succes !!!');
                    return redirect()->back();
                }
            }
        }
    }

    /**
      * AllQuete
      *
      * Fonction afficher tous les quetes du master
      *
      * @return view; redirection vers l'affichage des quetes
      */
    public function allQuete ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'master') {
            return view('user.panelPlayer');
        }
        $masterQuetes = DB::table('quetes')->where('quetes.idMaster', Auth::user()->id)->get();
        return view('user.allQuete')->with('quetes', $masterQuetes);
    }

    /**
      * AddPersonnage
      *
      * Fonction afficher d'ajout de personnage
      *
      * @return view; redirection vers l'affichage d'ajout de personnage
      */
    public function addPersonnage ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'player') {
            return view('user.panelMaster');
        }
        return view('user.addPersonnage');
    }

    /**
      * AjoutPersonnage
      *
      * Fonction ajout de Personnage
      *
      * @return view; redirection vers l'ajout de Personnage
      */
    public function ajoutPersonnage ()
    {
        if (Auth::user()->droit == 'player') {
            $data = Request::all();
            if (empty($data['name'])) {
                Session::flash('messageNameEmpty', 'Votre item doit avoir un nom !!!');
                return redirect()->back();
            } else {
                if (substr($data['file']->getClientMimeType(), 0, 5) == 'image') {
                    $path = public_path().'/avatarPersonnage/';
                    $extension = strstr($data['file']->getClientMimeType(), '/');
                    $extension = substr($extension, 1);
                    $nameFile = str_replace(' ', '_', $data['name']).'.'.$extension;
                    if (File::exists($path) == false) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $data['file']->move($path, $nameFile);
                    DB::table('personnages')->insert(['name' =>  $data['name'], 'idPlayer' => Auth::user()->id, 'level' => Auth::user()->level, 'skillPoint' => (Auth::user()->level * 10), 'picture' => $nameFile, 'created_at' => DB::raw('now()')]);
                    Session::flash('messagePersonnageSuccess', 'Votre personnage a bien été créer !!!');
                    return redirect()->back();
                } else {
                    Session::flash('messageNoImage', 'Votre personnage doit avoir une image !!!');
                    return redirect()->back();
                }
            }
        }
    }

    /**
      * Equipement
      *
      * Fonction afficher d'ajout d'equipement d'un personnage
      *
      * @return view; redirection vers l'affichage d'ajout d'equipement d'un personnage
      */
    public function equipement ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'player') {
            return view('user.panelMaster');
        }
        $yourPersonnages = DB::table('personnages')->where('idPlayer', Auth::user()->id)->get();
        $allItems = DB::table('items')->get();
        return view('user.equipement')->with('personnages', $yourPersonnages)->with('items', $allItems);
    }

    /**
      * AjoutEquipement
      *
      * Fonction ajout d'equipement
      *
      * @return view; redirection vers l'ajout d'equipement
      */
    public function ajoutEquipement ()
    {
        if (Auth::user()->droit == 'player') {
            $data = Request::all();
            $argentItem = DB::table('items')->where('id', $data['equipement'])->get();
            $partieItem = $argentItem[0]->partie;
            $nameItem = $argentItem[0]->name;
            $HPItem = $argentItem[0]->HP;
            $ADItem = $argentItem[0]->AD;
            $APItem = $argentItem[0]->AP;
            $armorItem = $argentItem[0]->armor;
            $MRItem = $argentItem[0]->MR;
            $peneArmorItem = $argentItem[0]->peneArmor;
            $peneMRItem = $argentItem[0]->peneMR;
            $levelItem = $argentItem[0]->level;
            $argentItem = $argentItem[0]->prix;
            $argentPersonnage = DB::table('personnages')->where('id', $data['personnage'])->get();
            $partiePersonnage = $argentPersonnage[0]->$partieItem;
            $namePersonnage = $argentPersonnage[0]->name;
            $HPPersonnage = $argentPersonnage[0]->HP;
            $ADPersonnage = $argentPersonnage[0]->AD;
            $APPersonnage = $argentPersonnage[0]->AP;
            $armorPersonnage = $argentPersonnage[0]->armor;
            $MRPersonnage = $argentPersonnage[0]->MR;
            $peneArmorPersonnage = $argentPersonnage[0]->peneArmor;
            $peneMRPersonnage = $argentPersonnage[0]->peneMR;
            $levelPersonnage = $argentPersonnage[0]->level;
            $argentPersonnage = $argentPersonnage[0]->argent;
            if ($argentItem <= $argentPersonnage) {
                if ($levelPersonnage < $levelItem) {
                    Session::flash('messagePasLevel', 'Vous n\'avez pas assez de level pour acheter cette item !!!');
                    return redirect()->back();
                }
                if ($levelPersonnage >= $levelItem) {
                    $partiePersonnage = $partiePersonnage.$data['equipement'].'|';
                    $partiePersonnage = explode('|', $partiePersonnage);
                    unset($partiePersonnage[count($partiePersonnage) - 1]);
                    if ($partieItem == 'tete') {
                        if (count($partiePersonnage) >= 1) {
                            Session::flash('messageFullTete', 'Vous ne pouvez plus equiper des items de tête sur votre personnages !!!');
                            return redirect()->back();
                        }
                    }
                    if ($partieItem == 'visage') {
                        if (count($partiePersonnage) >= 1) {
                            Session::flash('messageFullVisage', 'Vous ne pouvez plus equiper des items de visage sur votre personnages !!!');
                            return redirect()->back();
                        }
                    }
                    if ($partieItem == 'mains') {
                        if (count($partiePersonnage) >= 2) {
                            Session::flash('messageFullMains', 'Vous ne pouvez plus equiper des items de mains sur votre personnages !!!');
                            return redirect()->back();
                        }
                    }
                    if ($partieItem == 'doigts') {
                        if (count($partiePersonnage) >= 10) {
                            Session::flash('messageFullDoigts', 'Vous ne pouvez plus equiper des items de doigts sur votre personnages !!!');
                            return redirect()->back();
                        }
                    }
                    if ($partieItem == 'coprs') {
                        if (count($partiePersonnage) >= 2) {
                            Session::flash('messageFullCorps', 'Vous ne pouvez plus equiper des items de corps sur votre personnages !!!');
                            return redirect()->back();
                        }
                    }
                    if ($partieItem == 'hanche') {
                        if (count($partiePersonnage) >= 2) {
                            Session::flash('messageFullHanche', 'Vous ne pouvez plus equiper des items de hanche sur votre personnages !!!');
                            return redirect()->back();
                        }
                    }
                    DB::table('personnages')->where('id', $data['personnage'])->update(['HP' => ($HPPersonnage + $HPItem), 'AD' => ($ADPersonnage + $ADItem), 'AP' => ($APPersonnage + $APItem), 'armor' => ($armorPersonnage + $armorItem), 'MR' => ($MRPersonnage + $MRItem), 'peneArmor' => ($peneArmorPersonnage + $peneMRItem), 'peneMR' => ($peneMRPersonnage + $peneMRItem), $partieItem => $data['equipement'].'|', 'argent' => ($argentPersonnage - $argentItem), 'updated_at' => DB::raw('now()')]);
                    Session::flash('messageEquipementSuccess', $nameItem.' a bien été ajouter sur votre personnages !!!');
                    return redirect()->back();
                }
            }
            if ($argentItem > $argentPersonnage) {
                Session::flash('messagePasArgent', 'Vous n\'avez pas assez d\'argent pour acheter cette item !!!');
                return redirect()->back();
            }
        }
    }

    /**
      * GoQuete
      *
      * Fonction afficher de participer une quete
      *
      * @return view; redirection vers l'affichage de participer une quete
      */
    public function goQuete ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'player') {
            return view('user.panelMaster');
        }
        $queteDispo = DB::table('quetes')->where('level', '<=',  Auth::user()->level)->get();
        return view('user.goQuete')->with('quetes', $queteDispo);
    }

    /**
      * Quete
      *
      * Fonction Faire la quete
      *
      * @param integer; $idQuete ; id de la quête
      * @param integer; $idEtape ; id de l'etape
      *
      * @return view; redirection vers l'affichage de faire la quete
      */
    public function quete ($idQuete, $idEtapes)
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'player') {
            return view('user.panelMaster');
        }
        $quete = DB::table('quetes')->where('id', $idQuete)->get();
        $etape = DB::table('etapes')->where('id', $idEtapes)->get();
        $personnage = DB::table('personnages')->where('idPlayer', Auth::user()->id)->get();
        return view('user.currentQuete')->with('currentQuete', $quete)->with('currentEtape', $etape)->with('personnages', $personnage);
    }

    /**
      * Etape
      *
      * Fonction Faire la etape
      *
      * @return view; redirection vers l'affichage de etape
      */
    public function etape ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'player') {
            return view('user.panelMaster');
        }
        $data = Request::all();
        if (substr($data['type'], 0, 6) == "Enigme") {
            $enigme = DB::table('questions')->where('id', substr($data['type'], 6))->get();
            $etape = DB::table('etapes')->where('id', $data['etape'])->get();
            DB::table('personnages')->where('id', $data['personnage'])->update(['currentQuete' => $data['quete'], 'currentEtape' => $data['etape'], 'updated_at' => DB::raw('now()')]);
            $reponsePossible = DB::table('reponses')->where('idAsk', substr($data['type'], 6))->get();
            $reponses = [];
            $idReponses = [];
            foreach ($reponsePossible as $value) {
                array_push($reponses, $value->answer);
                array_push($idReponses, $value->id);
            }
            $personnage = DB::table('personnages')->where('id', $data['personnage'])->get();
            $currentEtape = $data['etape'];
            $currentQuete = $data['quete'];
            return view('user.currentEnigme')->with('enigme', $enigme)->with('idReponses', $idReponses)->with('reponses', $reponses)->with('personnage', $personnage)->with('currentEtape', $currentEtape)->with('currentQuete', $currentQuete);
        }
        if (substr($data['type'], 0, 3) == "PNJ") {
            $personnage = DB::table('personnages')->where('id', $data['personnage'])->get();
            $pnj = DB::table('pnjs')->where('id', substr($data['type'], 3))->get();
            $etape = DB::table('etapes')->where('id', $data['etape'])->get();
            $currentEtape = $data['etape'];
            $currentQuete = $data['quete'];
            $currentEtapes = DB::table('etapes')->where('id', $data['etape'])->get();
            $currentQuetes = DB::table('quetes')->where('id', $data['quete'])->get();
            $allEtapes = $currentQuetes[0]->idEtapes;
            $allEtapes = explode('|', $allEtapes);
            DB::table('personnages')->where('id', $data['personnage'])->update(['currentQuete' => $data['quete'], 'currentEtape' => $data['etape'], 'updated_at' => DB::raw('now()')]);
            return view('user.currentPNJ')->with('pnj', $pnj)->with('personnage', $personnage)->with('currentEtape', $currentEtape)->with('currentQuete', $currentQuete);
        }
    }

    /**
      * Reponse
      *
      * Fonction Faire la reponse
      *
      * @return view; redirection vers l'affichage de reponse
      */
    public function reponse ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'player') {
            return view('user.panelMaster');
        }
        $data = Request::all();
        $enigme = DB::table('questions')->where('id', $data['question'])->get();
        $trueReponse = $enigme[0]->idAnswer;
        if ($data['reponse'] != $trueReponse) {
            Session::flash('messageBonneReponse', 'Bonne Réponse !!!');
            $personnage = DB::table('personnages')->where('id', $data['personnage'])->get();
            $currentEtape = DB::table('etapes')->where('id', $data['etape'])->get();
            $currentQuete = DB::table('quetes')->where('id', $data['quete'])->get();
            $currentEtape = $currentEtape[0]->id;
            $currentQuete = $currentQuete[0]->id;
            $reponsePossible = DB::table('reponses')->where('idAsk', $enigme[0]->id)->get();
            $reponses = [];
            $idReponses = [];
            foreach ($reponsePossible as $value) {
                array_push($reponses, $value->answer);
                array_push($idReponses, $value->id);
            }
            $currentEtape = DB::table('etapes')->where('id', $data['etape'])->get();
            $currentQuete = DB::table('quetes')->where('id', $data['quete'])->get();
            $currentEtape = $currentEtape[0]->id;
            $currentQuete = $currentQuete[0]->id;
            $personnage = DB::table('personnages')->where('idPlayer', Auth::user()->id)->get();
            Session::flash('messageMauvaiseReponse', 'Mauvaise réponse !!!');
            return self::quete($currentQuete, $currentEtape);
            //return view('user.currentEnigme')->with('enigme', $enigme)->with('idReponses', $idReponses)->with('reponses', $reponses)->with('personnage', $personnage)->with('currentEtape', $currentEtape)->with('currentQuete', $currentQuete);
        } else {
            $personnage = DB::table('personnages')->where('id', $data['personnage'])->get();
            DB::table('personnages')->where('id', $data['personnage'])->update(['currentQuete' => $data['quete'], 'xp' => $personnage[0]->xp + 100,'currentEtape' => $data['etape'] + 1, 'updated_at' => DB::raw('now()')]);
            $currentEtape = DB::table('etapes')->where('id', $data['etape'])->get();
            $currentQuete = DB::table('quetes')->where('id', $data['quete'])->get();
            $allEtapes = $currentQuete[0]->idEtapes;
            $allEtapes = explode('|', $allEtapes);
            if ($currentEtape[0]->id == $allEtapes[count($allEtapes)-1]) {
                $level = $currentQuete[0]->xp / 500;
                $xp = $currentQuete[0]->xp;
                $idItem = $currentQuete[0]->idItem;
                $itemGagner = DB::table('items')->where('id', $idItem)->get();
                $partieItem = $itemGagner[0]->partie;
                $nameItem = $itemGagner[0]->name;
                $HPItem = $itemGagner[0]->HP;
                $ADItem = $itemGagner[0]->AD;
                $APItem = $itemGagner[0]->AP;
                $armorItem = $itemGagner[0]->armor;
                $MRItem = $itemGagner[0]->MR;
                $peneArmorItem = $itemGagner[0]->peneArmor;
                $peneMRItem = $itemGagner[0]->peneMR;
                $levelItem = $itemGagner[0]->level;
                $partiePersonnage = $personnage[0]->$partieItem;
                $HPPersonnage = $personnage[0]->HP;
                $ADPersonnage = $personnage[0]->AD;
                $APPersonnage = $personnage[0]->AP;
                $armorPersonnage = $personnage[0]->armor;
                $MRPersonnage = $personnage[0]->MR;
                $peneArmorPersonnage = $personnage[0]->peneArmor;
                $peneMRPersonnage = $personnage[0]->peneMR;
                DB::table('personnages')->where('id', $data['personnage'])->update(['HP' => ($HPPersonnage + $HPItem), 'AD' => ($ADPersonnage + $ADItem), 'AP' => ($APPersonnage + $APItem), 'armor' => ($armorPersonnage + $armorItem), 'MR' => ($MRPersonnage + $MRItem), 'peneArmor' => ($peneArmorPersonnage + $peneMRItem), 'peneMR' => ($peneMRPersonnage + $peneMRItem), $partieItem => $partiePersonnage.$idItem.'|', 'updated_at' => DB::raw('now()')]);
                Session::flash('messageEquipementSuccess', $nameItem.' a bien été ajouter sur votre personnages !!!');
                DB::table('personnages')->where('id', $data['personnage'])->update(['currentQuete' => 0, 'level' => $personnage[0]->level + $level, 'skillPoint' => $personnage[0]->skillPoint + ($level * 10), 'currentEtape' => 0, 'updated_at' => DB::raw('now()')]);
                Session::flash('messageQueteFini', 'Quête fini !!!');
                return self::panelPlayer();
            }
            $currentEtape = $currentEtape[0]->id;
            $currentQuete = $currentQuete[0]->id;
            if ($personnage[0]->xp == 400) {
                DB::table('personnages')->where('id', $data['personnage'])->update(['currentQuete' => $data['quete'], 'xp' => 0, 'level' => $personnage[0]->level + 1, 'skillPoint' => $personnage[0]->skillPoint + 10, 'currentEtape' => $data['etape'] + 1, 'updated_at' => DB::raw('now()')]);
                Session::flash('messageLevelUp', 'Vous passez level '.($personnage[0]->level + 1).' !!!');
            }
            Session::flash('messageBonneReponse', 'Bonne réponse !!!');
            return self::quete($currentQuete, $currentEtape + 1);
        }
    }

    /**
      * Victory
      *
      * Fonction Faire la suite
      *
      * @param integer; $idQuete ; id de la quête
      * @param integer; $idEtape ; id de l'etape
      * @param integer; $idEtape ; id du personnage
      *
      * @return view; redirection vers l'affichage de faire la suite de la quete
      */
    public function victory ($idQuete, $idEtape, $idPerso)
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'player') {
            return view('user.panelMaster');
        }
        $quete = DB::table('quetes')->where('id', $idQuete)->get();
        $etape = DB::table('etapes')->where('id', ($idEtape + 1))->get();
        $currentQuete = DB::table('quetes')->where('id', $idQuete)->get();
        $currentEtape = DB::table('etapes')->where('id', $idEtape)->get();
        $personnage = DB::table('personnages')->where('id', $idPerso)->get();
        $allEtapes = $currentQuete[0]->idEtapes;
        $allEtapes = explode('|', $allEtapes);
        if ($currentEtape[0]->id == $allEtapes[count($allEtapes)-1]) {
            $level = $currentQuete[0]->xp / 500;
            $xp = $currentQuete[0]->xp;
            $idItem = $currentQuete[0]->idItem;
            $itemGagner = DB::table('items')->where('id', $idItem)->get();
            $partieItem = $itemGagner[0]->partie;
            $nameItem = $itemGagner[0]->name;
            $HPItem = $itemGagner[0]->HP;
            $ADItem = $itemGagner[0]->AD;
            $APItem = $itemGagner[0]->AP;
            $armorItem = $itemGagner[0]->armor;
            $MRItem = $itemGagner[0]->MR;
            $peneArmorItem = $itemGagner[0]->peneArmor;
            $peneMRItem = $itemGagner[0]->peneMR;
            $levelItem = $itemGagner[0]->level;
            $partiePersonnage = $personnage[0]->$partieItem;
            $HPPersonnage = $personnage[0]->HP;
            $ADPersonnage = $personnage[0]->AD;
            $APPersonnage = $personnage[0]->AP;
            $armorPersonnage = $personnage[0]->armor;
            $MRPersonnage = $personnage[0]->MR;
            $peneArmorPersonnage = $personnage[0]->peneArmor;
            $peneMRPersonnage = $personnage[0]->peneMR;
            DB::table('personnages')->where('id', $idPerso)->update(['HP' => ($HPPersonnage + $HPItem), 'AD' => ($ADPersonnage + $ADItem), 'AP' => ($APPersonnage + $APItem), 'armor' => ($armorPersonnage + $armorItem), 'MR' => ($MRPersonnage + $MRItem), 'peneArmor' => ($peneArmorPersonnage + $peneMRItem), 'peneMR' => ($peneMRPersonnage + $peneMRItem), $partieItem => $partiePersonnage.$idItem.'|', 'updated_at' => DB::raw('now()')]);
            Session::flash('messageEquipementSuccess', $nameItem.' a bien été ajouter sur votre personnages !!!');
            DB::table('personnages')->where('id', $idPerso)->update(['currentQuete' => 0, 'level' => $personnage[0]->level + $level, 'skillPoint' => $personnage[0]->skillPoint + ($level * 10), 'currentEtape' => 0, 'updated_at' => DB::raw('now()')]);
            Session::flash('messageQueteFini', 'Quête fini !!!');
            return self::panelPlayer();
        }
        $currentPerso = DB::table('personnages')->where('id', $idPerso)->get();
        $personnage = DB::table('personnages')->where('idPlayer', Auth::user()->id)->get();
        if ($currentPerso[0]->xp == 400) {
            DB::table('personnages')->where('id', $currentPerso[0]->id)->update(['currentQuete' => $idQuete, 'xp' => 0, 'level' => $personnage[0]->level + 1, 'skillPoint' => $currentPerso[0]->skillPoint + 10, 'currentEtape' => $idEtape + 1, 'updated_at' => DB::raw('now()')]);
            Session::flash('messageLevelUp', 'Vous passez level '.($personnage[0]->level + 1).' !!!');
        }
        DB::table('personnages')->where('id', $currentPerso[0]->id)->update(['currentQuete' => $idQuete, 'currentEtape' => $idEtape + 1, 'updated_at' => DB::raw('now()')]);
        Session::flash('messageWin', 'Votre personnage a gagne !!!');
        return view('user.currentQuete')->with('currentQuete', $quete)->with('currentEtape', $etape)->with('personnages', $personnage);
    }

    /**
      * Defeat
      *
      * Fonction Faire la suite
      *
      * @param integer; $idQuete ; id de la quête
      * @param integer; $idEtape ; id de l'etape
      *
      * @return view; redirection vers l'affichage de faire la suite de la quete
      */
    public function defeat ($idQuete, $idEtape)
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'player') {
            return view('user.panelMaster');
        }
        $quete = DB::table('quetes')->where('id', $idQuete)->get();
        $etape = DB::table('etapes')->where('id', $idEtape)->get();
        $personnage = DB::table('personnages')->where('idPlayer', Auth::user()->id)->get();
        Session::flash('messageLoose', 'Votre personnage a perdu !!!');
        return view('user.currentQuete')->with('currentQuete', $quete)->with('currentEtape', $etape)->with('personnages', $personnage);
    }

    /**
      * AddSkill
      *
      * Fonction afficher ajout skill au personnage
      *
      * @return view; redirection vers l'affichage ajout skill au personnage
      */
    public function addSkill ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'player') {
            return view('user.panelMaster');
        }
        $personnages = DB::table('personnages')->where('idPlayer', Auth::user()->id)->get();
        return view('user.addSkill')->with('personnages', $personnages);
    }

    /**
      * AjoutSkill
      *
      * Fonction ajouter les skills
      *
      * @return view; redirection vers l'affichage ajout skill au personnage
      */
    public function ajoutSkill ()
    {
        if (Auth::check() == false) {
            Session::flash('messagePasCo', 'Vous devez être connecter !!!');
            return view('user.accueil');
        }
        if (Auth::user()->droit != 'player') {
            return view('user.panelMaster');
        }
        $data = Request::all();
        $personnage = DB::table('personnages')->where('id', $data['id'])->get();
        $currentStat = $personnage[0]->$data['typeSkill'];
        $currentPoint = $personnage[0]->skillPoint;
        DB::table('personnages')->where('id', $data['id'])->update([$data['typeSkill'] => ($currentStat + $data['nbSkill']), 'skillPoint' => ($currentPoint - $data['nbSkill']), 'updated_at' => DB::raw('now()')]);
        Session::flash('messageAddSkillSuccess', 'Point ajouter avec success !!!');
        return redirect()->back();
    }

    /**
      * Deco
      *
      * Fonction deconnexion
      *
      * @return view; redirection vers le login
      */
    public function deco ()
    {
        Auth::logout();
        return view('user.accueil');
    }
}