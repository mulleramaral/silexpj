<?php

namespace muller\Entity;

use Symfony\Component\Security\Core\User\UserProviderInterface,
    Symfony\Component\Security\Core\Exception\UsernameNotFoundException,
    Symfony\Component\Security\Core\User\UserInterface,
    Symfony\Component\Security\Core\Exception\UnsupportedUserException,
    Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface,
    Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserProviderInterface{
    
    private $passwordEncoder;
    
    
    public function createAdminUser($username,$password){
        $user = new User;
        $user->username = $username;
        $user->plainPassword = $password;
        $user->roles = 'ROLE_ADMIN';
        
        $this->insert($user);
    }
    
    public function insert(User $user)
    {
        $this->encodePassword($user);
        $em = $this->getEntityManager();
        $em->persist($user);
        $em->flush();
        return $user;
    }
    
    public function setPasswordEncoder(PasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    public function encodePassword(User $user)
    {
        if($user->plainPassword)
            $user->password = $this->passwordEncoder->encodePassword ($user->password,$user->getSalt());
    }
    
    public function loadUserByUsername($username) {
        $user = $this->findOneByUsername($username);
        if(!$user)
            throw new UsernameNotFoundException(sprintf('Usuario "%s" não existe.',$username));
        
        return $this->arrayToObject($user->toArray());
    }

    public function refreshUser(UserInterface $user) {
        if(!user instanceOf User)
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not suported',  get_class ($user)));
    }

    public function supportsClass($class) {
        return $class === 'muller\Entity\User';
    }
    
    public function arrayToObject($userArr,$user = null)
    {
        if(!$user){
            $user = new User();
            $user->id = isset($userArr['id']) ? $userArr['id'] : null;
        }
        
        $username = isset($userArr['username']) ? $userArr['username'] : null;
        $password = isset($userArr['password']) ? $userArr['password'] : null;
        $roles = isset($userArr['roles']) ? explode(',',$userArr['roles']) : array();
        #$createdAt = isset($userArr['created_at']) ? \DateTime::createFromFormat(self::DATE_FORMAT,$userArr['created_at']);
        
        if($username){
            $user->username = $username;
        }
        
        if($password){
            $user->password = $password;
        }
        
        if($roles){
            $user->roles = $roles;
        }
        
        return $user;
    }
    
    public function objectToArray(User $user)
    {
        return array(
            'id' => $user->id,
            'username' => $user->username,
            'password' => $user->password,
            'roles' => implode(',',$user->roles),
            'created_at' => $user->createdAt->format(self::DATE_FORMAT)
        );
    }
}
