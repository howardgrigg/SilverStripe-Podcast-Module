<?php

class PodcastEpisode extends DataObject
{
	static $db = array (
		'Title' => 'Varchar',
		'Artist' => 'Varchar',
		'Date' => 'Date',
		'Duration' => 'Varchar'
	);
	
	static $has_one = array (
		'Attachment' => 'File',
		'PodcastPage' => 'PodcastPage'
	);

	public function getCMSFields_forPopup()
	{
		return new FieldSet(
			new TextField('Title', _t("PodcastEpisode.Title","Title")),
			new TextField('Artist', _t("PodcastEpisode.Artist","Artist")),
			new TextField('Duration', _t("PodcastEpisode.Duration","Duration").'(MM:SS)'),
			new DatePickerField('Date', _t("PodcastEpisode.Date","Date")),
			new FileIFrameField('Attachment', _t("PodcastEpisode.Attachment","Attachment"))
		);
	}
	
	function Link(){
		return $this->Attachment()->Filename;
	}
}

?>