<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, ProjectCategory>
     */
    #[ORM\OneToMany(targetEntity: ProjectCategory::class, mappedBy: 'category_id', cascade: ['remove'], orphanRemoval: true)]
    private Collection $projectCategories;

    public function __construct()
    {
        $this->projectCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, ProjectCategory>
     */
    public function getProjectCategories(): Collection
    {
        return $this->projectCategories;
    }

    public function addProjectCategory(ProjectCategory $projectCategory): static
    {
        if (!$this->projectCategories->contains($projectCategory)) {
            $this->projectCategories->add($projectCategory);
            $projectCategory->setCategoryId($this);
        }

        return $this;
    }

    public function removeProjectCategory(ProjectCategory $projectCategory): static
    {
        if ($this->projectCategories->removeElement($projectCategory)) {
            // set the owning side to null (unless already changed)
            if ($projectCategory->getCategoryId() === $this) {
                $projectCategory->setCategoryId(null);
            }
        }

        return $this;
    }
}
