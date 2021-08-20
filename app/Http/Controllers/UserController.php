<?php

namespace App\Http\Controllers;

use App\Domain\Repository\IUserRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /** @var IUserRepository $UserRepository */
    var $UserRepository;

    function __construct(IUserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $pageNumber=null)
    {
        $UserModelsArray = [];
        foreach($this->UserRepository->getUsers($pageNumber) as $rawUser)
        {
            $User = new User();
            $User->mapRawArrayToUser((array) $rawUser);
            $UserModelsArray[] = $User->getAttributes();
        }
            
        return new Response($UserModelsArray);
    }

}
