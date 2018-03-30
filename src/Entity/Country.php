<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 * @ORM\Entity
 * @ORM\Table(name="countries")
 * @UniqueEntity("name")
 */
class Country
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
     * @ORM\OneToMany(targetEntity="Supplier", mappedBy="country")
     */
    private $suppliers;

    /**
     * Country constructor.
     */
    public function __construct()
    {
        $this->suppliers = new ArrayCollection();
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
     * @return Collection|Supplier[]
     */
    public function getSuppliers()
    {
        return $this->suppliers;
    }

    public function addSupplier(Supplier $supplier)
    {
        if ($this->suppliers->contains($supplier)) {
            return;
        }

        $this->suppliers[] = $supplier;
        // set the *owning* side!
        $supplier->setCountry($this);
    }

    public function removeSupplier(Supplier $supplier)
    {
        $this->suppliers->removeElement($supplier);
        // set the owning side to null
        $supplier->setCountry(null);
    }
}
