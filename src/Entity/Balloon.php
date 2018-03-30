<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BalloonRepository")
 * @ORM\Entity
 * @ORM\Table(name="balloons")
 * @UniqueEntity("name")
 */
class Balloon
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
     * @Assert\Type("numeric")
     * @Assert\Range(min="0.1")
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
    private $price;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Color", inversedBy="balloons")
     */
    private $color;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="ColorType", inversedBy="balloons")
     */
    private $colorType;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Diameter", inversedBy="balloons")
     */
    private $diameter;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Material", inversedBy="balloons")
     */
    private $material;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="PrintType", inversedBy="balloons")
     */
    private $printType;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Shape", inversedBy="balloons")
     */
    private $shape;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Supplier", inversedBy="balloons")
     */
    private $supplier;

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
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getColor(): ?Color
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor(Color $color = null)
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getColorType(): ?ColorType
    {
        return $this->colorType;
    }

    /**
     * @param mixed $colorType
     */
    public function setColorType(ColorType $colorType = null)
    {
        $this->colorType = $colorType;
    }

    /**
     * @return mixed
     */
    public function getDiameter(): ?Diameter
    {
        return $this->diameter;
    }

    /**
     * @param mixed $diameter
     */
    public function setDiameter(Diameter $diameter = null)
    {
        $this->diameter = $diameter;
    }

    /**
     * @return mixed
     */
    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    /**
     * @param mixed $material
     */
    public function setMaterial(Material $material = null)
    {
        $this->material = $material;
    }

    /**
     * @return mixed
     */
    public function getPrintType(): ?PrintType
    {
        return $this->printType;
    }

    /**
     * @param mixed $printType
     */
    public function setPrintType(PrintType $printType = null)
    {
        $this->printType = $printType;
    }

    /**
     * @return mixed
     */
    public function getShape(): ?Shape
    {
        return $this->shape;
    }

    /**
     * @param mixed $shape
     */
    public function setShape(Shape $shape = null)
    {
        $this->shape = $shape;
    }

    /**
     * @return mixed
     */
    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    /**
     * @param mixed $supplier
     */
    public function setSupplier(Supplier $supplier = null)
    {
        $this->supplier = $supplier;
    }

    public function __toString()
    {
        return (string) $this->getName();
    }
}
