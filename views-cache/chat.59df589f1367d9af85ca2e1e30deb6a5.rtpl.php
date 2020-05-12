<?php if(!class_exists('Rain\Tpl')){exit;}?><link rel="stylesheet" href="/views/admin/chatadmin/public/style.css">
	<script type="text/javascript">
		function ajax(){
			var req = new XMLHttpRequest();
			req.onreadystatechange = function(){
				if (req.readyState == 4 && req.status == 200) {
						document.getElementById('chat').innerHTML = req.responseText;
				}
			}
			req.open('GET', 'chat.php', true);
			req.send();
		}
	
		setInterval(function(){ajax();}, 1000);

 
	</script>
<body onload="ajax();">
	<form method="post" action="/admin/chat" id="chatbody">
		<input type="text" name="name" placeholder="Insere o seu nome: ">
		<div class="messages" id="chat">
			<?php $counter1=-1;  if( isset($chat) && ( is_array($chat) || $chat instanceof Traversable ) && sizeof($chat) ) foreach( $chat as $key1 => $value1 ){ $counter1++; ?>
			<div class="message"><strong><?php echo htmlspecialchars( $value1["name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></strong>: <?php echo htmlspecialchars( $value1["message"], ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
			<?php } ?>
		</div>
		<input type="text" name="message" placeholder="mensagem">
		<input type="submit" value="Enviar">
		
	</form>
