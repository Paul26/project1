<?php
/**
 * File name: MysqlUserRepository.php
 * Project: project1
 * PHP version 5
 * @category  PHP
 * @package   Project1\Infrastructure
 * @author    donbstringham <donbstringham@gmail.com>
 * @copyright 2016 © donbstringham
 * @license   http://opensource.org/licenses/MIT MIT
 * @version   GIT: <git_id>
 * @link      http://donbstringham.us
 * $LastChangedDate$
 * $LastChangedBy$
 */
namespace Project1\Infrastructure;
use Project1\Domain\StringLiteral;
use Project1\Domain\User;
use Project1\Domain\UserRepository;
use system\S;
/**
 * Class MysqlUserRepository
 * @category  PHP
 * @package   Project1\Infrastructure
 * @author    donbstringham <donbstringham@gmail.com>
 * @link      http://donbstringham.us
 */
class MysqlUserRepository implements UserRepository
{
    /** @var \PDO */
    protected $driver;

    /**
     * MysqlUserRepository constructor
     * @param \PDO $driver
     */
    public function __construct(\PDO $driver)
    {
        $this->driver = $driver;
    }

    private function execSqlNoReturn(String $query)
    {
        try {
            $this->driver->exec($query);
        } catch (\PDOException $e) {
            if ($e->getCode() === 1062) {
                // TODO: something
            } else {
                throw $e;
            }
        }
    }

    private function execSqlWithReturn(String $query, bool $fetchall)
    {
        $result = [];
        try {
            $stmt = $this->driver->query($query);
            if($fetchall){
                $result = $stmt->fetchAll();
            }
            else{
                $result = $stmt->fetch();
            }
        } catch (\PDOException $e) {
            if ($e->getCode() === 1062) {
                // TODO: something
            } else {
                throw $e;
            }
        }
        return $result;
    }

    private function createUserOrArray(String $query, bool $create)
    {
        $result = $this->execSqlWithReturn($query, false);
        if($create) {
            $user = new User(new StringLiteral($result["email"]),
                new StringLiteral($result["name"]), new StringLiteral($result["username"]));
            $user->setId($result["id"]);
            return $user;
        }
        return $result;
    }

    /**
     * @param \Project1\Domain\User $user
     * @return $this
     * @throws \PDOException
     */
    public function add(User $user)
    {
        $data = json_decode(json_encode($user));
        $this->execSqlNoReturn('INSERT INTO users (username, name, email) VALUES ("'.$data->username.'", "'.$data->name.'", "'.$data->email.'");');
        return $this;
    }

    /**
     * @param \Project1\Domain\StringLiteral $id
     * @return $this
     */
    public function delete(StringLiteral $id)
    {
        $this->execSqlNoReturn('DELETE FROM users WHERE id = '.$id.';');
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $all = $this->execSqlWithReturn('SELECT * FROM users', true);
        return json_encode($all);
    }

    /**
     * @param StringLiteral $fragment
     * @return array
     */
    public function findByEmail(StringLiteral $fragment)
    {
        $query = 'SELECT id, email, name, username FROM users WHERE email = "'.$fragment.'";';
        return $this->createUserOrArray($query, false);
    }

    /**
     * @param StringLiteral $id
     * @return \Project1\Domain\User
     */
    public function findById(StringLiteral $id)
    {
        $query = 'SELECT id, email, name, username FROM users WHERE id = '.(string) $id.';';
        echo "";
        return $this->createUserOrArray($query, true);
    }

    /**
     * @param StringLiteral $fragment
     * @return array
     */
    public function findByName(StringLiteral $fragment)
    {
        $query = 'SELECT id, email, name, username FROM users WHERE name = '.$fragment.';';
        return $this->createUserOrArray($query, false);
    }

    /**
     * @param StringLiteral $username
     * @return array
     */
    public function findByUsername(StringLiteral $username)
    {
        $query = 'SELECT id, email, name, username FROM users WHERE username = '.$username.';';
        return $this->createUserOrArray($query, false);
    }

    /**
     * @return bool
     */
    public function save()
    {
        return true;
    }

    /**
     * @param \Project1\Domain\User $user
     * @return $this
     */
    public function update(User $user)
    {
        $query = 'UPDATE users SET email="'.$user->getEmail().'",
        name="'.$user->getName().'", username="'.$user->getUsername().'" 
        WHERE id='.$user->getId().';';
        return $this->execSqlNoReturn($query);
    }
}