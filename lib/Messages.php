<?php

    /**
     * Collects all possible error messages
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class Messages
    {

        /**
         * List of messages
         * 
         * @var array
         */
        private static $messages = array(
            // Success messages
            'OK_01' => 'Ok',

            // Error messages
            'GEN_01' => 'General error',
            'GEN_02' => 'Controller does not exists',
            'GEN_03' => 'Bad request URI',
            'GEN_04' => 'Invalid JSON format',
            'GEN_05' => 'Invalid field',
            'GEN_06' => 'Invalid method',
            'GEN_07' => 'Unable to save file',
            'GEN_08' => 'Unable to delete file',
            'GEN_09' => 'Invalid ID'
        );


        /**
         * Function to get the message from a given code
         * 
         * @param string $code Code to get the message from
         * 
         * @return string The message
         */
        public static function GetMessage($code)
        {
            if (isset(self::$messages[$code])) {
                return self::$messages[$code];
            } else {
                return Messages::GetMessage('GEN_01');
            }
        }
    }