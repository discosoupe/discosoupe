<nav class="navbar">
  <div class="navbar-inner">
      <ul class="nav">
        <li><a href="<?php echo site_url('accueil');?>"><i class="icon-home"></i></a></li>
        <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo site_url('actu');?>"> Toutes les actualités <b class="caret"></b> </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('actu');?>">Actualités</a></li>
            <li><a href="<?php echo site_url('agenda');?>">Agenda & évènements</a></li>
            <li><a href="<?php echo site_url('presse');?>">Articles de presse</a></li>
          </ul>
        </li>
        <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo site_url('association');?>"> Notre association <b class="caret"></b> </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('association');?>">Notre association</a></li>
            <li><a href="<?php echo site_url('concept');?>">Le concept</a></li>
            <li><a href="<?php echo site_url('historique');?>">Historique</a></li>
            <li><a href="<?php echo site_url('valeur');?>">Nos valeurs</a></li>
            <li><a href="<?php echo site_url('localisation');?>">Localisation/contact</a></li>
          </ul>
        </li>
        <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo site_url('gaspillage');?>"> Le gaspillage en image <b class="caret"></b> </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('gaspillage');?>">Recueil d'infographie</a></li>
          </ul>
        </li>
        <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo site_url('recette');?>"> Espace discopains <b class="caret"></b> </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('recette');?>">Recettes</a></li>
            <li><a href="<?php echo site_url('tutoriel');?>">Tutoriel</a></li>
            <li><a href="<?php echo site_url('toolbox');?>">Tool Box</a></li>
            <li><a href="<?php echo site_url('atelier');?>">Ateliers</a></li>
            <?php
            	if($this->session->userdata('is_logged_in') == 'ok'){
            		echo '<li><a href="'.site_url('valideuser').'">Valider Disco Copain</a></li>';
            	}
            ?>
          </ul>
        </li>
        <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo site_url('partenaire');?>"> Espace partenaires <b class="caret"></b> </a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('partenaire');?>">Statuts</a></li>
            <li><a href="<?php echo site_url('aide');?>">Comment nous aider</a></li>
            <li><a href="<?php echo site_url('dossier');?>">Dossier de presse</a></li>
          </ul>
        </li>
      </ul>
  </div>
</nav>