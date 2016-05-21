
Call to undefined function curl_init的解决方法

在测试模拟登录时，出现“Call to undefined function curl_init”这个错误提示，
没有定义的函数，也就是php还没打开对curl_init函数的支持。

解决方法如下：
	1.打开php.ini，开启extension=php_curl.dll
	2.检查php.ini的extension_dir值是哪个目录，检查有无php_curl.dll，
	没有的请下载php_curl.dll，再把php目录中的libeay32.dll,ssleay32.dll
	拷到c:\windows\system32里面