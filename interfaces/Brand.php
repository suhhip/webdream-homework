<?php
namespace interfaces;

interface Brand
{
    /**
     * Set name of brand
     *
     * @param string $name   Name of brand
     *
     * @return boolean
     */
    public function setName($name);

    /**
     * Set quality class of brand
     *
     * @param integer $class   Quality class
     *
     * @return boolean
     */
    public function setQuality($class);

    /**
     * Get name of brand
     *
     * @return string
     */
    public function getName();

    /**
     * Get quality class of brand
     *
     * @return integer
     */
    public function getQuality();

    /**
     * String output of object
     *
     * @return string
     */
    public function __toString();
}
