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
    if (Session::has('messageNameEmpty')) {
        ?>
        <div class="alert alert-success">{!! Session::get('messageNameEmpty') !!}</div>
        <?php
    }
    if (Session::has('messageNoImage')) {
        ?>
        <div class="alert alert-danger">{!! Session::get('messageNoImage') !!}</div>
        <?php
    }
    if (Session::has('messageDejaCo')) {
        ?>
        <div class="alert alert-warning" role="alert">{!! Session::get('messageDejaCo') !!}</div>
        <?php
    }
    if (Session::has('messagePersonnageSuccess')) {
        ?>
        <div class="alert alert-success" role="alert">{!! Session::get('messagePersonnageSuccess') !!}</div>
        <?php
    }
    if (Session::has('messageImageValide')) {
        ?>
        <div class="alert alert-success" role="alert">{!! Session::get('messageImageValide') !!}</div>
        <?php
    }
    ?>
</div>
<div class="container">
    <div class="jumbotron">
        <h1>Bienvenue <?php echo Auth::user()->lastname;?> <?php echo Auth::user()->name;?> !!</h1>
        <p>Créer votre personnage et faite lui monter de level !!!</p>
        {!! Form::open(['url' => 'ajoutPersonnage', 'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Son Nom :') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Son nom']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('file', 'Avatar  :') !!}
            {!! Form::input('file', 'file', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Ajouter un personnage', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
</body>
</html>