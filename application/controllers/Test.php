<?php if(!defined('BASEPATH')) exit('No Direct Script Access Allow');

class Test extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
			
	}

	public function index()
	{
		$library = $this->load->library('rssparser');	// load library
		$rss = $this->rssparser->set_feed_url('http://feeds.arstechnica.com/arstechnica/index/')->set_cache_life(30)->getFeed(10); 
		// // Get there items from the feed

		//title, description, author, pubDate, link

    	/*foreach ($rss as $item)
    	{
        	echo "<br>".$item['title'];
        	echo "<br>".$item['description'];
    	}*/
    	
    	echo "<pre>";
		print_r($rss);
		echo "</pre>";
    	
	}
}