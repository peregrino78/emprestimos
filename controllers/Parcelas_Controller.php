<?php 
class Parcelas_Controller extends Controller
{
	protected $parcelas;
	protected $emprestimos;
	protected $clientes;
	protected $view;

	public function __construct($models = array())
	{
		$this->parcelas = $models['Parcelas'];
		$this->emprestimos = $models['Emprestimos'];
		$this->clientes = $models['Clientes'];
		
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

		if ($this->parcelas->cadastrar($data)) {
			Session::flash('success', 'Pagamento Cadastrado com Sucesso.');
		} else {
			Session::flash('error', 'Erro ao tentar Cadastrar o Pagamento.');
		}

		Redirect::to('parcelas.form_cadastrar', "id_cliente={$id_cliente}|id_emprestimo={$id_emprestimo}");
	}

	public function listar_parcelas()
	{
		$id_cliente = Input::in_get('id_cliente');
		$id_emprestimo = Input::in_get('id_emprestimo');

		$cliente = $this->clientes->obter_cliente_pelo_id($id_cliente);
		$emprestimo = $this->emprestimos->obter_emprestimo_por_id($id_emprestimo);
		$parcelas = $this->parcelas->listar_parcelas($id_emprestimo);

		$this->view->layout('layout_default');
		return $this->view->make('parcelas.listar_parcelas', compact('parcelas', 'cliente', 'emprestimo'));
	}
}
