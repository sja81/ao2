<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/vision/v1/product_search_service.proto

namespace Google\Cloud\Vision\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request message for the `UpdateProductSet` method.
 *
 * Generated from protobuf message <code>google.cloud.vision.v1.UpdateProductSetRequest</code>
 */
class UpdateProductSetRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * The ProductSet resource which replaces the one on the server.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.ProductSet product_set = 1;</code>
     */
    private $product_set = null;
    /**
     * The [FieldMask][google.protobuf.FieldMask] that specifies which fields to
     * update.
     * If update_mask isn't specified, all mutable fields are to be updated.
     * Valid mask path is `display_name`.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2;</code>
     */
    private $update_mask = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\Vision\V1\ProductSet $product_set
     *           The ProductSet resource which replaces the one on the server.
     *     @type \Google\Protobuf\FieldMask $update_mask
     *           The [FieldMask][google.protobuf.FieldMask] that specifies which fields to
     *           update.
     *           If update_mask isn't specified, all mutable fields are to be updated.
     *           Valid mask path is `display_name`.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Vision\V1\ProductSearchService::initOnce();
        parent::__construct($data);
    }

    /**
     * The ProductSet resource which replaces the one on the server.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.ProductSet product_set = 1;</code>
     * @return \Google\Cloud\Vision\V1\ProductSet
     */
    public function getProductSet()
    {
        return $this->product_set;
    }

    /**
     * The ProductSet resource which replaces the one on the server.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.ProductSet product_set = 1;</code>
     * @param \Google\Cloud\Vision\V1\ProductSet $var
     * @return $this
     */
    public function setProductSet($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Vision\V1\ProductSet::class);
        $this->product_set = $var;

        return $this;
    }

    /**
     * The [FieldMask][google.protobuf.FieldMask] that specifies which fields to
     * update.
     * If update_mask isn't specified, all mutable fields are to be updated.
     * Valid mask path is `display_name`.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2;</code>
     * @return \Google\Protobuf\FieldMask
     */
    public function getUpdateMask()
    {
        return $this->update_mask;
    }

    /**
     * The [FieldMask][google.protobuf.FieldMask] that specifies which fields to
     * update.
     * If update_mask isn't specified, all mutable fields are to be updated.
     * Valid mask path is `display_name`.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2;</code>
     * @param \Google\Protobuf\FieldMask $var
     * @return $this
     */
    public function setUpdateMask($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\FieldMask::class);
        $this->update_mask = $var;

        return $this;
    }

}

