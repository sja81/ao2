<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/vision/v1/image_annotator.proto

namespace Google\Cloud\Vision\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Image context and/or feature-specific parameters.
 *
 * Generated from protobuf message <code>google.cloud.vision.v1.ImageContext</code>
 */
class ImageContext extends \Google\Protobuf\Internal\Message
{
    /**
     * Not used.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.LatLongRect lat_long_rect = 1;</code>
     */
    private $lat_long_rect = null;
    /**
     * List of languages to use for TEXT_DETECTION. In most cases, an empty value
     * yields the best results since it enables automatic language detection. For
     * languages based on the Latin alphabet, setting `language_hints` is not
     * needed. In rare cases, when the language of the text in the image is known,
     * setting a hint will help get better results (although it will be a
     * significant hindrance if the hint is wrong). Text detection returns an
     * error if one or more of the specified languages is not one of the
     * [supported languages](/vision/docs/languages).
     *
     * Generated from protobuf field <code>repeated string language_hints = 2;</code>
     */
    private $language_hints;
    /**
     * Parameters for crop hints annotation request.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.CropHintsParams crop_hints_params = 4;</code>
     */
    private $crop_hints_params = null;
    /**
     * Parameters for product search.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.ProductSearchParams product_search_params = 5;</code>
     */
    private $product_search_params = null;
    /**
     * Parameters for web detection.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.WebDetectionParams web_detection_params = 6;</code>
     */
    private $web_detection_params = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\Vision\V1\LatLongRect $lat_long_rect
     *           Not used.
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $language_hints
     *           List of languages to use for TEXT_DETECTION. In most cases, an empty value
     *           yields the best results since it enables automatic language detection. For
     *           languages based on the Latin alphabet, setting `language_hints` is not
     *           needed. In rare cases, when the language of the text in the image is known,
     *           setting a hint will help get better results (although it will be a
     *           significant hindrance if the hint is wrong). Text detection returns an
     *           error if one or more of the specified languages is not one of the
     *           [supported languages](/vision/docs/languages).
     *     @type \Google\Cloud\Vision\V1\CropHintsParams $crop_hints_params
     *           Parameters for crop hints annotation request.
     *     @type \Google\Cloud\Vision\V1\ProductSearchParams $product_search_params
     *           Parameters for product search.
     *     @type \Google\Cloud\Vision\V1\WebDetectionParams $web_detection_params
     *           Parameters for web detection.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Vision\V1\ImageAnnotator::initOnce();
        parent::__construct($data);
    }

    /**
     * Not used.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.LatLongRect lat_long_rect = 1;</code>
     * @return \Google\Cloud\Vision\V1\LatLongRect
     */
    public function getLatLongRect()
    {
        return $this->lat_long_rect;
    }

    /**
     * Not used.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.LatLongRect lat_long_rect = 1;</code>
     * @param \Google\Cloud\Vision\V1\LatLongRect $var
     * @return $this
     */
    public function setLatLongRect($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Vision\V1\LatLongRect::class);
        $this->lat_long_rect = $var;

        return $this;
    }

    /**
     * List of languages to use for TEXT_DETECTION. In most cases, an empty value
     * yields the best results since it enables automatic language detection. For
     * languages based on the Latin alphabet, setting `language_hints` is not
     * needed. In rare cases, when the language of the text in the image is known,
     * setting a hint will help get better results (although it will be a
     * significant hindrance if the hint is wrong). Text detection returns an
     * error if one or more of the specified languages is not one of the
     * [supported languages](/vision/docs/languages).
     *
     * Generated from protobuf field <code>repeated string language_hints = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getLanguageHints()
    {
        return $this->language_hints;
    }

    /**
     * List of languages to use for TEXT_DETECTION. In most cases, an empty value
     * yields the best results since it enables automatic language detection. For
     * languages based on the Latin alphabet, setting `language_hints` is not
     * needed. In rare cases, when the language of the text in the image is known,
     * setting a hint will help get better results (although it will be a
     * significant hindrance if the hint is wrong). Text detection returns an
     * error if one or more of the specified languages is not one of the
     * [supported languages](/vision/docs/languages).
     *
     * Generated from protobuf field <code>repeated string language_hints = 2;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setLanguageHints($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->language_hints = $arr;

        return $this;
    }

    /**
     * Parameters for crop hints annotation request.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.CropHintsParams crop_hints_params = 4;</code>
     * @return \Google\Cloud\Vision\V1\CropHintsParams
     */
    public function getCropHintsParams()
    {
        return $this->crop_hints_params;
    }

    /**
     * Parameters for crop hints annotation request.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.CropHintsParams crop_hints_params = 4;</code>
     * @param \Google\Cloud\Vision\V1\CropHintsParams $var
     * @return $this
     */
    public function setCropHintsParams($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Vision\V1\CropHintsParams::class);
        $this->crop_hints_params = $var;

        return $this;
    }

    /**
     * Parameters for product search.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.ProductSearchParams product_search_params = 5;</code>
     * @return \Google\Cloud\Vision\V1\ProductSearchParams
     */
    public function getProductSearchParams()
    {
        return $this->product_search_params;
    }

    /**
     * Parameters for product search.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.ProductSearchParams product_search_params = 5;</code>
     * @param \Google\Cloud\Vision\V1\ProductSearchParams $var
     * @return $this
     */
    public function setProductSearchParams($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Vision\V1\ProductSearchParams::class);
        $this->product_search_params = $var;

        return $this;
    }

    /**
     * Parameters for web detection.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.WebDetectionParams web_detection_params = 6;</code>
     * @return \Google\Cloud\Vision\V1\WebDetectionParams
     */
    public function getWebDetectionParams()
    {
        return $this->web_detection_params;
    }

    /**
     * Parameters for web detection.
     *
     * Generated from protobuf field <code>.google.cloud.vision.v1.WebDetectionParams web_detection_params = 6;</code>
     * @param \Google\Cloud\Vision\V1\WebDetectionParams $var
     * @return $this
     */
    public function setWebDetectionParams($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Vision\V1\WebDetectionParams::class);
        $this->web_detection_params = $var;

        return $this;
    }

}

