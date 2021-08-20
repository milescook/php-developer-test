<?php

namespace App\Domain\Repository;

use GuzzleHttp\Client;

class UserRepositoryAPI implements IUserRepository
{
    /** @var Client $GuzzleClient */
    var $GuzzleClient;


    function __construct()
    {
        $this->GuzzleClient = new Client([
            // Base URI is used with relative requests
            'base_uri' => "https://reqres.in",
            // You can set any number of default request options.
            'http_errors' => true,
            'timeout'  => 5.0
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getUsers(int $requestedPageNumber=null) : array
    {
        $users = [];
        $moreResultsAvailable = true;
        if($requestedPageNumber==null)
            $currentPageNumber = 1;
        else
            $currentPageNumber = $requestedPageNumber;

        do
        {
            $resultObject = $this->getUsersEndpointResponse($currentPageNumber);
            foreach($resultObject->data as $userObject)
            {
                $users[] = $userObject;
            }

            // Check if we only wanted a certain page
            if($requestedPageNumber == $currentPageNumber)
                return $users;

            // Otherwise, keep going uintil we run out of results
            if($currentPageNumber == $resultObject->total_pages)
                $moreResultsAvailable = false;

            $currentPageNumber++;
        }
        while($moreResultsAvailable);

        return $users;
    }

    /**
     * @param int $pageNumber
     */
    private function getUsersEndpointResponse(int $pageNumber=1)
    {
        $queryParams = 
        [
            "page" => $pageNumber
        ];
        $response = $this->GuzzleClient->request('GET', "/api/users/",['query'=>$queryParams]);
        $statusCode = $response->getStatusCode();
        if($statusCode!=200)
            throw new \Exception("Could not query API for users, got status ".$statusCode);

        $body = $response->getBody();
        $resultObject = json_decode($body);
        return $resultObject;
    }
}
