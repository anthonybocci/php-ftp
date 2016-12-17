# Php-transport

PHP class to use transport.

Class(es) implemented:

## FTP

This class has simple methods to connect, set host, and can handle every ftp_* PHP method using __call. So to use *ftp_login*, just call login
 method without give $ftp_stream parameter.

Example:

    ftp_login ( resource $ftp_stream , string $username , string $password )

become

    $ftpObject->login($yourUsername, $yourPassword);

ftp stream is automatically given by this class.
