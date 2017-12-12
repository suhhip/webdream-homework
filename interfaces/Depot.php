<?php
namespace interfaces;

interface Depot
{
    /**
     * Set name of depot
     *
     * @param string $name   Name of depot
     *
     * @return boolean
     */
    public function setName($name);

    /**
     * Set address of depot
     *
     * @param string $address   Address of depot
     *
     * @return boolean
     */
    public function setAddress($address);

    /**
     * Set capacity of depot
     *
     * @param integer $capacity   Capacity of depot
     *
     * @return boolean
     */
    public function setCapacity($capacity);

    /**
     * Get depot's name
     *
     * @return string
     */
    public function getName();

    /**
     * Get depot's address
     *
     * @return string
     */
    public function getAddress();

    /**
     * Get depot capacity
     *
     * @return integer
     */
    public function getCapacity();

    /**
     * Get depot available capacity
     *
     * @return integer
     */
    public function getAvailableCapacity();

    /**
     * Add product into the depot
     *
     * @param \interfaces\Product $product    Product object
     * @param integer             $quantity   Product quantity
     *
     * @return boolean
     */
    public function addProduct(Product $product, $quantity);

    /**
     * Remove product from the depot
     *
     * @param \interfaces\Product $product    Product object
     * @param integer             $quantity   Product quantity
     *
     * @return boolean
     */
    public function removeProduct(Product $product, $quantity);

    /**
     * Get product list
     *
     * @return array
     */
    public function getProductList();

    /**
     * String output of object
     *
     * @return string
     */
    public function __toString();
}
