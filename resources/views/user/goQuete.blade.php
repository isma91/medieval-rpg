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
                <li>
                    <a href="goQuete">Participer Quêtes</a>
                </li>
                <li>
                    <a href="addSkill">Ajoter skills points</a>
                </li>
                <li>
                    <a href="equipement">Equipement</a>
                </li>
                <li>
                    <a href="addPersonnage">Créer personnage</a>
                </li>
                <li>
                    <a href="itemAndPNJ">PNJ et items généraux</a>
                </li>
                <li>
                    <a href="profilPlayer">Profil</a>
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
            <h1 class="page-header">Player {!! Auth::user()->name !!} {!! Auth::user()->lastname !!}
                <small>Level {!! Auth::user()->level !!}</small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Tout les Quêtes possibles pour votre level </h2>
        </div>
    </div>
    <div class="row">
        <?php if(!empty($quetes)){
            foreach ($quetes as $value) {
                $nbEtapes = explode('|', $value->idEtapes);
                ?>
                <div class="col-lg-4 col-sm-6 text-center">
                    <h3><?php echo $value->name; ?>
                        <small>Level  <?php echo $value->level ?></small>
                    </h3>
                    <h4>XP donnés : <?php echo $value->xp; ?></h4>
                    <h4>Nombres d'étapes : <?php echo count($nbEtapes); ?></h4>
                    <h4><a href="quete/<?php echo $value->id; ?>/<?php echo $nbEtapes[0]; ?>">GO</a></h4>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="col-lg-4 col-sm-6 text-center">
                <h3>Pas de quête pour vous pour l'instant !!
                </h3>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</body>
</html>