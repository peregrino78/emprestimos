<?php 
class Parcelas extends Model
{
	protected $table = 'parcelas';

	public function cadastrar($input = array())
	{
		$data['valor_parcela'] = $input['valor_parcela'];
		$data['id_emprestimo'] = $input['id_emprestimo'];
		$data['parcela_paga'] = $input['parcela_paga'];
		$data['data_pagamento'] = $input['data_pagamento'];
		$data['hora_pagamento'] = $input['hora_pagamento'];

		if ($this->save($data)) {
			return true;
		}

		return false;
	}

	public function parcelas_pagas($id_emprestimo)
	{
		$consulta = $this->select()
		->where('id_emprestimo', '=', $id_emprestimo)
		->and_too('parcela_paga', '=', true);

		$resultado = $this->prepare($consulta);
		return count($resultado);
	}

	public function listar_parcelas($id_emprestimo)
	{
		$consulta = $this->select()->where('id_emprestimo', '=' ,$id_emprestimo);
		return $this->prepare($consulta);

	}

	/*public function valor_quitado($id_emprestimo)
	{
		$consulta = $this->select()->where('id_emprestimo', '=', $id_emprestimo);
		$resultado = $this->prepare($consulta);

		$valor_quitado = 0;
		foreach ($resultado as $valor) {
			$valor_quitado += $valor->valor_parcela;
		}

		return $valor_quitado;
	}*/
}