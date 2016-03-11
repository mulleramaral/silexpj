<?php

namespace muller\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="muller\Entity\UserRepository")
 */
class User implements UserInterface {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $username;

    /**
     * @ORM\Column(type="string")
     */
    public $password;

    /**
     * @ORM\Column(type="string")
     */
    public $plainPassword;

    /**
     * @ORM\Column(type="string")
     */
    public $roles = array('ROLE_USER');

    /**
     * @ORM\Column(type="datetime")
     */
    public $createdAt;

    public function __construct() {
        $this->createdAt = new \DateTime();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPlainPassword() {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function setRoles($roles) {
        $this->roles = $roles;
    }

    public function getSalt() {
        return null;
    }

    public function eraseCredentials() {
        $this->plainPassword = null;
    }

    public function __toString() {
        return $this->getUsername();
    }

    public function toArray() {
        return array(
            'id' => $this->id,
            'username' => $this->username,
            'salt' => $this->getSalt(),
            'roles' => $this->getRoles(),
            'password' => $this->getPassword()
        );
    }

}
