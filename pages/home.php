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
require_once('lib/util.php');
require_once('lib/dig_util.php');
require_once('lib/query.php');

// -------- SETUP QUERY -----------

$topicArgs = array(
    'dataview' => 'digtopics',
    'datasource' => 'topics',
    'type' => 'dig-home',
    'ord' => 'ASC'
);

$homeQuery = new digQuery(DIG_PAGING_OFF);
$homeQuery->ProcessAdminArgs($topicArgs);
$homeQuery->Query();
$topics =& $homeQuery->results;


$page_title = 'dig.ccmixter &ldquo;You already have permission&hellip;&rdquo;';
$home_class = 'class="current"';
	
	require_once('lib/head.php');
?>
	<div id="content">
		<div class="page full home-heading" id="homepage">
			<div class="block wider first">
				<h2>ccMixter Music Discovery <span style="font-size:11px">(BETA)</span></h2>
				<h3 class="subheading">&ldquo;You already have permission&hellip;&rdquo;</h3>
			</div>
			<div class="block wider">
				<form class="dig-entry round" action="/dig" method="get">
					<img src="images/start-digging.png" alt="Start digging" id="entry-label" />
					<div class="entry-input-container round"><input type="text" name="search-query" value="" id="q" /></div>
					<div class="entry-button-container">
						<input id="entry-search" type="image" alt="dig" src="images/search-button-bg.png" />
					</div>
					<div class="clearer"></div>
				</form>
			</div>
		</div>
		
		<div class="page full home-description">
			<div class="block widest first">
				<p><strong>dig.ccmixter</strong> is divided into several sections to get you going:</p>
            <?
                $count = count($topics);
                for( $i = 0; $i < $count; $i++ )
                {
                    $first = $i == 0 || $i == 3 ? ' first' : ($i == 4 ? ' wider' : '');
                    $T =& $topics[$i];
                    print "<div class=\"block{$first}\">\n" .
                            "<h3>{$T['topic_name']}</h3>\n" .
                            "<p>{$T['topic_text']}</p>\n" .
                            "</div>\n";
                    if( $i == 2 )
                        print '<div class="clearer"></div>' . "\n";
                }
            ?>
				<div class="clearer"></div>
			</div>
			<div class="block badge-container round">
					<div class="badge">
						<a href="http://ccmixter.org"><img src="images/ccmixter.jpg" alt="Visit ccmixter"></a>
					</div>
					<div class="badge">
						<a href="http://tunetrack.net"><img src="images/tunetrack.jpg" alt="Visit TuneTrack"></a>
					</div>
					<div class="badge">
						<a href="http://artistechmedia.com"><img src="images/artistech.jpg" alt="Visit ArtisTech Media"></a>
					</div>
					<div class="badge">
						<a href="http://creativecommons.org"><img src="images/cc.jpg" alt="Visit Creative Commons"></a>
					</div>
			</div>
			<div class="clearer"></div>

		</div>
	<? require_once('lib/footer.php'); ?>
	</div>
  </div>
</body>
</html>
