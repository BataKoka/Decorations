<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ColorTypeRepository")
 * @ORM\Table(name="color_types")
 * @UniqueEntity("name")
 */
class ColorType
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
     * @ORM\OneToMany(targetEntity="Balloon", mappedBy="colorType")
     */
    private $balloons;

    /**
     * Color constructor.
     */
    public function __construct()
    {
        $this->balloons = new ArrayCollection();
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
     * @return Collection|Balloon[]
     */
    public function getBalloons()
    {
        return $this->balloons;
    }

    public function addBalloon(Balloon $balloon)
    {
        if ($this->balloons->contains($balloon)) {
            return;
        }

        $this->balloons[] = $balloon;
        // set the *owning* side!
        $balloon->setColorType($this);
    }

    public function removeBalloon(Balloon $balloon)
    {
        $this->balloons->removeElement($balloon);
        // set the owning side to null
        $balloon->setColorType(null);
    }
}
