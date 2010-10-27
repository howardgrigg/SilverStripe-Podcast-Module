<?php

class PodcastEpisode extends DataObject
{
	static $db = array (
		'Title' => 'Varchar',
		'Artist' => 'Varchar',
		'Date' => 'Date',
		'Duration' => 'Varchar',
		'ShowNotes' => 'HTMLText'
	);

	static $has_one = array (
		'Attachment' => 'MP3',
		'PodcastPage' => 'PodcastPage'
	);

	/**
	 *
	 *
	 * @return unknown
	 */


	public function getCMSFields_forPopup() {
		$f = new FieldSet(
			new TextField('Title', _t("PodcastEpisode.Title", "Title")),
			new TextField('Artist', _t("PodcastEpisode.Artist", "Artist")),
			new TextField('Duration', _t("PodcastEpisode.Duration", "Duration").'(MM:SS)'),
			new DatePickerField('Date', _t("PodcastEpisode.Date", "Date")),
			new FileIFrameField('Attachment', _t("PodcastEpisode.Attachment", "Attachment"))
		);


		if ($this->PodcastPage()->PagePerEpisode) {
			$f->push(new SimpleTinyMCEField('ShowNotes', _t("PodcastEpisode.ShowNotes", "Show Notes:")));
		}

		return $f;

	}





	/**
	 *
	 *
	 * @return unknown
	 */
	function link() {
		return $this->Attachment()->Filename;
	}


}


?>