<?php

class SimpleCSV {
	private $_delimiter;
	private $_enclosure;
	private $_linebreak;
	private $_csv = '';
	public static function import( $filename_or_data, $is_data = false, $delimiter = 'auto', $enclosure = 'auto', $linebreak = 'auto' ) {
		$csv = new static( $delimiter, $enclosure, $linebreak );
		return $csv->toArray( $filename_or_data, $is_data );
	}
	public static function export( $items, $delimiter = ',', $enclosure = '"', $linebreak = "\r\n") {
		$csv = new static( $delimiter, $enclosure, $linebreak );
		return $csv->fromArray( $items );
	}
	public function __construct( $delimiter = 'auto', $enclosure = 'auto', $linebreak = 'auto' ) {
		$this->_delimiter = $delimiter;
		$this->_enclosure = $enclosure;
		$this->_linebreak = $linebreak;
	}
	public function delimiter( $set = false ) {
		if ($set !== false) {
			return $this->_delimiter = $set;
		}
		if ($this->_delimiter === 'auto') {
			// detect delimiter
			if ( strpos($this->_csv, $this->_enclosure . ',' ) !== false ) {
				$this->_delimiter = ',';
			} else if (strpos($this->_csv, $this->_enclosure."\t") !== false ) {
				$this->_delimiter = "\t";
			} else if ( strpos($this->_csv, $this->_enclosure . ';' ) !== false ) {
				$this->_delimiter = ';';
			} else if ( strpos($this->_csv, ',' ) !== false ) {
				$this->_delimiter = ',';
			} else if (strpos($this->_csv, "\t") !== false) {
				$this->_delimiter = "\t";
			}
			else if ( strpos($this->_csv, ';' ) !== false) {
				$this->_delimiter = ';';
			}
			else {
				$this->_delimiter = ',';
			}
		}
		return $this->_delimiter;
	}
	public function enclosure( $set = false ) {
		if ($set !== false) {
			return $this->_enclosure = $set;
		}
		if ($this->_enclosure === 'auto') {
			// detect quot
			if (strpos($this->_csv, '"') !== false) {
				$this->_enclosure = '"';
			}
			else if (strpos($this->_csv, "'") !== false) {
				$this->_enclosure = "'";
			}
			else {
				$this->_enclosure = '"';
			}
		}
		return $this->_enclosure;
	}
	public function linebreak( $set = false ) {
		if ($set !== false) {
			return $this->_linebreak = $set;
		}
		if ($this->_linebreak === 'auto') {
			if (strpos($this->_csv,"\r\n") !== false) {
				$this->_linebreak = "\r\n";
			}
			else if (strpos($this->_csv,"\n") !== false) {
				$this->_linebreak = "\n";
			}
			else if (strpos($this->_csv,"\r") !== false) {
				$this->_linebreak = "\r";
			}
			else {
				$this->_linebreak = "\r\n";
			}
		}
		return $this->_linebreak;
	}
	public function toArray( $filename, $is_csv_content = false ) {
		
		$this->_csv = $is_csv_content ? $filename : file_get_contents( $filename );

		$CSV_LINEBREAK = $this->linebreak();
		$CSV_ENCLOSURE = $this->enclosure();
		$CSV_DELIMITER = $this->delimiter();


		$r = array();
		$cnt = strlen($this->_csv); 
		
		$esc = $escesc = false; 
		$i = $k = $n = 0;
		$r[$k][$n] = '';
		
		while ($i < $cnt) { 
			$ch = $this->_csv{$i};
			$chch = ($i < $cnt-1) ? $ch.$this->_csv{$i+1} : $ch;

			if ($ch === $CSV_LINEBREAK) {
				if ($esc) {
					$r[$k][$n] .= $ch; 
				} else {
					$k++;
					$n = 0;
					$esc = $escesc = false;
					$r[$k][$n] = '';
				}
			} else if ($chch === $CSV_LINEBREAK) {
				if ($esc) {
					$r[$k][$n] .= $chch;
				} else {
					$k++;
					$n = 0;
					$esc = $escesc = false;
					$r[$k][$n] = '';
				}
				$i++;
			} else if ($ch === $CSV_DELIMITER) { 
				if ($esc) { 
					$r[$k][$n] .= $ch; 
				} else { 
					$n++;
					$r[$k][$n] = '';
					$esc = $escesc = false; 
				}
			} else if ( $chch === $CSV_ENCLOSURE.$CSV_ENCLOSURE && $esc ) {
				$r[$k][$n] .= $CSV_ENCLOSURE;
				$i++;
			} elseif ($ch === $CSV_ENCLOSURE) {
				
				$esc = !$esc;
				
			} else {
				$r[$k][$n] .= $ch;
			}
			$i++; 
		}
		return $r;
	}
	public function fromArray( $items ) {
		
		if (!is_array($items)) {
			trigger_error('CSV::export array required', E_USER_WARNING);
			return false;
		}
		
		$CSV_DELIMITER = $this->delimiter();
		$CSV_ENCLOSURE = $this->enclosure();
		$CSV_LINEBREAK = $this->linebreak();
		
		$result = '';
		foreach( $items as $i) {
			$line = '';
			
			foreach ($i as $v) { 
				if (strpos($v, $CSV_ENCLOSURE) !== false) { 
					$v = str_replace($CSV_ENCLOSURE, $CSV_ENCLOSURE . $CSV_ENCLOSURE, $v); 
				} 
			
				if ((strpos($v, $CSV_DELIMITER) !== false) 
					|| (strpos($v, $CSV_ENCLOSURE) !== false) 
					|| (strpos($v, $CSV_LINEBREAK) !== false))
				{
					$v = $CSV_ENCLOSURE . $v . $CSV_ENCLOSURE; 
				}
				$line .= $line ? $CSV_DELIMITER . $v : $v;
			}
			$result .= $result ? $CSV_LINEBREAK . $line : $line;
		}
		
		return $result;
	}
}