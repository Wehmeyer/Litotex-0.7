<?php
/*
************************************************************
Litotex BrowsergameEngine
http://www.Litotex.de
http://www.freebg.de

Copyright (c) 2008 FreeBG Team
************************************************************
Hinweis:
Diese Software ist urheberechtlich gesch�tzt.

F�r jegliche Fehler oder Sch�den, die durch diese Software
auftreten k�nnten, �bernimmt der Autor keine Haftung.

Alle Copyright - Hinweise Innerhalb dieser Datei
d�rfen NICHT entfernt und NICHT ver�ndert werden.
************************************************************
Released under the GNU General Public License
************************************************************
*/

class navigation 
{
    
    var $version = "0.7.0";
    var $modul_name="navigation";
    var $modul_type="nav";
    
    function make_navigation($modulename,$modul_id,$ingame,$menue_art)
	{
        global $tpl,$db,$n;
        
        $new_found_inhalt_navi=array();
        $new_found_navi=array();
        
        $IMG_PATH=LITO_IMG_PATH_URL.$this->modul_name.'/';
        
        $navi ="";
        $theme = 0;
        if(!defined('LITO_THEMES'))
		{
        	$theme = 1;
        }
		else
		{
            $themeq = $db->query("SELECT `design_id` FROM `cc".$n."_desigs` WHERE `design_name` = '".LITO_THEMES."'");
            $themeq = $db->fetch_array($themeq);
			$theme = (!isset($themeq['design_id']) ? 1 :$themeq['design_id']);
        }
        $result=$db->query("SELECT * FROM cc".$n."_menu_game where ingame='".$ingame."' and  modul_id ='$modul_id' and menu_art_id ='".$menue_art."' and design_id = $theme order by sort_order ASC");
        
        
        while($row_g=$db->fetch_array($result)) 
		{
            $new_found_inhalt_navi=array($row_g['sort_order'],$row_g['menu_game_name'],$row_g['menu_game_link'],$row_g['optional_parameter']	);
            array_push($new_found_navi,$new_found_inhalt_navi);
        }
        $tpl->assign('daten_navi', $new_found_navi);

        $navi = $tpl->fetch(LITO_THEMES_PATH.$this->modul_name.'/navigation_'.$menue_art.'.html');
        
		$searchReplace = array(
			'[LITO_ROOT_PATH_URL]' => LITO_ROOT_PATH_URL,
			'[LITO_IMG_PATH]' => $IMG_PATH,
			'[LITO_BASE_MODUL_URL]' => LITO_MODUL_PATH_URL,
		);
        return str_replace(array_keys($searchReplace), array_values($searchReplace), $navi );;
    }
    
}