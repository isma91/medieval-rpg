<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Medieval RPG</title>
    <meta charset="utf-8" />
    <meta name="description" content="Entrez dans un monde dédieval et faites des quetes merveilleuses !!" />
    <link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/bootstrap-theme.min.css') !!}
    {!! Html::style('css/bootstrap.css.map') !!}
    {!! Html::style('css/bootstrap-theme.css.map') !!}
    {!! Html::style('css/round-about.css') !!}
    {!! Html::style('css/my_style.css') !!}
    {!! Html::script('js/jquery-2.1.3.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::script('js/valuePNJ.js') !!}
    <!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <?php if (Auth::user()->droit == 'player') {
                ?>
                <a class="navbar-brand" href="panelPlayer" id="titre">Medieval RPG</a>
                <?php
            }
            if (Auth::user()->droit == 'master') {
                ?>
                <a class="navbar-brand" href="panelMaster" id="titre">Medieval RPG</a>
                <?php
            } ?>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="addQuete" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ajouter Quêtes<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="addItem">Ajouter Item</a></li>
                      <li><a href="addQuestionReponse">Ajouter Question/Réponse</a></li>
                      <li><a href="addPNJ">Ajouter PNJ</a></li>
                      <li><a href="addQuete">Ajouter Quêtes</a></li>
                  </ul>
              </li>
              <li>
                <a href="allQuete">Voir vos quêtes</a>
            </li>
            <li>
                <a href="PNJQuestionReponseItem">Vos enigmes et PNJ</a>
            </li>
            <li>
                <a href="itemAndPNJ">Items généraux</a>
            </li>
            <li>
                <a href="profilMaster">Profil</a>
            </li>
            <li>
                <a href="deco">Déconnexion</a>
            </li>
        </ul>
    </div>
</div>
</nav>
<div class="container">
    <?php
    if (Session::has('messageDejaCo')) {
        ?>
        <div class="alert alert-warning" role="alert">{!! Session::get('messageDejaCo') !!}</div>
        <?php
    }
    if (Session::has('messageNameEmpty')) {
        ?>
        <div class="alert alert-warning" role="alert">{!! Session::get('messageNameEmpty') !!}</div>
        <?php
    }
    if (Session::has('messageAvatarEmpty')) {
        ?>
        <div class="alert alert-warning" role="alert">{!! Session::get('messageAvatarEmpty') !!}</div>
        <?php
    }
    if (Session::has('messageAvatarNoImage')) {
        ?>
        <div class="alert alert-warning" role="alert">{!! Session::get('messageAvatarNoImage') !!}</div>
        <?php
    }
    if (Session::has('messagePNJSuccess')) {
        ?>
        <div class="alert alert-success" role="alert">{!! Session::get('messagePNJSuccess') !!}</div>
        <?php
    }
    if (Session::has('messageLevelUp')) {
        ?>
        <div class="alert alert-success" role="alert">{!! Session::get('messageLevelUp') !!}</div>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Master {!! Auth::user()->name !!} {!! Auth::user()->lastname !!}
                <small>Level {!! Auth::user()->level !!}</small>
            </h1>
            <p>Oublier pas de créer vos items, PNJ et questions <big>AVANT</big> de créer une quête !!!</p>
        </div>
    </div>
    <div class="container">
        <div class="jumbotron">
            <p>Vous êtes level {!! Auth::user()->level !!} donc vous pouvez ajout {!! 100*Auth::user()->level !!} point de vie et {!! 10*Auth::user()->level !!} points sur les autres caractéristiques</p>
            <p>Noté que votre PNJ auras le même niveau que vous !!</p>
            {!! Form::open(['url' => 'ajoutPNJ', 'files'=>true]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Le Nom :') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Votre nom']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('HP', 'Point de vie :') !!}
                <p id="valeurHP"></p>
                <input type="range" name="HP" id="HP" class="form-control" min="1" max="{!! 100 * Auth::user()->level !!}" value="1" onchange="HPValue()" />
            </div>
            <div class="form-group">
                {!! Form::label('AD', 'Attack Physique :') !!}
                <p id="valeurAD"></p>
                <input type="range" name="AD" id="AD" class="form-control" min="0" max="{!! 10 * Auth::user()->level !!}" value="0" onchange="ADValue()" />
            </div>
            <div class="form-group">
                {!! Form::label('AP', 'Attack Magique :') !!}
                <p id="valeurAP"></p>
                <input type="range" name="AP" id="AP" class="form-control" min="0" max="{!! 10 * Auth::user()->level !!}" value="0" onchange="APValue()" />
            </div>
            <div class="form-group">
                {!! Form::label('armor', 'Armure :') !!}
                <p id="valeurArmor"></p>
                <input type="range" name="armor" id="armor" class="form-control" min="0" max="{!! 10 * Auth::user()->level !!}" value="0" onchange="armorValue()" />
            </div>
            <div class="form-group">
                {!! Form::label('MR', 'Résistence Magique :') !!}
                <p id="valeurMR"></p>
                <input type="range" name="MR" id="MR" class="form-control" min="0" max="{!! 10 * Auth::user()->level !!}" value="0" onchange="MRValue()" />
            </div>
            <div class="form-group">
                {!! Form::label('peneArmor', 'Pénétration Armure :') !!}
                <p id="valeurPeneArmor"></p>
                <input type="range" name="peneArmor" id="peneArmor" class="form-control" min="0" max="{!! 10 * Auth::user()->level !!}" value="0" onchange="peneArmorValue()" />
            </div>
            <div class="form-group">
                {!! Form::label('peneMR', 'Pénétration Magique :') !!}
                <p id="valeurPeneMR"></p>
                <input type="range" name="peneMR" id="peneMR" class="form-control" min="0" max="{!! 10 * Auth::user()->level !!}" value="0" onchange="peneMRValue()" />
            </div>
            <div class="form-group">
                {!! Form::label('file', 'Avatar  :') !!}
                {!! Form::input('file', 'file', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Ajouter PNJ', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
</body>
</html>