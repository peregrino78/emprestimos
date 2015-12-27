<?php 
class Clientes extends Model
{
	protected $table = 'clientes';

	public function cadastrar($input = array())
	{
		$data['nome'] = $input['nome'];
		$data['sobre_nome'] = $input['sobre_nome'];
		$data['email'] = $input['email'];

		if ($this->save($data)) {
			return true;
		}

		return false;
	}

	public function listar_clientes()
	{
		return $this->select()->get_all();
	}

	public function obter_cliente_pelo_id($id_cliente)
	{
		return $this->find($id_cliente);
	}

	public function editar($input = array(), $id_cliente)
	{
		$data['nome'] = $input['nome'];
		$data['sobre_nome'] = $input['sobre_nome'];
		$data['email'] = $input['email'];

		if ($this->update($data, $id_cliente)) {
			return true;
		}

		return false;
	}
}