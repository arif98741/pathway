<?php
namespace Phpdark\Main;

use Whoops\Run as Run;
use Whoops\Handler\PrettyPageHandler as PrettyPageHandler;


/**
 * Class Structure
 * @package Phpdark\Main
 */
class Structure
{
    /**
     * @var string
     */
    protected $path;
    /**
     * @var bool
     */
    private $whoops = true;
    /**
     * @var int
     */
    public $SOFTWARE;
    /**
     * @var
     */
    public $NAME;
    /**
     * @var
     */
    public $ADDRESS;
    /**
     * @var
     */
    public $PORT_SERVER;

    /**
     * @var
     */
    public $ADDRESS_REMOTE;

    /**
     * @var
     */
    public $ROOT;

    /**
     * @var
     */
    public $SCHEME;

    /**
     * @var
     */
    public $ROOT_DOCUMENT;
    /**
     * @var
     */
    public $ADMIN;
    /**
     * @var
     */
    public $FILENAME;
    /**
     * @var
     */
    /**
     * @var
     */
    public $GATEWAY;
    /**
     * @var
     */
    public $PROTOCOL;
    /**
     * @var
     */
    public $METHOD;
    /**
     * @var
     */
    public $QUERY_STRING;
    /**
     * @var
     */
    public $REQUEST_URI;
    /**
     * @var
     */
    public $FILE_CURRENT;

    /**
     * Structure constructor.
     * @param string $path
     * @param bool $whoops
     */
    public function __construct($path="", $whoops = true)
    {
        $this->whoops = $whoops;
        $this->pathSetup($path);
        $this->whoopsError($this->whoops);
    }

    /**
     * @param $path
     */
    private function pathSetup($path)
    {
        $explode = explode('/',$this->server('REQUEST_URI'));
        $exist = explode('.',$explode[count($explode) - 1]);
        if (empty($path) || $path == '/')
        {
            $this->path =  $this->server('NAME').'/'.$explode[1];
        }else{
            //echo $path;
            $more_explodes = explode('/',$path);
            foreach ($more_explodes as $path_explode)
            {
              $this->path =  $this->server('NAME').'/'.$explode[1].'/'. $path;
              $this->path = rtrim($this->path,'/');
            }
        }
    }

    /**
     * @return mixed
     */
    protected function  realPath()
    {
        return realpath($this->path);
    }


    /**
     * @param $whoops
     */
    private function  whoopsError($whoops)
    {
        if ($whoops == true)
        {
            $whoops = new Run;
            $whoops->prependHandler(new PrettyPageHandler);
            $whoops->register();
        }
    }

    /**
     * @return mixed
     */
    protected function server(string $param='')
    {
        $data = [
            'SOFTWARE' => $_SERVER['SERVER_SOFTWARE'],
            'NAME' => $_SERVER['SERVER_NAME'],
            'ADDRESS' => $_SERVER['SERVER_ADDR'],
            'PORT_SERVER' => $_SERVER['SERVER_PORT'],
            'ADDRESS_REMOTE' => $_SERVER['REMOTE_ADDR'],
            'ROOT' => $_SERVER['DOCUMENT_ROOT'],
            'SCHEME' => $_SERVER['REQUEST_SCHEME'],
            'ROOT_DOCUMENT' => $_SERVER['CONTEXT_DOCUMENT_ROOT'],
            'ADMIN' => $_SERVER['SERVER_ADMIN'],
            'FILENAME' => $_SERVER['SCRIPT_FILENAME'],
            'PORT_REMOTE' => $_SERVER['REMOTE_PORT'],
            'GATEWAY' => $_SERVER['GATEWAY_INTERFACE'],
            'PROTOCOL' => $_SERVER['SERVER_PROTOCOL'],
            'METHOD' => $_SERVER['REQUEST_METHOD'],
            'QUERY_STRING' => $_SERVER['QUERY_STRING'],
            'REQUEST_URI' => $_SERVER['REQUEST_URI'],
            'FILE_CURRENT' => $_SERVER['PHP_SELF']
        ];
        if (empty($param))
        {
            return $data;
        }else{
            if (array_key_exists($param,$data))
                return $data[$param];
            else
                return "Array Doesn't Exist.";
        }
        return $data;
    }

    /**
     * @return mixed
     */
    public static function serverName()
    {
        return self::server()['NAME'];
    }

    /**
     * @return mixed
     */
    public static function fileName()
    {
        return self::server()['FILENAME'];
    }

    /**
     * @return mixed
     */
    public static function requestPath()
    {
        return self::server()['REQUEST_URI'];
    }

    /**
     * @return mixed
     */
    public static function fileCurrent()
    {
        return self::server()['FILE_CURRENT'];
    }

}

