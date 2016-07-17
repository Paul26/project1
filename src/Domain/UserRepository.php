<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 7/14/16
 * Time: 8:37 PM
 */

namespace Project1\Domain;

// TODO: the rest of CRUD, and use remove in repository instead of delete

interface UserRepository
{
    /**
     * @param StringLiteral $fragment
     * @return array
     */
    public function findByEmail(StringLiteral $fragment);

    /**
     * @param StringLiteral $id
     * @return \Project1\Domain\User
     */
    public function findById($id);

    /**
     * @param StringLiteral $fragment
     * @return array
     */
    public function findByName($fragment);

    /**
     * @param StringLiteral $username
     * @return array
     */
    public function findByUsername($username);

    /**
     * @param StringLiteral $name
     * @param StringLiteral $email
     * @param StringLiteral $username
     * @return array
     */
    public function addUser(StringLiteral $name, StringLiteral $email, StringLiteral $username);

    /**
     * @param StringLiteral $id
     * @return array
     */
    public function removeUser(StringLiteral $id);

    /**
     * @param StringLiteral $name
     * @param StringLiteral $email
     * @param StringLiteral $username
     * @return array
     */
    public function updateUser(StringLiteral $name, StringLiteral $email, StringLiteral $username);

}