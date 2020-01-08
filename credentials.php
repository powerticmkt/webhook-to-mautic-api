<?php

/*******************************************************************************
  Configurações da API do Mautic
********************************************************************************
*
*   @property               Powertic
*   @autor                  Luiz Eduardo - luiz@powertic.com
*   @license                GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*   @mautic-min-version     2.10.0
*   @ TODO: Tratar as exceções
*
*/

$ts = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: $ts");
header("Last-Modified: $ts");
header("Pragma: no-cache");
header("Cache-Control: no-cache, must-revalidate");

// Coloque aqui a sua chave de segurança
$secure = "25dgdg437257ddg28672dg357686";

// Se a chave não for informada ou esteja incorreta
// interrompe o script imediatamente
if (!(empty($_POST["key"]))) :
  if (!$secure == $_POST["key"]) :
   die();
  endif;
else:
  die();
endif;

// a url do seu mautic
$mauticUrl    = "https://mkt.powertic.com";

// login do Basic Authentication (crie um usuário ou utilize um existente)
$credentials  = array(
  'userName'   => $_POST["mautic_usr"],
  'password'   => $_POST["mautic_pwd"]
);
