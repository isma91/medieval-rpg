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
    if (Session::has('messageAddSkillSuccess')) {
        ?>
        <div class="alert alert-success" role="alert">{!! Session::get('messageAddSkillSuccess') !!}</div>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Player {!! Auth::user()->name !!} {!! Auth::user()->lastname !!}
                <small>Level {!! Auth::user()->level !!}</small>
            </h1>
            <p><?php if (empty($personnages)) {
                ?>Vous n'avez pas de personnages !! Voulez-vous en <a href="addPersonnage">créer</a> un ?<?php
            } ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Ameliorer vos Personnages</h2>
        </div>
        <?php if(!empty($personnages)){
            foreach ($personnages as $value) {
                ?>
                {!! Form::open(['url' => 'ajoutSkill']) !!}
                <div class="col-lg-12 col-sm-6 text-center">
                    <img class="img-circle img-responsive img-center avatar" src="{!! url() !!}/avatarPersonnage/<?php echo $value->picture;?>" alt="avatar <?php echo $value->name; ?>">
                    <h3><?php echo $value->name; ?>
                        <small>Level  <?php echo $value->level ?></small>
                    </h3>
                    <div class="form-group">
                        {!! Form::label('typeSkill', 'Choisissez sur quelle caracteristique voulez ajouter :') !!}
                        <select class="form-control" id="typeSkill" name="typeSkill">
                                <option value="HP">HP</option>
                                <option value="AD">AD</option>
                                <option value="AP">AP</option>
                                <option value="armor">armor</option>
                                <option value="MR">MR</option>
                                <option value="peneArmor">peneArmor</option>
                                <option value="peneMR">peneMR</option>
                        </select>
                    </div>
                    <div class="form-group">
                        {!! Form::label('nbSkill', 'Choisissez le nombre de point que vous voulez ajouter :') !!}
                        <select class="form-control" id="nbSkill" name="nbSkill">
                        <?php for ($i=1; $i <= $value->skillPoint; $i++) { 
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                            } ?>
                        </select>
                    </div>
                    <h4>Argent disponible : <?php echo $value->argent; ?></h4>
                    <h4>Point disponible : <?php echo $value->skillPoint; ?></h4>
                    <h4>Point de Vie : <?php echo $value->HP; ?></h4>
                    <h4>Dégats Physiques : <?php echo $value->AD; ?></h4>
                    <h4>Dégats Magiques : <?php echo $value->AP; ?></h4>
                    <h4>Armure : <?php echo $value->armor; ?></h4>
                    <h4>Résistances Magiques : <?php echo $value->MR; ?></h4>
                    <h4>Pénétration Armure : <?php echo $value->peneArmor; ?></h4>
                    <h4>Pénétration Magiques : <?php echo $value->peneMR; ?></h4>
                    <input type="hidden" name="id" value="<?php echo $value->id; ?>">
                </div>
                <div class="form-group">
                    {!! Form::submit('Ajouter les points', ['class' => 'btn btn-primary form-control']) !!}
                </div>
                {!! Form::close() !!}
                <?php
            }
        }
        ?>
    </div>
</div>
</body>
</html>