<?php
//тестовый скрипт, не используется
/* require( $_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php" );

IncludeComponent("bitrix:catalog.import.1c", "",
    array(
        "IBLOCK_TYPE" => "catalog",
        "SITE_LIST" => array( 0 => "s1", ),
        "INTERVAL" => "30",
        "GROUP_PERMISSIONS" => array( 0 => "1", 1 => "6", 2 => "3", 3 => "4", 4 => "5", 5 => "7", 6 => "2", ),
        "GENERATE_PREVIEW" => "N",
        "DETAIL_RESIZE" => "N",
        "USE_OFFERS" => "N",
        "USE_IBLOCK_TYPE_ID" => "Y",
        "ELEMENT_ACTION" => "N",
        "SECTION_ACTION" => "N",
        "FILE_SIZE_LIMIT" => "204800",
        "USE_CRC" => "N",
        "USE_ZIP" => "N"
    ),
    false
);

require( $_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php" ); */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//header("Content-type:text/html; charset=windows-1251");
$_SESSION["BX_CML2_IMPORT"]["NS"]["STEP"]=0;

$path = '../upload/1c_catalog/';
$filesList = array();
$dir = opendir( $path );
while( $fileName = readdir( $dir ) ) {
    $fileInfo = pathinfo( $fileName );
    $extension = strtolower( $fileInfo['extension'] );
    if( $extension === 'xml' ) {
        $filesList[ $fileName ] = $fileName;
    }
}
sort( $filesList );

?>

<style>
    .buttons-panel {
        background: #eee;
        border: 1px solid #ADC3D5;
        border-radius: 4px;
        display: block;
        margin: 0 0 10px;
        padding: 10px 10px 5px;
    }

    .buttons-panel a {
        background-color: #86ad00;
        background-image: -webkit-linear-gradient(bottom, #729e00, #97ba00);
        border: solid 1px;
        border-color: #97c004 #7ea502 #648900;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0,0,0,.25), inset 0 1px 0 #cbdc00;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        font-size: 13px;
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-weight: bold;
        line-height: 30px;
        margin: 0 0 5px;
        padding: 0 10px;
        text-shadow: 0 1px rgba(0,0,0,0.1);
    }

    .buttons-panel a:hover {
        background-color: #9ec710;
        background-image: -webkit-linear-gradient(top, #acce11, #8abb0d);
        border-color: #97c004 #7ea502 #648900;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.25), 0 1px 0 #d5e71a inset;
        text-decoration: none;
    }

    .buttons-panel a.warning {
        color: #dd0000;
        text-shadow: 0 0 3px #fff;
    }

    .text-box {
        border: 1px solid #ADC3D5;
        display: none;
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 13px;
        line-height: 16px;
        padding: 5;
        width: 400;
    }

    .buttons-timer {
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
        font-size: 13px;
        line-height: 16px;
    }
</style>
<div class="buttons-panel">
    <?php foreach( $filesList as $fileName ) { ?>
        <?php if( preg_match( '/^users_.*\.xml$/i', $fileName ) ) { ?>
            <a  href="javascript:start_import_users('<?php echo urlencode( $fileName ); ?>')">Users: <?php echo $fileName.' ('.( number_format( filesize( $path.$fileName ) / 1024, 2, '.', '' ) ).' Кб)'; ?></a>
        <?php } else { ?>
            <a  href="javascript:start('<?php echo urlencode( $fileName ); ?>')"><?php echo $fileName.' ('.( number_format( filesize( $path.$fileName ) / 1024, 2, '.', '' ) ).' Кб)'; ?></a>
        <?php } ?>
    <?php } ?>
</div>

<div class="buttons-panel">
    <a class="warning" href="javascript:reset()">обнулить шаг</a>
    <a class="warning" href="javascript:status='stop'">остановить импорт</a>
</div>
<div id='main' class="text-box">
<div id="log"></div>
<div align=right id="load"></div>
</div>
<div id="timer" class="buttons-timer"></div>

<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
<script>
var 
log=document.getElementById("log"),
timer=document.getElementById("timer"),
load=document.getElementById("load");
var zup_import=false,
//переменные таймера
m_second=0,
seconds=0,
minute=0,
//переменные импорта
i=1,
a='',
proccess=true,
status="continue";


function createHttpRequest() {
   var httpRequest;
      if (window.XMLHttpRequest) 
      httpRequest = new XMLHttpRequest();  
      else if (window.ActiveXObject) {    
      try {
      httpRequest = new ActiveXObject('Msxml2.XMLHTTP');  
      } catch (e){}                                   
      try {                                           
      httpRequest = new ActiveXObject('Microsoft.XMLHTTP');
      } catch (e){}
      }
   return httpRequest;

}

function start(file) {
      document.getElementById("main").style.display='block';
      load.innerHTML="<b>Загрузка</b>..."
             i=1;
      a="";
      m_second=0;
        seconds=0;
      proccess=true;
      start_timer();
      timer.innerHTML="";
      if (file=="company.xml") {zup_import=true;}
      log.innerHTML="<b>Импорт "+file+"</b><hr>";
      query_1c(file)
}

function query_1c(file) {
  var import_1c=createHttpRequest();
  if (zup_import==true)
  {
  r="/bitrix/admin/1c_intranet.php?type=catalog&mode=import&filename="+file;
  } else{r="/bitrix/admin/1c_exchange.php?type=catalog&mode=import&filename="+file;}
    load.style.display="block";
    import_1c.open("GET", r, true);
    import_1c.onreadystatechange = function() {
        a=log.innerHTML;
        if (import_1c.readyState == 4 && import_1c.status == 0)
              {
              error_text="<em>Ошибка в процессе выгрузки</em><div style='width:270;font-size:11;border:1px solid             black;background-color:#ADC3D5;padding:5'>Сервер упал и не вернул заголовков.</div>"
                 log.innerHTML=a+"Шаг "+i+": "+error_text;
                 load.style.display="none";
                 status="continue"
                 alert("Import is crashed!");
              }
        
              if (import_1c.readyState == 4 && import_1c.status == 200)  
                 {
                    if ((import_1c.responseText.substr(0,8 )!="progress")&&(import_1c.responseText.substr(0,7)!="success"))
                    {
                       error_text="<em>Ошибка в процессе выгрузки</em><div style='width:270;font-size:11;border:1px solid black;background-color:#ADC3D5;padding:5'>"+import_1c.responseText+"</div>"
                       log.innerHTML=a+"Шаг "+i+": "+error_text;
                       status="error";
                    }
                    else
                    {
                       n=import_1c.responseText.lastIndexOf('s')+1;
                       l=import_1c.responseText.length;
                       mess=import_1c.responseText.substr(n,l);
                       log.innerHTML=a+"Шаг "+i+": "+mess+" ("+seconds+" сек.)"+"<br>";
                       seconds=0;
                       load.style.display="none";
                       i++;
                    }
                    if ((import_1c.responseText.substr(0,7)=="success")||(status=="error")||(status=="stop"))
                    {
                       load.style.display="none";
                       status="continue"
                       proccess=false;
                       timer.innerHTML="<hr>Время выгрузки: <b>"+minute+" мин. "+m_second+" сек.</b>";
                    }
                    else 
                    { 
                       query_1c(file);
                    }
                 } 
              
              

  }; 
  import_1c.send(null);
}

function start_import_users( fileName ) {
    $( '.text-box' ).show();
    $( '#log' ).html( $( '<div>' ).html( 'Загрузка '+( fileName )+'...' ) );
    $.get( '/includes/users-import.php?fn='+( fileName ) ).success(function( res ){
        $( '#log' ).append( $( '<div>' ).html( res + '\nГотово' ) );
    });
    return 0;
}//start_import_users

function start_timer() {
     if (m_second==60)
     {
     m_second=0;
     minute+=1;
     }
     if (proccess==true)
     {
     seconds+=1;
     m_second+=1;

     setTimeout("start_timer()",1000);
  }
}
      
function reset() {
    var rest=createHttpRequest();
       q="bx_1c_import_lite.php";
       rest.open("GET", q, true);
       rest.onreadystatechange=function()
                {
                if (rest.readyState == 4 && rest.status == 200)  
                   alert("Шаг импорта обнулён!");
                }
       
       rest.send(null);
       
}
</script>
