<?php
/**
*  class Xml2Rss
* 
*  @author Axel Roszkopf, WEBAX, 2014
*  @version 1.0, 3.2.2014
* 
*  This class is an easy to use, simple XML to RSS generator. You can automatically convert your XML feed (or XML file) to a valid RSS 2.0 feed, 
*  with only a few required parameters.
*  Advanved features include setting of optional RSS feed fields, custom description HTML output, including images in the feed etc
*  
*  Features:
* 
*    - easy generation with only a few parameters 
*    - file, url or string as XML input
*    - custom mapping of XML nodes to RSS fields
*    - setting parameters easily by chained function calls or by accessing them directly
*    - possibility to mass-setup of paramters
*    - set an interval to limit the number of processed items (from, to)      
* 
*  Examples: 
*  <code>
* 
*    // Example 1 - easy automatic conversion  
*    XmlToCsv::convert('example.xml');
* 
*    // Example 2 -  chained parameter setting
*    $x = new XmlToCsv();
*    echo $x->url('example.xml')
*           ->output(false)
*           ->autoConvert();
*
*    // Example 3 - parameters set separately by directly accessing the class variables
*    $x = new XmlToCsv();
*    $x->url = 'example.xml';
*    $x->output = false;
*    echo $x->autoConvert();
*
*    // Example 4 - parameters set at object creation as an array 
*    $x = new XmlToCsv(array(
*            'url'=>'example.xml',
*            'output'=>'echo',
*            'importTo'=>3,
*        ));
*    $x->autoConvert();
* 
* </code> 
*/

require_once('XmlToCsv.class.php');

class XmlToRss extends XmlToCsv {

    /**
    * the URL to the XML file (local or remote). If $xml is filled, then $url is ignored
    * 
    * @var string
    */
    public $url = '';

    /**
    * the XML string, can be used to directly input the XML. If this is filled, the $url param is ignored 
    * 
    * @var string
    */
    public $xml = '';

    /**
    * the filename used for the newly created RSS XML, if $output is set to 'file' 
    * 
    * @var string
    */
    public $filename = "export.xml";

    /**
    * indicate FROM which entry to begin to export the data. This can be used if you want to export only some items from the XML, not all of them. 
    * Defaults to. If used together with $importTo, you can set an interval for selecting specific items from the XML
    * 
    * @var int
    */
    public $importFrom = 0;

    /**
    * indicate TO which entry to export the data. This can be used if you want to export only some items from the XML, not all of them
    * Defaults to 999999999. If used together with $importFrom, you can set an interval for selecting specific items from the XML
    * 
    * @var int
    */
    public $importTo = 99999999;

    /**
    * This key=>value paired array can be used to map XML nodes to RSS fields. By default none of the exported XML nodes are mapped to RSS fields. 
    * You have to specify exactly which XML field will be used as which RSS field 
    * The whole mapping is used to populate the ITEM elements of the RSS output. The header(=CHANNEL) element is set separatly, and is not mapped from the XML (maybe a todo for a next version)
    * 
    * Example: 
    * <code>
    *   <root>
    *       <item>
    *           <node1>Text1</node1>
    *           <node2>Text2</node2>
    *       </item>
    *   </root>
    * </code>
    * 
    * You need to map the XML nodes to different fields, e.g. by passing a mapping to $map:
    * <code>
    *   $this->map = array(
    *                   'title' => 'node1',
    *                   'description' => 'node2',  
    *                )
    * </code>  
    * 
    * The array (KEY => VALUE pair) defines which  element in the RSS (=KEY) should be filled with which element from the XML (=VALUE). 
    * So in the example above - the TITLE element in the RSS will be filled with the value from NODE1 in the XML 
    * The example XML would be mapped to the RSS like this:
    * 
    * <channel>
    * ...
    *   <item>
    *     <title>Text1</title>
    *     <description>Text2</description>            
    *   </item>
    * ...
    * </channel>
    * 
    * @var array
    */
    public $map = array();

    /**
    * XPath expression to determine the Item nodes (=RSS items) for the export
    * Defaults to the 2nd child node in the XML
    * 
    * @var string
    */
    public $item = "/*/*";


    /**
    * output type:
    *             - 'echo' (default) - write the RSS out to the document (with all the needed headers!)
    *             - 'string' - return the RSS as a string 
    *             - 'file' - return as RSS XML file 
    *             - 'array' - return as an array prepared for further use (only the items are returned)
    * @var string
    */
    public $output = 'echo';

    /**
    * the property holds an array of key=>value pairs which will be rendered as sub-element into the channel element
    * 
    * @var array
    */
    public $channel = array(
        "title"        => "Xml2Rss Title",
        "description"  => "Xml2Rss Description",
    );

    /**
    * internal method used to set a parameter value
    * 
    * @param string $name
    * @param mixed $value
    * @return XmlToRss
    */
    protected function _setParam($name,$value) 
    {
        if(property_exists($this,$name)) {
            $this->$name = $value;    
        } else {
            $this->channel[$name] = $value;
        }

        return $this;
    }

    /**
    * get the value of a channel sub-element
    * 
    * @param string $name name of the element
    * @return mixed value of the element
    */
    public function __get($name) 
    {
        if(isset($this->channel[$name])) {
            return $this->channel[$name];
        } else {
            return null;
        }
    }

    /**
    * set some sub-element in the channel element
    * 
    * @param string $name - name of the element
    * @param mixed $value - value of the element (when this is the image element, then value must be an array)
    */
    public function __set($name,$value) 
    {
        $this->channel[$name] = $value;
    }


    /**
    * This method sets the image for the feed. It can be used in 2 different ways:
    *   1. with 3 arguments: $this->image($url,$link,$title) - which sets the required elements of the image tag at once
    *   2. with 1 array argument: $this->image(array $elements), where $elements is a key=>value pair of sub-elements of the image tag with its values 
    * <code> 
    *     // example 1 
    *     $x = new XmlToRss();
    *     $x->image('http://example.com/image.png','http://example.com/image.png','Some image title')
    * 
    *     // example 2
    *     $x = new XmlToRss();
    *     $x->image(array(
    *           'url'    => 'http://example.com/image.png',
    *           'link'   => 'http://example.com/image.png',
    *           'title'  => 'Some image title',
    *           'height' => '88'
    *      ));
    * </code>
    * 
    * @param mixed $url_or_array
    * @param mixed $title
    * @param mixed $link
    * @return XmlToRss
    */
    public function image($url_or_array,$title=null,$link=null) 
    {
        if(is_array($url_or_array)) {
            if(!isset($this->channel['image'])) {
                $this->channel['image'] = $url_or_array;
            } else {
                $this->channel['image'] = array_merge($this->channel['image'],$url_or_array);    
            }

        } else {
            $this->channel['image']['url'] = $url_or_array;
            $this->channel['image']['title'] = $title;
            $this->channel['image']['link'] = $link;
        }
        return $this;

    }

    /**
    * create a datetime string in RFC-822 format needed for RSS
    *     
    * @param mixed $dateTimeString
    * @return string datetime in RFC-822 format
    */
    public static function formatDate($dateTimeString=null) 
    {
        if($dateTimeString===null) {
            return date('D, d M Y H:i:s O');
        } else {
            return date('D, d M Y H:i:s O',strtotime($dateTimeString));      
        }

    } 

    /**
    * This is the function which does the whole magic conversion.
    * All previously set up paramtere are used to extend the default functionality. 
    * 
    * @return mixed 
    *            - string - if $output is set to 'string' and the conversion is OK
    *            - bool - otherwise. True on success and false on failure   
    */
    public function autoConvert($map=null) 
    {

        $o = $this->output;     // save the output setting for later
        $this->output('array'); // return the parsed XML as an array 
        $m = $this->map;     // save the map setting for later
        $this->map(array()); // do not map any fields in the XML, just return them as they are 
        $csv = parent::autoConvert();
        $this->output($o);
        $this->map($m);  // return the previous setting
        if($map!==null) {
            $this->map($map);   
        }

        unset($csv[0]);

        $new =  array();

        foreach($csv as $key=>$value) {

            if($this->importFrom > $key or $this->importTo < $key) continue;  // only process values in the selected range

            foreach($this->map as $k=>$v) {

                if($k=='##IMAGE##') continue; // this is a special field, it should not go to the output

                if(!is_array($v)) {
                    $fields = explode(';',$v);    
                } else {
                    $fields = $v;
                }

                if($k=='description') {
                    $new[$key][$k]='<![CDATA[';
                } else {
                    $new[$key][$k]='';
                }

                foreach($fields as $f) {
                    switch($f) {
                        case '##IMAGE##':
                            $new[$key][$k].= (isset($value[$this->map[$f]]) ? "<img src=\"".htmlspecialchars($value[$this->map[$f]])."\" />" : '');
                            break;

                        default:
                            $new[$key][$k].= (isset($value[trim($f)]) ? $value[trim($f)] : $f);
                            break;     
                    }



                }
                if($k=='description') {
                    $new[$key][$k].=']]>';
                }

                // re-format the date to RFC-822
                if($k=='pubDate') {
                    $new[$key][$k] = self::formatDate($new[$key][$k]);
                }
            }
        }

        if($this->output=='array') {
            return $new;
        }

        ob_start();
        echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
        echo "<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">\n";

        echo "  <channel>\n";

        foreach($this->channel as $key=>$value) { 
            switch($key) {
                case "pubDate":
                    echo "      <$key>".self::formatDate($value)."</$key>\n";
                    break;
                case "image":

                    echo "      <image>\n";
                    foreach($value as $k=>$v) {
                        echo "          <$k>$v</$k>\n"; 
                    }
                    echo "      </image>\n";                        
                    break;
                default:
                    echo "      <$key>$value</$key>\n";
                    break; 
            }
        }

        echo '      <atom:link href="http://'.$_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] .'" rel="self" type="application/rss+xml" />'."\n";
        foreach($new as $key=>$value) {
            echo "      <item>\n";
            foreach($value as $k=>$v) {
                switch($k) {
                    case "media":
                    case "enclosure":
                    echo "      <$k ";
                    $v = trim(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $v));
                    $v = explode(PHP_EOL, $v);
                    echo 'url="'.trim($v[0]).'" length="'.trim($v[3]).'" type="'.trim($v[2]).'" title="'.trim($v[4]).'"';
                    echo " />\n";                        
                    break;
                    default:
                echo "          <$k>$v</$k>\n";
                break;
                }
            } 

            echo "      </item>\n";            

        }
        echo "  </channel>\n";
        echo "</rss>";


        if($this->output=='file') {
            header("Content-Disposition: attachment; filename=\"".$this->filename."\";" );
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
            header("Content-Transfer-Encoding: binary"); 
        }

        if($this->output=='echo' or $this->output=='file') {
            header('Content-Type: application/rss+xml; charset=utf-8');
            echo ob_get_clean();
            return true;

        } else {
            return ob_get_clean();;
        }


    }
    /**
    * this function is not used in this class
    */
    public function mapConvert() 
    {
        die("The function <b>mapConvert</b> cannot be used in the XmlToRss class"); 
    }

    /**
    * this function is not used in this class
    */
    public static function convert() 
    {
        die("The function <b>convert</b> cannot be used in the XmlToRss class"); 
    }

    /**
    * this function is not used in this class
    */
    public static function convertString() 
    {
        die("The function <b>convertString</b> cannot be used in the XmlToRss class"); 
    }

}
