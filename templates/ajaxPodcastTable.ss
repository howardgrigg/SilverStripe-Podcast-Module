<table id="episodes">
<% control orderedEpisodes %>
	<tr class="$EvenOdd $FirstLast">
		<% if Top.PagePerEpisode %>
			<td class="episode-date"><a href="{$Top.Link}episode/{$ID}" title="$Title">$Date.Nice</a></td>
			<td class="episode-title"><a href="{$Top.Link}episode/{$ID}" title="$Title">$Title<br />$Speaker <% if Duration %><span class="duration">($Duration <% _t('Mins','mins') %>)</span><% end_if %></a></td>
		<% else %>
			<td class="episode-date">$Date.Nice</td>
			<td class="episode-title">$Title<br />$Speaker <% if Duration %><span class="duration">($Duration <% _t('Mins','mins') %>)</span><% end_if %></td>
		<% end_if %>
		<% control Attachment %>
			<td class="episode-download"><a href="$Link"><% _t('Download','Download') %></a></td>
			<td class="episode-playnow"><% _t('PlayNow','Play now') %>:</td>
			<td class="episode-player">$Player</td>
		<% end_control %>
	</tr>
<% end_control %>
</table>
<% if orderedEpisodes.MoreThanOnePage %>
	<p id="pagination-links">
		<% if orderedEpisodes.NotFirstPage %>
			<a href="$orderedepisodes.PrevLink" class="ajax" title="<% _t('PreviousPage','Previous Page') %>">&lt;&lt; <% _t('Prev','Prev') %></a> | 
		<% end_if %>
		
		<% control orderedEpisodes.Pages %>
			<% if CurrentBool %>
				<strong>$PageNum</strong> 
			<% else %>
				<a href="$Link" class="ajax" title="<% _t('GoToPage','Go to Page') %> $PageNum">$PageNum</a> 
			<% end_if %>
		<% end_control %>
		
		<% if orderedEpisodes.NotLastPage %>
			| <a href="$orderedepisodes.NextLink" class="ajax" title="<% _t('NextPage','Next Page') %>"><% _t('Next','Next') %> &gt;&gt;</a>
		<% end_if %>
	</p>
<% end_if %>