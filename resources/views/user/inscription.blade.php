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
								<li class="active"><a href="inscription">Inscription</a></li>
								<li><a href="connexion">Connexion</a></li>
							</ul>
						</nav>
					</div>
				</div>
				<?php
				if (Session::has('messagePasCo')) {
					?>
					<div class="alert alert-warning" role="alert">{!! Session::get('messagePasCo') !!}</div>
					<?php
				}if (Session::has('messageUserCreatedFailed')) {
					?>
					<div class="alert alert-danger" role="alert">{!! Session::get('messageUserCreatedFailed') !!}</div>
					<?php
				}if (Session::has('messageUserCreated')) {
					?>
					<div class="alert alert-success" role="alert">{!! Session::get('messageUserCreated') !!}</div>
					<?php
				}
				?>
				<div class="inner cover">
					<h1 class="cover-heading">Bienvenue dans Médieval RPG !!</h1>
					<p class="lead">Inscrivez-vous pour commencer à créer votre personnage et des quetes !!</p>
				</div>
			</div>
			<div class="container">
				{!! Form::open(['url' => 'inscription']) !!}
				<div class="form-group">
					{!! Form::label('name', 'Nom :') !!}
					{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Votre nom']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('lastname', 'Prenom :') !!}
					{!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Votre prenom']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('username', 'Pseudo :') !!}
					{!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Votre pseudo']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('password', 'Mot de passe :') !!}
					<input type="password" name="password" class="form-control" placeholder="MINIMUM 5 CHARACTERES" />
				</div>
				<div class="form-group">
					{!! Form::label('birthdate', 'Date de naissance :') !!}
					{!! Form::input('date', 'birthdate', null, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('email', 'Email :') !!}
					{!! Form::email('email', null, ['class' => 'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Inscription', ['class' => 'btn btn-primary form-control']) !!}
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</body>
</html>