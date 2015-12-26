<section class="content">
	<h2>Cadastro de Cliêntes</h2>
	<hr>

    <?php Helper::import_once('views.flash_message.flash_message');?>

	<form method="post" <?php Helper::action("clientes.cadastrar");?>
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o Nome do Cliênte..."/>
        </div>

        <div class="form-group">
            <label for="sobre_nome">Sobre Nome</label>
            <input type="text" class="form-control" name="sobre_nome" id="sobre_nome" placeholder="Digite o Sobre Nome do Cliênte..."/>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Digite o Email do Cliênte..."/>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Cadastrar Cliênte</button>
        </div>
    </form>
</section>