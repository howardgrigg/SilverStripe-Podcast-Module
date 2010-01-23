<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
    <channel>
        <title>$PodcastTitle</title>
        <link></link>
        <copyright>Copyright $Now.Year <% control Page(home) %>$Title<% end_control %></copyright>
        <itunes:author>$Author</itunes:author>
        <itunes:block>no</itunes:block>
        <itunes:explicit>no</itunes:explicit>
        <itunes:image href="$Image.AbsoluteURL"></itunes:image>
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
			<link>$Attachment.URL</link>
			<description>$Artist</description>
			<source url="$Top.RSSLink"></source>
			<itunes:subtitle>$Artist</itunes:subtitle>
			<itunes:explicit>no</itunes:explicit>
			<itunes:block>no</itunes:block>
			<itunes:author>$Artist</itunes:author>
			<guid>$Attachment.URL</guid>
			<% if Duration %><itunes:duration>{$Duration}</itunes:duration><% end_if %>
			<enclosure url="$Attachment.URL" type="audio/mpeg" length="$Attachment.getAbsoluteSize"></enclosure>
		</item>
		<% end_control %>
		
    </channel>
</rss>