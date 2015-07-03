<?php
/**
 * phpAsyncShell - Run asynchronous shell commands
 *
 * @copyright 2015
 * @license GPL-3
 * @author lorenzo at poixson.com
 * @link http://poixson.com/
 */
namespace pxn\phpAsyncShell;

//use pxn\phpAsyncShell\Shell;
use pxn\phpAsyncShell\BufferedShell;

class ShellTest extends \PHPUnit_Framework_TestCase {



	public function testShell_pid() {
		$shell = new BufferedShell(
				'pgrep php'
		);
		$shell->run();
		$this->assertGreaterThan(0, (int) $shell->getLine(0));
		unset($shell);
	}



	public function testStoredShell() {
		$shell = new BufferedShell(
				'echo -e "Line 1\nLine 2\nLine 3"'
		);
		$shell->run();
		$this->assertEquals(
				\print_r(['Line 1', 'Line 2', 'Line 3'], TRUE),
				\print_r($shell->getLines(), TRUE)
		);
		$shell->reset();
		$this->assertEquals('Line 1', $shell->next());
		$this->assertEquals('Line 2', $shell->next());
		$this->assertEquals('Line 3', $shell->next());
		unset($shell);
	}



}