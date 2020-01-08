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

// Conecta no objeto de autenticação através da BasicAuth
$initAuth = new ApiAuth();
$auth  = $initAuth->newAuth( $credentials, 'BasicAuth' );

// Instanciando um novo objeto Mautic
$api = new MauticApi();

$emailApi = $api->newApi( 'emails', $auth, $mauticUrl );

$dados = $_GET();

$ids = explode(",", $dados["ids"]);

$email_id = $dados["email_id"];

foreach ($ids as $contact_id):

   $emailApi->sendToContact($email_id, $contact_id, dados);

endforeach;
