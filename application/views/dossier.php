<h1>Dossier de presse</h1>
<hr />

<form method="post">
	Lien Event Facebook : <input name="fblinkevent" class="input-xxlarge" placeholder="https://www.facebook.com/events/472934692792634/" />
	<button type="submit">Synchroniser</button>
</form>

<?php
	if(isset($event_facebook)){
		foreach ($event_facebook as $event) {
			echo "<div class='carte'>";
			echo "<table class='table table-striped'>
				<caption>";
					echo "<h3>".$event['name']."</h3>";
					echo "<table class='table table-bordered'><tr>";
						echo "<td>Créateur</td><td>Emplacement</td>
							<td>date de début</td>";
						if($event['end_time']){
							echo "<td>date de fin</td>";
						}
						echo "<td>nombre de participants</td>";
						echo "</tr><tr>";
						echo "<td>".$event['host']."</td>";
						echo "<td>".$event['location']."</td>";
						echo "<td>".date('j M Y - G:i' ,strtotime($event['start_time']))."</td>";
						if($event['end_time']){
							echo "<td>".date('j M Y - G:i' , strtotime($event['end_time']))."</td>";
						}
						echo "<td>".$event['attending_count']."</td>";
					echo "</tr></table>";
			echo "</caption>";
			echo "<tr>";
			echo "<td width='300'><img src='".$event['pic_big']."' width='280'/></td>";
			echo "<td>".nl2br($event['description'])."</td>";
			echo "</tr>";
			echo "</table>";
			
			echo "</div><br /><br />";
		}
	}
?>