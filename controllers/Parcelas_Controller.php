<?php 
class Parcelas_Controller extends Controller
{
	protected $parcelas;
	protected $emprestimos;
	protected $clientes;
	protected $validator;
	protected $view;
	protected $parcelas_por_emprestimos;

	public function __construct($models = array(), $services = array())
	{
		$this->parcelas = $models['Parcelas'];
		$this->emprestimos = $models['Emprestimos'];
		$this->clientes = $models['Clientes'];
		$this->validator = $services['Data_Validator'];
		
		$this->view = $this->view();
	}

	public function form_cadastrar()
	{
		$id_cliente = Input::in_get('id_cliente');
		$id_emprestimo = Input::in_get('id_emprestimo');

		$cliente = $this->clientes->obter_cliente_pelo_id($id_cliente);
		$emprestimo = $this->emprestimos->obter_emprestimo_por_id($id_emprestimo);

		$this->view->layout('layout_default');
		return $this->view->make('parcelas.cadastrar', compact('cliente', 'emprestimo'));
	}

	public function cadastrar()
	{
		$id_cliente = Input::in_get('id_cliente');
		$id_emprestimo = Input::in_get('id_emprestimo');

		$data['valor_parcela'] = Input::in_post('valor_parcela');
		$data['id_emprestimo'] = $id_emprestimo;
		$data['parcela_paga'] = true;
		$data['data_pagamento'] = Date::date_now('br');
		$data['hora_pagamento'] = Date::hour();
        
        $this->validator->set('valor_parcela', $data['valor_parcela'])->is_required();

        if ($this->validator->validate()) {
        	if ($this->parcelas->cadastrar($data)) {
			    Session::flash('success', 'Pagamento Cadastrado com Sucesso.');
		    } else {
			    Session::flash('error', 'Erro ao tentar Cadastrar o Pagamento.');
		    }
        }

        foreach ($this->validator->get_errors() as $erro) {
        	Session::flash('error', $erro[0]);
        }
		
		return Redirect::to('parcelas.form_cadastrar', "id_cliente={$id_cliente}|id_emprestimo={$id_emprestimo}");
	}

	public function listar_parcelas()
	{
		$id_cliente = Input::in_get('id_cliente');
		$id_emprestimo = Input::in_get('id_emprestimo');

		$cliente = $this->clientes->obter_cliente_pelo_id($id_cliente);
		$emprestimo = $this->emprestimos->obter_emprestimo_por_id($id_emprestimo);

		$this->parcelas_por_emprestimos = $this->parcelas($id_emprestimo);
		$parcelas = $this->parcelas_por_emprestimos;
		$quitado = $this->valor_quitado();
		$falta_quitar = $this->valor_nao_quitado($id_emprestimo);

		$this->view->layout('layout_default');
		return $this->view->make('parcelas.listar_parcelas', compact('parcelas', 'cliente', 'emprestimo','quitado', 'falta_quitar'));
	}

	public function parcelas($id_emprestimo)
	{
		return $this->parcelas->listar_parcelas($id_emprestimo);
	}

	public function valor_quitado()
	{
		$valor_quitado = 0;
		foreach ($this->parcelas_por_emprestimos as $valor) {
			$valor_quitado += $valor->valor_parcela;
		}

		return $valor_quitado;
	}

	public function valor_nao_quitado($id_emprestimo)
	{
		$emprestimo = $this->emprestimos->obter_emprestimo_por_id($id_emprestimo);
		return $emprestimo['valor_emprestimo'] - $this->valor_quitado();
	}
}