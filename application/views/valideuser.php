<div class="row-fluid">
	<div class="fondjaune soustitre span12">
		<center><h1>Valider Disco Copain</h1></center>
	</div>
</div>
<br />
<div class="row-fluid">
    <div class="carte span12">
    	<?php
    		$nbusertovalide = count($usertovalide);
			if($nbusertovalide == 0){
				echo "<center>Il n'y a pas de Disco copains à valider !</center>";
			}else{
				echo "<table class='table table-striped'>";
				for($i=0; $i<$nbusertovalide; $i++){
					echo "<tr>";
					echo "<td>".$usertovalide[$i]->mail." </td>
					<td>
					<form method='post'> 
						<button name='valideuser' class='btn' type='submit' value='".$usertovalide[$i]->iduser."'>validez <i class='icon-thumbs-up'></i></button>
					</form>
					</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
    	?>
    </div>
</div>