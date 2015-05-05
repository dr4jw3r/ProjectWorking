<?php 

	class BaseEntity{
		
		//Overriding __set for mapping purposes
	    public function __set($name, $value){
	    	if(property_exists($this, $name)){
	    		$method_name = 'set_' . $name;
	    		if(method_exists($this, $method_name)){
	    			return $this->$method_name($value);
	    		}
	    		else{
	    			echo "method does NOT exist";
	    		}
	    	}
	    }

	    // Overriding __get for mapping purposes
	    public function __get($name){
	    	if(property_exists($this, $name)){
	    		$method_name = 'get_' . $name;
	    		if(method_exists($this, $method_name)){
	    			return $this->$method_name();
	    		}
	    		else{
	    			echo 'function does NOT exist';
	    		}
	    	}
	    }
		
	}

?>