<?php
/*
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/*
 * GENERATED CODE WARNING
 * This file was generated from the file
 * https://github.com/google/googleapis/blob/master/google/cloud/vision/v1/product_search_service.proto
 * and updates to that file get reflected here through a refresh process.
 *
 * @experimental
 */

namespace Google\Cloud\Vision\V1\Gapic;

use Google\ApiCore\ApiException;
use Google\ApiCore\CredentialsWrapper;
use Google\ApiCore\GapicClientTrait;
use Google\ApiCore\LongRunning\OperationsClient;
use Google\ApiCore\OperationResponse;
use Google\ApiCore\PathTemplate;
use Google\ApiCore\RequestParamsHeaderDescriptor;
use Google\ApiCore\RetrySettings;
use Google\ApiCore\Transport\TransportInterface;
use Google\ApiCore\ValidationException;
use Google\Auth\FetchAuthTokenInterface;
use Google\Cloud\Vision\V1\AddProductToProductSetRequest;
use Google\Cloud\Vision\V1\BatchOperationMetadata;
use Google\Cloud\Vision\V1\CreateProductRequest;
use Google\Cloud\Vision\V1\CreateProductSetRequest;
use Google\Cloud\Vision\V1\CreateReferenceImageRequest;
use Google\Cloud\Vision\V1\DeleteProductRequest;
use Google\Cloud\Vision\V1\DeleteProductSetRequest;
use Google\Cloud\Vision\V1\DeleteReferenceImageRequest;
use Google\Cloud\Vision\V1\GetProductRequest;
use Google\Cloud\Vision\V1\GetProductSetRequest;
use Google\Cloud\Vision\V1\GetReferenceImageRequest;
use Google\Cloud\Vision\V1\ImportProductSetsInputConfig;
use Google\Cloud\Vision\V1\ImportProductSetsRequest;
use Google\Cloud\Vision\V1\ImportProductSetsResponse;
use Google\Cloud\Vision\V1\ListProductSetsRequest;
use Google\Cloud\Vision\V1\ListProductSetsResponse;
use Google\Cloud\Vision\V1\ListProductsInProductSetRequest;
use Google\Cloud\Vision\V1\ListProductsInProductSetResponse;
use Google\Cloud\Vision\V1\ListProductsRequest;
use Google\Cloud\Vision\V1\ListProductsResponse;
use Google\Cloud\Vision\V1\ListReferenceImagesRequest;
use Google\Cloud\Vision\V1\ListReferenceImagesResponse;
use Google\Cloud\Vision\V1\Product;
use Google\Cloud\Vision\V1\ProductSet;
use Google\Cloud\Vision\V1\ProductSetPurgeConfig;
use Google\Cloud\Vision\V1\PurgeProductsRequest;
use Google\Cloud\Vision\V1\ReferenceImage;
use Google\Cloud\Vision\V1\RemoveProductFromProductSetRequest;
use Google\Cloud\Vision\V1\UpdateProductRequest;
use Google\Cloud\Vision\V1\UpdateProductSetRequest;
use Google\LongRunning\Operation;
use Google\Protobuf\FieldMask;
use Google\Protobuf\GPBEmpty;

/**
 * Service Description: Manages Products and ProductSets of reference images for use in product
 * search. It uses the following resource model:.
 *
 * - The API has a collection of [ProductSet][google.cloud.vision.v1.ProductSet]
 * resources, named `projects/&#42;/locations/&#42;/productSets/*`, which acts as a way
 * to put different products into groups to limit identification.
 *
 * In parallel,
 *
 * - The API has a collection of [Product][google.cloud.vision.v1.Product]
 * resources, named
 *   `projects/&#42;/locations/&#42;/products/*`
 *
 * - Each [Product][google.cloud.vision.v1.Product] has a collection of
 * [ReferenceImage][google.cloud.vision.v1.ReferenceImage] resources, named
 *   `projects/&#42;/locations/&#42;/products/&#42;/referenceImages/*`
 *
 * This class provides the ability to make remote calls to the backing service through method
 * calls that map to API methods. Sample code to get started:
 *
 * ```
 * $productSearchClient = new ProductSearchClient();
 * try {
 *     $formattedParent = $productSearchClient->locationName('[PROJECT]', '[LOCATION]');
 *     $productSet = new ProductSet();
 *     $response = $productSearchClient->createProductSet($formattedParent, $productSet);
 * } finally {
 *     $productSearchClient->close();
 * }
 * ```
 *
 * Many parameters require resource names to be formatted in a particular way. To assist
 * with these names, this class includes a format method for each type of name, and additionally
 * a parseName method to extract the individual identifiers contained within formatted names
 * that are returned by the API.
 *
 * @experimental
 */
class ProductSearchGapicClient
{
    use GapicClientTrait;

    /**
     * The name of the service.
     */
    const SERVICE_NAME = 'google.cloud.vision.v1.ProductSearch';

    /**
     * The default address of the service.
     */
    const SERVICE_ADDRESS = 'vision.googleapis.com';

    /**
     * The default port of the service.
     */
    const DEFAULT_SERVICE_PORT = 443;

    /**
     * The name of the code generator, to be included in the agent header.
     */
    const CODEGEN_NAME = 'gapic';

    /**
     * The default scopes required by the service.
     */
    public static $serviceScopes = [
        'https://www.googleapis.com/auth/cloud-platform',
        'https://www.googleapis.com/auth/cloud-vision',
    ];
    private static $locationNameTemplate;
    private static $productNameTemplate;
    private static $productSetNameTemplate;
    private static $referenceImageNameTemplate;
    private static $pathTemplateMap;

    private $operationsClient;

    private static function getClientDefaults()
    {
        return [
            'serviceName' => self::SERVICE_NAME,
            'apiEndpoint' => self::SERVICE_ADDRESS.':'.self::DEFAULT_SERVICE_PORT,
            'clientConfig' => __DIR__.'/../resources/product_search_client_config.json',
            'descriptorsConfigPath' => __DIR__.'/../resources/product_search_descriptor_config.php',
            'gcpApiConfigPath' => __DIR__.'/../resources/product_search_grpc_config.json',
            'credentialsConfig' => [
                'scopes' => self::$serviceScopes,
            ],
            'transportConfig' => [
                'rest' => [
                    'restClientConfigPath' => __DIR__.'/../resources/product_search_rest_client_config.php',
                ],
            ],
        ];
    }

    private static function getLocationNameTemplate()
    {
        if (null == self::$locationNameTemplate) {
            self::$locationNameTemplate = new PathTemplate('projects/{project}/locations/{location}');
        }

        return self::$locationNameTemplate;
    }

    private static function getProductNameTemplate()
    {
        if (null == self::$productNameTemplate) {
            self::$productNameTemplate = new PathTemplate('projects/{project}/locations/{location}/products/{product}');
        }

        return self::$productNameTemplate;
    }

    private static function getProductSetNameTemplate()
    {
        if (null == self::$productSetNameTemplate) {
            self::$productSetNameTemplate = new PathTemplate('projects/{project}/locations/{location}/productSets/{product_set}');
        }

        return self::$productSetNameTemplate;
    }

    private static function getReferenceImageNameTemplate()
    {
        if (null == self::$referenceImageNameTemplate) {
            self::$referenceImageNameTemplate = new PathTemplate('projects/{project}/locations/{location}/products/{product}/referenceImages/{reference_image}');
        }

        return self::$referenceImageNameTemplate;
    }

    private static function getPathTemplateMap()
    {
        if (null == self::$pathTemplateMap) {
            self::$pathTemplateMap = [
                'location' => self::getLocationNameTemplate(),
                'product' => self::getProductNameTemplate(),
                'productSet' => self::getProductSetNameTemplate(),
                'referenceImage' => self::getReferenceImageNameTemplate(),
            ];
        }

        return self::$pathTemplateMap;
    }

    /**
     * Formats a string containing the fully-qualified path to represent
     * a location resource.
     *
     * @param string $project
     * @param string $location
     *
     * @return string The formatted location resource.
     * @experimental
     */
    public static function locationName($project, $location)
    {
        return self::getLocationNameTemplate()->render([
            'project' => $project,
            'location' => $location,
        ]);
    }

    /**
     * Formats a string containing the fully-qualified path to represent
     * a product resource.
     *
     * @param string $project
     * @param string $location
     * @param string $product
     *
     * @return string The formatted product resource.
     * @experimental
     */
    public static function productName($project, $location, $product)
    {
        return self::getProductNameTemplate()->render([
            'project' => $project,
            'location' => $location,
            'product' => $product,
        ]);
    }

    /**
     * Formats a string containing the fully-qualified path to represent
     * a product_set resource.
     *
     * @param string $project
     * @param string $location
     * @param string $productSet
     *
     * @return string The formatted product_set resource.
     * @experimental
     */
    public static function productSetName($project, $location, $productSet)
    {
        return self::getProductSetNameTemplate()->render([
            'project' => $project,
            'location' => $location,
            'product_set' => $productSet,
        ]);
    }

    /**
     * Formats a string containing the fully-qualified path to represent
     * a reference_image resource.
     *
     * @param string $project
     * @param string $location
     * @param string $product
     * @param string $referenceImage
     *
     * @return string The formatted reference_image resource.
     * @experimental
     */
    public static function referenceImageName($project, $location, $product, $referenceImage)
    {
        return self::getReferenceImageNameTemplate()->render([
            'project' => $project,
            'location' => $location,
            'product' => $product,
            'reference_image' => $referenceImage,
        ]);
    }

    /**
     * Parses a formatted name string and returns an associative array of the components in the name.
     * The following name formats are supported:
     * Template: Pattern
     * - location: projects/{project}/locations/{location}
     * - product: projects/{project}/locations/{location}/products/{product}
     * - productSet: projects/{project}/locations/{location}/productSets/{product_set}
     * - referenceImage: projects/{project}/locations/{location}/products/{product}/referenceImages/{reference_image}.
     *
     * The optional $template argument can be supplied to specify a particular pattern, and must
     * match one of the templates listed above. If no $template argument is provided, or if the
     * $template argument does not match one of the templates listed, then parseName will check
     * each of the supported templates, and return the first match.
     *
     * @param string $formattedName The formatted name string
     * @param string $template      Optional name of template to match
     *
     * @return array An associative array from name component IDs to component values.
     *
     * @throws ValidationException If $formattedName could not be matched.
     * @experimental
     */
    public static function parseName($formattedName, $template = null)
    {
        $templateMap = self::getPathTemplateMap();

        if ($template) {
            if (!isset($templateMap[$template])) {
                throw new ValidationException("Template name $template does not exist");
            }

            return $templateMap[$template]->match($formattedName);
        }

        foreach ($templateMap as $templateName => $pathTemplate) {
            try {
                return $pathTemplate->match($formattedName);
            } catch (ValidationException $ex) {
                // Swallow the exception to continue trying other path templates
            }
        }
        throw new ValidationException("Input did not match any known format. Input: $formattedName");
    }

    /**
     * Return an OperationsClient object with the same endpoint as $this.
     *
     * @return OperationsClient
     * @experimental
     */
    public function getOperationsClient()
    {
        return $this->operationsClient;
    }

    /**
     * Resume an existing long running operation that was previously started
     * by a long running API method. If $methodName is not provided, or does
     * not match a long running API method, then the operation can still be
     * resumed, but the OperationResponse object will not deserialize the
     * final response.
     *
     * @param string $operationName The name of the long running operation
     * @param string $methodName    The name of the method used to start the operation
     *
     * @return OperationResponse
     * @experimental
     */
    public function resumeOperation($operationName, $methodName = null)
    {
        $options = isset($this->descriptors[$methodName]['longRunning'])
            ? $this->descriptors[$methodName]['longRunning']
            : [];
        $operation = new OperationResponse($operationName, $this->getOperationsClient(), $options);
        $operation->reload();

        return $operation;
    }

    /**
     * Constructor.
     *
     * @param array $options {
     *                       Optional. Options for configuring the service API wrapper.
     *
     *     @type string $serviceAddress
     *           **Deprecated**. This option will be removed in a future major release. Please
     *           utilize the `$apiEndpoint` option instead.
     *     @type string $apiEndpoint
     *           The address of the API remote host. May optionally include the port, formatted
     *           as "<uri>:<port>". Default 'vision.googleapis.com:443'.
     *     @type string|array|FetchAuthTokenInterface|CredentialsWrapper $credentials
     *           The credentials to be used by the client to authorize API calls. This option
     *           accepts either a path to a credentials file, or a decoded credentials file as a
     *           PHP array.
     *           *Advanced usage*: In addition, this option can also accept a pre-constructed
     *           {@see \Google\Auth\FetchAuthTokenInterface} object or
     *           {@see \Google\ApiCore\CredentialsWrapper} object. Note that when one of these
     *           objects are provided, any settings in $credentialsConfig will be ignored.
     *     @type array $credentialsConfig
     *           Options used to configure credentials, including auth token caching, for the client.
     *           For a full list of supporting configuration options, see
     *           {@see \Google\ApiCore\CredentialsWrapper::build()}.
     *     @type bool $disableRetries
     *           Determines whether or not retries defined by the client configuration should be
     *           disabled. Defaults to `false`.
     *     @type string|array $clientConfig
     *           Client method configuration, including retry settings. This option can be either a
     *           path to a JSON file, or a PHP array containing the decoded JSON data.
     *           By default this settings points to the default client config file, which is provided
     *           in the resources folder.
     *     @type string|TransportInterface $transport
     *           The transport used for executing network requests. May be either the string `rest`
     *           or `grpc`. Defaults to `grpc` if gRPC support is detected on the system.
     *           *Advanced usage*: Additionally, it is possible to pass in an already instantiated
     *           {@see \Google\ApiCore\Transport\TransportInterface} object. Note that when this
     *           object is provided, any settings in $transportConfig, and any `$apiEndpoint`
     *           setting, will be ignored.
     *     @type array $transportConfig
     *           Configuration options that will be used to construct the transport. Options for
     *           each supported transport type should be passed in a key for that transport. For
     *           example:
     *           $transportConfig = [
     *               'grpc' => [...],
     *               'rest' => [...]
     *           ];
     *           See the {@see \Google\ApiCore\Transport\GrpcTransport::build()} and
     *           {@see \Google\ApiCore\Transport\RestTransport::build()} methods for the
     *           supported options.
     * }
     *
     * @throws ValidationException
     * @experimental
     */
    public function __construct(array $options = [])
    {
        $clientOptions = $this->buildClientOptions($options);
        $this->setClientOptions($clientOptions);
        $this->operationsClient = $this->createOperationsClient($clientOptions);
    }

    /**
     * Creates and returns a new ProductSet resource.
     *
     * Possible errors:
     *
     * * Returns INVALID_ARGUMENT if display_name is missing, or is longer than
     *   4096 characters.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedParent = $productSearchClient->locationName('[PROJECT]', '[LOCATION]');
     *     $productSet = new ProductSet();
     *     $response = $productSearchClient->createProductSet($formattedParent, $productSet);
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $parent The project in which the ProductSet should be created.
     *
     * Format is `projects/PROJECT_ID/locations/LOC_ID`.
     * @param ProductSet $productSet   The ProductSet to create.
     * @param array      $optionalArgs {
     *                                 Optional.
     *
     *     @type string $productSetId
     *          A user-supplied resource id for this ProductSet. If set, the server will
     *          attempt to use this value as the resource id. If it is already in use, an
     *          error is returned with code ALREADY_EXISTS. Must be at most 128 characters
     *          long. It cannot contain the character `/`.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Vision\V1\ProductSet
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function createProductSet($parent, $productSet, array $optionalArgs = [])
    {
        $request = new CreateProductSetRequest();
        $request->setParent($parent);
        $request->setProductSet($productSet);
        if (isset($optionalArgs['productSetId'])) {
            $request->setProductSetId($optionalArgs['productSetId']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
          'parent' => $request->getParent(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startCall(
            'CreateProductSet',
            ProductSet::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Lists ProductSets in an unspecified order.
     *
     * Possible errors:
     *
     * * Returns INVALID_ARGUMENT if page_size is greater than 100, or less
     *   than 1.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedParent = $productSearchClient->locationName('[PROJECT]', '[LOCATION]');
     *     // Iterate over pages of elements
     *     $pagedResponse = $productSearchClient->listProductSets($formattedParent);
     *     foreach ($pagedResponse->iteratePages() as $page) {
     *         foreach ($page as $element) {
     *             // doSomethingWith($element);
     *         }
     *     }
     *
     *
     *     // Alternatively:
     *
     *     // Iterate through all elements
     *     $pagedResponse = $productSearchClient->listProductSets($formattedParent);
     *     foreach ($pagedResponse->iterateAllElements() as $element) {
     *         // doSomethingWith($element);
     *     }
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $parent The project from which ProductSets should be listed.
     *
     * Format is `projects/PROJECT_ID/locations/LOC_ID`.
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type int $pageSize
     *          The maximum number of resources contained in the underlying API
     *          response. The API may return fewer values in a page, even if
     *          there are additional values to be retrieved.
     *     @type string $pageToken
     *          A page token is used to specify a page of values to be returned.
     *          If no page token is specified (the default), the first page
     *          of values will be returned. Any page token used here must have
     *          been generated by a previous call to the API.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\PagedListResponse
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function listProductSets($parent, array $optionalArgs = [])
    {
        $request = new ListProductSetsRequest();
        $request->setParent($parent);
        if (isset($optionalArgs['pageSize'])) {
            $request->setPageSize($optionalArgs['pageSize']);
        }
        if (isset($optionalArgs['pageToken'])) {
            $request->setPageToken($optionalArgs['pageToken']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
          'parent' => $request->getParent(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->getPagedListResponse(
            'ListProductSets',
            $optionalArgs,
            ListProductSetsResponse::class,
            $request
        );
    }

    /**
     * Gets information associated with a ProductSet.
     *
     * Possible errors:
     *
     * * Returns NOT_FOUND if the ProductSet does not exist.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedName = $productSearchClient->productSetName('[PROJECT]', '[LOCATION]', '[PRODUCT_SET]');
     *     $response = $productSearchClient->getProductSet($formattedName);
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $name Resource name of the ProductSet to get.
     *
     * Format is:
     * `projects/PROJECT_ID/locations/LOG_ID/productSets/PRODUCT_SET_ID`
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Vision\V1\ProductSet
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function getProductSet($name, array $optionalArgs = [])
    {
        $request = new GetProductSetRequest();
        $request->setName($name);

        $requestParams = new RequestParamsHeaderDescriptor([
          'name' => $request->getName(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startCall(
            'GetProductSet',
            ProductSet::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Makes changes to a ProductSet resource.
     * Only display_name can be updated currently.
     *
     * Possible errors:
     *
     * * Returns NOT_FOUND if the ProductSet does not exist.
     * * Returns INVALID_ARGUMENT if display_name is present in update_mask but
     *   missing from the request or longer than 4096 characters.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $productSet = new ProductSet();
     *     $response = $productSearchClient->updateProductSet($productSet);
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param ProductSet $productSet   The ProductSet resource which replaces the one on the server.
     * @param array      $optionalArgs {
     *                                 Optional.
     *
     *     @type FieldMask $updateMask
     *          The [FieldMask][google.protobuf.FieldMask] that specifies which fields to
     *          update.
     *          If update_mask isn't specified, all mutable fields are to be updated.
     *          Valid mask path is `display_name`.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Vision\V1\ProductSet
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function updateProductSet($productSet, array $optionalArgs = [])
    {
        $request = new UpdateProductSetRequest();
        $request->setProductSet($productSet);
        if (isset($optionalArgs['updateMask'])) {
            $request->setUpdateMask($optionalArgs['updateMask']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
          'product_set.name' => $request->getProductSet()->getName(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startCall(
            'UpdateProductSet',
            ProductSet::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Permanently deletes a ProductSet. Products and ReferenceImages in the
     * ProductSet are not deleted.
     *
     * The actual image files are not deleted from Google Cloud Storage.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedName = $productSearchClient->productSetName('[PROJECT]', '[LOCATION]', '[PRODUCT_SET]');
     *     $productSearchClient->deleteProductSet($formattedName);
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $name Resource name of the ProductSet to delete.
     *
     * Format is:
     * `projects/PROJECT_ID/locations/LOC_ID/productSets/PRODUCT_SET_ID`
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function deleteProductSet($name, array $optionalArgs = [])
    {
        $request = new DeleteProductSetRequest();
        $request->setName($name);

        $requestParams = new RequestParamsHeaderDescriptor([
          'name' => $request->getName(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startCall(
            'DeleteProductSet',
            GPBEmpty::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Creates and returns a new product resource.
     *
     * Possible errors:
     *
     * * Returns INVALID_ARGUMENT if display_name is missing or longer than 4096
     *   characters.
     * * Returns INVALID_ARGUMENT if description is longer than 4096 characters.
     * * Returns INVALID_ARGUMENT if product_category is missing or invalid.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedParent = $productSearchClient->locationName('[PROJECT]', '[LOCATION]');
     *     $product = new Product();
     *     $response = $productSearchClient->createProduct($formattedParent, $product);
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $parent The project in which the Product should be created.
     *
     * Format is
     * `projects/PROJECT_ID/locations/LOC_ID`.
     * @param Product $product      The product to create.
     * @param array   $optionalArgs {
     *                              Optional.
     *
     *     @type string $productId
     *          A user-supplied resource id for this Product. If set, the server will
     *          attempt to use this value as the resource id. If it is already in use, an
     *          error is returned with code ALREADY_EXISTS. Must be at most 128 characters
     *          long. It cannot contain the character `/`.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Vision\V1\Product
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function createProduct($parent, $product, array $optionalArgs = [])
    {
        $request = new CreateProductRequest();
        $request->setParent($parent);
        $request->setProduct($product);
        if (isset($optionalArgs['productId'])) {
            $request->setProductId($optionalArgs['productId']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
          'parent' => $request->getParent(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startCall(
            'CreateProduct',
            Product::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Lists products in an unspecified order.
     *
     * Possible errors:
     *
     * * Returns INVALID_ARGUMENT if page_size is greater than 100 or less than 1.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedParent = $productSearchClient->locationName('[PROJECT]', '[LOCATION]');
     *     // Iterate over pages of elements
     *     $pagedResponse = $productSearchClient->listProducts($formattedParent);
     *     foreach ($pagedResponse->iteratePages() as $page) {
     *         foreach ($page as $element) {
     *             // doSomethingWith($element);
     *         }
     *     }
     *
     *
     *     // Alternatively:
     *
     *     // Iterate through all elements
     *     $pagedResponse = $productSearchClient->listProducts($formattedParent);
     *     foreach ($pagedResponse->iterateAllElements() as $element) {
     *         // doSomethingWith($element);
     *     }
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $parent The project OR ProductSet from which Products should be listed.
     *
     * Format:
     * `projects/PROJECT_ID/locations/LOC_ID`
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type int $pageSize
     *          The maximum number of resources contained in the underlying API
     *          response. The API may return fewer values in a page, even if
     *          there are additional values to be retrieved.
     *     @type string $pageToken
     *          A page token is used to specify a page of values to be returned.
     *          If no page token is specified (the default), the first page
     *          of values will be returned. Any page token used here must have
     *          been generated by a previous call to the API.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\PagedListResponse
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function listProducts($parent, array $optionalArgs = [])
    {
        $request = new ListProductsRequest();
        $request->setParent($parent);
        if (isset($optionalArgs['pageSize'])) {
            $request->setPageSize($optionalArgs['pageSize']);
        }
        if (isset($optionalArgs['pageToken'])) {
            $request->setPageToken($optionalArgs['pageToken']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
          'parent' => $request->getParent(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->getPagedListResponse(
            'ListProducts',
            $optionalArgs,
            ListProductsResponse::class,
            $request
        );
    }

    /**
     * Gets information associated with a Product.
     *
     * Possible errors:
     *
     * * Returns NOT_FOUND if the Product does not exist.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedName = $productSearchClient->productName('[PROJECT]', '[LOCATION]', '[PRODUCT]');
     *     $response = $productSearchClient->getProduct($formattedName);
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $name Resource name of the Product to get.
     *
     * Format is:
     * `projects/PROJECT_ID/locations/LOC_ID/products/PRODUCT_ID`
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Vision\V1\Product
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function getProduct($name, array $optionalArgs = [])
    {
        $request = new GetProductRequest();
        $request->setName($name);

        $requestParams = new RequestParamsHeaderDescriptor([
          'name' => $request->getName(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startCall(
            'GetProduct',
            Product::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Makes changes to a Product resource.
     * Only the `display_name`, `description`, and `labels` fields can be updated
     * right now.
     *
     * If labels are updated, the change will not be reflected in queries until
     * the next index time.
     *
     * Possible errors:
     *
     * * Returns NOT_FOUND if the Product does not exist.
     * * Returns INVALID_ARGUMENT if display_name is present in update_mask but is
     *   missing from the request or longer than 4096 characters.
     * * Returns INVALID_ARGUMENT if description is present in update_mask but is
     *   longer than 4096 characters.
     * * Returns INVALID_ARGUMENT if product_category is present in update_mask.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $product = new Product();
     *     $response = $productSearchClient->updateProduct($product);
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param Product $product      The Product resource which replaces the one on the server.
     *                              product.name is immutable.
     * @param array   $optionalArgs {
     *                              Optional.
     *
     *     @type FieldMask $updateMask
     *          The [FieldMask][google.protobuf.FieldMask] that specifies which fields
     *          to update.
     *          If update_mask isn't specified, all mutable fields are to be updated.
     *          Valid mask paths include `product_labels`, `display_name`, and
     *          `description`.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Vision\V1\Product
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function updateProduct($product, array $optionalArgs = [])
    {
        $request = new UpdateProductRequest();
        $request->setProduct($product);
        if (isset($optionalArgs['updateMask'])) {
            $request->setUpdateMask($optionalArgs['updateMask']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
          'product.name' => $request->getProduct()->getName(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startCall(
            'UpdateProduct',
            Product::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Permanently deletes a product and its reference images.
     *
     * Metadata of the product and all its images will be deleted right away, but
     * search queries against ProductSets containing the product may still work
     * until all related caches are refreshed.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedName = $productSearchClient->productName('[PROJECT]', '[LOCATION]', '[PRODUCT]');
     *     $productSearchClient->deleteProduct($formattedName);
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $name Resource name of product to delete.
     *
     * Format is:
     * `projects/PROJECT_ID/locations/LOC_ID/products/PRODUCT_ID`
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function deleteProduct($name, array $optionalArgs = [])
    {
        $request = new DeleteProductRequest();
        $request->setName($name);

        $requestParams = new RequestParamsHeaderDescriptor([
          'name' => $request->getName(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startCall(
            'DeleteProduct',
            GPBEmpty::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Creates and returns a new ReferenceImage resource.
     *
     * The `bounding_poly` field is optional. If `bounding_poly` is not specified,
     * the system will try to detect regions of interest in the image that are
     * compatible with the product_category on the parent product. If it is
     * specified, detection is ALWAYS skipped. The system converts polygons into
     * non-rotated rectangles.
     *
     * Note that the pipeline will resize the image if the image resolution is too
     * large to process (above 50MP).
     *
     * Possible errors:
     *
     * * Returns INVALID_ARGUMENT if the image_uri is missing or longer than 4096
     *   characters.
     * * Returns INVALID_ARGUMENT if the product does not exist.
     * * Returns INVALID_ARGUMENT if bounding_poly is not provided, and nothing
     *   compatible with the parent product's product_category is detected.
     * * Returns INVALID_ARGUMENT if bounding_poly contains more than 10 polygons.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedParent = $productSearchClient->productName('[PROJECT]', '[LOCATION]', '[PRODUCT]');
     *     $referenceImage = new ReferenceImage();
     *     $response = $productSearchClient->createReferenceImage($formattedParent, $referenceImage);
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $parent Resource name of the product in which to create the reference image.
     *
     * Format is
     * `projects/PROJECT_ID/locations/LOC_ID/products/PRODUCT_ID`.
     * @param ReferenceImage $referenceImage The reference image to create.
     *                                       If an image ID is specified, it is ignored.
     * @param array          $optionalArgs   {
     *                                       Optional.
     *
     *     @type string $referenceImageId
     *          A user-supplied resource id for the ReferenceImage to be added. If set,
     *          the server will attempt to use this value as the resource id. If it is
     *          already in use, an error is returned with code ALREADY_EXISTS. Must be at
     *          most 128 characters long. It cannot contain the character `/`.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Vision\V1\ReferenceImage
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function createReferenceImage($parent, $referenceImage, array $optionalArgs = [])
    {
        $request = new CreateReferenceImageRequest();
        $request->setParent($parent);
        $request->setReferenceImage($referenceImage);
        if (isset($optionalArgs['referenceImageId'])) {
            $request->setReferenceImageId($optionalArgs['referenceImageId']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
          'parent' => $request->getParent(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startCall(
            'CreateReferenceImage',
            ReferenceImage::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Permanently deletes a reference image.
     *
     * The image metadata will be deleted right away, but search queries
     * against ProductSets containing the image may still work until all related
     * caches are refreshed.
     *
     * The actual image files are not deleted from Google Cloud Storage.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedName = $productSearchClient->referenceImageName('[PROJECT]', '[LOCATION]', '[PRODUCT]', '[REFERENCE_IMAGE]');
     *     $productSearchClient->deleteReferenceImage($formattedName);
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $name The resource name of the reference image to delete.
     *
     * Format is:
     *
     * `projects/PROJECT_ID/locations/LOC_ID/products/PRODUCT_ID/referenceImages/IMAGE_ID`
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function deleteReferenceImage($name, array $optionalArgs = [])
    {
        $request = new DeleteReferenceImageRequest();
        $request->setName($name);

        $requestParams = new RequestParamsHeaderDescriptor([
          'name' => $request->getName(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startCall(
            'DeleteReferenceImage',
            GPBEmpty::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Lists reference images.
     *
     * Possible errors:
     *
     * * Returns NOT_FOUND if the parent product does not exist.
     * * Returns INVALID_ARGUMENT if the page_size is greater than 100, or less
     *   than 1.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedParent = $productSearchClient->productName('[PROJECT]', '[LOCATION]', '[PRODUCT]');
     *     // Iterate over pages of elements
     *     $pagedResponse = $productSearchClient->listReferenceImages($formattedParent);
     *     foreach ($pagedResponse->iteratePages() as $page) {
     *         foreach ($page as $element) {
     *             // doSomethingWith($element);
     *         }
     *     }
     *
     *
     *     // Alternatively:
     *
     *     // Iterate through all elements
     *     $pagedResponse = $productSearchClient->listReferenceImages($formattedParent);
     *     foreach ($pagedResponse->iterateAllElements() as $element) {
     *         // doSomethingWith($element);
     *     }
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $parent Resource name of the product containing the reference images.
     *
     * Format is
     * `projects/PROJECT_ID/locations/LOC_ID/products/PRODUCT_ID`.
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type int $pageSize
     *          The maximum number of resources contained in the underlying API
     *          response. The API may return fewer values in a page, even if
     *          there are additional values to be retrieved.
     *     @type string $pageToken
     *          A page token is used to specify a page of values to be returned.
     *          If no page token is specified (the default), the first page
     *          of values will be returned. Any page token used here must have
     *          been generated by a previous call to the API.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\PagedListResponse
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function listReferenceImages($parent, array $optionalArgs = [])
    {
        $request = new ListReferenceImagesRequest();
        $request->setParent($parent);
        if (isset($optionalArgs['pageSize'])) {
            $request->setPageSize($optionalArgs['pageSize']);
        }
        if (isset($optionalArgs['pageToken'])) {
            $request->setPageToken($optionalArgs['pageToken']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
          'parent' => $request->getParent(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->getPagedListResponse(
            'ListReferenceImages',
            $optionalArgs,
            ListReferenceImagesResponse::class,
            $request
        );
    }

    /**
     * Gets information associated with a ReferenceImage.
     *
     * Possible errors:
     *
     * * Returns NOT_FOUND if the specified image does not exist.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedName = $productSearchClient->referenceImageName('[PROJECT]', '[LOCATION]', '[PRODUCT]', '[REFERENCE_IMAGE]');
     *     $response = $productSearchClient->getReferenceImage($formattedName);
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $name The resource name of the ReferenceImage to get.
     *
     * Format is:
     *
     * `projects/PROJECT_ID/locations/LOC_ID/products/PRODUCT_ID/referenceImages/IMAGE_ID`.
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Vision\V1\ReferenceImage
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function getReferenceImage($name, array $optionalArgs = [])
    {
        $request = new GetReferenceImageRequest();
        $request->setName($name);

        $requestParams = new RequestParamsHeaderDescriptor([
          'name' => $request->getName(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startCall(
            'GetReferenceImage',
            ReferenceImage::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Adds a Product to the specified ProductSet. If the Product is already
     * present, no change is made.
     *
     * One Product can be added to at most 100 ProductSets.
     *
     * Possible errors:
     *
     * * Returns NOT_FOUND if the Product or the ProductSet doesn't exist.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedName = $productSearchClient->productSetName('[PROJECT]', '[LOCATION]', '[PRODUCT_SET]');
     *     $formattedProduct = $productSearchClient->productName('[PROJECT]', '[LOCATION]', '[PRODUCT]');
     *     $productSearchClient->addProductToProductSet($formattedName, $formattedProduct);
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $name The resource name for the ProductSet to modify.
     *
     * Format is:
     * `projects/PROJECT_ID/locations/LOC_ID/productSets/PRODUCT_SET_ID`
     * @param string $product The resource name for the Product to be added to this ProductSet.
     *
     * Format is:
     * `projects/PROJECT_ID/locations/LOC_ID/products/PRODUCT_ID`
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function addProductToProductSet($name, $product, array $optionalArgs = [])
    {
        $request = new AddProductToProductSetRequest();
        $request->setName($name);
        $request->setProduct($product);

        $requestParams = new RequestParamsHeaderDescriptor([
          'name' => $request->getName(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startCall(
            'AddProductToProductSet',
            GPBEmpty::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Removes a Product from the specified ProductSet.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedName = $productSearchClient->productSetName('[PROJECT]', '[LOCATION]', '[PRODUCT_SET]');
     *     $formattedProduct = $productSearchClient->productName('[PROJECT]', '[LOCATION]', '[PRODUCT]');
     *     $productSearchClient->removeProductFromProductSet($formattedName, $formattedProduct);
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $name The resource name for the ProductSet to modify.
     *
     * Format is:
     * `projects/PROJECT_ID/locations/LOC_ID/productSets/PRODUCT_SET_ID`
     * @param string $product The resource name for the Product to be removed from this ProductSet.
     *
     * Format is:
     * `projects/PROJECT_ID/locations/LOC_ID/products/PRODUCT_ID`
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function removeProductFromProductSet($name, $product, array $optionalArgs = [])
    {
        $request = new RemoveProductFromProductSetRequest();
        $request->setName($name);
        $request->setProduct($product);

        $requestParams = new RequestParamsHeaderDescriptor([
          'name' => $request->getName(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startCall(
            'RemoveProductFromProductSet',
            GPBEmpty::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Lists the Products in a ProductSet, in an unspecified order. If the
     * ProductSet does not exist, the products field of the response will be
     * empty.
     *
     * Possible errors:
     *
     * * Returns INVALID_ARGUMENT if page_size is greater than 100 or less than 1.
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedName = $productSearchClient->productSetName('[PROJECT]', '[LOCATION]', '[PRODUCT_SET]');
     *     // Iterate over pages of elements
     *     $pagedResponse = $productSearchClient->listProductsInProductSet($formattedName);
     *     foreach ($pagedResponse->iteratePages() as $page) {
     *         foreach ($page as $element) {
     *             // doSomethingWith($element);
     *         }
     *     }
     *
     *
     *     // Alternatively:
     *
     *     // Iterate through all elements
     *     $pagedResponse = $productSearchClient->listProductsInProductSet($formattedName);
     *     foreach ($pagedResponse->iterateAllElements() as $element) {
     *         // doSomethingWith($element);
     *     }
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $name The ProductSet resource for which to retrieve Products.
     *
     * Format is:
     * `projects/PROJECT_ID/locations/LOC_ID/productSets/PRODUCT_SET_ID`
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type int $pageSize
     *          The maximum number of resources contained in the underlying API
     *          response. The API may return fewer values in a page, even if
     *          there are additional values to be retrieved.
     *     @type string $pageToken
     *          A page token is used to specify a page of values to be returned.
     *          If no page token is specified (the default), the first page
     *          of values will be returned. Any page token used here must have
     *          been generated by a previous call to the API.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\PagedListResponse
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function listProductsInProductSet($name, array $optionalArgs = [])
    {
        $request = new ListProductsInProductSetRequest();
        $request->setName($name);
        if (isset($optionalArgs['pageSize'])) {
            $request->setPageSize($optionalArgs['pageSize']);
        }
        if (isset($optionalArgs['pageToken'])) {
            $request->setPageToken($optionalArgs['pageToken']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
          'name' => $request->getName(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->getPagedListResponse(
            'ListProductsInProductSet',
            $optionalArgs,
            ListProductsInProductSetResponse::class,
            $request
        );
    }

    /**
     * Asynchronous API that imports a list of reference images to specified
     * product sets based on a list of image information.
     *
     * The [google.longrunning.Operation][google.longrunning.Operation] API can be
     * used to keep track of the progress and results of the request.
     * `Operation.metadata` contains `BatchOperationMetadata`. (progress)
     * `Operation.response` contains `ImportProductSetsResponse`. (results)
     *
     * The input source of this method is a csv file on Google Cloud Storage.
     * For the format of the csv file please see
     * [ImportProductSetsGcsSource.csv_file_uri][google.cloud.vision.v1.ImportProductSetsGcsSource.csv_file_uri].
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedParent = $productSearchClient->locationName('[PROJECT]', '[LOCATION]');
     *     $inputConfig = new ImportProductSetsInputConfig();
     *     $operationResponse = $productSearchClient->importProductSets($formattedParent, $inputConfig);
     *     $operationResponse->pollUntilComplete();
     *     if ($operationResponse->operationSucceeded()) {
     *         $result = $operationResponse->getResult();
     *         // doSomethingWith($result)
     *     } else {
     *         $error = $operationResponse->getError();
     *         // handleError($error)
     *     }
     *
     *
     *     // Alternatively:
     *
     *     // start the operation, keep the operation name, and resume later
     *     $operationResponse = $productSearchClient->importProductSets($formattedParent, $inputConfig);
     *     $operationName = $operationResponse->getName();
     *     // ... do other work
     *     $newOperationResponse = $productSearchClient->resumeOperation($operationName, 'importProductSets');
     *     while (!$newOperationResponse->isDone()) {
     *         // ... do other work
     *         $newOperationResponse->reload();
     *     }
     *     if ($newOperationResponse->operationSucceeded()) {
     *       $result = $newOperationResponse->getResult();
     *       // doSomethingWith($result)
     *     } else {
     *       $error = $newOperationResponse->getError();
     *       // handleError($error)
     *     }
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $parent The project in which the ProductSets should be imported.
     *
     * Format is `projects/PROJECT_ID/locations/LOC_ID`.
     * @param ImportProductSetsInputConfig $inputConfig  The input content for the list of requests.
     * @param array                        $optionalArgs {
     *                                                   Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\OperationResponse
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function importProductSets($parent, $inputConfig, array $optionalArgs = [])
    {
        $request = new ImportProductSetsRequest();
        $request->setParent($parent);
        $request->setInputConfig($inputConfig);

        $requestParams = new RequestParamsHeaderDescriptor([
          'parent' => $request->getParent(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startOperationsCall(
            'ImportProductSets',
            $optionalArgs,
            $request,
            $this->getOperationsClient()
        )->wait();
    }

    /**
     * Asynchronous API to delete all Products in a ProductSet or all Products
     * that are in no ProductSet.
     *
     * If a Product is a member of the specified ProductSet in addition to other
     * ProductSets, the Product will still be deleted.
     *
     * It is recommended to not delete the specified ProductSet until after this
     * operation has completed. It is also recommended to not add any of the
     * Products involved in the batch delete to a new ProductSet while this
     * operation is running because those Products may still end up deleted.
     *
     * It's not possible to undo the PurgeProducts operation. Therefore, it is
     * recommended to keep the csv files used in ImportProductSets (if that was
     * how you originally built the Product Set) before starting PurgeProducts, in
     * case you need to re-import the data after deletion.
     *
     * If the plan is to purge all of the Products from a ProductSet and then
     * re-use the empty ProductSet to re-import new Products into the empty
     * ProductSet, you must wait until the PurgeProducts operation has finished
     * for that ProductSet.
     *
     * The [google.longrunning.Operation][google.longrunning.Operation] API can be
     * used to keep track of the progress and results of the request.
     * `Operation.metadata` contains `BatchOperationMetadata`. (progress)
     *
     * Sample code:
     * ```
     * $productSearchClient = new ProductSearchClient();
     * try {
     *     $formattedParent = $productSearchClient->locationName('[PROJECT]', '[LOCATION]');
     *     $operationResponse = $productSearchClient->purgeProducts($formattedParent);
     *     $operationResponse->pollUntilComplete();
     *     if ($operationResponse->operationSucceeded()) {
     *         // operation succeeded and returns no value
     *     } else {
     *         $error = $operationResponse->getError();
     *         // handleError($error)
     *     }
     *
     *
     *     // Alternatively:
     *
     *     // start the operation, keep the operation name, and resume later
     *     $operationResponse = $productSearchClient->purgeProducts($formattedParent);
     *     $operationName = $operationResponse->getName();
     *     // ... do other work
     *     $newOperationResponse = $productSearchClient->resumeOperation($operationName, 'purgeProducts');
     *     while (!$newOperationResponse->isDone()) {
     *         // ... do other work
     *         $newOperationResponse->reload();
     *     }
     *     if ($newOperationResponse->operationSucceeded()) {
     *       // operation succeeded and returns no value
     *     } else {
     *       $error = $newOperationResponse->getError();
     *       // handleError($error)
     *     }
     * } finally {
     *     $productSearchClient->close();
     * }
     * ```
     *
     * @param string $parent The project and location in which the Products should be deleted.
     *
     * Format is `projects/PROJECT_ID/locations/LOC_ID`.
     * @param array $optionalArgs {
     *                            Optional.
     *
     *     @type ProductSetPurgeConfig $productSetPurgeConfig
     *          Specify which ProductSet contains the Products to be deleted.
     *     @type bool $deleteOrphanProducts
     *          If delete_orphan_products is true, all Products that are not in any
     *          ProductSet will be deleted.
     *     @type bool $force
     *          The default value is false. Override this value to true to actually perform
     *          the purge.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\OperationResponse
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function purgeProducts($parent, array $optionalArgs = [])
    {
        $request = new PurgeProductsRequest();
        $request->setParent($parent);
        if (isset($optionalArgs['productSetPurgeConfig'])) {
            $request->setProductSetPurgeConfig($optionalArgs['productSetPurgeConfig']);
        }
        if (isset($optionalArgs['deleteOrphanProducts'])) {
            $request->setDeleteOrphanProducts($optionalArgs['deleteOrphanProducts']);
        }
        if (isset($optionalArgs['force'])) {
            $request->setForce($optionalArgs['force']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
          'parent' => $request->getParent(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startOperationsCall(
            'PurgeProducts',
            $optionalArgs,
            $request,
            $this->getOperationsClient()
        )->wait();
    }
}
