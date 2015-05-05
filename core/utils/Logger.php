<?php 
	class Logger{

		private static $instance;
		private static $logfile;
		private static $logfile_path;

		private function __construct(){}

		public static function log($ex){

			$type = gettype($ex);

			if($type == 'object'){
				$class = get_class($ex);
				if(preg_match('/exception/', strtolower($class))){
					$to_file = date('d/m/Y H:i:s') . "\n======================\n";
					$to_file .= 'Type: ' . get_class($ex) . "\n";
					$to_file .= 'Code: ' . $ex->getCode() . "\n";
					$to_file .= 'File: ' . $ex->getFile() . "\n";
					$to_file .= 'Line: ' . $ex->getLine() . "\n\n";
					$to_file .= "Stack trace:\n---------------------\n" . $ex->getTraceAsString() . "\n---------------------\n\n";
					$to_file .= "Message:\n---------------------\n" . $ex->getMessage() . "\n---------------------\n";
					$to_file .= "\n\n\n\n\n\nRaw exception: \n--------------------------------\n" . $ex;
					$to_file .= $ex;
				}
				else{
					
				}
			}
			else if($type == 'string'){
				$to_file = $ex;
			}

			try{
				$logfile_path = LOGS_DIR . date('Y-m-d__H-i-s', time()) . '.txt';
				$logfile = fopen($logfile_path, 'w');				
				fwrite($logfile, $to_file);
			}
			catch(Exception $ex){
				echo $ex;
			}
			finally{
				fclose($logfile);
			}
		}

	}
?>