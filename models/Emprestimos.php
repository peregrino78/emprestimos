<?php 
class Emprestimos extends Model
{
	protected $table = 'emprestimos';

	public function cadastrar($input = array())
	{
		$data['valor_emprestimo'] = $input['valor_emprestimo'];
		$data['id_cliente'] = $input['id_cliente'];
		$data['data_emprestimo'] = $input['data_emprestimo'];
		$data['hora_emprestimo'] = $input['hora_emprestimo'];

		if ($this->save($data)) {
			return true;
		}

		return false;
	}

	public function listar_emprestimos_por_cliente($id_cliente)
	{
		$consulta = $this->select()->where('id_cliente', '=', $id_cliente);
		$resultado = $this->prepare($consulta);

		if (count($resultado) < 1) {
			return false;
		}

		return $resultado;
	}

	public function obter_emprestimo_por_id($id_emprestimo)
	{
		return $this->find($id_emprestimo);
	}

	public function obter_um_emprestimo_por_cliente($id_cliente)
	{
		$emprestimo = $this->find_by('id_cliente', $id_cliente);
		return $emprestimo;
	}
}