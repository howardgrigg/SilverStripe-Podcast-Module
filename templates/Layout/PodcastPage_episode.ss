<% require css(podcast/css/Podcast.css) %>

<% if Image %>
<span id="episode-image">
$Image.setWidth(200)
</span>
<% end_if %>
<% control singleEpisode %>
	<h2>$Title</h2>
	<% control Attachment %>
		<p><% _t('PlayNow','Play now') %>: $Player</p>
	<% end_control %>
	<p id="shownotes">$ShowNotes</p>
	<% control Attachment %>
		<p><a href="$Link"><% _t('Download','Download') %></a></p>
	<% end_control %>
<% end_control %>