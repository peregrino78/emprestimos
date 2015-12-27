<?php 
class Clientes_Controller extends Controller
{
	protected $clientes;
	protected $view;

	public function __construct($models = array())
	{
		$this->clientes = $models['Clientes'];
		$this->view = $this->view();
	}

	public function index()
	{
		$this->view->layout('layout_default');
		return $this->view->make('clientes.index');
	}

	public function form_cadastrar()
	{
		$this->view->layout('layout_default');
		return $this->view->make('clientes.cadastrar');
	}

	public function cadastrar()
	{
		$data['nome'] = Input::in_post('nome');
		$data['sobre_nome'] = Input::in_post('sobre_nome');
		$data['email'] = Input::in_post('email');

		if ($this->clientes->cadastrar($data)) {
			Session::flash('success', 'Usuário Cadastrado com Sucesso.');
		} else {
			Session::flash('error', 'Erro ao tentar Cadastrar este Usuário.');
		}
        
		return Redirect::to('clientes.form_cadastrar');
	}

	public function listar_clientes()
	{
		$this->view->layout('layout_default');
		$clientes = $this->clientes->listar_clientes();
		return $this->view->make('clientes.clientes_cadastrados', compact('clientes'));
	}

	public function form_editar()
	{
		$id_cliente = Input::in_get('id_cliente');
		$cliente = $this->clientes->obter_cliente_pelo_id($id_cliente);

		$this->view->layout('layout_default');
		return $this->view->make('clientes.editar', compact('cliente'));
	}

	public function editar()
	{
		$id_cliente = Input::in_get('id_cliente');
		$data['nome'] = Input::in_post('nome');
		$data['sobre_nome'] = Input::in_post('sobre_nome');
		$data['email'] = Input::in_post('email');

		if ($this->clientes->editar($data, $id_cliente)) {
			Session::flash('success', 'Usuário Editado com Sucesso.');
		} else {
			Session::flash('error', 'Erro ao tentar Editar Usuário.');
		}

		return Redirect::to('clientes.form_editar', "id_cliente={$id_cliente}");
	}
}