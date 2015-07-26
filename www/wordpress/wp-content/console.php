<?php
/*
 * console()
 * Chromeのコンソールにvar_dumpする関数
 * @auther muyuu
 * @param  ???
 * @return false
 */
function console ( $d ) {
  // var_dump を変数に入れる
  ob_start();
  var_dump($d);
  $dump = ob_get_contents();
  ob_end_clean();

  // 文字列をサニタイズとかconsole.logで見やすいように
  $dump = str_replace(array("rn","r","n"), 'n', $dump);
  $dump = str_replace("'", '"', $dump);

  // scriptタグとconsole.logを出力
  $str = "≶script>";
  $str .= "console.log('" . $dump. "');";
  $str .= "</script>";
  echo $str;
  return;
}