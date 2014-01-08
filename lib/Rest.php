<?php

    /**
     * Provides functions to manage all the Rest requests
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    abstract class Rest
    {

        /**
         * Requested method
         * 
         * @var array
         */
        protected $method;

        /**
         * Raw request
         * 
         * @var string
         */
        protected $raw_request;

        /**
         * Request object
         * 
         * @var object
         */
        protected $request;


        /**
         * Constructor of the class
         * 
         * @param int $id Identifier to work with
         */
        public function __construct($id)
        {
            // Get the method
            $this->method = $_SERVER['REQUEST_METHOD'];

            // Process the request body
            $this->raw_request = file_get_contents('php://input');
            $this->request = ($this->raw_request === '' ? array() : json_decode($this->raw_request, true));

            if (isset($this->request)) {
                // Automatically call the function desired
                switch ($this->method) {
                    case 'PUT':
                        $this->createObject();
                    break;

                    case 'GET':
                        if (isset($id)) {
                            $this->getObject($id);
                        } else {
                            $iiv = new InvalidIdView($id);
                            $iiv->send();
                        }
                    break;

                    case 'POST':
                        if (isset($id)) {
                            $this->updateObject($id);
                        } else {
                            $iiv = new InvalidIdView($id);
                            $iiv->send();
                        }
                    break;

                    case 'DELETE':
                        if (isset($id)) {
                            $this->deleteObject($id);
                        } else {
                            $iiv = new InvalidIdView($id);
                            $iiv->send();
                        }
                    break;

                    default:
                        $imv = new InvalidMethodView($this->method);
                        $imv->send();
                    break;
                }
            } else {
                $ijv = new InvalidJsonView();
                $ijv->send();
            }
        }

        /**
         * Function to create a new object
         */
        abstract protected function createObject();

        /**
         * Function to get the object
         * 
         * @param int $id Object identifier
         */
        abstract protected function getObject($id);

        /**
         * Function to update the object
         * 
         * @param int $id Object identifier
         */
        abstract protected function updateObject($id);

        /**
         * Function to delete the object
         * 
         * @param int $id Object identifier
         */
        abstract protected function deleteObject($id);

        /**
         * Function to route the query to the right controller
         * NOTE: URLs must be constructed like this:
         * - http://host/controller/[id]
         * 
         * The ID is not need for PUT queries
         */
        public static function Route()
        {
            // Prepare URI and REGEX
            $uri = rtrim($_SERVER['REQUEST_URI'], '/');
            $regex = '|^/([^/]*)(/(\d+))?$|';

            // Get matches
            $matches = array();
            if (preg_match($regex, $uri, $matches) === 1) {
                $controller = ucfirst($matches[1]);
                $id = (isset($matches[3]) ? intval($matches[3]) : null);

                // Find the controller
                if (is_file('../controllers/' . $controller . '.php')) {
                    // Try to load the controller
                    $controller = new $controller($id);
                } else {
                    // Send a controller not found response
                    $cnfv = new ControllerNotFoundView($controller);
                    $cnfv->send();
                }
            } else {
                // Send a bad request response
                $brv = new BadRequestView($uri);
                $brv->send();
            }
        }

    }