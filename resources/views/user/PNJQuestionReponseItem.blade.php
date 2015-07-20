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
    <!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <?php
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
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Master {!! Auth::user()->name !!} {!! Auth::user()->lastname !!}
                <small>Level {!! Auth::user()->level !!}</small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Tout vos PNJ</h2>
        </div>
        <?php
        foreach ($PNJ as $value) {
            ?>
            <div class="col-lg-4 col-sm-6 text-center">
                <?php if ($value->picture == null) {
                    ?>
                    <img class="img-circle img-responsive img-center avatar" src="http://placehold.it/200x200" alt="no picture yet !!">
                    <?php
                } else {
                    ?>
                    <img class="img-circle img-responsive img-center avatar" src="{!! url() !!}/avatarPNJ/<?php echo $value->picture; ?>" alt="$value->name">
                    <?php
                } ?>
                <h3><?php echo $value->name; ?>
                    <small>Level : <?php echo $value->level ?></small>
                </h3>
                <h2>Point de Vie : <?php echo $value->HP; ?></h2>
                <h2>Dégats Physiques : <?php echo $value->AD; ?></h2>
                <h2>Dégats Magiques : <?php echo $value->AP; ?></h2>
                <h2>Armure : <?php echo $value->armor; ?></h2>
                <h2>Résistances Magiques : <?php echo $value->MR; ?></h2>
                <h2>Pénétration Armure : <?php echo $value->peneArmor; ?></h2>
                <h2>Pénétration Magiques : <?php echo $value->peneMR; ?></h2>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Tout vos énigmes</h2>
        </div>
        <?php
        foreach ($enigme as $value) {
            ?>
            <div class="col-lg-4 col-sm-6 text-center">
                <h3><?php echo $value->ask; ?>
                    <small>Réponse : <?php echo $value->answer; ?></small>
                </h3>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</body>
</html>