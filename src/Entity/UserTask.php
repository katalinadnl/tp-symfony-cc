<?php

namespace App\Entity;

use App\Repository\UserTaskRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserTaskRepository::class)]
class UserTask
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userTasks')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private ?User $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'userTasks')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private ?Task $task_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getTaskId(): ?Task
    {
        return $this->task_id;
    }

    public function setTaskId(?Task $task_id): static
    {
        $this->task_id = $task_id;

        return $this;
    }
}
