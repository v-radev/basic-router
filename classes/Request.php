<?php


class Request {

    //TODO I will response to the error from the router.php depending on the $_errorCode

    public $errorCode = 0;

    protected $_error = FALSE;

    /**
     * @var string URL path of request
     */
    protected $_requestPath;
    /**
     * @var string Method of HTTP request
     */
    protected $_requestMethod;
    /**
     * @var string Class name
     */
    protected $_requestClass;
    /**
     * @var string If any id is added to the request
     */
    protected $_requestId = '';
    /**
     * @var string Name of function in the requested class
     */
    protected $_requestFunction = '';

    protected $_availableMethods = ['get', 'post', 'put', 'delete'];
    protected $_getMethods = ['index', 'create', 'show', 'edit'];
    protected $_postMethods = ['store'];
    protected $_putMethods = ['update'];
    protected $_deleteMethods = ['delete'];

    /**
     * @param string $requestPath
     */
    public function __construct( $requestPath )
    {

        $this->_requestPath = trim($requestPath, '/');

        $this->getMethod();
        $this->getResource();
        $this->validateClass();
    }

    /**
     * Get the request method
     */
    protected function getMethod()
    {
        if ( $this->_error ) return;

        if ( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'get' ) {
            $this->_requestMethod = 'get';
            return;
        }

        if ( isset($_POST['_method']) && in_array($_POST['_method'], $this->_availableMethods) ) {
            $this->_requestMethod = $_POST['_method'];
            return;
        }

        $this->_error = TRUE;
        $this->errorCode = 405;

    }//END getMethod()

    /**
     * Try to get the called method and the class name
     */
    protected function getResource()
    {
        if ( $this->_error ) return;

        $p = $this->_requestPath;

        if ( preg_match('/^[a-z]+$/i', $p) ) {// /book
            $functions = ['index', 'store'];
            goto getClassMethod;
        }
        elseif ( preg_match('/^[a-z]+\/create$/i', $p) ) {// /book/create
            $functions = ['create'];
            goto getClassMethod;
        }
        elseif ( preg_match('/^[a-z]+\/([1-9][0-9]*)$/i', $p, $matches) ){// /book/{id}
            if ( !is_numeric($matches[1]) )
                goto setError;

            $this->_requestId = $matches[1];
            $functions = ['show', 'update', 'delete'];
            goto getClassMethod;
        }
        elseif ( preg_match('/^[a-z]+\/([1-9][0-9]*)\/edit$/i', $p, $matches) ){// /book/{id}/edit
            if ( !is_numeric($matches[1]) )
                goto setError;

            $functions = ['edit'];
            $this->_requestId = $matches[1];
            goto getClassMethod;
        }

        setError:
        $this->_error = TRUE;
        $this->errorCode = 404;
        return;

        getClassMethod:
        preg_match('/^([a-z]+)/i', $p, $className);
        $this->_requestClass = array_pop($className);
        $methodsArray = '_' . $this->_requestMethod . 'Methods';
        $call = array_intersect($this->$methodsArray, $functions);

        if ( count($call) != 1 )
            goto setError;

        $this->_requestFunction = array_pop($call);

    }//END getResource()

    protected function validateClass()
    {
        if ( $this->_error ) return;

        //TODO here I should check if method exists in the class
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return !$this->_error;
    }

    /**
     * @return bool
     */
    public function notValid()
    {
        return $this->_error;
    }

    public function serve()
    {
        if ( $this->_error )
            throw new HttpRequestException('Request error occurred. Execution can not continue. Please handle error before serve()');

        //TODO make the call to the class method()
    }
}