<?php

use models\Brand;
use models\Depot;
use models\Product;

class Methods
{
    /**
     * Build brands array
     *
     * @param array $data   Brand details array
     *
     * @return array
     */
    public static function buildBrands(array $data)
    {
        $brands = [];

        foreach ($data as $details) {
            $brand = new Brand();
            $brand->setName($details['name']);
            $brand->setQuality($details['quality']);

            $brands[] = $brand;
        }

        return $brands;
    }

    /**
     * Build products array
     *
     * @param array $data     Product details array
     * @param array $brands   Built brands array
     *
     * @return array
     * @throws \AppException
     */
    public static function buildProducts(array $data, array $brands)
    {
        $products = [];

        foreach ($data as $details) {
            $brand = null;
            foreach ($brands as $b) {
                if ($b == $details['brand']) {
                    $brand = $b;
                    break;
                }
            }

            if (!$brand) {
                throw new AppException('Not available brand', '0001');
            }

            $product = new Product();
            $product->setNumber($details['number']);
            $product->setBrand($brand);
            $product->setName($details['name']);
            $product->setPrice($details['price']);

            foreach ($details['metas'] as $metaTitle => $metaValue) {
                $product->addMeta($metaTitle, $metaValue);
            }

            $products[] = $product;
        }

        return $products;
    }

    /**
     * Build depots array
     *
     * @param array $data       Depot details array
     * @param array $products   Built products array
     *
     * @return array
     * @throws \AppException

     */
    public static function buildDepots(array $data, array $products)
    {
        $depots = [];

        foreach ($data as $details) {
            $depot = new Depot();
            $depot->setName($details['name']);
            $depot->setAddress($details['address']);
            $depot->setCapacity($details['capacity']);

            foreach ($details['products'] as $pDetails) {
                $product = null;
                foreach ($products as $p) {
                    if ($p == $pDetails['name']) {
                        $product = $p;
                        break;
                    }
                }

                if (!$product) {
                    throw new AppException('Not available product', '0001');
                }

                if (!$depot->addProduct($product, $pDetails['quantity'])) {
                    throw new AppException('There is not enough capacity.', '1002');
                }
            }

            $depots[] = $depot;
        }

        return $depots;
    }
}
