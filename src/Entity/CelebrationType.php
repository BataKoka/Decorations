<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CelebrationTypeRepository")
 * @ORM\Table(name="celebration_types")
 * @UniqueEntity("name")
 */
class CelebrationType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    // add your own fields

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="2")
     * @ORM\Column(type="string", unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", options={"default":true})
     */
    private $isActive = true;

    /**
     * @ORM\OneToMany(targetEntity="Celebration", mappedBy="celebrationType")
     */
    private $celebrations;

    /**
     * CelebrationType constructor.
     */
    public function __construct()
    {
        $this->celebrations = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    public function __toString()
    {
        return (string) $this->getName();
    }

    /**
     * @return Collection|Celebration[]
     */
    public function getCelebrations()
    {
        return $this->celebrations;
    }

    public function addCelebration(Celebration $celebration)
    {
        if ($this->celebrations->contains($celebration)) {
            return;
        }

        $this->celebrations[] = $celebration;
        // set the *owning* side!
        $celebration->setCelebrationType($this);
    }

    public function removeCelebration(Celebration $celebration)
    {
        $this->celebrations->removeElement($celebration);
        // set the owning side to null
        $celebration->setCelebrationType(null);
    }
}
