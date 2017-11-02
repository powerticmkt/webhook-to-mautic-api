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
*/

include __DIR__ . '/vendor/autoload.php';

use Mautic\Auth\ApiAuth;
use Mautic\MauticApi;

session_start();

$mauticUrl = "https://mkt.seumautic.com.br";

$credentials = array(
    'userName'   => "login-do-mautic",
    'password'   => "senha-do-mautic"
);

// Conecta no objeto de autenticação através da BasicAuth
$initAuth = new ApiAuth();
$auth = $initAuth->newAuth($credentials, 'BasicAuth');

// Objeto do Mautic API
$api = new MauticApi();

// Nova instância do objeto Contact
$contactApi = $api->newApi('contacts', $auth, $mauticUrl);

// Captura os dados do POST
$mautic_data = array(
    'email'        =>    $_POST['email'],  // customize a variavel
    'firstname'    =>    $_POST['name'],    // customize a variavel
    'phone'		     =>    $_POST['phone']    // customize a variavel
);

// Pesquisa o contato pelo e-mail
// "email:luiz@powertic.com"
$response = $contactApi->getList("email:$email");
$json = json_encode($response);
$decodedJson = json_decode($json, true);

$id = 1;
foreach ($decodedJson as $lista) {
    foreach ($decodedJson["contacts"] as $listaTotal) {
        $id = $listaTotal["id"];
        break;
    }
    break;
}

// Permite criar um novo contato caso o contato especificado
// não seja encontrado
$createIfNotFound = true;

// Envia a requisição para o Mautic atualizar ou criar o contato
$contact = $contactApi->edit($id, $mautic_data, $createIfNotFound);

// finalizado
echo "OK";
