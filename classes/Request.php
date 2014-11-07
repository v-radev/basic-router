<?php


class Request {

    //TODO I will response to the error from the router.php depending on the $_errorCode

    public $errorCode = 0;

    protected $_error = FALSE;

    protected $_requestPath;
    protected $_requestMethod;
    protected $_requestId = '';
    protected $_requestFunction = '';

    protected $_availableMethods = ['get', 'post', 'put', 'delete'];
    protected $_getMethods = ['index', 'create', 'show', 'edit'];
    protected $_postMethods = ['store'];
    protected $_putMethods = ['update'];
    protected $_deleteMethods = ['delete'];

    /**
     * @param $requestPath
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

    protected function getResource()
    {

        //TODO not sure about the /route part
        //TODO use preg_match or something preg
        //TODO check if you have X class else 404
        //If you have only route/resource
        if ( regex('/route\/[a-z]+/i') ) {
            $functions = ['index', 'store'];
            goto getClassMethod;
        }
        elseif ( regex('/route\/[a-z]+\/create/i') ) {
            $functions = ['create'];
            goto getClassMethod;
        }
        elseif ( regex('/route\/[a-z]+\/([1-9][0-9]*)/i') ){
            $functions = ['show', 'update', 'delete'];
            $this->_requestId = $capturedValue1;
            goto getClassMethod;
        }
        elseif ( regex('/route\/[a-z]+\/([1-9][0-9]*)\/edit/i') ){
            $functions = ['edit'];
            $this->_requestId = $capturedValue1;
            goto getClassMethod;
        }

        $this->_error = TRUE;
        $this->errorCode = 404;
        return;

        getClassMethod:
        $methodsArray = '_' . $this->_requestMethod . 'Methods';
        $call = array_intersect($this->$methodsArray, $functions);//TODO validate

        //TODO maybe check count to be 1?
        //TODO array shift to make it string not array
        //Then assign to protected var and this method is done
    }

    protected function validateClass()
    {
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