<?php
/**
 * Created by PhpStorm.
 * User: ngoha
 * Date: 7/21/2020
 * Time: 6:59 PM
 */


namespace App\Repositories;


use App\User;


class UserRepository
{

    public function create(array $request)
    {
        return User::create($request);
    }

    /**
     * @param array $request
     * @param User $user
     * @return bool
     */

    public function update($request, User $user)
    {
        return $user->update([
            'name' => $request['name'],
            'email' => $request['email']
        ]);
    }
}
