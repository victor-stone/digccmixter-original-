<?
/*
* Artistech Media has made the contents of this file
* available under a CC-GNU-GPL license:
*
* http://creativecommons.org/licenses/GPL/2.0/
*
* A copy of the full license can be found as part of this
* distribution in the file LICENSE.TXT.
* 
* You may use dig.ccMixter software in accordance with the
* terms of that license. You agree that you are solely 
* responsible for your use of dig.ccMixter software and you
* represent and warrant to Artistech Media that your use
* of dig.ccMixter software will comply with the CC-GNU-GPL.
*
* $Id$
*
*/
?>
<div class="clearer"></div>
<div id="footer">
<?
$footerArgs = array(
    'dataview' => 'digtopics',
    'datasource' => 'topics',
    'type' => 'dig-footer',
    'ord' => 'ASC'
);

$footerQuery = new digQuery(DIG_PAGING_OFF);
$footerQuery->ProcessAdminArgs($footerArgs);
$footerQuery->Query();
$topics =& $footerQuery->results;
$count = count($topics);
for( $i = 0; $i < $count; $i++ )
{
    $T =& $topics[$i];
    $pos = $i == 0 ? ' first-footer-column' : ($i == $count-1 ? ' last-footer-column' : '');
    print   "<div class=\"footer-column{$pos}\">\n" .
            " <h4>{$T['topic_name']}</h4>\n" .
            "  <ul>\n";
    $links = preg_split('#</a>#',$T['topic_text'],-1,PREG_SPLIT_NO_EMPTY);
    foreach( $links as $A )
    {
        $A = trim($A) . '</a>';
        print "   <li>{$A}</li>\n";
    }
    print "  </ul>\n</div>\n";
		
}
?>
    <div class="clearer"></div>
    <p class="center site-license"><a href="http://creativecommons.org/licenses/by-nc/3.0/us/"><img src="images/by-nc.png" alt="Creative Commons Attribution-Noncommercial 3.0 United States License"></a> This text and images on this site are licensed under a <a href="http://creativecommons.org/licenses/by-nc/3.0/us/">Creative Commons Attribution-Noncommercial 3.0 United States License</a> by <a href="http://artistechmedia.com">ArtIsTech Media</a>.</p>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try { var pageTracker = _gat._getTracker("UA-2878955-3"); pageTracker._trackPageview();} catch(err) {}
</script>
