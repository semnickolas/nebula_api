<?php

namespace App\Component;

use Exception;
use Google_Client;
use Google_Service_Sheets;
use Google_Service_Sheets_ValueRange;

/**
 * Class SpreadSheetsClientFactory
 * @package App\Component
 */
class SpreadSheetsClientFactory
{
    private string $tokenPath;

    private Google_Client $client;

    /**
     * SpreadSheetsClientFactory constructor.
     *
     * @param string $tokenPath
     * @param Google_Client $client
     */
    public function __construct(string $tokenPath, Google_Client $client)
    {
        $this->tokenPath = $tokenPath;
        $this->client = $client;
    }

    /**
     * @return Google_Service_Sheets
     * @throws Exception
     */
    public function createSheetClient() : Google_Service_Sheets
    {
        $this->client->setScopes(Google_Service_Sheets::SPREADSHEETS);
        $this->checkToken();
        return new Google_Service_Sheets($this->client);
    }

    /**
     * @return Google_Service_Sheets_ValueRange
     */
    public function createSheetsValueRange() : Google_Service_Sheets_ValueRange
    {
        return new Google_Service_Sheets_ValueRange();
    }

    /**
     * @throws Exception
     */
    private function checkToken() : void
    {
        //TODO : need refactoring
        if (file_exists($this->tokenPath)) {
            $accessToken = json_decode(file_get_contents($this->tokenPath), true);
            $this->client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($this->client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $this->client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $this->client->fetchAccessTokenWithAuthCode($authCode);
                $this->client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($this->tokenPath))) {
                mkdir(dirname($this->tokenPath), 0700, true);
            }
            file_put_contents($this->tokenPath, json_encode($this->client->getAccessToken()));
        }
    }
}