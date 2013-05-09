<div class="container">
	<div class="row">
    	<div class="span12">
    		<h1>Les évènements et l'agenda</h1>
    		<?php 
    			foreach ($discosoupe as $disco) {
					echo "<br /><br />date : ".$disco->date;
					echo "<br />lieu : ".$disco->ville;
					echo "<br />adresse : ".$disco->adresse;
					echo "<br />evenement : ".$disco->evenement;
					echo "<br />telephone : ".$disco->telephone;
					echo "<br />contact : ".$disco->contact;
					echo "<br />email : ".$disco->email;
				}
    		?>
    	</div>
	</div>
</div>