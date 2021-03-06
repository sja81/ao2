<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/vision/v1/product_search_service.proto

namespace Google\Cloud\Vision\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request message for the `CreateProduct` method.
 *
 * Generated from protobuf message <code>google.cloud.vision.v1.CreateProductRequest</code>
 */
class CreateProductRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * The project in which the Product should be created.
     * Format is
     * `projects/PROJECT_ID/locations/LOC_ID`.
     *
     * Generated from protobuf field <code>string parent = 1;</code>
     */
    private $parent = '';
    /**
     * The product to create.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.Product product = 2;</code>
     */
    private $product = null;
    /**
     * A user-supplied resource id for this Product. If set, the server will
     * attempt to use this value as the resource id. If it is already in use, an
     * error is returned with code ALREADY_EXISTS. Must be at most 128 characters
     * long. It cannot contain the character `/`.
     *
     * Generated from protobuf field <code>string product_id = 3;</code>
     */
    private $product_id = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $parent
     *           The project in which the Product should be created.
     *           Format is
     *           `projects/PROJECT_ID/locations/LOC_ID`.
     *     @type \Google\Cloud\Vision\V1\Product $product
     *           The product to create.
     *     @type string $product_id
     *           A user-supplied resource id for this Product. If set, the server will
     *           attempt to use this value as the resource id. If it is already in use, an
     *           error is returned with code ALREADY_EXISTS. Must be at most 128 characters
     *           long. It cannot contain the character `/`.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Vision\V1\ProductSearchService::initOnce();
        parent::__construct($data);
    }

    /**
     * The project in which the Product should be created.
     * Format is
     * `projects/PROJECT_ID/locations/LOC_ID`.
     *
     * Generated from protobuf field <code>string parent = 1;</code>
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * The project in which the Product should be created.
     * Format is
     * `projects/PROJECT_ID/locations/LOC_ID`.
     *
     * Generated from protobuf field <code>string parent = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setParent($var)
    {
        GPBUtil::checkString($var, True);
        $this->parent = $var;

        return $this;
    }

    /**
     * The product to create.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.Product product = 2;</code>
     * @return \Google\Cloud\Vision\V1\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * The product to create.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.Product product = 2;</code>
     * @param \Google\Cloud\Vision\V1\Product $var
     * @return $this
     */
    public function setProduct($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Vision\V1\Product::class);
        $this->product = $var;

        return $this;
    }

    /**
     * A user-supplied resource id for this Product. If set, the server will
     * attempt to use this value as the resource id. If it is already in use, an
     * error is returned with code ALREADY_EXISTS. Must be at most 128 characters
     * long. It cannot contain the character `/`.
     *
     * Generated from protobuf field <code>string product_id = 3;</code>
     * @return string
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * A user-supplied resource id for this Product. If set, the server will
     * attempt to use this value as the resource id. If it is already in use, an
     * error is returned with code ALREADY_EXISTS. Must be at most 128 characters
     * long. It cannot contain the character `/`.
     *
     * Generated from protobuf field <code>string product_id = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setProductId($var)
    {
        GPBUtil::checkString($var, True);
        $this->product_id = $var;

        return $this;
    }

}

