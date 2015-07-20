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
    if (Session::has('messageMauvaiseReponse')) {
        ?>
        <div class="alert alert-warning" role="alert">{!! Session::get('messageMauvaiseReponse') !!}</div>
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
            <h2 class="page-header">Voici l'enigme :</h2>
        </div>
        <?php
        foreach ($enigme as $value) {
            ?>
            <div class="col-lg-4 col-sm-6 text-center">
                <h3><?php echo $value->ask; ?>
                </h3>
            </div>
            <?php
        }
        ?>
    </div>
    {!! Form::open(['url' => 'reponse']) !!}
    <div class="form-group">
        {!! Form::label('reponse', 'La réponse :') !!}
        <select name="reponse" id="reponse" class="form-control">
            <?php for ($i = 0; $i < count($idReponses); $i++) {
                ?>
                <option value="<?php echo $idReponses[$i]; ?>"><?php echo $reponses[$i]; ?></option>
                <?php
            }?>
        </select>
    </div>
    <input type="hidden" name="etape" value="<?php echo $currentEtape; ?>">
    <input type="hidden" name="quete" value="<?php echo $currentQuete; ?>">
    <input type="hidden" name="question" value="<?php echo $enigme[0]->id; ?>">
    <input type="hidden" name="personnage" value="<?php echo $personnage[0]->id; ?>">
    <div class="form-group">
        {!! Form::submit('Go pour Etape', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
</div>
</body>
</html>