<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
private UserPasswordHasherInterface $passwordHasher;

public function __construct(UserPasswordHasherInterface $passwordHasher)
{
$this->passwordHasher = $passwordHasher;
}

public function load(ObjectManager $manager): void
{
// Utilisateurs normaux
for ($i = 1; $i <= 5; $i++) {
$user = new User();
$user->setName('User' . $i);
$user->setSurname('Surname' . $i);
$user->setEmail('user' . $i . '@example.com');
$user->setRoles(['ROLE_USER']);
$user->setPassword($this->passwordHasher->hashPassword($user, 'password123'));
$manager->persist($user);
}

// Administrateurs
for ($i = 1; $i <= 2; $i++) {
$admin = new User();
$admin->setName('Admin' . $i);
$admin->setSurname('Surname' . $i);
$admin->setEmail('admin' . $i . '@example.com');
$admin->setRoles(['ROLE_ADMIN']);
$admin->setPassword($this->passwordHasher->hashPassword($admin, 'admin123'));
$manager->persist($admin);
}

// Utilisateurs bannis
for ($i = 1; $i <= 2; $i++) {
$bannedUser = new User();
$bannedUser->setName('BannedUser' . $i);
$bannedUser->setSurname('Surname' . $i);
$bannedUser->setEmail('banned' . $i . '@example.com');
$bannedUser->setRoles(['ROLE_BANNED']);
$bannedUser->setPassword($this->passwordHasher->hashPassword($bannedUser, 'banned123'));
$manager->persist($bannedUser);
}

$manager->flush();
}
}
