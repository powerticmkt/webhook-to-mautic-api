<?php

/*******************************************************************************
  Captura informações de um POST de um webhook e envia para a API do Mautic
  - Captura um parâmetro e-mail e pesquisa pelo lead no mautic
  - caso encontre, atribui um proprietário aleatório caso o lead não possua
********************************************************************************
*
*   @property               Powertic
*   @autor                  Luiz Eduardo - luiz@powertic.com
*   @license                GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*   @mautic-min-version     2.10.0
*   @ TODO: Tratar as exceções
*
*/

include __DIR__ . '/vendor/autoload.php';
use Mautic\Auth\ApiAuth;
use Mautic\MauticApi;
session_start();

include "credentials.php";

// Conecta no objeto de autenticação através da BasicAuth
$initAuth     = new ApiAuth();
$auth         = $initAuth->newAuth( $credentials, 'BasicAuth' );

// Instanciando um novo objeto Mautic
$api          = new MauticApi();

// Nova instância do objeto Contact
$contactApi   = $api->newApi( 'contacts', $auth, $mauticUrl );

// Pesquisa o contato pelo e-mail | "email:luiz@powertic.com"
$email        = $_GET['email'];
$response     = $contactApi->getList( "email:$email" );
$json         = json_encode( $response );
$decodedJson  = json_decode( $json, true );
$id           = 0;
$mautic_data  = array();

foreach( $decodedJson as $lista ) {
 	foreach( $decodedJson["contacts"] as $listaTotal ) {
      $id = $listaTotal["id"];
    break;
  }
  break;
}

// Retorna todos os possíveis proprietários
$all_owners = $contactApi->getOwners();

// Sorteia um proprietário aleatoriamente
$owner = array_rand( $all_owners , 1 );

$owner_id = $all_owners[$owner]["id"];

$mautic_data = array();

foreach($decodedJson as $lista)
{
 	foreach($decodedJson["contacts"] as $listaTotal)
  {
    $id                           =     $listaTotal["id"];
    $mautic_data                  =     $listaTotal["fields"]["all"];
    $mautic_data["points"] = 0;
    // coloque todos os dados que você quer atualizar aqui
    break;
  }
  break;
}

// Permite criar um novo contato caso o contato especificado não seja encontrado
$createIfNotFound = false;

// Envia a requisição para o Mautic atualizar ou criar o contato
  if ( $contactApi->edit($id, $mautic_data, $createIfNotFound) ) :
    echo "OK";
  else:
    echo "ERROR";
  endif;
