<?php

namespace App\Helpers;
use Carbon\Carbon;

class Common
{
    public static function setSessionToken()
    {
        $token = self::getToken();
        $_SESSION['dropboxToken'] = $token['access_token'];
        $_SESSION['dropboxExpires'] = Carbon::now()->timestamp + ($token['expires_in'] - 100);
        return $token['access_token'];
    }

    public static function getSessionToken()
    {
        if( isset($_SESSION['dropboxToken']) && !empty($_SESSION['dropboxToken']) ) {
            if( Carbon::now()->timestamp < $_SESSION['dropboxExpires'] ) {
                return $_SESSION['dropboxToken'];
            }
            unset($_SESSION["dropboxToken"]);
            unset($_SESSION["dropboxExpires"]);
        }
        return self::setSessionToken();
    }

    public static function getToken()
    {
        try {
            $client = new \GuzzleHttp\Client();
            $res = $client->request("POST", "https://".env('DROPBOX_KEY').":".env('DROPBOX_SECRET')."@api.dropbox.com/oauth2/token", [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => env('DROPBOX_REFRESH_TOKEN'),
                ]
            ]);
            if ($res->getStatusCode() == 200) {
                return json_decode($res->getBody(), TRUE);
            } else {
                return false;
            }
        }
        catch (Exception $e) {
            dd("[{$e->getCode()}] {$e->getMessage()}");
            return false;
        }
    }
}