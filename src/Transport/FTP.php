<?php

namespace AnthonyBocci\Transport;

/**
 * @class FTP
 * An FTP class to do stuff with FTP
 */
class FTP
{
    /**
     * @var string
     * The server url
     */
    private $host;
    /**
     * @var string
     * FTP login
     */
    private $login;
    /**
     * @var string
     * FTP password
     */
    private $password;
    /**
     * @var resource
     * FTP stream, connection with host
     */
    private $connexionId;

    /**
     * @var int
     * Connection port
     */
    private $port;

    /**
     * @var int
     * Timeout during connections
     */
    private $timeout;

    /**
     * Constructor
     * @param string $host the host to connect
     * @param int $port the connection port
     * @param int $timeout the timeout during connections
     * @param bool $connect should it connect immediatly to host
     */
    public function __construct($host, $login = "", $password = "", $port = 21, $timeout = 90, $connect = true)
    {
        $this->host = $host;
        $this->port = $port;
        $this->timeout = $timeout;
        if ($connect) {
            $this->connect();
        }
    }

    /**
     * Connect to host
     * @return bool true if connection worked, false else
     */
    public function connect()
    {
        $this->connexionId = ftp_connect($this->host, $this->port, $this->timeout);
        return $this->connexionId !== false;
    }

    /**
     * Log on FTP server
     * @return bool true if login is a success, false else
     */
    public function login()
    {
        return ftp_login($this->connexionId, $this->login, $this->password);
    }


    /**
     * Call a ftp_* method without need to give connection stream
     * Example: $ftp->login($username, $password)
     * There is no need to write ftp_ nor give connexion stream
     * Found at http://php.net/manual/en/book.ftp.php#105868
     * @param  callable $func The FTP function to call
     * @param  array $params The params to give to $func
     * @return mixed The value returned by $func
     */
    public function __call($func,$params)
    {
        if(function_exists("ftp_" . $func)){
            array_unshift($params,$this->connexionId);
            return call_user_func_array("ftp_" . $func,$params);
        } else{
            throw new \Exception("ftp_$func is not a valid FTP function");
        }
    }


}
