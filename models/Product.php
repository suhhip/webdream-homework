<?php
namespace models;

use interfaces\Brand as BrandInterface;
use interfaces\Product as ProductInterface;

class Product implements ProductInterface
{
    /**
     * @var string   Product number
     */
    private $number;

    /**
     * @var \interfaces\Brand   Brand
     */
    private $brand;

    /**
     * @var string   Product name
     */
    private $name;

    /**
     * @var string   Product price
     */
    private $price;

    /**
     * @var array   Product metas
     */
    private $metas = [];

    /**
     * {@inheritDoc}
     * @see \interfaces\Product::setNumber()
     */
    public function setNumber($number)
    {
        $number = (string)$number;
        if (empty($number)) {
            return false;
        }

        $this->number = $number;

        return true;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Product::setBrand()
     */
    public function setBrand(BrandInterface $brand)
    {
        $this->brand = $brand;

        return true;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Product::setName()
     */
    public function setName($name)
    {
        $name = (string)$name;
        if (empty($name)) {
            return false;
        }

        $this->name = $name;

        return true;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Product::setPrice()
     */
    public function setPrice($price)
    {
        $price = (int)$price;
        if ($price === 0) {
            return false;
        }

        $this->price = $price;

        return true;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Product::addMeta()
     */
    public function addMeta($title, $value)
    {
        $title   = (string)$title;
        $value   = (string)$value;

        if (!$title || isset($this->metas[$title])) {
            return false;
        }

        $this->metas[$title] = $value;

        return true;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Product::getNumber()
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Product::getBrand()
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Product::getName()
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Product::getPrice()
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Product::getMetas()
     */
    public function getMetas()
    {
        return $this->metas;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Product::__toString()
     */
    public function __toString()
    {
        return $this->brand . ' ' . $this->name;
    }
}
