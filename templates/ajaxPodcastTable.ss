<table id="episodes">
<% control orderedEpisodes %>
	<tr class="$EvenOdd $FirstLast">
		<td class="episode-date">$Date.Nice</td>
		<td class="episode-title">$Title<br />$Speaker <% if Duration %><span class="duration">($Duration mins)</span><% end_if %></td>
		<% control Attachment %>
			<td class="episode-download"><a href="$Link">Download</a></td>
			<td class="episode-playnow">Play now:</td>
			<td class="episode-player">$Player</td>
		<% end_control %>
	</tr>
<% end_control %>
</table>
<% if orderedEpisodes.MoreThanOnePage %>
	<p id="pagination-links">
		<% if orderedEpisodes.NotFirstPage %>
			<a href="$orderedepisodes.PrevLink" class="ajax" title="Previous Page">&lt;&lt; Prev</a> | 
		<% end_if %>
		
		<% control orderedEpisodes.Pages %>
			<% if CurrentBool %>
				<strong>$PageNum</strong> 
			<% else %>
				<a href="$Link" class="ajax" title="Go to page $PageNum">$PageNum</a> 
			<% end_if %>
		<% end_control %>
		
		<% if orderedEpisodes.NotLastPage %>
			| <a href="$orderedepisodes.NextLink" class="ajax" title="Next Page">Next &gt;&gt;</a>
		<% end_if %>
	</p>
<% end_if %>