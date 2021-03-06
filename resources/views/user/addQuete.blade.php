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
    {!! Html::script('js/etapes.js') !!}
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
    if (Session::has('messageAucunChoix')) {
        ?>
        <div class="alert alert-warning" role="alert">{!! Session::get('messageAucunChoix') !!}</div>
        <?php
    }
    if (Session::has('messageQueteSuccess')) {
        ?>
        <div class="alert alert-success" role="alert">{!! Session::get('messageQueteSuccess') !!}</div>
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
            <div id="item"><?php foreach ($items as $value) {
                echo $value->id."|";
                echo $value ->name.":";
                /*echo $value->HP."|";
                echo $value->AD."|";
                echo $value->AP."|";
                echo $value->armor."|";
                echo $value->MR."|";
                echo $value->peneArmor."|";
                echo $value->peneMR."|";
                echo $value->picture."|";
                echo $value->type."|";
                echo $value->partie."|";
                echo $value->prix.":";*/
            } ?></div>
            <div id="url">{!! url() !!}/avatarPNJ/</div>
            <div id="pnj">
                <?php foreach ($PNJ as $value) {
                    echo $value->id."|";
                    echo $value->name."|";
                    echo $value->HP."|";
                    echo $value->AD."|";
                    echo $value->AP."|";
                    echo $value->armor."|";
                    echo $value->MR."|";
                    echo $value->peneArmor."|";
                    echo $value->peneMR."|";
                    echo $value->picture."|";
                    echo $value->level.":";
                } ?>
            </div>
            <div id="enigme">
                <?php foreach ($enigme as $value) {
                    echo $value->id."|";
                    echo $value->ask.":";
                } ?>
            </div>
            <p>Une quête ce fait par plusieurs étapes !!</p>
            <p>Noté que votre quête auras le même level que vous !!</p>
            {!! Form::open(['url' => 'ajoutQuete']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Le Nom :') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'nom de quete']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('choix', 'Nombre de questions :') !!}
                <select class="form-control" name="choix" id="choix">
                    <option value="aucun">non sélectionnée</option>
                    <?php
                    for ($i=3; $i <= (5 *Auth::user()->level); $i++) { 
                        ?>
                        <option value="<?php echo $i?>"><?php echo $i;?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group" id="etape"></div>
            <div class="form-group" id="allPNJ"></div>
            <div class="form-group">
                {!! Form::label('xp', 'XP à la fin de la quête :') !!}
                <select class="form-control" name="xp" id="xp">
                    <?php
                    for ($i=(100* Auth::user()->level); $i <= (1000 *Auth::user()->level); $i = $i + 500) { 
                        ?>
                        <option value="<?php echo $i?>"><?php echo $i;?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group" id="allItem"></div>
            <div class="form-group">
                {!! Form::submit('Ajouter quête', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
</body>
</html>