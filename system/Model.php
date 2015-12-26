<?php 
require_once('traits/String_helper.php');
require_once('traits/Generating_perfect_url.php');
require_once('traits/Get_url.php');

require_once('traits/Input.php');
require_once('traits/Helper.php');
require_once('traits/Auth.php');
require_once('traits/Hash.php');
require_once('traits/Redirect.php');
require_once('traits/Session.php');
require_once('traits/Pagination.php');
require_once('traits/Date.php');

class Model extends Persistence
{
	use Input,
	Helper,
	Auth,
	Hash,
	Redirect,
	Session,
	Pagination,
	Get_url,
	Date;
}