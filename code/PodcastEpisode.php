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
			new TextField('Title'),
			new TextField('Artist'),
			new TextField('Duration','Duration: (MM:SS)'),
			new DatePickerField('Date'),
			new FileIFrameField('Attachment')
		);
	}
	
	function Link(){
		return $this->Attachment()->Filename;
	}
}

?>