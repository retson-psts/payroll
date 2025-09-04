<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('custom_error_handler')) {
    function custom_error_handler($severity, $message, $filepath, $line) {
        $is_error = ((E_ERROR | E_COMPILE_ERROR | E_CORE_ERROR | E_USER_ERROR) & $severity) === $severity;
        if ($is_error) {
            $error_data = [
                'error' => true,
                'message' => $message,
                'file' => $filepath,
                'line' => $line,
                'severity' => $severity
            ];

            // Set the response content type to JSON
            header('Content-Type: application/json');
            echo json_encode($error_data);

            // Ensure the script doesn't continue
            exit(1);
        }

        // Otherwise, continue with the default error handling
        return false;
    }
}

