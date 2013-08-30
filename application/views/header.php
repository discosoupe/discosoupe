<header class="carte">
	<br />
	<div class="row-fluid">
		<div class="span2" align="right">
			<?php echo img("logo.png", $alt = "logo");?>
		</div>
		<div class="span6">
			<h1>Disco Soupe</h1>
			<h3>Le recyclage du gaspillage, la propriété du recyclage</h3>
		</div>
		<div class="span4">
			<?php if ($this->session->userdata('is_logged_in') == 'ok'){ ?>
			<form action="" method="post" class="form-inline" style="margin-top: 20px; margin-bottom: 8px">
				<button name="deconnexion" class="btn" type="submit" value="deconnexion">deconnexion</button>
			</form>
			<?php }else{ ?>
			<form action="" method="post" class="form-inline" style="margin-top: 20px; margin-bottom: 8px">
				<input name="login" type="text" class="input-small" placeholder="log in" />
				<input name="password" type="password" class="input-small" placeholder="password" />
				<button class="btn" type="submit"><i class="icon-user"></i></button>
			</form>
			<?php } ?>
			<a href="mailto:discosoupe@gmail.com"><i class="icon-envelope"></i> Contact</a> :
			<?php echo '<a href="https://www.facebook.com/DiscoSoupe">'.img("u70_normal.png", $alt = "co").'</a>';?>
			<?php echo img("u72_normal.png", $alt = "co");?>
			<?php echo '<a href="http://vimeo.com/39596405">'.img("u74_normal.png", $alt = "co").'</a>';?>
			<?php echo img("u76_normal.png", $alt = "co");?>
			<?php echo img("u78_normal.png", $alt = "co");?>
		</div>
	</div>
	<br />
</header>