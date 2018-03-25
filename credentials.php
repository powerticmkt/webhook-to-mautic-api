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

// Coloque aqui a sua chave de segurança
$secure = "25dgdg437257ddg28672dg357686";

// Se a chave não for informada ou esteja incorreta
// interrompe o script imediatamente
if (!(empty($_GET["key"]))) :
  if (!($secure == $_GET["key"])) :
   die();
  endif;
else:
  die();
endif;

// a url do seu mautic
$mauticUrl    = "https://mkt.seumautic.com";

// login do Basic Authentication (crie um usuário ou utilize um existente)
$credentials  = array(
  'userName'   => "nome do usuario",
  'password'   => "senha do usuario"
);
