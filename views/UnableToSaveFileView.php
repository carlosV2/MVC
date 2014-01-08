<?php

    /**
     * Provides functions to handle an unable to save file view
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class UnableToSaveFileView extends GeneralView
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
        protected $error_code = 'GEN_07';


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