<?php 
class Emprestimos_Controller extends Controller
{
	protected $emprestimos;
	protected $clientes;
	protected $parcelas;
	protected $validator;
	protected $view;

	public function __construct($models = array(), $services = array())
	{
		$this->emprestimos = $models['Emprestimos'];
		$this->clientes = $models['Clientes'];
		$this->parcelas = $models['Parcelas'];
		$this->validator = $services['Data_Validator'];

		$this->view = $this->view();
	}

	public function form_cadastrar()
	{
		$id_cliente = Input::in_get('id_cliente');
		$cliente = $this->clientes->obter_cliente_pelo_id($id_cliente);

		$this->view->layout('layout_default');
		return $this->view->make('emprestimos.cadastrar', compact('cliente'));
	}

	public function cadastrar()
	{
		$data['valor_emprestimo'] = Input::in_post('valor_emprestimo');
		$data['id_cliente'] = Input::in_get('id_cliente');
		$data['data_emprestimo'] = Date::date_now('br');
		$data['hora_emprestimo'] = Date::hour();

		$this->validator->set('valor_emprestimo', $data['valor_emprestimo'])->is_required();

		if ($this->validator->validate()) {
			if ($this->emprestimos->cadastrar($data)) {
			    Session::flash('success', 'Emprestimo Cadastrado com Sucesso.');
		    } else {
			    Session::flash('error', 'Erro ao tentar Cadastrar o Emprestimo.');
		    }
		}

		foreach ($this->validator->get_errors() as $erro) {
        	Session::flash('error', $erro[0]);
        }
		
		return Redirect::to('emprestimos.form_cadastrar', "id_cliente={$data['id_cliente']}");
	}


	public function listar_emprestimos_por_cliente()
	{
		$id_cliente = Input::in_get('id_cliente');
		$cliente = $this->clientes->obter_cliente_pelo_id($id_cliente);
		$emprestimos = $this->ober_lista_de_emprestimos_por_clientes($id_cliente);
		$emprestimo_por_id = $this->emprestimo_por_cliente($id_cliente);
        
        $tem_emprestimo = false;
		if ($emprestimos) {
			$tem_emprestimo = true;
		}

		$this->view->layout('layout_default');
		return $this->view->make('emprestimos.listar_emprestimos', compact('tem_emprestimo', 'emprestimos', 'cliente'));
	}

	private function emprestimo_por_cliente($id_cliente)
	{
		return $this->emprestimos->obter_um_emprestimo_por_cliente($id_cliente);
	}

	private function parcelas_pagas($id_emprestimo)
	{
		return $this->parcelas->parcelas_pagas($id_emprestimo);
	}

	private function ober_lista_de_emprestimos_por_clientes($id_cliente)
	{
		return $this->emprestimos->listar_emprestimos_por_cliente($id_cliente);
	}

	public function quitado($id_emprestimo)
	{
		return $this->parcelas->valor_quitado($id_emprestimo);
	}
}