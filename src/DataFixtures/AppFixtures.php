<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Client;
use App\Entity\Category;
use App\Entity\Project;
use App\Entity\Task;
use App\Entity\Deliverable;
use App\Entity\Testimonial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // --- Création des Utilisateurs ---
        $usersData = [
            ['ROLE_ADMIN', 'admin@example.com'],
            ['ROLE_USER', 'user@example.com'],
            ['ROLE_BANNED', 'banned@example.com'],
        ];

        foreach ($usersData as [$role, $email]) {
            $user = new User();
            $user->setName($faker->firstName());
            $user->setSurname($faker->lastName());
            $user->setEmail($email);
            $user->setRoles([$role]);

            // Hashage du mot de passe "catalina"
            $hashedPassword = $this->passwordHasher->hashPassword($user, 'catalina');
            $user->setPassword($hashedPassword);

            $manager->persist($user);
        }

        // --- Création des Clients ---
        for ($i = 0; $i < 5; $i++) {
            $client = new Client();
            $client->setName($faker->name());
            $client->setEmail($faker->email());
            $client->setPhone($faker->phoneNumber());
            $client->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeThisYear()));

            $manager->persist($client);
        }

        // --- Création des Catégories ---
        for ($i = 0; $i < 3; $i++) {
            $category = new Category();
            $category->setName($faker->word());
            $category->setDescription($faker->sentence());

            $manager->persist($category);
        }

        $manager->flush();
    }
}
