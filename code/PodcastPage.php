<?php

class PodcastPage extends Page {

	static $db = array (
		'PodcastTitle' => 'Varchar',
		'Author' => 'Varchar',
		'Summary' => 'Text',
		'OwnerEmail'  => 'Varchar',
		'Explicit'  => 'Boolean',
		'PagePerEpisode' => 'Boolean'
	);

	static $has_one = array (
		'Image' => 'Image'
	);

	static $has_many = array (
		'Episodes' => 'PodcastEpisode'
	);

	static $icon = 'podcast/images/podcast';

	/**
	 *
	 *
	 * @return unknown
	 */


	public function getCMSFields() {
		$f = parent::getCMSFields();
    $gridFieldConfig = GridFieldConfig::create()->addComponents(
      new GridFieldToolbarHeader(),
      new GridFieldAddNewButton('toolbar-header-right'),
      new GridFieldSortableHeader(),
      new GridFieldDataColumns(),
      new GridFieldPaginator(20),
      new GridFieldEditButton(),
      new GridFieldDeleteAction(),
      new GridFieldDetailForm()
    );
		$gridField = new GridField("Episodes", "Podcast Episodes", $this->Episodes(), $gridFieldConfig);
		

		$f->addFieldToTab("Root.Episodes", $gridField); // add the grid field to a tab in the CMS	

		$f->addFieldToTab("Root.PodcastDetails",
			new LiteralField('Explanation', '<h2>Podcast Details</h2><p>These details are used in the RSS feed for the podcast - the RSS feed is compatible with iTunes.</p>'));
		$f->addFieldToTab("Root.PodcastDetails",
			new TextField('PodcastTitle', _t("PodcastPage.PodcastTitle", "Podcast Title")));
		$f->addFieldToTab("Root.PodcastDetails",
			new TextField('Author', _t("PodcastPage.PodcastAuthor", "Podcast Author")));
		$f->addFieldToTab("Root.PodcastDetails",
			new TextField('OwnerEmail', _t("PodcastPage.OwnerEmail", "Podcast Owner Contact Email")));
		$f->addFieldToTab("Root.PodcastDetails",
			new CheckboxField('Explicit', _t("PodcastPage.Explicit", "Explicit:")));
		$f->addFieldToTab("Root.PodcastDetails",
			new CheckboxField('PagePerEpisode', _t("PodcastPage.PagePerEpisode", "Allow episode notes (including a page for each episode to display them:")));
		$f->addFieldToTab("Root.PodcastDetails",
			new TextAreaField('Summary', _t("PodcastPage.Summary", "Podcast Summary")));
		$f->addFieldToTab("Root.PodcastDetails",
			new UploadField('Image', _t("PodcastPage.Image", "Podcast Image")));


		return $f;

	}


}


class PodcastPage_Controller extends Page_Controller {

	protected $numPerPage = "5";





	/**
	 *
	 */
	function init() {
		RSSFeed::linkToFeed(Director::baseURL().$this->URLSegment."/episodesRSS");

		if (Director::is_ajax()) {
			$this->isAjax = true;
		}
		else {
			$this->isAjax = false;
		}

		parent::init();
	}





	/**
	 *
	 *
	 * @return unknown
	 */
	function index() {
		if ($this->isAjax) {
			return $this->renderWith("ajaxPodcastTable");
		}
		else {
			return array();
		}
	}





	/**
	 *
	 *
	 * @return unknown
	 */
	function episodesRSS() {
		return $this->renderWith("PodcastRSSFeed");
	}





	/**
	 *
	 *
	 * @return unknown
	 */
	function RSSLink() {
		return $this->AbsoluteLink()."episodesRSS";
	}





	/**
	 *
	 *
	 * @return unknown
	 */
	function orderedEpisodes() {

		$Limit = $this->numPerPage;

		if (!isset($_GET['start']) || !is_numeric($_GET['start']) || (int)$_GET['start'] < 1) $_GET['start'] = 0;
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





	/**
	 *
	 *
	 * @return unknown
	 */
	function RSSorderedEpisodes() {

		$doSet = DataObject::get(
			"PodcastEpisode",
			"PodcastPageID = $this->ID",
			"Date DESC",
			"",
			""
		);

		return $doSet;
	}



	/**
	 *
	 *
	 * @return unknown
	 */
	public function episode() {
		return $this;
	}





	/**
	 *
	 *
	 * @return unknown
	 */
	function singleEpisode() {

		if ($URLID = Director::URLParam('ID')) {

			$EpisodeID = Convert::raw2xml($URLID);

			if (is_numeric($EpisodeID)) {
				return DataObject::get_by_id('PodcastEpisode', $EpisodeID);
			}
		}

	}
}


?>