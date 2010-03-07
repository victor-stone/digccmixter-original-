<?
error_reporting(E_ALL);
$qurl = urldecode($_GET['q']);
$retval = load($qurl);
print $retval;
exit;

function d($x)
{
    var_dump($x);
    exit;
}

/**
 * See http://www.bin-co.com/php/scripts/load/
 * Version : 2.00.A
 */
function load($url,$options=array()) {
    
    $default_options = array(
        'method'        => 'get',
        'return_info'    => false,
        'return_body'    => true,
        'referer'        => '',
        'headers'        => array(),
        'session'        => false,
        'session_close'    => false,
    );
    // Sets the default options.
    foreach($default_options as $opt => $value) {
        if(!isset($options[$opt])) $options[$opt] = $value;
    }

    $url_parts = parse_url($url);

    $ch = false;
    $info = array(
        'http_code'    => 200
    );
    $response = '';
    
    $send_header = array(
        'Accept' => 'text/*',
        'User-Agent' => 'ccMixter query proxy'
    );
    

    if(isset($url_parts['query'])) {
        $page = $url_parts['path'] . '?' . str_replace(' ','%20',$url_parts['query']);
    } else {
        $page = $url_parts['path'];
    }
    
    if(!isset($url_parts['port'])) $url_parts['port'] = 80;
    $fp = fsockopen($url_parts['host'], $url_parts['port'], $errno, $errstr, 30);
    if ($fp) {
        $out = '';
        $out .= "GET $page HTTP/1.0\r\n"; //HTTP/1.0 is much easier to handle than HTTP/1.1
        $out .= "Host: $url_parts[host]\r\n";
        $out .= "Accept: $send_header[Accept]\r\n";
        $out .= "User-Agent: {$send_header['User-Agent']}\r\n";
        $out .= "Connection: Close\r\n";
        $out .= "\r\n";

        fwrite($fp, $out);
        while (!feof($fp)) {
            $response1 = fgets($fp, 128);
            $response .= $response1;
        }
        
        fclose($fp);
        /* start :vs: */
        $size = 0;
        $lines = explode("\n", $response);
        foreach ($lines as $line) {
            if( $line == '' || $line{0} == chr(13) )
                break;
            $size += strlen($line) + 1;
        }
        $info['header_size'] = $size;
        /* end :vs: */
     }

    //Get the headers in an associative array
    $headers = array();

    if($info['http_code'] == 404) {
        $body = "404";
        $headers['Status'] = 404;
    } else {
        //Seperate header and content
        $header_text = substr($response, 0, $info['header_size']);
        $body = substr($response, $info['header_size']);
    }
    
    return $body;
} 
?>
