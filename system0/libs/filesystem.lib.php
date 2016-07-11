<?php
function format_perms($mode) {
  $perms  = ($mode & 00400) ? "r" : "-";
  $perms .= ($mode & 00200) ? "w" : "-";
  $perms .= ($mode & 00100) ? "x" : "-";
  $perms .= ($mode & 00040) ? "r" : "-";
  $perms .= ($mode & 00020) ? "w" : "-";
  $perms .= ($mode & 00010) ? "x" : "-";
  $perms .= ($mode & 00004) ? "r" : "-";
  $perms .= ($mode & 00002) ? "w" : "-";
  $perms .= ($mode & 00001) ? "x" : "-";
  return $perms;
}

function slash_delete($dir) {
  $result = $dir;
  if(substr($result, -1) == '/') {
    $result = substr($result, 0, -1);
  }
  return $result;
}

function isHomeDir($dir) {
  global $fstab;

  return (isset($fstab[$dir]) && isset($fstab[$dir]['is_homedir']) && ($fstab[$dir]['is_homedir'] === TRUE));
}

function getUserHome($user_home) {
  global $fstab;
  global $Session;
  reset($fstab);

  $result = "";  
  while (list($key, $value) = each($fstab)) { 
    if (isset($value['is_homedir']) && ($value['is_homedir'] === TRUE)) {
      $result = str_replace("%%user_homedir%%", $user_home, $value['full_path']);
    }
  }
  return $result;
}

function getFullPath($dir) {
  global $fstab;
  global $Session;
  reset($fstab);
  
  $dir = str_replace("\\", "/", $dir);
  if (substr($dir, 0, 1) != '/') {
    $dir = '/' . $dir;
  }
  
  $mount_point = '/';
  $len = strlen($mount_point);
  $fullPathDir = $fstab['/']['full_path'];
  while (list($key, $value) = each($fstab)) { 
    if ((strpos($dir, $key) === 0) && (strlen($key) >= $len)) {
      $mount_point = $key;
      $len = strlen($mount_point);
      if (isset($value['is_homedir']) && ($value['is_homedir'] === TRUE)) {
        if (isset($Session['USER']->homedir) && ($Session['USER']->homedir != '')) {
          $fullPathDir = str_replace("%%user_homedir%%", $Session['USER']->homedir, $value['full_path']);
        } else {
          $fullPathDir = str_replace("/%%user_homedir%%", '', $value['full_path']);
        }
      } else {
        $fullPathDir = $value['full_path'];
      }
    }
  }
  
  return str_replace("//", "/", slash_delete(slash_delete(str_replace("\\", "/", $fullPathDir)) . '/' . slash_delete(substr($dir, strlen($mount_point)))));
}

function getMountedDirs($dir) {
  global $fstab;
  reset($fstab);
  
  if ($dir == '') {
    $depth = 1;
  } elseif (strpos($dir, '/') === FALSE) {
    $depth = 2;
  } else {
    $depth = count(split('/', $dir)) + 1;
  }

  $result = array();
  while (list($key, $value) = each($fstab)) { 
    $tmp = split('/', $key);
	if (isset($tmp[$depth]) && ($tmp[$depth] != '')) $result[] = $tmp[$depth];
  }
  
  return $result;
}

function dir_copy($source, $dest, $overwrite = FALSE){
  $source = slash_delete($source);
  $dest = slash_delete($dest);
  
  if (!is_dir(getFullPath($dest)) && (!@mkdir(getFullPath($dest)))) {
    return FALSE;
  } elseif (!file_exists(getFullPath($source)) || !is_dir(getFullPath($source))) {
    return FALSE;
  } elseif (!is_readable(getFullPath($source))) {
    return FALSE;
  } elseif (FALSE !== ($handle = @opendir(getFullPath($source)))) {
    while (FALSE !== ($name = @readdir($handle))) {
      if ($name != '.' && $name != '..') {
        $path = $source . '/' . $name;
        if (is_file(getFullPath($path))) {
          if (!is_file(getFullPath($dest . '/' . $name)) || $overwrite) {
            if (!@copy(getFullPath($path), getFullPath($dest . '/' . $name))) {
              return FALSE;
            }
          } else {
            return FALSE;
          }
        } elseif (is_dir(getFullPath($path))) {
          if (!is_dir(getFullPath($dest . '/' . $name))) {
            if (@mkdir(getFullPath($dest . '/' . $name))) {
              if (!@dir_copy($path, $dest . '/' . $name, $overwrite)) {
                return FALSE;
              }
            } else {
              return FALSE;
            }
          } else {
            return FALSE;
          }
        }
      }
    }
    @closedir($handle);
  }
  return TRUE;
}

function dir_delete($dir, $empty = FALSE) {
  $dir = slash_delete($dir);
 
  if(!file_exists(getFullPath($dir)) || !is_dir(getFullPath($dir))) {
    return FALSE;
  } elseif (!is_readable(getFullPath($dir))) {
    return FALSE;
  } elseif (FALSE !== ($handle = @opendir(getFullPath($dir)))) {
    while (FALSE !== ($item = @readdir($handle))) {
      if($item != '.' && $item != '..') {
        $path = $dir . '/' . $item;
        if(is_file(getFullPath($path))) {
          if (!@unlink(getFullPath($path))) {
            return FALSE;
          }
        } else {
          if (!@dir_delete($path, $empty)) {
           return FALSE;
          }
        }
      }
    }

    @closedir($handle);
    if($empty == FALSE) {
      if(!@rmdir(getFullPath($dir))) {
        return FALSE;
      }
    }

    return TRUE;
  }
}

function dir_permissions($dir, $perms, $include_dirs = FALSE) {
  $dir = slash_delete($dir);
 
  if(!file_exists(getFullPath($dir)) || !is_dir(getFullPath($dir))) {
    return FALSE;
  } elseif (!is_readable(getFullPath($dir))) {
    return FALSE;
  } elseif (FALSE !== ($handle = @opendir(getFullPath($dir)))) {
    while (FALSE !== ($item = @readdir($handle))) {
      if (($item != '.') && ($item != '..') && ($include_dirs)) {
        $path = $dir . '/' . $item;
        if(is_file(getFullPath($path))) {
          if (!@chmod(getFullPath($path), $perms)) {
            return FALSE;
          }
        } else {
          if ((!@file_exists(getFullPath($path) . "/.")) || (!@dir_permissions($path, $perms, $include_dirs))) {
            return FALSE;
          }
        }
      }
    }

    @closedir($handle);
  }

  return @chmod(getFullPath($dir), $perms);
}

function dir_size($dir, &$size, &$dirs_no, &$files_no) {
  $dir = slash_delete($dir);

  if(!file_exists(getFullPath($dir)) || !is_dir(getFullPath($dir))) {
    return FALSE;
  } elseif (!is_readable(getFullPath($dir))) {
    return FALSE;
  } elseif (FALSE !== ($handle = @opendir(getFullPath($dir)))) {
    $int_size = 0;
	$int_dirs = 0;
	$int_files = 0;

	$dirs_no = 0;
	$files_no = 0;

	$size = 0;
    while (FALSE !== ($item = @readdir($handle))) {
      if($item != '.' && $item != '..') {
        $path = $dir . '/' . $item;
        if(is_file(getFullPath($path))) {
          $size += @filesize(getFullPath($path));
          $files_no++;
        } else {
          if (@dir_size($path, $int_size, $int_dirs, $int_files)) {
            $size += $int_size;
	        $dirs_no++;
            $dirs_no += $int_dirs;
            $files_no += $int_files;
          } else {
		    return FALSE;
		  }
		}
      }
    }
    @closedir($handle);
  }
  return TRUE;
}

function file_ext($filename) {
  $tmp = explode(".", $filename);
  return (count($tmp) > 1) ? strtoupper($tmp[count($tmp) - 1]) : "";
}

function mime($ext) {
  global $extensions;
  return (isset($extensions[strtolower($ext)]['image']) && ($extensions[strtolower($ext)]['image'] != "")) ? $extensions[strtolower($ext)]['image'] : "generic.gif";
}

function mime_color($ext) {
  global $extensions;
  return (isset($extensions[strtolower($ext)]['color']) && ($extensions[strtolower($ext)]['color'] != "")) ? $extensions[strtolower($ext)]['color'] : "#000000";
}

function can_view($ext) {
  global $extensions;
  return (isset($extensions[strtolower($ext)]['view']) && ($extensions[strtolower($ext)]['view'] != "")) ? $extensions[strtolower($ext)]['view'] : FALSE;
}

function can_edit($ext) {
  global $extensions;
  return (isset($extensions[strtolower($ext)]['edit']) && ($extensions[strtolower($ext)]['edit'] != "")) ? $extensions[strtolower($ext)]['edit'] : FALSE;
}

function get_viewer($ext) {
  global $extensions;
  return (isset($extensions[strtolower($ext)]['viewer']) && ($extensions[strtolower($ext)]['viewer'] != "")) ? $extensions[strtolower($ext)]['viewer'] : 'none';
}

function get_editor($ext) {
  global $extensions;
  return (isset($extensions[strtolower($ext)]['editor']) && ($extensions[strtolower($ext)]['editor'] != "")) ? $extensions[strtolower($ext)]['editor'] : 'none';
}

function get_highlighter($ext) {
  global $extensions;
  return (isset($extensions[strtolower($ext)]['highlighter']) && ($extensions[strtolower($ext)]['highlighter'] != "")) ? $extensions[strtolower($ext)]['highlighter'] : 'none';
}

function format_size($size) {
  $index = 0;
  $units = array("&nbsp;&nbsp;B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");
  while((($size/1024) > 1) && ($index < 8)) {
    $size = $size/1024;
    $index++;
  }
  return sprintf("%01.2f %s", $size, $units[$index]);
}

function file_list($dir, $include_dirs = FALSE, $search = NULL, $case_sensitive = FALSE) {
  global $bfexplorer_dir;
  global $names_chars;
  global $lang;

  $dir = slash_delete($dir);

  $result = array();
  $tmp_files = array();
  $result['files'] = array();
  $tmp_dirs = array();
  $result['dirs'] = array();

  $result['files_size'] = 0;
  
  $search_function = ($case_sensitive == FALSE) ? 'eregi' : 'ereg';
  
  $handle = opendir(getFullPath($dir));
  while ($name = readdir($handle)) {
    if ((@is_file(getFullPath($dir . "/" . $name))) && ($name != ".") && ($name != "..")) {
      $tmp_files[] = $name;
    } elseif ((@is_dir(getFullPath($dir . "/" . $name))) && ($name != ".") && ($name != "..") && ($name != $bfexplorer_dir)) {
      $tmp_dirs[] = $name;
    }
  }

  closedir($handle);

  $tmp_dirs = array_unique(array_merge((array)$tmp_dirs, (array)getMountedDirs($dir)));

  if (count($tmp_files) > 0) {
    natcasesort($tmp_files);
  }

  if (count($tmp_dirs) > 0) {
    natcasesort($tmp_dirs);
  }

  while (list($key, $name) = each($tmp_files)) {
    if (($search == NULL) || ($search == '') || ($search_function($search, $name))){
      $filename["name"] = $name;
      $filename["small_name"] = (strlen($name) > $names_chars) ? substr($name, 0, $names_chars) . "..>" : $name;
      $filename["size"] = format_size(@filesize(getFullPath($dir . "/" . $name)));
      $filename["ext"] = file_ext($name);
      $filename["color"] = mime_color(strtolower(file_ext($name)));
      $filename["type"] = ($filename["ext"] != "") ? sprintf($lang['files']['file_type'], $filename["ext"]) : $lang['files']['file_type2'];
      $filename["last_accessed"] = @fileatime(getFullPath($dir . "/" . $name));
      $filename["last_modified"] = @filemtime(getFullPath($dir . "/" . $name));
      $filename["permissions"] = format_perms(@fileperms(getFullPath($dir . "/" . $name)));
      $filename["path"] = ($dir != "") ? $dir . "/" . $name : $name;
      $filename["title"] = sprintf($lang['files']['file_title'], $name);
      $filename["in_dir"] = $dir;

      $result['files'][] = $filename;
      $result['files_size'] += filesize(getFullPath($dir . "/" . $name));
    }
  }

  while (list($key, $name) = each($tmp_dirs)) {
    if (($search == NULL) || ($search == '') || ($search_function($search, $name))){
      $dirname["name"] = $name;
      $dirname["small_name"] = (strlen($name) > $names_chars) ? substr($name, 0, $names_chars) . "..>" : $name;
      $dirname["size"] = "&nbsp;";
      $dirname["ext"] = "";
      $dirname["type"] = $lang['files']['dir_type'];
      $dirname["last_accessed"] = @fileatime(getFullPath($dir . "/" . $name));
      $dirname["last_modified"] = @filemtime(getFullPath($dir . "/" . $name));
      $dirname["permissions"] = format_perms(@fileperms(getFullPath($dir . "/" . $name)));
      $dirname["path"] = ($dir != "") ? $dir . "/" . $name : $name;
      $dirname["in_dir"] = $dir;

      if (@file_exists(getFullPath($dir . "/" . $name) . "/.")) {
        $dirname["title"] = sprintf($lang['files']['dir_title'], $name);
        $dirname["link"] = "?current_dir=" . urlencode($dirname["path"]);
      } else {
        $dirname["title"] = sprintf($lang['files']['prot_dir_title'], $name);
        $dirname["link"] = "JavaScript: alert('" . $lang['files']['prot_dir_alert'] . "');";
      }

      $result['dirs'][] = $dirname;
    }

    if (($include_dirs) && (@file_exists(getFullPath($dir . "/" . $name) . "/."))) {
      $path = ($dir != "") ? $dir . "/" . $name : $name;
      $tmp = file_list($path, $include_dirs, $search, $case_sensitive);
      for ($i = 0; $i < count($tmp['files']); $i++) {
        $result['files'][] = $tmp['files'][$i];
      }
      for ($i = 0; $i < count($tmp['dirs']); $i++) {
        $result['dirs'][] = $tmp['dirs'][$i];
      }
      $result['files_size'] += $tmp['files_size'];
    }
  }
  
  return $result;
}

function get_children($dir) {
  global $bfexplorer_dir;

  // Read subdirectories
  $result = array();
  $handle = @opendir(getFullPath($dir));
  while ($directory = @readdir($handle)) {
    if ((is_dir(getFullPath($dir) . '/' . $directory)) && ($directory != ".") && ($directory != "..") && ($directory != $bfexplorer_dir)) {
      $result[] = $dir . $directory;
    }
  }
  @closedir($handle);

  $result = array_unique(array_merge((array)$result, (array)getMountedDirs($dir)));

  if (count($result) > 0) {
    natcasesort($result);
  }

  return $result;
}

function get_tree($dir, $depth=0, $include_parents=FALSE, $root_item_id="", $current_depth=1) {
  global $lang;

  $result = "";
  $dir = slash_delete($dir);
  $dir .= ($dir != "") ? "/" : "";

  if ($include_parents) {
    $dir = slash_delete($dir);
    if ($dir == '') $dir = '/';

    $calc_depth = count(split('/', $dir)) - 1;
    if ($calc_depth < 1) $calc_depth = 1;
    $ancestors = get_tree('/', $calc_depth, FALSE, $root_item_id, 1); 

    $parent_id = substr($dir, 0, strrpos($dir, '/'));
    $parent_name = substr($parent_id, strrpos($parent_id, '/') + 1);
    $parent_value = get_tree($parent_id, $depth + 1, FALSE, $root_item_id, 1); 

    $result = str_replace("id: '" . $parent_id . "', name: '" . $parent_name . "'}", "id: '" . $parent_id . "', name: '" . $parent_name . "', children: [" . str_replace("\n", "\n" . str_repeat("  ", 2*$calc_depth), $parent_value) . "]}", $ancestors);
  } else {
    $dirs_list = get_children($dir);

    $i = 0;
    while (list($key, $value) = each($dirs_list)) {
      $go = substr($value, 0);
      $name = (strpos($go, '/') !== FALSE) ? substr(strrchr($go, '/'), 1) : $go;
      if (@file_exists(getFullPath(slash_delete($dir) . '/' . $name) . "/.")) {
        $result .= str_repeat("  ", 2*$current_depth - 1) . "{ id: '" . $go . "', name: '" . $name . "'";

        if (($depth == 0) || ($current_depth < $depth)) {
          $result .= ", children: [";
          $tmp = get_tree($value, $depth, FALSE, $root_item_id, $current_depth + 1); 
          $result .= ($tmp != "") ? ("\n" . $tmp) : "";
          $result .= "]";
        } else {
          $tmp = "";
          $result .= (count(get_children($value)) > 0) ? "" : ", children: []";
        }

        $result .= ($i == (count($dirs_list) - 1)) ? "}" : "},\n";
      } else {
        $result .= str_repeat("  ", 2*($current_depth - 1)) . "{ id: '" . $go . "', name: '" . $name . "', children: []}";
      }
      $i++;
    }

    if ($current_depth == 1) {
      $dir = slash_delete($dir);
      $name = (strpos($dir, '/') !== FALSE) ? substr(strrchr($dir, '/'), 1) : $dir;
      if ($dir == '') $dir = '/';
      if ($name == '') $name = '/';

      if (!$include_parents) {
        $result = str_repeat("  ", 2*($current_depth - 1)) . "{ id: '" . $dir . "', name: '" . $name . "', children: [\n" . $result . "]}";
      }
    } else {
      $result = (count($dirs_list) > 0) ? $result : "";
    }
  }

  return $result;
}
?>