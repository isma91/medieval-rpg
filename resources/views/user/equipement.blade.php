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
    {!! Html::script('js/equipement.js') !!}
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
    if (Session::has('messagePasArgent')) {
        ?>
        <div class="alert alert-danger">{!! Session::get('messagePasArgent') !!}</div>
        <?php
    }
    if (Session::has('messagePasLevel')) {
        ?>
        <div class="alert alert-danger">{!! Session::get('messagePasLevel') !!}</div>
        <?php
    }
    if (Session::has('messageFullTete')) {
        ?>
        <div class="alert alert-danger">{!! Session::get('messageFullTete') !!}</div>
        <?php
    }
    if (Session::has('messageFullVisage')) {
        ?>
        <div class="alert alert-warning" role="alert">{!! Session::get('messageFullVisage') !!}</div>
        <?php
    }
    if (Session::has('messageFullMains')) {
        ?>
        <div class="alert alert-warning" role="alert">{!! Session::get('messageFullMains') !!}</div>
        <?php
    }
    if (Session::has('messageFullDoigts')) {
        ?>
        <div class="alert alert-warning" role="alert">{!! Session::get('messageFullDoigts') !!}</div>
        <?php
    }
    if (Session::has('messageFullCorps')) {
        ?>
        <div class="alert alert-warning" role="alert">{!! Session::get('messageFullCorps') !!}</div>
        <?php
    }
    if (Session::has('messageFullHanche')) {
        ?>
        <div class="alert alert-warning" role="alert">{!! Session::get('messageFullHanche') !!}</div>
        <?php
    }
    if (Session::has('messageEquipementSuccess')) {
        ?>
        <div class="alert alert-success" role="alert">{!! Session::get('messageEquipementSuccess') !!}</div>
        <?php
    }
    ?>
</div>
<div class="container">
    <div class="jumbotron">
        <h1>Bienvenue <?php echo Auth::user()->lastname;?> <?php echo Auth::user()->name;?> !!</h1>
        <p>Ajouter un équipemment à votre personnage choisit !!!</p>
        <div id="items"><?php foreach ($items as $value) {
            echo $value->id.'|';
            echo $value->level.'|';
            echo $value->prix.'|';
            echo $value->partie.':';
        } ?></div>
        <div id="characters"><?php foreach ($personnages as $value) {
            echo $value->id.'|';
            echo $value->argent.':';
        }?></div>
        {!! Form::open(['url' => 'ajoutEquipement', 'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('personnage', 'Le personnage :') !!}
            <select name="personnage" id="personnage" class="form-control">
                <?php foreach ($personnages as $value) {
                    ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                    <?php
                }?>
            </select>
        </div>
        <div class="form-group" id="argentPersonnage"></div>
        <div class="form-group">
            {!! Form::label('equipement', 'Equipement que vous voulez ajouter  :') !!}
            <select name="equipement" id="equipement" class="form-control">
                <?php foreach ($items as $value) {
                    ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                    <?php
                }?>
            </select>
        </div>
        <div class="form-group" id="argentRestePersonnage"></div>
        <div class="form-group" id="argentItem"></div>
        <div class="form-group" id="submit">
            {!! Form::submit('Equipement !!!!', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
</body>
</html>