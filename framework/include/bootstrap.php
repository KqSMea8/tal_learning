<?php
/**
 * 异常处理
 * @param lib_base_exception $exception
 */
function exception_handler(lib_base_exception $exception)
{
    lib_base_exception::log($exception->__toString());
}
/**
 * 错误处理
 * @param string $handler
 * @param int $types
 * @throws lib_base_exception
 */
function error_handler($handler, $types)
{
    if (!(error_reporting() & $handler)) {
        return false;
    }
    switch ($handler) {
        case E_NOTICE:
            return true;

        case E_USER_NOTICE:
            return true;

        default:
            throw new lib_base_exception($handler.$types);
    }

}

if(!DEBUG)
{
    //由于没有日志系统，暂时不处理
    // //捕捉异常
    // if(function_exists('set_exception_handler'))
    // {
    //     set_exception_handler('exception_handler');
    // }
    //捕捉错误
    if(function_exists('set_error_handler'))
    {
        set_error_handler('error_handler');
    }

    ini_set('display_errors', 'Off');
    error_reporting(E_ALL & ~E_NOTICE);
}
else
{
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
}

/**
 * 自动加载处理方法
 * @param string $classname
 * @throws lib_base_exception
 * @return boolean
 */
class load
{
	public static function loadClass($classname)
	{
		$path = explode('_',$classname);
	    switch ($path[0])
	    {
	        case 'fw' :
	            unset($path[0]);
	            $file = FRAMEWORK_DIR . implode($path, '/') . '.class.php';
	            break;
	        case 'lib' :
	            $file = FRAMEWORK_DIR . implode($path, '/') . '.class.php';
	            break;
            case 'vendor' :
                $file = ROOT_DIR. implode($path, '/') . '.class.php';
                break;
	        case 'config' :
	            $file = ROOT_DIR . lib_router::ret_site() . '/' . implode($path, '/') . '.class.php';
	            if (!isset($file) || !file_exists($file))
	            {
	                $file = ROOT_DIR . implode($path, '/') . '.class.php';
	            }
	            break;
	        default:
	            $file = ROOT_DIR . lib_router::ret_site() . '/' . implode($path, '/') . '.class.php';
                $file2 = ROOT_DIR . DEFAULT_SITE . '/' . implode($path, '/') . '.class.php';
	    }

    if (isset($file) && file_exists($file))
    {
        require_once "$file";
    }else if(isset($file2) && file_exists($file2)){
        require_once "$file2";
    }else
    {
        require_once FRAMEWORK_DIR . 'lib/base/exception.class.php';
        throw new lib_base_exception($file . ' file does not exist');
    }
	}

}
spl_autoload_register(array('load','loadClass'));
