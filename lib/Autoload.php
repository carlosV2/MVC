<?php

    /**
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */

    /**
     * Function to autoload all the classes dinamically
     * 
     * @param string $class_name Name of the class to load
     * 
     * @return bool Whether was successfull or not
     */
    spl_autoload_register(function ($class_name) {

        // Check for a valid input
        if (!is_string($class_name) || $class_name === '') {
            return false;
        }

        // Generate the path of the class
        if (substr_compare($class_name, 'Controller', -10, 10) === 0) {
            $path = '../controllers/';
        } elseif (substr_compare($class_name, 'Model', -5, 5) === 0) {
            $path = '../models/';
        } elseif (substr_compare($class_name, 'View', -4, 4) === 0) {
            $path = '../views/';
        } else {
            $path = '../lib/';
        }
        $path .= $class_name . '.php';

        // Check for the existence of the file
        if (is_file($path)) {
            require_once $path;
            return true;
        } else {
            return false;
        }

    });