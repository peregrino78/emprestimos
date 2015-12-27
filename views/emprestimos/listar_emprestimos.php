<section class="content">
	<h2>Lista de Emprestimos</h2>
	<hr>

    <h4>Emprestimos do Cliênte: 
        <small>
            <?php echo "{$cliente['nome']} {$cliente['sobre_nome']}";?>
        </small>
    </h4>

<?php if ($tem_emprestimo):?>

    <table class="table table-bordered table-hover table-striped">
        <tr>
            <td><b>Protocolo</b></td>
            <td><b>Quantia Emprestada</b></td>
            <td><b>Data do Emprestimo</b></td>
            <td><b>Açao Parcelas</b></td>
            <td><b>Ação Pagamento</b></td>
        </tr>

        <?php foreach ($emprestimos as $emprestimo):?>

        <tr>
            <td><?php echo $emprestimo->id;?></td>
            <td><?php echo 'R$ ' . number_format($emprestimo->valor_emprestimo, 2, ',', '.');?></td>
            <td><?php echo $emprestimo->data_emprestimo;?></td>
            <td><a <?php Helper::link_to('parcelas.listar_parcelas', "id_cliente={$emprestimo->id_cliente}|id_emprestimo={$emprestimo->id}");?>Visualizar Parcelas Pagas</a></td>
            <td><a <?php Helper::link_to('parcelas.form_cadastrar', "id_cliente={$emprestimo->id_cliente}|id_emprestimo={$emprestimo->id}");?>Cadastrar Pagamento</a></td>
        </tr>

        <?php endforeach;?>
    </table>

<?php else:?>  
    <p>Esse Usuário não tem nenhum emprestimo Contratado.</p>
<?php endif;?>
    
</section>