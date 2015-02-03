<?php
error_reporting(0);
      function get_menu($data, $parent = 0) {
	      static $i = 1;
	      $tab = str_repeat(" ", $i);
	      if (isset($data[$parent])) {
		      $html = "$tab<ul id='menu-tree' class='filetree'>";
		      $i++;
		      foreach ($data[$parent] as $v) {
			       $child = get_menu($data, $v->id_menu_utama);
			       $html .= "$tab<li>";
			       $html .= '<a href="media.php?'.$v->link_menu.'">'.$v->nama_menu.'</a>';
			       if ($child) {
				       $i--;
				       $html .= $child;
				       $html .= "$tab";
			       }
			       $html .= '</li>';
		      }
		      $html .= "$tab</ul>";
		      return $html;
	      } 
        else {
		      return false;
	      }
      }

?>