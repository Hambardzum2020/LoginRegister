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

    public function create(array $request){
        return User::create($request);
    }

    /**
     * @param $request
     * @return bool
     */

    public function update(array $request){
        return User::where('id', $request['id'])->update([
            'name' => $request['name'],
            'email' => $request['email']
        ]);
    }
}
