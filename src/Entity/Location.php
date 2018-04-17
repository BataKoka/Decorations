<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 * @ORM\Table(name="locations")
 * @UniqueEntity("name")
 */
class Location
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
     * @Assert\Type("integer")
     * @Assert\Range(min="0", max="100")
     * @ORM\Column(type="integer", options={"unsigned":true, "default":0})
     */
    private $percentage = 0;

    /**
     * @ORM\Column(type="boolean", options={"default":true})
     */
    private $isActive = true;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="LocationType", inversedBy="locations")
     */
    private $locationType;

    /**
     * @ORM\OneToMany(targetEntity="Celebration", mappedBy="location")
     */
    private $celebrations;

    /**
     * Location constructor.
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
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * @param mixed $percentage
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;
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

    /**
     * @return mixed
     */
    public function getLocationType(): ?LocationType
    {
        return $this->locationType;
    }

    /**
     * @param mixed $locationType
     */
    public function setLocationType(LocationType $locationType = null)
    {
        $this->locationType = $locationType;
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
        $celebration->setLocation($this);
    }

    public function removeCelebration(Celebration $celebration)
    {
        $this->celebrations->removeElement($celebration);
        // set the owning side to null
        $celebration->setLocation(null);
    }
}
