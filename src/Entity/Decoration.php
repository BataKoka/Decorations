<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DecorationRepository")
 * @ORM\Entity
 * @ORM\Table(name="decorations")
 * @UniqueEntity("name")
 */
class Decoration
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
     * @Assert\Length(min="3")
     * @ORM\Column(type="string", unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", options={"default":true})
     */
    private $isActive = true;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Celebration", inversedBy="decorations")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $celebration;

    /**
     * @ORM\OneToMany(targetEntity="DecorationItem", mappedBy="decoration", orphanRemoval=true)
     */
    private $decorationItems;

    /**
     * Decoration constructor.
     */
    public function __construct()
    {
        $this->decorationItems = new ArrayCollection();
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

    /**
     * @return mixed
     */
    public function getCelebration(): ?Celebration
    {
        return $this->celebration;
    }

    /**
     * @param mixed $celebration
     */
    public function setCelebration(Celebration $celebration = null)
    {
        $this->celebration = $celebration;
    }

    public function __toString()
    {
        return (string) $this->getName();
    }

    /**
     * @return Collection|DecorationItem[]
     */
    public function getDecorationItems()
    {
        return $this->decorationItems;
    }

    public function addDecorationItem(DecorationItem $decorationItem)
    {
        if ($this->decorationItems->contains($decorationItem)) {
            return;
        }

        $this->decorationItems[] = $decorationItem;
        // set the *owning* side!
        $decorationItem->setDecoration($this);
    }

    public function removeDecorationItem(DecorationItem $decorationItem)
    {
        $this->decorationItems->removeElement($decorationItem);
        // set the owning side to null
        $decorationItem->setDecoration(null);
    }
}
