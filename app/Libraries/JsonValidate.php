<?php namespace App\Libraries;

use JsonSchema\RefResolver;
use JsonSchema\Uri\UriRetriever;
use JsonSchema\Validator;

class JsonValidate {

    /**
     * @var array Error array
     */
    private $_errors = null;

    /**
     * This will check for valid json string...
     *
     * @param string $data
     *
     * @return boolean $success
     */
    public function valid($data)
    {
        // If data is not a string, add to error buffer and abort further processing
        if (!is_string($data))
        {
            // Append error to error buffer
            $this->_errors[] = '\App\Libraries\JsonValidate::valid() : Non-string value passed.';
            
            // Return
            return false;
        }
        
        // Attempt to decode data, which will produce a json error in json_last_error if failed
        json_decode($data);
        
        // Check json_last_error object for Errors
        if (json_last_error() != JSON_ERROR_NONE || !strlen($data))
        {
            // Append error to error buffer
            $this->_errors[] = '\App\Libraries\JsonValidate::valid() : JSON is not valid. JSON ERROR: '.json_last_error();
            
            // Return
            return false;
        }
        
        // Happiness. No Errors. Return success.
        return true;
    }

    /**
     * Validate json and Compare json to schema
     *
     * @param string $json
     * @param string $schema_file
     *
     * @return boolean $success
     */
	public function check($json, $schema_file)
	{
        // check is json string valid
        if(!$this->valid($json))
            return false;

        // Set Schema Path for Loading
        $rp = realpath(app_path().'/Schemas/JSON').'/'.$schema_file.'.schema.json';
        
        // Get UriRetriever Object to retrieve the schema file
        $retriever = new UriRetriever;
        
        // Load Schema
        $schema = $retriever->retrieve('file://'.$rp);
        
        // If you use $ref or if you are unsure, resolve those references here
        // This modifies the $schema object
        $refResolver = new RefResolver($retriever);
        $refResolver->resolve($schema);

        // Validate
        $validator = new Validator();
        
        // Run check against schema file
        $validator->check(json_decode($json), $schema);
        
        // Check result
        if (!$validator->isValid()) 
        {
            // Append to Error Buffer
            $this->_errors[] = 'JSON schema validation failed!!';
            foreach ($validator->getErrors() as $error)
                $this->_errors[] = sprintf("[%s] %s", $error['property'], $error['message']);
            
            // Return unhappiness
            return false;
        }
        
        // Return Happiness
        return true;
	}
    
    /**
     * Wrapper to retrieve errors in error buffer
     *
     * @return array Error Buffer
     */
    public function getErrors() 
    {
        // Return Error Buffer
        return $this->_errors;
    }
    
    /**
     * Retrieve a list of errors in a string format
     *
     * @return string Imploded string containing errors from error buffer
     */ 
    public function getErrorsString() 
    {
        // Return String of Errors by imploding on charaige return and new line
        return implode('\r\n', $this->_errors);
    }
}
