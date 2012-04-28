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
  
  public static $summary_fields = array(
    'Title' => 'Title',
    'Date'  =>  'Date'
  );
	/**
	 *
	 *
	 * @return unknown
	 */


	public function getCMSFields() {
		$f = new FieldList(
			new TextField('Title', _t("PodcastEpisode.Title", "Title")),
			new TextField('Artist', _t("PodcastEpisode.Artist", "Artist")),
			new TextField('Duration', _t("PodcastEpisode.Duration", "Duration").'(MM:SS)'),
			new DateField('Date', _t("PodcastEpisode.Date", "Date")),
			new UploadField('Attachment', _t("PodcastEpisode.Attachment", "Attachment"))
		);


		if ($this->PodcastPage()->PagePerEpisode) {
			$f->push(new TextAreaField('ShowNotes', _t("PodcastEpisode.ShowNotes", "Show Notes:")));
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