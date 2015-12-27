<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Gerenciador de Emprestimos</title>

	<?php Helper::css('css.bootstrap');?>
	<?php Helper::css('css.style');?>
</head>

<body>
	<section class="section_menu">
		<ul class="ul_menu">
			<li><a <?php Helper::link_to('clientes.index');?>Inicio</a></li>
			<li><a <?php Helper::link_to('clientes.form_cadastrar');?>Cadastrar Clientes</a></li>
			<li><a <?php Helper::link_to('clientes.listar_clientes');?>Clientes Cadastrados</a></li>
		</ul>
	</section>

	<?php require_once($this->content);?>

	<?php Helper::script('js.jquery');?>
	<?php Helper::script('js.bootstrap');?>
	
</body>
</html>