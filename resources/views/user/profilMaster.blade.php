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
    if (Session::has('messagePass')) {
        ?>
        <div class="alert alert-success">{!! Session::get('messagePass') !!}</div>
        <?php
    }
    if (Session::has('messageOldPass')) {
        ?>
        <div class="alert alert-danger">{!! Session::get('messageOldPass') !!}</div>
        <?php
    }
    if (Session::has('messageNewPass')) {
        ?>
        <div class="alert alert-danger">{!! Session::get('messageNewPass') !!}</div>
        <?php
    }
    if (Session::has('messageDejaCo')) {
        ?>
        <div class="alert alert-warning" role="alert">{!! Session::get('messageDejaCo') !!}</div>
        <?php
    }
    if (Session::has('messageUpdateUserUsername')) {
        ?>
        <div class="alert alert-danger" role="alert">{!! Session::get('messageUpdateUserUsername') !!}</div>
        <?php
    }
    if (Session::has('messageUpdateUser')) {
        ?>
        <div class="alert alert-success" role="alert">{!! Session::get('messageUpdateUser') !!}</div>
        <?php
    }
    if (Session::has('messagePasImage')) {
        ?>
        <div class="alert alert-success" role="alert">{!! Session::get('messagePasImage') !!}</div>
        <?php
    }
    ?>
</div>
<div class="container">
    <div class="jumbotron">
        <h1>Bienvenue <?php echo Auth::user()->lastname;?> <?php echo Auth::user()->name;?> !!</h1>
        <?php if (Auth::user()->picture == null) {
            ?>
            <img class="img-circle img-responsive img-center avatar" src="http://placehold.it/200x200" alt="no avatar">
            <?php
        } else {
            ?>
            <img class="img-circle img-responsive img-center avatar" src="{!! url() !!}/avatar/{!! Auth::user()->picture !!}" alt="avatar">
            <?php
        }
        ?>
        <p>Vous pouvez changer votre profil selon vos envies !!</p>
        {!! Form::open(['url' => 'updateProfilUser', 'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Votre Nom :') !!}
            {!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'placeholder' => 'Votre nom']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('lastname', 'Votre Prenom :') !!}
            {!! Form::text('lastname', Auth::user()->lastname, ['class' => 'form-control', 'placeholder' => 'Votre prenom']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('birthdate', 'Votre Date de naissance :') !!}
            {!! Form::input('date', 'birthdate', Auth::user()->birthdate, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Votre Email :') !!}
            {!! Form::email('email', Auth::user()->email, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('file', 'Avatar  :') !!}
            {!! Form::input('file', 'file', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Modifier votre profil', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
        {!! Form::open(['url' => 'updateUserPass']) !!}
        <div class="form-group">
            {!! Form::label('oldPassword', 'Ancien Mot de passe :') !!}
            <input type="password" name="oldPassword" class="form-control" id="oldPassword" placeholder="MINIMUM 5 CHARACTERES" />
        </div>
        <div class="form-group">
            {!! Form::label('newPassword', 'Nouveau Mot de passe :') !!}
            <input type="password" name="newPassword" class="form-control" id="newPassword" placeholder="MINIMUM 5 CHARACTERES" />
        </div>
        <div class="form-group">
            {!! Form::submit('Modifier votre mot de passe', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
</body>
</html>