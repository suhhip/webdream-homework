<?php
namespace interfaces;

interface Product
{
    /**
     * Set product number
     *
     * @param string $number   Product number
     *
     * @return boolean
     */
    public function setNumber($number);

    /**
     * Set product brand
     *
     * @param \interfaces\Brand $brand   Brand object
     *
     * @return boolean
     */
    public function setBrand(Brand $brand);

    /**
     * Set product name
     *
     * @param string $name   Product name
     *
     * @return boolean
     */
    public function setName($name);

    /**
     * Set product price
     *
     * @param string $price   Set product price
     *
     * @return boolean
     */
    public function setPrice($price);

    /**
     * Add meta
     *
     * @param string $title   Meta tile
     * @param string $value   Meta value
     *
     * @return boolean
     */
    public function addMeta($title, $value);

    /**
     * Get product number
     *
     * @return string
     */
    public function getNumber();

    /**
     * Get product brand
     *
     * @return Brand
     */
    public function getBrand();

    /**
     * Get product name
     *
     * @return string
     */
    public function getName();

    /**
     * Get product price
     *
     * @return integer
     */
    public function getPrice();

    /**
     * Get product metas
     *
     * @return array
     */
    public function getMetas();

    /**
     * String output of object
     *
     * @return string
     */
    public function __toString();
}
