<?php

    /**
     * Provides functions to handle a controller not found view
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class ControllerNotFoundView extends GeneralView
    {

        /**
         * Status code
         * 
         * @var int
         */
        protected $status_code = 405;

        /**
         * Error code
         * 
         * @var string
         */
        protected $error_code = 'GEN_02';


        /**
         * Constructor for the class
         * 
         * @param string $controller Called and erroneous controller
         */
        public function __construct($controller)
        {
            $this->error_issue = $controller;
        }

    }