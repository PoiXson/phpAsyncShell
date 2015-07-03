<?php
/**
 * phpAsyncShell - Run asynchronous shell commands
 * (simplifies using stream-process by christiaan)
 *
 * @copyright 2015
 * @license GPL-3
 * @author lorenzo at poixson.com
 * @link http://poixson.com/
 */
namespace pxn\phpAsyncShell;

use pxn\phpUtils\Strings;

class BufferedShell extends Shell {

	protected $lines = [];



	public function __construct($command,
			$workingDir=NULL, array $env=NULL) {
		parent::__construct(
				$command,
				function ($data) {
					$this->lines[] = Strings::TrimEnd($data, "\r", "\n");
				},
				$workingDir,
				$env
		);
	}



	public function getLines() {
		return $this->lines;
	}
	public function getLine($number) {
		return $this->lines[$number];
	}



	public function reset() {
		return \reset($this->lines);
	}
	public function next() {
		$line = \current($this->lines);
		\next($this->lines);
		return $line;
	}
	public function end() {
		return \end($this->lines);
	}



}
