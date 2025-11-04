<?php
    namespace App\Http\Controllers;

    use Google_Client;
    use Google_Service_Gmail;
    use Illuminate\Http\Request;

    class GoogleController extends Controller
    {
        public function redirectToGoogle()
        {
            $client = new Google_Client();
            $client->setClientId(config('google.client_id'));
            $client->setClientSecret(config('google.client_secret'));
            $client->setRedirectUri(config('google.redirect_uri'));
            $client->addScope(Google_Service_Gmail::GMAIL_READONLY);
            
            // Gera a URL de autenticação
            $authUrl = $client->createAuthUrl();
            return redirect()->away($authUrl);
        }

        public function handleGoogleCallback(Request $request)
        {
            $client = new Google_Client();
            $client->setClientId(config('google.client_id'));
            $client->setClientSecret(config('google.client_secret'));
            $client->setRedirectUri(config('google.redirect_uri'));
            
            // Pega o código de autorização
            $code = $request->get('code');
            
            // Troca o código de autorização por um access token
            $accessToken = $client->fetchAccessTokenWithAuthCode($code);
            
            // Configura o cliente com o token de acesso
            $client->setAccessToken($accessToken);

            // Agora você pode fazer chamadas à API do Gmail, por exemplo
            $gmailService = new Google_Service_Gmail($client);
            $messages = $gmailService->users_messages->listUsersMessages('me');
            
            // Retorne os e-mails ou faça o que precisar
            return view('gmail.messages', compact('messages'));
        }
    }

