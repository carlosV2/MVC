<?php

    /**
     * Provides functions to handle an invalid json view
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class InvalidJsonView extends GeneralView
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
        protected $error_code = 'GEN_04';

    }