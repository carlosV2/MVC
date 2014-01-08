<?php

    /**
     * Provides functions to handle an invalid method view
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class InvalidMethodView extends GeneralView
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
        protected $error_code = 'GEN_06';


        /**
         * Constructor for the class
         * 
         * @param string $method Method called
         */
        public function __construct($method)
        {
            $this->error_issue = $method;
        }

    }