<% require javascript(dataobject_manager/javascript/jquery.1.3.js) %>
<% require javascript(podcast/javascript/livequery.jquery.js) %>
<% require javascript(podcast/javascript/podcast.js) %>
<% require css(podcast/css/Podcast.css) %>

<div class="typography">
	$Content
	
	<div id="ajaxTableBoxContainer">
		<div id="ajaxTableBox">
	
			<% include ajaxPodcastTable %>
	
		</div>
	</div>
</div>