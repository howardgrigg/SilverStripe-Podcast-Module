<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
    <channel>
        <title>$PodcastTitle</title>
        <link></link>
        <copyright>Copyright $Now.Year <% control Page(home) %>$Title<% end_control %></copyright>
        <itunes:author>$Author</itunes:author>
        <itunes:block>no</itunes:block>
        <itunes:explicit><% if Explicit %>yes<% else %>no<% end_if %></itunes:explicit>
        <% if Image %>
        <itunes:image href="$Image.AbsoluteURL"></itunes:image>
        <% end_if %>
        <itunes:owner>
            <itunes:name>$Author</itunes:name>
            <itunes:email>$OwnerEmail</itunes:email>
        </itunes:owner>
        <description>$Summary</description>
        <itunes:summary>$Summary</itunes:summary>
        <language>en</language>
        
		<% control RSSorderedEpisodes %>
		<item>
			<title>$Title</title>
			<pubDate>$Date.Rfc822</pubDate>
			<link>$Attachment.AbsoluteURL</link>
			<description>$Artist</description>
			<source url="$Top.RSSLink"></source>
			<itunes:subtitle>$Artist</itunes:subtitle>
			<itunes:explicit>no</itunes:explicit>
			<itunes:block>no</itunes:block>
			<itunes:author>$Artist</itunes:author>
			<guid>$Attachment.AbsoluteURL</guid>
			<% if Duration %><itunes:duration>{$Duration}</itunes:duration><% end_if %>
			<enclosure url="$Attachment.AbsoluteURL" type="audio/mpeg" length="$Attachment.getAbsoluteSize"></enclosure>
			<% if Top.PagePerEpisode %>
			<% if ShowNotes %>
			<itunes:summary>$ShowNotes</itunes:summary>
			<% end_if %>
			<% end_if %>
		</item>
		<% end_control %>
		
    </channel>
</rss>