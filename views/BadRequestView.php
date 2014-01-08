<?php

    /**
     * Provides functions to handle a bad request view
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class BadRequestView extends GeneralView
    {

        /**
         * Status code
         * 
         * @var int
         */
        protected $status_code = 400;

        /**
         * Error code
         * 
         * @var string
         */
        protected $error_code = 'GEN_03';


        /**
         * Constructor for the class
         * 
         * @param string $request Request called
         */
        public function __construct($request)
        {
            $this->error_issue = $request;
        }

    }