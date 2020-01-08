<?php

 /*******************************************************************************
    Captura informações de um POST de um webhook e envia para a API do Mautic
 ********************************************************************************
 *
 * @property               Powertic
 *  @autor                  Luiz Eduardo - luiz@powertic.com
 *   @license                GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 *   @mautic-min-version     2.10.0
 *
 */

include __DIR__ . '/vendor/autoload.php';
use Mautic\Auth\ApiAuth;
use Mautic\MauticApi;
session_start();

include "credentials.php";

echo 'processando ....';

// Conecta no objeto de autenticação através da BasicAuth
$initAuth = new ApiAuth();
$auth  = $initAuth->newAuth( $credentials, 'BasicAuth' );

// Instanciando um novo objeto Mautic
$api = new MauticApi();

$emailApi = $api->newApi( 'emails', $auth, $mauticUrl );

$contactApi   = $api->newApi( 'contacts', $auth, $mauticUrl );

$dados = $_POST;

// Pesquisa o contato pelo e-mail | "email:luiz@powertic.com"
$contact_id        = $dados['contact_id'];
$response     = $contactApi->getList( "ids:$contact_id" );
$json         = json_encode( $response );
$decodedJson  = json_decode( $json, true );
$id           = 0;
$mautic_data  = array();

$mautic_data = $decodedJson["contacts"][$contact_id]["fields"][ "all"];

$ids = explode(",", $dados["ids"]);

$email_id = $dados["email_id"];

foreach ($ids as $contact_id):

   $r = $emailApi->sendToContact($email_id, $contact_id, array( 'tokens' => $mautic_data ) );

   var_dump($r);

endforeach;
