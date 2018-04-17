<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationTypeRepository")
 * @ORM\Table(name="location_types")
 * @UniqueEntity("name")
 */
class LocationType
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
     * @ORM\OneToMany(targetEntity="Location", mappedBy="locationType")
     */
    private $locations;

    /**
     * LocationType constructor.
     */
    public function __construct()
    {
        $this->locations = new ArrayCollection();
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
     * @return Collection|Location[]
     */
    public function getLocations()
    {
        return $this->locations;
    }

    public function addLocation(Location $location)
    {
        if ($this->locations->contains($location)) {
            return;
        }

        $this->locations[] = $location;
        // set the *owning* side!
        $location->setLocationType($this);
    }

    public function removeLocation(Location $location)
    {
        $this->locations->removeElement($location);
        // set the owning side to null
        $location->setLocationType(null);
    }
}
