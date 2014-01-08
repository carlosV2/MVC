<?php

    /**
     * Provides functions to handle an unable to delete file view
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class UnableToDeleteFileView extends GeneralView
    {

        /**
         * Status code
         * 
         * @var int
         */
        protected $status_code = 500;

        /**
         * Error code
         * 
         * @var string
         */
        protected $error_code = 'GEN_08';


        /**
         * Constructor for the class
         * 
         * @param string $file File called
         */
        public function __construct($file)
        {
            $this->error_issue = $file;
        }

    }