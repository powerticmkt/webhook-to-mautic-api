<?php

/*******************************************************************************
  Captura informações de um POST de um webhook e envia para a API do Mautic
********************************************************************************
*
*   @property               Powertic
*   @autor                  Luiz Eduardo - luiz@powertic.com
*   @license                GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*   @mautic-min-version     2.10.0
*
*   @informações: https://developer.mautic.org/#delete-contact
*/

include __DIR__ . '/vendor/autoload.php';
use Mautic\Auth\ApiAuth;
use Mautic\MauticApi;
session_start();
// a url do seu mautic
$mauticUrl    = "https://mkt.seumautic.com.br";
// login do Basic Authentication
$credentials  = array(
  'userName'   => "login-do-mautic",
  'password'   => "senha-do-mautic"
);
// Conecta no objeto de autenticação através da BasicAuth
$initAuth     = new ApiAuth();
$auth         = $initAuth->newAuth( $credentials, 'BasicAuth' );
// Instanciando um novo objeto Mautic
$api          = new MauticApi();
// Nova instância do objeto Contact
$contactApi   = $api->newApi( 'contacts', $auth, $mauticUrl );
// Pesquisa o contato pelo e-mail
// "email:luiz@powertic.com"
$email        = $_GET['email'];
$response     = $contactApi->getList( "email:$email" );
$json         = json_encode( $response );
$decodedJson  = json_decode( $json, true );
$id           = 0;
$mautic_data  = array();

foreach( $decodedJson as $lista ) {
 	foreach( $decodedJson["contacts"] as $listaTotal ) {
      $id                           = $listaTotal["id"];
      $mautic_data["email"]         = $email;
    break;
  }
  break;
}
// Se a API retornar uma mensagem de sucesso, imprimir ok em tela
if( $contactApi->addDnc($id, "email" ) ) :
  echo "OK";
endif;