<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	public function index() {
		$link = mysql_connect('localhost', 'booking', 'qnzld');
		if ($link) echo "connect!";
	}
}