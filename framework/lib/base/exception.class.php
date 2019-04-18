
<?php
/**
 * 基础异常类
 */

class lib_base_exception extends Exception
{
    /**
     * 构造函数
     * @param string $message
     * @param string $code
     */
    public function __construct($message=null, $code=null)
    {        
        parent::__construct($message, $code);
        self::log($this->__toString());
    }
    
    /**
     * 写入错误日志
     */
    public static function log($message = '')
    {
        $error_message = $message . ' date:' . date('Y-m-d H:i:s') . "\r\n";
        error_log($error_message, 0);
    }
}
?>