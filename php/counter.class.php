<?php
 
	/**
	 * Example: 
	 * <?php
	 * 		include("Counter.php");
	 * 		$start = new Counter;
	 * 		$start->add($start->getinfo());
	 * 
	 * To display use:
	 * 		
	 * 		$start->display();
	 * 
	 * If you only want to display Unique visitors type:
	 * 		$start->display('u');
	 * 
	 * If you want to display all hits then type:
	 * 		$start->display();
	 * 
	 * To change the styles, change the CSS code for the variable $styles in the code
	 * To change the datafile, change the $datafile variable to whatever you want.
	 */
 
class Counter {
 
	//Name of the data file where we store all info
	private $datafile = "App_data/counter.txt";
	private $delimiter = "---";
	public $styles = "";
 
	function __construct() {
		if (!is_file($this->datafile)) {
			touch($this->datafile);
		}
	}
 
	public function add($info) {
		if (!$info) return;
 
		//open file for writing
		$file = fopen($this->datafile,'a+') or die ("Couldn't open file :(");
 
		if (!fwrite($file,nl2br($info."\n"))) {
			die("Couldn't Write to database :( ");
		}
	}
 
	public function getinfo() {
		//Get the vieweres info:
		$ip = $_SERVER['REMOTE_ADDR'];
		$page = $_SERVER['SCRIPT_NAME'];
 
		return $ip.$this->delimiter.$page.$this->delimiter.time().$this->delimiter;
	}
 
	public function display($views = 'a') {
 
		//Open and red the file in an array format
		$file = file($this->datafile) or die("File couldnt be read");
 
		//our counter variable
		$counter = 0;
 
 
 
		switch($views) {
			case 'a':
			case 'A':
			case 'all':
				$counter = count($file);
				break;
			case 'u';
			case 'U';
			case 'unique':
				//get all the IPs so we can compare them.
				//Im sure there is a better wayt to do this but we'll just stick to this for now
				$IP = array();
				foreach($file as $key => $value) {
					$line = explode($this->delimiter,$value);
					//echo $line[0];
 
					if (!@array_values($IP,$line[0])) {
						$IP[$line[0]] = TRUE;
					} 
				}
				$counter = count($IP);
				break;
			default:
				return;
		}
 
		echo "<span style='{$this->styles}'>$counter</span>";
	}
}
  
?>
