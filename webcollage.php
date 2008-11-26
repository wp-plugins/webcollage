<?php 
/* 
Plugin Name: WebCollage 
Plugin URI: http://www.bhawmik.com/
Description: Plugin for displaying a collage of website images with links
Version: 1.0 
Author: Sudipta Bhawmik
Author URI: http://www.bhawmik.com 
Disclaimer: Use at your own risk. No warranty expressed or implied is provided.

Copyright 2008 Sudipta Bhawmik (email: bhawmik@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

function webcollage_function ($text)
{
  global $wpdb; 
  // Edit the next line to set the default maximum number of Rows
  $MAX_NO_POSTS = 5;
  
  
  $weblinks = get_bookmarks();
  
//	$text = str_replace('[/webcollage]','</h2>',$text);  // no option

  
  $query = ""; 
  $feedURL = $weblinks;
  $iFeeds = count($feedURL);  // Find out how many feeds on the page
//  echo "Number of Links = ". $iFeeds; 
  $atext = "<table><tr>"; // reset replacement for string between  brackets
  $link_urls = $wpdb->get_col($query, 1);
  $j = 0;
  for ($i = 0; $i < $iFeeds; $i++)
  {
    
//    $link = get_bookmark_field('link_url',  $i, 'display');
//    echo $link;
       if ($i == 3) {  
	       $atext .= "<td><a href=\"http://nynjbengali.ethnomediallc.com\"><img src=\"http://images.websnapr.com/?size=T&key=S7UwgQjArlAL&url=http://nynjbengali.ethnomediallc.com\"></a></td>"; 
               $atext .= "<td><a href=\"$link_urls[$i]\"><img src=\"http://images.websnapr.com/?size=T&key=S7UwgQjArlAL&url=$link_urls[$i]\"></a></td>";
               $j++;
       }
       else {
	       $atext .= "<td><a href=\"$link_urls[$i]\"><img src=\"http://images.websnapr.com/?size=T&key=S7UwgQjArlAL&url=$link_urls[$i]\"></a></td>";
       }
    if ($j == 5)
      {
       $j = 0;
       $atext .= "</tr><tr>";
      }
   else
       $j++; 
   } 
    // this finds the particular feed between the feedsnap brackets and replaces
    // it with the assembled feed text
 
  $atext .= "</tr></table>";
  
  $text = str_replace('[webcollage]', $atext, $text); //allow for option
  	
  return $text;
}



add_filter('the_content','webcollage_function');

?>