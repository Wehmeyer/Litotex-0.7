<?PHP
/*
************************************************************
Litotex Browsergame - Engine
http://www.Litotex.de
http://www.freebg.de

Copyright (c) 2008 FreeBG Team
************************************************************
Hinweis:
Diese Software ist urheberrechtlich gesch�tzt.

F�r jegliche Fehler oder Sch�den, die durch diese Software
auftreten k�nnten, �bernimmt der Autor keine Haftung.

Alle Copyright - Hinweise innerhalb dieser Datei
d�rfen WEDER entfernt, NOCH ver�ndert werden.
************************************************************
Released under the GNU General Public License
************************************************************

*/

$modul_name="index";
require("./../../includes/global.php");


if (is_modul_name_aktive($modul_name)==0)
{
    show_error('MODUL_LOAD_ERROR','core');
    exit();
}

if(isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else $action="main";
    
if($action=="main")
{
    
    $tpl ->assign('if_disable_menu',1);
    template_out('index.html',$modul_name);
    exit();
}