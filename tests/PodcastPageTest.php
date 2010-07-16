<?php
class PodcastPageTest extends SapphireTest{
	static $fixture_file = 'podcast/tests/PodcastTest.yml';

	/**
	 *
	 */


	function setUp() {
		parent::setUp();

		$PodcastPage = $this->objFromFixture('PodcastPage', 'show');
		$PodcastPage->publish('Stage', 'Live');
	}





	/**
	 *
	 */
	function testEpisodes() {
		$PodcastPage = $this->objFromFixture('PodcastPage', 'show');

		$Episodes = $PodcastPage->Episodes();
		$this->assertEquals($Episodes->count(), 2);
	}





	/**
	 *
	 */
	function testBasicView() {
		// Confirm that this URL gets you the entire page, with the edit form loaded
		$response = Director::test('great-show');
		$this->assertTrue(strpos($response->getBody(), '<head') !== false);
		$this->assertTrue(strpos($response->getBody(), 'First Episode') !== false);
	}


}


?>