<?php

class PodcastPage extends Page {
	
	static $db = array (
		'PodcastTitle' => 'Varchar',
		'Author' => 'Varchar',
		'Summary' => 'Text',
		'OwnerEmail'  => 'Varchar'
	);
	
	static $has_one = array (
		'Image' => 'Image'
	);
	
	static $has_many = array (
		'Episodes' => 'PodcastEpisode'
	);
	
	static $icon = 'podcast/images/podcast';
	
	public function getCMSFields()
	{
		$f = parent::getCMSFields();
		
		$manager = new FileDataObjectManager(
			$this, // Controller
			'Episodes',
			'PodcastEpisode', // Source class
			'Attachment', // File name on DataObject
			array(
				'Title' => 'Title',
				'Artist' => 'Artist'
			), // Headings 
			'getCMSFields_forPopup' // Detail fields (function name or FieldSet object)
			// Filter clause
			// Sort clause
			// Join clause
		);

		$manager->setUploadFolder('/Podcasts/');
		
		$f->fieldByName('Root.Content')->insertBefore(new Tab('Episodes'), 'Main');
		$f->fieldByName('Root.Content')->insertBefore(new Tab('PodcastDetails'), 'Main');
		
		$f->addFieldToTab("Root.Content.PodcastDetails", new LiteralField('Explaination','<h2>Podcast Details</h2><p>These details are used in the RSS feed for the podcast - the RSS feed is compatible with iTunes.</p>'));
		$f->addFieldToTab("Root.Content.PodcastDetails", new TextField('PodcastTitle','Podcast Title'));
		$f->addFieldToTab("Root.Content.PodcastDetails", new TextField('Author','Podcast Author'));
		$f->addFieldToTab("Root.Content.PodcastDetails", new TextField('OwnerEmail','Podcast Owner Contact Email'));
		$f->addFieldToTab("Root.Content.PodcastDetails", new TextAreaField('Summary','Podcast Summary'));
		$f->addFieldToTab("Root.Content.PodcastDetails", new FileIFrameField('Image', 'Podcast Image'));
		
		$f->addFieldToTab("Root.Content.Episodes", $manager);
//		if(!Permission::check('ADMIN')) $f->removeFieldFromTab("Root.Content", "Main");

		
		return $f;
			
	}
	
}

class PodcastPage_Controller extends Page_Controller {
	
	protected $numPerPage = "5";
	

	function init() {
		RSSFeed::linkToFeed(Director::baseURL().$this->URLSegment."/episodesRSS");	
		
		if(Director::is_ajax()) {
			$this->isAjax = true;
		}
		else {
			$this->isAjax = false;
		} 
		
		parent::init();
	}
	
	function index() {
		if($this->isAjax) {		
			return $this->renderWith("ajaxPodcastTable");
		}
		else {
			return Array();
		}  
	}
	
	function episodesRSS(){
		return $this->renderWith("PodcastRSSFeed");
	}
	
	function RSSLink() {
		return $this->AbsoluteLink()."episodesRSS";
	}
	
	function orderedEpisodes(){
		
		$Limit = $this->numPerPage;
		
		if(!isset($_GET['start']) || !is_numeric($_GET['start']) || (int)$_GET['start'] < 1) $_GET['start'] = 0;
		$SQL_start = (int)$_GET['start'];
		$doSet = DataObject::get(
			"PodcastEpisode",
			"PodcastPageID = $this->ID",
			"Date DESC",
			"",
			"{$SQL_start},$Limit"
		);
  	return $doSet ? $doSet : false;
	}
	
	function RSSorderedEpisodes(){
	
		$doSet = DataObject::get(
			"PodcastEpisode",
			"",
			"Date DESC",
			"",
			""
		);
		
  	return $doSet;
	}
	
}

?>