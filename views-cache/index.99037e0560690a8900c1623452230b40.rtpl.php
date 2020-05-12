<?php if(!class_exists('Rain\Tpl')){exit;}?><body onload="ajax();">
	<form method="post" action="/admin/chat" id="chatbody">
		<?php $counter1=-1;  if( isset($users) && ( is_array($users) || $users instanceof Traversable ) && sizeof($users) ) foreach( $users as $key1 => $value1 ){ $counter1++; ?>
		<input type="text" name="name" placeholder="Insere o seu nome: " value="<?php echo htmlspecialchars( $value1["desperson"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" readonly="true">
		<?php } ?>
		<div class="messages" id="chat">
			<?php $counter1=-1;  if( isset($chat) && ( is_array($chat) || $chat instanceof Traversable ) && sizeof($chat) ) foreach( $chat as $key1 => $value1 ){ $counter1++; ?>
			<div class="message"><strong><?php echo htmlspecialchars( $value1["name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></strong>: <?php echo htmlspecialchars( $value1["message"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
			<?php } ?>
		</div>
		<input type="text" name="message" placeholder="mensagem">
		<button class="enviar" type="submit">Enviar</button>

		<a href="/admin">Voltar</a>
		
	</form>
