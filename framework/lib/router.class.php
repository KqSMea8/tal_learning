<?php
/**
 * 基础路由类
 */
class lib_router
{
    protected static $site;
    protected static $controller;
    protected static $action;
    /**
     * 当前控制器对象
     * @var object
     */
    protected $_cur_obj;

    public function __construct()
    {

    }

    /**
     * 处理Request等全局变量数据
     */
    public function dispose_request()
    {
        $_POST = daddslashes($_POST);
        $_GET  = daddslashes($_GET);
        $_REQUEST = daddslashes($_REQUEST);
    }

    /**
     * 路由调度
     */
    public function dispatch()
    {
        $this->dispose_request();

        self::$site = lib_context::get('site', lib_context::T_STRING, '');
        self::$controller = lib_context::get('ctl', lib_context::T_STRING, '');
        self::$action = lib_context::get('act', lib_context::T_STRING, '');

        self::$site = empty(self::$site) ? DEFAULT_SITE : self::$site;
        self::$controller = empty(self::$controller) ? DEFAULT_CONTROLLER : self::$controller;
        self::$action = empty(self::$action) ? DEFAULT_ACTION : self::$action;

        $class_name = 'controller_' . self::$controller;
        $class_file = ROOT_DIR . self::$site . '/' . str_replace('_', '/', $class_name) . '.class.php';

        //Controller不存在或Action不存在
        $controller_base = new fw_controller_base();
        if(!file_exists($class_file))
        {
            $controller_base->show_404('fw/lib/router89');
        }
        $this->_cur_obj = new $class_name();
    }

    /**
     * 执行路由
     */
    public function execute_router()
    {
        try {
            call_user_func_array(array($this->_cur_obj, self::$action), array());
        }catch (lib_base_exception $e){
            $controller_base = new fw_controller_base();
            $controller_base->show_404('fw/lib/router/100');
        }
    }


    /**
     * 返回当前应用
     */
    public static function ret_site()
    {
        return self::$site;
    }

    /**
     * 返回当前控制器
     */
    public static function ret_controller()
    {
        return self::$controller;
    }

    /**
     * 返回当前动作
     */
    public static function ret_action()
    {
        return self::$action;
    }

    /**
     * 加载其他组件类
     * 类名为组件名加上类名
     * @example manager_controller_login 即manager组件中controller_login类
     * @param unknown_type $class_name
     * @throws lib_base_exception
     */
    public static function load_class($class_name)
    {
        if(empty($class_name)) return false;
        $path = explode('_',$class_name);
        $file = ROOT_DIR . implode($path, '/') . '.class.php';

        if (isset($file) && file_exists($file))
        {
            require_once "$file";
        }
        else
        {
            require_once FRAMEWORK_DIR . 'lib/base/exception.class.php';
            throw new lib_base_exception($file . ' file does not exist');
        }
    }

    public function run()
    {
        $this->dispatch();
        $this->execute_router();
    }
}