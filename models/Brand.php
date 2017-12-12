<?php
namespace models;

use interfaces\Brand as BrandInterface;

class Brand implements BrandInterface
{
    /**
     * @var string   Brand name
     */
    private $name;

    /**
     * @var integer   Brand quality
     */
    private $quality;

    /**
     * {@inheritDoc}
     * @see \interfaces\Brand::setName()
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
     * @see \interfaces\Brand::setQuality()
     */
    public function setQuality($quality)
    {
        $quality = (int)$quality;
        if ($quality === 0) {
            return false;
        }

        $this->quality = $quality;

        return true;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Brand::getName()
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Brand::getQuality()
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Brand::__toString()
     */
    public function __toString()
    {
        return $this->name;
    }
}
