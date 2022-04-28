<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

use Gedmo\Blameable\Traits\BlameableEntity;


#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    use BlameableEntity;


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: Group::class, inversedBy: 'contacts')]
    #[ORM\JoinColumn(nullable: false)]
    private $belongsToGroup;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBelongsToGroup(): ?Group
    {
        return $this->belongsToGroup;
    }

    public function setBelongsToGroup(?Group $belongsToGroup): self
    {
        $this->belongsToGroup = $belongsToGroup;

        return $this;
    }
}
