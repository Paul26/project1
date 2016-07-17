<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 7/14/16
 * Time: 8:49 PM
 */

namespace Project1\Infrastructure;

use Project1\Domain\StringLiteral;
use Project1\Domain\UserRepository;
use Project1\Domain\User;


class InMemoryUserRepository implements UserRepository
{
    /* @var array */
    protected $storage;

    /**
     * InMemoryUserRepository constructor.
     */
    public function __construct()
    {
        $this->storage = [];
    }

    /**
     * @param StringLiteral $fragment
     * @return array
     */
    public function findByEmail(StringLiteral $fragment)
    {
        $responseStorage = [];
        
        /** @var \Project1\Domain\user $user */
        foreach ($this->storage as $user) {
            if ($fragment->equal($user->getEmail())) {
                $responseStorage[] = $user;
            }
        }
        
        return $responseStorage;
    }

    /**
     * @param StringLiteral $id
     * @return \Project1\Domain\User
     */
    public function findById($id)
    {
        // TODO: Implement findById() method.
    }

    /**
     * @param StringLiteral $fragment
     * @return array
     */
    public function findByName($fragment)
    {
        // TODO: Implement findByName() method.
    }

    /**
     * @param StringLiteral $username
     * @return array
     */
    public function findByUsername($username)
    {
        // TODO: Implement findByUsername() method.
    }

    public function addUser(StringLiteral $name, StringLiteral $email, StringLiteral $username) {
        $newUser = new User($name, $email, $username);
        array_push($this->storage, $newUser);
    }

    public function removeUser(StringLiteral $id) {
       //  TODO:
    }

    public function updateUser(StringLiteral $name, StringLiteral $email, StringLiteral $username) {
        if(!empty($name) && $name != '') {
            //  update name
        }

        if(!empty($email) && $email != '') {
            //  update email
        }

        if(!empty($username) && $username != '') {
            //  update username
        }
    }

}  //End InMemoryUserRepository class