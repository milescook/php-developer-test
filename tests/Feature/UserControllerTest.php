<?php

namespace Tests\Feature;

use App\Domain\Repository\IUserRepository;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Prophecy\Prophecy\ObjectProphecy;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function test_user_controller()
    {
        $UserRepoProphecy = $this->prophesize(IUserRepository::class);
        $User1 = 
        [
            "id" => 1,
            "email" => "john@doe.com",
            "first_name" => "John",
            "last_name" => "Doe"
        ];
        $User2 = 
        [
            "id" => 2,
            "email" => "tina@turner.com",
            "first_name" => "Tina",
            "last_name" => "Turner"
        ];

        $UserRepoProphecy
            ->getUsers(1)
            ->willReturn([$User1,$User2]);

        $UserController = new UserController($UserRepoProphecy->reveal());
        $response = $UserController->index(1);
        $responseString = (string) $response->getContent();
        $responseObject = json_decode($responseString);
        if($responseObject==false)
            throw new \Exception("Can't parse index response");

        
        $this->assertEquals("Tina Turner", $responseObject[1]->name);
    }
}
