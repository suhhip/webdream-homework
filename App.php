<?php

use interfaces\Depot as DepotInterface;
use interfaces\Product as ProductInterface;

class App
{
    /**
     * @var array   Depot list
     */
    private $depots = [];

    /**
     * @param \interfaces\Depot $depot   Depot object
     */
    public function addDepot(DepotInterface $depot)
    {
        $this->depots[] = $depot;
    }

    /**
     * Add product to depot
     *
     * @param \interfaces\Product $product    Product object
     * @param integer             $quantity   Quantity of product
     *
     * @throws AppException
     */
    public function addToDepot(ProductInterface $product, $quantity)
    {
        if ($this->getTotalAvailableCapacity() < $quantity) {
            throw new AppException('There is not enough capacity.', '1001');
        }

        $calculatedQuantity = $quantity;
        foreach ($this->depots as $depot) {
            $capacityInDepot = $depot->getAvailableCapacity();
            if ($capacityInDepot < $calculatedQuantity) {
                $quantity = $capacityInDepot;
            }

            $calculatedQuantity -= $quantity;

            if (!$depot->addProduct($product, $quantity)) {
                throw new AppException('There is not enough capacity.', '1002');
            }

            if ($calculatedQuantity === 0) {
                break;
            }
        }
    }

    /**
     * Remove product from depot
     *
     * @param \interfaces\Product $product    Product object
     * @param integer             $quantity   Quantity of product
     *
     * @throws AppException
     */
    public function removeFromDepot(ProductInterface $product, $quantity)
    {
        if ($this->getProductCount($product) < $quantity) {
            throw new AppException('There is not enough product.', '2001');
        }

        $calculatedQuantity = $quantity;
        foreach ($this->depots as $depot) {
            $countInDepot = self::getProductCountInDepot($depot, $product);
            if ($countInDepot < $calculatedQuantity) {
                $quantity = $countInDepot;
            }

            $calculatedQuantity -= $quantity;

            if (!$depot->removeProduct($product, $quantity)) {
                throw new AppException('There is not enough product.', '2002');
            }
        }
    }

    /**
     * Get total available capacity - in all depots
     *
     * @return integer
     */
    private function getTotalAvailableCapacity()
    {
        $availableCapacity = 0;
        foreach ($this->depots as $depot) {
            $availableCapacity += $depot->getAvailableCapacity();
        }

        return $availableCapacity;
    }

    /**
     * Get count of available product
     *
     * @param \interfaces\Product $product
     *
     * @return integer
     */
    private function getProductCount(ProductInterface $product)
    {
        $count = 0;
        foreach ($this->depots as $depot) {
            $count += self::getProductCountInDepot($depot, $product);
        }

        return $count;
    }

    /**
     * Get count of available product in depot
     *
     * @param \interfaces\Depot   $depot     Depot object
     * @param \interfaces\Product $product   Product object
     *
     * @return integer
     */
    private static function getProductCountInDepot(DepotInterface $depot, ProductInterface $product)
    {
        $count = 0;

        $list = $depot->getProductList();
        foreach ($list as $row) {
            if ($row['product'] == $product) {
                $count += $row['quantity'];

                break;
            }
        }

        return $count;
    }
}
