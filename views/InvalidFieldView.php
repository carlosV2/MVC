<?php

    /**
     * Provides functions to handle an invalid field view
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class InvalidFieldView extends GeneralView
    {

        /**
         * Status code
         * 
         * @var int
         */
        protected $status_code = 412;

        /**
         * Error code
         * 
         * @var string
         */
        protected $error_code = 'GEN_05';


        /**
         * Constructor for the class
         * 
         * @param string $field Invalid field
         */
        public function __construct($field)
        {
            $this->error_issue = $field;
        }

    }