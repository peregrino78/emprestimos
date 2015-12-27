<section class="content">
	<h2>Lista de Parcelas Pagas | 
        <small>
            <a <?php Helper::link_to('parcelas.form_cadastrar', "id_cliente={$cliente['id']}|id_emprestimo={$emprestimo['id']}");?>
                Efetuar pagamento de Parcela
            </a>
        </small>
    </h2>
	<hr>

    <h4>
        Parcelas do Emprestimo do Clênte: 
        <small>
            <?php echo "{$cliente['nome']} {$cliente['sobre_nome']}";?> |
        </small>

        Emprestimo: 
        <small>
            <?php echo 'R$ ' . number_format($emprestimo['valor_emprestimo'], 2, ',' , '.');?>
        </small>

        Quitado: 
        <small>
            <?php echo 'R$ ' . number_format($quitado, 2, ',' , '.');?>
        </small>

        Falta quitar: 
        <small>
            <?php echo 'R$ ' . number_format($falta_quitar, 2, ',' , '.');?>
        </small>
    </h4>

    <table class="table table-bordered table-hover table-striped">
        <tr>
            <td><b>Protocolo</b></td>
            <td><b>Valor da Parcela</b></td>
            <td><b>Data de Pagamento</b></td>
            <td><b>Hora do Pagamento</b></td>
        </tr>

        <?php foreach ($parcelas as $parcela):?>

        <tr>
            <td><?php echo $parcela->id;?></td>
            <td><?php echo 'R$ ' . number_format($parcela->valor_parcela, 2, ',', '.');?></td>
            <td><?php echo $parcela->data_pagamento;?></td>
            <td><?php echo $parcela->hora_pagamento;?></td>
        </tr>

        <?php endforeach;?>
    </table>

</section>