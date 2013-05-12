<div class="container">
	<div class="row">
    	<div class="span12">
    		<h1>Les partenaires</h1>
    		<?php 
    			foreach ($partenaire as $parten) {
    				echo "<table class=\"table table-bordered\">
    						<caption><h4>Entreprise : ".$parten->entreprise."</h4></caption>";
							echo "<tr><td>localisation : </td><td>".$parten->ville."</td></tr>";
							echo "<tr><td>choix de partenariat: </td><td>";
							if($parten->choix == 1)
								echo "fournisseur";
							if($parten->choix == 2)
								echo "transporteur";
							if($parten->choix == 3)
								echo "financeur";
							echo "</td></tr>";
							echo "<tr><td>adresse : </td><td>".$parten->adresse."</td></tr>";
							echo "<tr><td>telephone : </td><td>".$parten->telephone."</td></tr>";
							echo "<tr><td>contact : </td><td>".$parten->contact."</td></tr>";
							echo "<tr><td>email : </td><td>".$parten->email."</td></tr>";
					echo "</table><br/>";
				}
    		?>
    	</div>
	</div>
</div>