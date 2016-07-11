<?php
                          /*=-- Shell Commander --=*\
                         <*===--- version 0.7 ---===*>
                          \*=--- Pavel Tzonkov ---=*/


  /***************************************************************************\
  |                                                                           |
  |  Copyright 2005-2006 SunHateR Home Studio                                 |
  |  Pavel Tzonkov <pavelc@mail.bg>                                           |
  |                                                                           |
  |  Shell Commander is free software; you can redistribute it and/or modify  |
  |  it under the terms of the GNU General Public License as published by     |
  |  the Free Software Foundation; either version 2 of the License, or (at    |
  |  your option) any later version.                                          |
  |                                                                           |
  |  Shell Commander is distributed in the hope that it will be useful, but   |
  |  WITHOUT ANY WARRANTY; without even the implied warranty of               |
  |  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU         |
  |  General Public License for more details.                                 |
  |                                                                           |
  |  You should have received a copy of the GNU General Public License along  |
  |  with Shell Commander; if not, write to the Free Software Foundation,     |
  |  Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA              |
  |                                                                           |
  \***************************************************************************/

  /////////////////////////////////////////////////////////////////////////////
  // This is a modification of version 0.7 in order to fit with              //
  // BytesFall Explorer. Ovidio (ovidio AT users.sourceforge.net)            //
  /////////////////////////////////////////////////////////////////////////////

  error_reporting(0);

  include('globals.inc.php');

  $link = ($Session["config"]["files"]["use_frames"]) ? "../files.php" : "../files_nf.php";
  
  if ((!isset($_POST['accion'])) || (($_POST['accion'] != "execute") && ($_POST['accion'] != "shell_cmd"))) {
	$Session["files"]["message"] = $lang['files']['error_in_request'];
    header("Location: " . $link);
    die();
  }
  
  if ($_POST['input']) $_POST['input'] = my_encode($_POST['input']);

  $cache_lines = 1000;	// Maximal number of output lines
  $history_lines = 100;	// Maximal number of command lines, stored in history
  $history_chars = 20;	// Maximal number of characters per line in displayed history

  $alias = array(
    "la"    => "ls -la",
    "rf"    => "rm -f",
    "unbz2" => "tar -xjpf",
    "ungz"  => "tar -xzpf"
  );

  $prompt = set_prompt();

  $current_dir = getFullPath($Session["config"]["files"]["current_dir"]);

  chdir($current_dir);

  if ($_GET['clear_hist']) $Session['files']['history'] = "";

  if ($Session['files']['history']) $hist_arr = explode("\n", $Session['files']['history']);

  if ($_POST['input']) {
    if (!in_array($_POST['input'], $hist_arr)) {
      $hist_arr[] = $_POST['input'];
      $Session['files']['history'] = implode("\n", $hist_arr);
    }

    if (count($hist_arr) > $history_lines) {
      $start = count($hist_arr) - $history_lines;
      $Session['files']['history'] = "";

      for ($i = $start; $i < count($hist_arr); $i++)
      $Session['files']['history'] .= $hist_arr[$i] . "\n";

      $Session['files']['history'] = substr($Session['files']['history'], 0, -1);
      $hist_arr = explode("\n", $Session['files']['history']);
    }

    $first_word = first_word($_POST['input']);

    if (array_key_exists($first_word, $alias)) {
      $_POST['input'] = $alias[$first_word] . substr($_POST['input'], strlen($first_word));
      $first_word = first_word($_POST['input']);
    }

    switch ($first_word) {

      case "clear":
        $Session['files']['output'] = "";
      break;

      case "exit":
        header("Location: " . $link);
      break;

      case "cd":
        $Session['files']['output'] .= "\n" . $prompt;
        $Session['files']['output'] .= $_POST['input'] . "\n" . $lang['files']['shell']['error_exec_cd'] . "\n";
      break;

      default:
        $result = shell_exec($_POST['input'] . " 2>&1");

        if (substr($result, -1) != "\n") $result .= "\n";
        $Session['files']['output'] .= $prompt . $_POST['input'] . "\n" . $result;

        $rows = preg_match_all('/\n/', $Session['files']['output'], $arr);
        unset($arr);

        if ($rows > $cache_lines) {
          preg_match('/(\n[^\n]*){' . $cache_lines . '}$/', $Session['files']['output'], $out);
          $Session['files']['output'] = $out[0] . "\n";
        }
      break;
    }
  }

  function my_encode($str) {
    $str = str_replace("\\\\", "\\", $str);
    $str = str_replace("\\\"", "\"", $str);
    $str = str_replace("\\'", "'", $str);

    while (strpos($str, "  ") !== false) $str = str_replace("  ", " ", $str);

    return rtrim(ltrim($str));
  }

  function set_prompt() {
    global $Session;

    return "/" . $Session["config"]["files"]["current_dir"] . " $ ";
  }

  function first_word($str) {
    list($str) = preg_split('/[ ;]/', $str);
    return $str;
  }

  $out = substr(preg_replace('/<\/(textarea)/i', '&lt;/\1', $Session['files']['output']), 0, -1);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $lang['all']['bfexplorer']; ?> - <?php echo $lang['files']['shell']['exec_shell_cmd']; ?></title>
<link rel="shortcut icon" href="../../favicon.ico">
<style type="text/css">
<!--
  input, textarea, select, option, td {
        color: #BBBBBB;
        background-color: #000000;
        font-family: Terminus, Fixedsys, Fixed, Terminal, Courier New, Courier;
        font-size: 10px;
  }

  textarea {
        overflow-y: auto;
        border-width: 0px;
        height: 100%;
        width: 100%;
        padding: 0px;
  }

  input {
        border-width: 0px;
        height: 26px;
        width: 100%;
        padding-top: 5px;
  }

  select, option {
        color: #000000;
        background-color: #BBBBBB;
  }

  body {
        overflow-y: auto;
        margin: 0;
  }

  -->
</style>
<script language="JavaScript">
  <!--
  hist_arr = new Array();

<?php
  foreach ($hist_arr as $key => $value) {
    $value = str_replace("\\", "\\\\", $value);
    $value = str_replace("\"", "\\\"", $value);
    echo "hist_arr[$key] = \"$value\";\n";
  }
?>

  function findObj(n, d) {
    var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
      d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
    if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
    for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=findObj(n,d.layers[i].document);
    if(!x && d.getElementById) x=d.getElementById(n); return x;
  }

  function parse_hist(key) {
    if (key < hist_arr.length) {
      if (key != "") {
        findObj('input').value = hist_arr[key];
        findObj('input').focus();
      }
    } else {
      document.form.action = "?clear_hist=1";
	  document.form.submit();
    }
  }

  function input_focus() {
    findObj('input').focus();
  }

  function selection_to_clipboard() { // IE only!
    if (window.clipboardData && document.selection)
      window.clipboardData.setData("Text", document.selection.createRange().text);
  }

  if (window.clipboardData)
    document.oncontextmenu = new Function("findObj('input').value = window.clipboardData.getData('Text'); input_focus(); return false");

  -->
</script>
</head>
<body onLoad="findObj('output').scrollTop = findObj('output').scrollHeight; input_focus()" topmargin="0" leftmargin="0">
<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%">
  <tr>
    <td height="100%" bgcolor="#000000" style="padding-top: 5px; padding-left: 5px; padding-right: 5px; padding-bottom: 0px"><textarea id="output" onSelect="selection_to_clipboard()" onClick="input_focus()" readonly><?php echo $out; ?></textarea></td>
  </tr>
  <tr>
    <td bgcolor="#000000"><table cellpadding="0" cellspacing="5" border="0" width="100%">
        <tr>
          <form action="?" method="post" name="form" id="form">
            <td nowrap onClick="input_focus()"><?php echo substr($prompt, 0, -1) ?></td>
            <td width="100%"><input name="accion" type="hidden" id="accion" value="execute" />
              <input id="input" type="text" name="input" /></td>
          </form>
          <?php if ($hist_arr) { ?>
          <td nowrap><select onChange="parse_hist(this.options[this.selectedIndex].value)">
              <option value=""><?php echo $lang['files']['shell']['history']; ?></option>
              <?php
              for ($i = count($hist_arr) - 1; $i >= 0; $i--) {
                if (strlen($hist_arr[$i]) > $history_chars) $option = substr($hist_arr[$i], 0, $history_chars - 3) . "...";
                else $option = $hist_arr[$i];
                echo "<option value=\"" . $i . "\">$option</option>";
              }
              ?>
              <option value="<?php echo $history_lines + 1 ?>"><?php echo $lang['files']['shell']['clear_history']; ?></option>
            </select></td>
          <?php }  ?>
        </tr>
      </table></td>
  </tr>
</table>
<script language="JavaScript">
  <!--
  findObj('output').scrollTop = findObj('output').scrollHeight;
  -->
</script>
</body>
</html>
