<?php
require(__DIR__ . '/../library/controller.php');
require('../library/smarty/Smarty.class.php');

function autoload($class_name)
{
	$path = __DIR__ . '/../' . str_replace('\\', '/', $class_name) . '.php';
	require_once($path);
}

spl_autoload_extensions('.php');
spl_autoload_register('autoload');

class URL
{
	function __construct()
	{

	}

	static function controller()
	{
		$url = strtolower($_SERVER['REQUEST_URI']);
		$map = explode('/', $url);
		$controller = empty($map[1]) ? 'index' : $map[1];
		$action = empty($map[2]) ? 'index' : $map[2];
		if (file_exists(__DIR__ . '/../controllers/' . $controller . '.php'))
		{
			$controller = '\\controllers\\' . $controller;
			$cv = new $controller();
			$cv->action = $action;
			$cv->argvc = array_splice($map, 3);
			return $cv;
		}
		else
		{
			$cv = new controllers\index();
			// если второго параметра нет, то считаем что первый параметр - action
			$action = $controller;
			$cv->action = $action;
			$cv->argvc = array_splice($map, 2);
			return $cv;
		}
	}
}

class Render
{
	protected $smarty;

	public function smarty_init()
	{
		$smarty = new Smarty;


		//$smarty->force_compile = true;
		$smarty->debugging = false;
		$smarty->caching = false;
		$smarty->cache_lifetime = 120;
		$smarty->setTemplateDir(__DIR__ . '/../templates/views/');
		$smarty->addTemplateDir(__DIR__ . '/../templates/layout/');

		$this->smarty = $smarty;
	}

	public function view($controller)
	{
		$this->smarty_init();
		$class_name = get_class($controller);
		$view = explode('\\', $class_name);
		$folder = end($view);
		/** @var $controller controller */
		$action = $controller->action;
		$args = '';
		foreach ($controller->argvc as $key => $value)
		{
			$args .= '$controller->argvc[' . $key . '],';
		}
		$args = substr_replace($args, '', -1, 1);
		$controller->preDispatch();
		eval('$controller->' . $action . "($args);");
		$controller->postDispatch();
		if (isset($controller->view))
		{
			foreach ($controller->view as $key => $value)
			{
				$this->smarty->assign($key, $value);
			}
		}
		if (file_exists(__DIR__ . '/../templates/views/' . $folder . '/' . $action . '.tpl'))
		{
			$this->smarty->display($folder . '/' . $action . '.tpl');
		}
		elseif (file_exists(__DIR__ . '/../templates/views/' . $folder . '/' . $action . '.phtml'))
		{
			require_once(__DIR__ . '/../templates/views/' . $folder . '/' . $action . '.phtml');
		}
		else
		{
			require_once(__DIR__ . '/../templates/views/' . $folder . '/index.phtml');
		}
	}

	public function __get($name)
	{
		return '';
	}
}

$cv = URL::controller();
$render = new Render;
$render->view($cv);