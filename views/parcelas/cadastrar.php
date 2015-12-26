<section class="content">
	<h2>Cadastro de Pagamento de Parcelas</h2>
	<hr>

    <?php Helper::import_once('views.flash_message.flash_message');?>

    <h4>
        Cliênte: 
        <small>
            <?php echo "{$cliente['nome']} {$cliente['sobre_nome']}";?> |
        </small>
        
        Protocolo:
        <small>
            <?php echo $emprestimo['id'];?> |
        </small>

        Valor:
        <small>
            <?php echo 'R$ ' . number_format($emprestimo['valor_emprestimo'], 2, ',', '.');?> |
        </small>

        Emprestado em:
        <small>
            <?php echo $emprestimo['data_emprestimo'];?>
        </small>
    </h4>

	<form method="post" <?php Helper::action("parcelas.cadastrar", "id_cliente={$cliente['id']}|id_emprestimo={$emprestimo['id']}");?>
        <div class="form-group">
            <label for="valor_parcela">Quantia a ser Paga</label>
            <input type="text" class="form-control" name="valor_parcela" id="valor_parcela" placeholder="Digite o valor monetário..."/>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Cadastrar Pagamento</button>
        </div>
    </form>
</section>