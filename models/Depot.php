<?php
namespace models;

use interfaces\Depot as DepotInterface;
use interfaces\Product as ProductInterface;

class Depot implements DepotInterface
{
    /**
     * @var string   Depot name
     */
    private $name;

    /**
     * @var string   Depot address
     */
    private $address;

    /**
     * @var integer   Total capacity
     */
    private $capacity;

    /**
     * @var integer Available capacity
     */
    private $availableCapacity;

    /**
     * @var array   Product list
     */
    private $productList = [];

    /**
     * {@inheritDoc}
     * @see \interfaces\Depot::setName()
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
     * @see \interfaces\Depot::setAddress()
     */
    public function setAddress($address)
    {
        $address = (string)$address;
        if (empty($address)) {
            return false;
        }

        $this->address = $address;

        return true;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Depot::setCapacity()
     */
    public function setCapacity($capacity)
    {
        $capacity = (int)$capacity;
        if ($capacity === 0) {
            return false;
        }

        $this->capacity            = $capacity;
        $this->availableCapacity   = $capacity;

        return true;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Depot::getName()
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Depot::getAddress()
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Depot::getCapacity()
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Depot::getAvailableCapacity()
     */
    public function getAvailableCapacity()
    {
        return $this->availableCapacity;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Depot::addProduct()
     */
    public function addProduct(ProductInterface $product, $quantity = 1)
    {
        if ($this->availableCapacity < $quantity) {
            return false;
        }

        $hasInDepot = false;
        foreach ($this->productList as $key => &$row) {
            if ($row['product'] != $product) {
                continue;
            }

            $hasInDepot = true;

            $row['quantity'] += $quantity;

            break;
        }

        if (!$hasInDepot) {
            $this->productList[] = [
                'product'    => $product,
                'quantity'   => $quantity,
            ];
        }

        $this->availableCapacity -= $quantity;

        return true;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Depot::removeProduct()
     */
    public function removeProduct(ProductInterface $product, $quantity = 1)
    {
        $hasInDepot = false;

        foreach ($this->productList as $key => &$row) {
            if ($row['product'] != $product) {
                continue;
            }

            $hasInDepot = true;

            if ($row['quantity'] < $quantity) {
                return false;
            }

            $row['quantity'] -= $quantity;

            if ($row['quantity'] === 0) {
                $this->productList[$key] = null;
                unset($this->productList[$key]);
            }

            break;
        }

        if (!$hasInDepot) {
            return false;
        }

        $this->availableCapacity += $quantity;

        return true;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Depot::getProductList()
     */
    public function getProductList()
    {
        return $this->productList;
    }

    /**
     * {@inheritDoc}
     * @see \interfaces\Depot::__toString()
     */
    public function __toString()
    {
        return $this->name;
    }
}
