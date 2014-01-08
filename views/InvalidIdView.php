<?php

    /**
     * Provides functions to handle an invalid id view
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class InvalidIdView extends GeneralView
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
        protected $error_code = 'GEN_09';


        /**
         * Constructor for the class
         * 
         * @param string $id Invalid id
         */
        public function __construct($id)
        {
            $this->error_issue = $id;
        }

    }