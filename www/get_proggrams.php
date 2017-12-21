<?php
ob_start();
require_once($_SERVER["DOCUMENT_ROOT"]."/includes/tools.php");
$tmp = ob_get_contents();
ob_end_clean();

header('Content-type: text/xml');
Tools::IncludeModule();

$filter = array(
  'ACTIVE' => 'Y',
  'IBLOCK_ID' => 19
);

$dbProgrammsList = CIBlockElement::GetList(array('ACTIVE_FROM'=>'DESC'),$filter);

$xml = '<?xml version="1.0" encoding="UTF-8"?>
<Программы>';

while($programm = $dbProgrammsList->GetNext()){
  $text = strip_tags($programm['DETAIL_TEXT'],'<p><h1><h2><h3><h4>');
  $text = preg_replace('/(<(\/?)\w(\d?))[^>]*(>)/','$1$4',$text);
  $preview_text = strip_tags($programm['PREVIEW_TEXT'],'<p><h1><h2><h3><h4> <a></a>');


  $xml .='
  <Программа lang="ru">
    <ИД>'.$programm['ID'].'</ИД>
    <Код>'.$programm['CODE'].'</Код>
    <Наименование>'.$programm['NAME'].'</Наименование>
    <Краткое_описание><![CDATA[<p class="tab" style="text-align:justify;">'.$preview_text.'</p>]]></Краткое_описание>
    
  </Программа>';
}
/*<Текст>'.htmlspecialchars($text).'</Текст>*/
$xml .= '
</Программы>';
echo $xml;
/*$fname = 'programms_'.date('d_m_Y').'.xml';
$fpath = $_SERVER["DOCUMENT_ROOT"].'/'.$fname;
$fh = fopen($fpath, 'w');
fwrite($fh, $xml);
fclose($fh);
doGet($fpath,$fname);
unlink($fpath);*/

function doGet($file, $fileName, $content_type = "application/xml")
{
  global $REMOTE_ADDR, $HTTP_SERVER_VARS;

  $fsize = filesize($file);
  $ftime = gmdate("D, d M Y H:i:s T", filemtime($file));
  $fh = fopen($file, "rb");

  if ($HTTP_SERVER_VARS["HTTP_RANGE"]) {
    $range = $HTTP_SERVER_VARS["HTTP_RANGE"];
    $range = str_replace("bytes=", "", $range);
    $range = str_replace("-", "", $range);
    if ($range)
      fseek($fh, $range);
  }

  $content = fread($fh, filesize($file));
  fclose($fh);

  if ($range)
    header("HTTP/1.1 206 Partial Content");
  else
    header("HTTP/1.1 200 OK");

  header("Content-Type: " . $content_type);
  header("Expires: ");
  header("Last-Modified: " . $ftime);
  header("Accept-Ranges: bytes");
  header("Content-Length: " . ($fsize - $range));
  header("Content-Range: bytes " . $range . "-" . ($fsize - 1) . "/" . $fsize);
  header("Content-disposition: attachment; filename=" . trim($fileName));
  header("Content-Transfer-Encoding: binary");
  header("Cache-Control: public");
  header("Pragma: public");
  print $content;
}