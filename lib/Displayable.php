<?php

    /**
     * Provides functions to read and write stores of data
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    abstract class Displayable
    {

        /**
         * Status code
         * 
         * @var int
         */
        protected $status_code;

        /**
         * HTTP status codes
         * 
         * @var array
         */
        private static $http_status_codes = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            423 => 'Locked',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        );


        /**
         * Function to send the response back
         */
        public function send()
        {
            // Get the response body
            $object = $this->composeBodyObject();

            // Attach the timestamp
            $object->timestamp = strtotime('now');

            // Get the HTTP status message
            $msg = self::$http_status_codes[$this->status_code];

            // Set the headers
            header('HTTP/1.1 ' . $this->status_code . ' ' . $msg);
            header('Content-Type: application/json');
            header('Accept: application/json');
            header('Expires: ' . gmdate('D, d M Y H:i:s', time()));

            // Send the body
            echo json_encode($object);
        }

        /**
         * Function to generate the response body object
         * 
         * @return object The response body object
         */
        abstract public function composeBodyObject();

    }