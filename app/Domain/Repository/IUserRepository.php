<?php

namespace App\Domain\Repository;

interface IUserRepository
{
    /**
     * @param int $requestedPageNumber
     * @return array<object>
     */
    public function getUsers(int $requestedPageNumber=null) : array;
}
