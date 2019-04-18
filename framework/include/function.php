<?php

/**
 * 转义数据
 * @param string|array $string
 * @param int $force
 */
function daddslashes($string, $force = 0)
{
	if (!get_magic_quotes_gpc() || $force)
	{
		if (is_array($string))
		{
			foreach ($string as $key => $val)
			{
				$string[$key] = daddslashes($val, $force);
			}
		}
		else
		{
			$string = addslashes($string);
		}
	}
	return $string;
}

if (! function_exists('app')) {
    /**
     * Get the available container instance.
     */
    function app($make = null)
    {
        if (is_null($make)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($make);
    }
}
