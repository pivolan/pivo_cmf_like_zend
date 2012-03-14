<?php
/**
 * Created by PhpStorm.
 * User: pivo
 * Date: 24.04.2011
 * Time: 3:22:50
 * To change this template use File | Settings | File Templates.
 */
namespace controllers;
use \models\db\Adb;
use library\jquery_file_upload\UploadHandler;

class file extends \library\controller
{
	public $page;

	function preDispatch()
	{
		parent::preDispatch();
	}

	function postDispatch()
	{
	}

	function delete()
	{
		$upload_handler = new UploadHandler(array(
			'script_url' => '/index/upload/',
			'upload_dir'=> __DIR__.'/../public/files/'
		));
		header('Pragma: no-cache');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Content-Disposition: inline; filename="files.json"');
		header('X-Content-Type-Options: nosniff');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
		header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');
		$upload_handler->delete();
	}

	function upload()
	{
		$upload_handler = new UploadHandler(array(
			'script_url' => '/file/delete/',
			'upload_dir'=> __DIR__.'/../public/files/'
		));
		header('Pragma: no-cache');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Content-Disposition: inline; filename="files.json"');
		header('X-Content-Type-Options: nosniff');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
		header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

		switch ($_SERVER['REQUEST_METHOD']) {
		    case 'OPTIONS':
		        break;
		    case 'HEAD':
		    case 'GET':
		        $upload_handler->get();
		        break;
		    case 'POST':
		        if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
		            $upload_handler->delete();
		        } else {
		            $upload_handler->post();
		        }
		        break;
		    case 'DELETE':
		        $upload_handler->delete();
		        break;
		    default:
		        header('HTTP/1.1 405 Method Not Allowed');
		}
	}
}
