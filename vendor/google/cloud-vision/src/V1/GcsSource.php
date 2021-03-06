<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/vision/v1/image_annotator.proto

namespace Google\Cloud\Vision\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The Google Cloud Storage location where the input will be read from.
 *
 * Generated from protobuf message <code>google.cloud.vision.v1.GcsSource</code>
 */
class GcsSource extends \Google\Protobuf\Internal\Message
{
    /**
     * Google Cloud Storage URI for the input file. This must only be a
     * Google Cloud Storage object. Wildcards are not currently supported.
     *
     * Generated from protobuf field <code>string uri = 1;</code>
     */
    private $uri = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $uri
     *           Google Cloud Storage URI for the input file. This must only be a
     *           Google Cloud Storage object. Wildcards are not currently supported.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Vision\V1\ImageAnnotator::initOnce();
        parent::__construct($data);
    }

    /**
     * Google Cloud Storage URI for the input file. This must only be a
     * Google Cloud Storage object. Wildcards are not currently supported.
     *
     * Generated from protobuf field <code>string uri = 1;</code>
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Google Cloud Storage URI for the input file. This must only be a
     * Google Cloud Storage object. Wildcards are not currently supported.
     *
     * Generated from protobuf field <code>string uri = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setUri($var)
    {
        GPBUtil::checkString($var, True);
        $this->uri = $var;

        return $this;
    }

}

