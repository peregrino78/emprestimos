<section class="content">
	<h2>Lista de Parcelas</h2>
	<hr>

    <h4>Parcelas do Emprestimo do Clênte: 
        <small>
            <?php echo "{$cliente['nome']} {$cliente['sobre_nome']}";?>
        </small>
    </h4>

<?php //if ($tem_emprestimo):?>

    <table class="table table-bordered table-hover table-striped">
        <tr>
            <td><b>Protocolo</b></td>
            <td><b>Valor da Prcela</b></td>
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

<?php //else:?>  
   
<?php //endif;?>
    
</section>