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
    {!! Html::script('js/jquery-2.1.3.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::style('css/cover.css') !!}
    {!! Html::style('css/my_style.css') !!}
    <!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
    <div class="site-wrapper">
        <div class="site-wrapper-inner">
            <div class="cover-container">
                <div class="masthead clearfix">
                    <div class="inner">
                        <h3 class="masthead-brand" id="titre">Medieval RPG</h3>
                        <nav>
                            <ul class="nav masthead-nav">
                                <li><a href="accueil">Accueil</a></li>
                                <li><a href="inscription">Inscription</a></li>
                                <li class="active"><a href="connexion">Connexion</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="inner cover">
                    <?php
                    if (Session::has('messagePasCo')) {
                        ?>
                        <div class="alert alert-warning" role="alert">{!! Session::get('messagePasCo') !!}</div>
                        <?php
                    }
                    if (Session::has('messageVerif')) {
                        ?>
                        <div class="alert alert-warning" role="alert">{!! Session::get('messageVerif') !!}</div>
                        <?php
                    }
                    ?>
                    <h1 class="cover-heading">Bienvenue dans Médieval RPG !!</h1>
                    <p class="lead">Inscrivez-vous pour commencer à créer votre personnage et des quetes !!</p>
                </div>
            </div>
            <div class="container"> 
                {!! Form::open(['url' => 'connexion']) !!}
                <div class="form-group">
                    {!! Form::label('username', 'Pseudo :') !!}
                    {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Votre pseudo']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password :') !!}
                    <input type="password" name="password" class="form-control" placeholder="MINIMUM 5 CHARACTERES" />
                </div>
                <div class="form-group">
                    <select class="form-control" name="droit">
                      <option value="player">Joueur</option>
                      <option value="master">Maitre de jeu</option>
                  </select>
              </div>
              <div class="form-group">
                {!! Form::submit('Connexion', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
</body>
</html>