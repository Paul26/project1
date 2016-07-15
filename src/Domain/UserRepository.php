<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 7/14/16
 * Time: 8:37 PM
 */

namespace Project1\Domain;

// TODO: the rest of CRUD, and use remove in reopository instead of delete

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

}