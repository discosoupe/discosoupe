<footer>
	<div class="row-fluid">
		<div class="span12">
			<center>
				<!-- Button to trigger modal -->
				©discosoupe 2012 - <a href="#nouscontacter" role="button" data-toggle="modal">NOUS CONTACTER</button></a>
					<!-- Modal -->
			</center>
			<div id="nouscontacter" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align="center">
				<form method="post" id="footercontactform" class="modal-body form-horizontal">
			    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    	<p id="parafooter">
			    		Pour nous envoyer un message, veuillez remplir le formulaire
			    	</p>
			    	<br />
			    	<center>
					<div class="control-group"><input name="footermail" id="footermail" class="input-xlarge" type="text" placeholder="adresse@mail.com" /></div>
					<div class="control-group"><input name="footerobjet" id="footerobjet" class="input-xlarge" type="text" placeholder="Objet du message" onpaste="return false;"/></div>
					<div class="control-group">
						<textarea class="input-xlarge" rows="4" name="footermessage">votre message</textarea>
					</div>
					</center>
					<div class="modal-footer"><button id="buttonsendmessage" class="btn btn-block btn-danger">Envoyer</button></div>
				</form>
				<script>
					$("#footercontactform").submit(function(event){
						event.preventDefault();
						$.ajax({
				            url: "<?php echo site_url('footercontact'); ?>",
				            type:"POST",
				            data: $(this).serialize(),
				            
				            beforeSend: function() {
					            $("#buttonsendmessage").hide();
					            $("#loading").show();
					        },
					
					        complete: function() {
					            $("#buttonsendmessage").show();
					            $("#loading").hide();
					        },        
					        cache: false,
					       
				            success: function(){
				            	$('#nouscontacter').modal('hide');
			            		$('#envoiereussi').modal('show');
			            	}
			            });
					});
				</script>		
			</div>
			<div id="envoiereussi" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    	<div class="modal-form">
				    <div class="modal-body form-horizontal">
				    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				    	<center>
					    	<h3 id="myModalLabel">
						    	Votre message a bien été envoyé<br />
						    	Merci !!!
						    </h3>
					    </center>
				    </div>
				</div>
			</div>
		</div>
	</div>
</footer>