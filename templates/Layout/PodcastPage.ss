<% require javascript(sapphire/thirdparty/jquery/jquery.js) %>
<% require javascript(sapphire/thirdparty/jquery-livequery/jquery.livequery.js) %>
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