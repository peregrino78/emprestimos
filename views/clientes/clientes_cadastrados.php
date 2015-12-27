<section class="content">
	<h2>Lista de Cliêntes Cadastrados</h2>
	<hr>

    <table class="table table-bordered table-hover table-striped">
        <tr>
            <td><b>Nome</b></td>
            <td><b>Email</b></td>
            <td><b>Ação Cadastrar</b></td>
            <td><b>Emprestimos</b></td>
            <td><b>Editar</b></td>  
        </tr>

        <?php foreach ($clientes as $cliente):?>

        <tr>
            <td><?php echo "{$cliente->nome} {$cliente->sobre_nome}"?></td>
            <td><?php echo $cliente->email;?></td>
            <td><a <?php Helper::link_to('emprestimos.form_cadastrar', "id_cliente={$cliente->id}");?>Cadastrar Emprestimos</a></td>
            <td><a <a <?php Helper::link_to('emprestimos.listar_emprestimos_por_cliente', "id_cliente={$cliente->id}");?>Listar Emprestimos</a></td>
            <td><a class="btn btn-small btn-success btn-sm" <?php Helper::link_to('clientes.form_editar', "id_cliente={$cliente->id}");?>Editar</a></td>
        </tr>

        <?php endforeach;?>
    </table>
    

</section>