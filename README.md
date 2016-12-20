# Php-transport

PHP class to use transport.

Class(es) implemented:

## FTP

This class has simple methods to connect, set host, and can handle every ftp_* PHP method using __call. So to use *ftp_login*, just call login
 method without give $ftp_stream parameter.

Usage:

```php
<?php
//Creates $ftp instance and connect automatically
$ftp = new \AnthonyBocci\Transport\FTP($host, $login, $password);
//$loginSuccess equals true if success, false otherwise
$loginSuccess = $ftp->login();

//Without this class, to put a file on a remote server we should use this method:
//ftp_put($myFtpStream, $targetFileName, $localFileName);
//With this class $myFtpStream can be avoided in all methods
//Only use the end of method name, after ftp_ and avoid $ftp_stream parameter
$ftp->put($targetFileName, $localFileName);
```
