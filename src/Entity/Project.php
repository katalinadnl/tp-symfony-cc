<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    private ?Client $client = null;

    /**
     * @var Collection<int, Deliverable>
     */
    #[ORM\OneToMany(targetEntity: Deliverable::class, mappedBy: 'project')]
    private Collection $delivrables;

    /**
     * @var Collection<int, Task>
     */
    #[ORM\OneToMany(targetEntity: Task::class, mappedBy: 'project')]
    private Collection $tasks;

    /**
     * @var Collection<int, Testimonial>
     */
    #[ORM\OneToMany(targetEntity: Testimonial::class, mappedBy: 'project')]
    private Collection $testimonials;

    /**
     * @var Collection<int, UserProject>
     */
    #[ORM\OneToMany(targetEntity: UserProject::class, mappedBy: 'project_id')]
    private Collection $userProjects;

    /**
     * @var Collection<int, ProjectCategory>
     */
    #[ORM\OneToMany(targetEntity: ProjectCategory::class, mappedBy: 'project_id')]
    private Collection $projectCategories;


    public function __construct()
    {
        $this->delivrables = new ArrayCollection();
        $this->tasks = new ArrayCollection();
        $this->testimonials = new ArrayCollection();
        $this->userProjects = new ArrayCollection();
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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(?\DateTimeInterface $start_date): static
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): static
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Deliverable>
     */
    public function getDelivrables(): Collection
    {
        return $this->delivrables;
    }

    public function addDelivrable(Deliverable $delivrable): static
    {
        if (!$this->delivrables->contains($delivrable)) {
            $this->delivrables->add($delivrable);
            $delivrable->setProject($this);
        }

        return $this;
    }

    public function removeDelivrable(Deliverable $delivrable): static
    {
        if ($this->delivrables->removeElement($delivrable)) {
            // set the owning side to null (unless already changed)
            if ($delivrable->getProject() === $this) {
                $delivrable->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): static
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
            $task->setProject($this);
        }

        return $this;
    }

    public function removeTask(Task $task): static
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getProject() === $this) {
                $task->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Testimonial>
     */
    public function getTestimonials(): Collection
    {
        return $this->testimonials;
    }

    public function addTestimonial(Testimonial $testimonial): static
    {
        if (!$this->testimonials->contains($testimonial)) {
            $this->testimonials->add($testimonial);
            $testimonial->setProject($this);
        }

        return $this;
    }

    public function removeTestimonial(Testimonial $testimonial): static
    {
        if ($this->testimonials->removeElement($testimonial)) {
            // set the owning side to null (unless already changed)
            if ($testimonial->getProject() === $this) {
                $testimonial->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserProject>
     */
    public function getUserProjects(): Collection
    {
        return $this->userProjects;
    }

    public function addUserProject(UserProject $userProject): static
    {
        if (!$this->userProjects->contains($userProject)) {
            $this->userProjects->add($userProject);
            $userProject->setProjectId($this);
        }

        return $this;
    }

    public function removeUserProject(UserProject $userProject): static
    {
        if ($this->userProjects->removeElement($userProject)) {
            // set the owning side to null (unless already changed)
            if ($userProject->getProjectId() === $this) {
                $userProject->setProjectId(null);
            }
        }

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
            $projectCategory->setProjectId($this);
        }

        return $this;
    }

    public function removeProjectCategory(ProjectCategory $projectCategory): static
    {
        if ($this->projectCategories->removeElement($projectCategory)) {
            // set the owning side to null (unless already changed)
            if ($projectCategory->getProjectId() === $this) {
                $projectCategory->setProjectId(null);
            }
        }

        return $this;
    }
}
