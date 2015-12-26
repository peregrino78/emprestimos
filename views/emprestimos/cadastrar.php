<section class="content">
	<h2>Cadastro de Emprestimos</h2>
	<hr>

    <?php Helper::import_once('views.flash_message.flash_message');?>

    <h4>Emprestimo destinado ao Cliênte: 
        <small>
            <?php echo "{$cliente['nome']} {$cliente['sobre_nome']}";?>
        </small>
    </h4>

	<form method="post" <?php Helper::action("emprestimos.cadastrar", "id_cliente={$cliente['id']}");?>
        <div class="form-group">
            <label for="valor_emprestimo">Quantia a ser emprestada</label>
            <input type="text" class="form-control" name="valor_emprestimo" id="valor_emprestimo" placeholder="Digite o valor monetário..."/>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Cadastrar Emprestimo</button>
        </div>
    </form>
</section>