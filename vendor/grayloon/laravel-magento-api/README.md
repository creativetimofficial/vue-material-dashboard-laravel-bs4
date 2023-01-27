
<p align="center">
  <img src="logo.png">
</p>

<p align="center">
<a href="https://github.com/grayloon/magento-laravel-api/actions"><img src="https://github.com/grayloon/magento-laravel-api/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/grayloon/magento-laravel-api"><img src="https://img.shields.io/packagist/v/grayloon/laravel-magento-api.svg?style=flat" alt="Latest Stable Version"></a>
<a href="https://github.styleci.io/repos/277585119?branch=master"><img src="https://github.styleci.io/repos/277585119/shield?branch=master" alt="Style CI"></a>
<a href="https://packagist.org/packages/grayloon/magento-laravel-api"><img src="https://img.shields.io/packagist/dt/grayloon/laravel-magento-api?style=flat" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/grayloon/magento-laravel-api"><img src="https://img.shields.io/badge/License-MIT-brightgreen.svg" alt="License"></a>
</p>

# Laravel - Magento API

A Magento 2 API Object Oriented wrapper for a Laravel application.

- [Installation](#installation)
- [API Usage](#api-usage)
- [Available Methods](#available-methods)
  - [Admin Token](#admin-token)
  - [Bundle Products](#bundle-products)
  - [Carts](#carts)
  - [Categories](#categories)
  - [Customer Token](#customer-token)
  - [Customers](#customers)
  - [Guest Cart](#guest-cart)
  - [Orders](#orders)
  - [Product Attributes](#product-attributes)
  - [Product Link Types](#product-link-types)
  - [Products](#products)
  - [Schema](#schema)
  - [Source Items](#source-items)
  - [Sources](#sources)
  - [Stocks]($stocks)
  - [Custom Modules](#custom-modules)


## Installation

Install this package via Composer:

```bash
composer require grayloon/laravel-magento-api
```

Publish the config options:
```bash
php artisan vendor:publish --provider="Grayloon\Magento\MagentoServiceProvider" --tag="config"
```

Configure your Magento 2 API endpoint and token in your `.env` file:
```
MAGENTO_BASE_URL="https://mydomain.com"
MAGENTO_ACCESS_TOKEN="client_access_token_here"

# Optional Config:
MAGENTO_BASE_PATH="rest"
MAGENTO_STORE_CODE="all"
MAGENTO_API_VERSION="V1"
```

## API Usage

Example:
```php
use Grayloon\Magento\Magento;

$magento = new Magento();
$response = $magento->api('products')->all();

$response->body() : string;
$response->json() : array|mixed;
$response->status() : int;
$response->ok() : bool;
```

> Will throw an exception on >500 errors.

## Available Methods:

<a id="admin-token"></a>
### Admin Token Integration (IntegrationAdminTokenServiceV1)

`/V1/integration/admin/token`

Generate a admin token:
```php
Magento::api('integration')->adminToken($username, $password);
```

<a id="bundle-products"></a>
### Bundle Product Options (bundleProductOptionRepositoryV1)

`/V1/bundle-products/{sku}/options/all`

Get all options for bundle product.
```php
Magento::api('bundleProduct')->options($sku);
```

#### Carts

`/V1/carts/mine`

Returns information for the cart for the authenticated customer. Must use a single store code.
```php
Magento::api('carts')->mine();
```

`/V1/carts/mine/coupons/{couponCode}`

Apply a coupon to a specified cart.
```php
Magento::api('carts')->couponCode($couponCode);
```

#### Cart Items (quoteCartItemRepositoryV1)

`/V1/carts/mine/items/`

Lists items that are assigned to a specified customer cart. Must have a store code.
```php
Magento::api('cartItems')->mine();
```

`/V1/carts/mine/items/`

Add/update the specified cart item with a customer token. Must have a store code.
```php
Magento::api('cartItems')->addItem($cartId, $sku, $quantity);
```

`put` - `/V1/carts/mine/items/{itemId}`

Update the specified cart item with a customer token. Must have a store code.
```php
Magento::api('cartItems')->editItem($itemId, $body = []);
```

Remove the specified cart item with a customer token. Must have a store code.
```php
Magento::api('cartItems')->removeItem($itemId);
```

#### Cart Totals (quoteCartTotalRepositoryV1)

`/V1/carts/mine/totals`

Returns information for the cart totals for the authenticated customer. Must use a single store code.
```php
Magento::api('cartTotals')->mine();
```

<a id="categories"></a>
### Categories (catalogCategoryManagementV1)

`/V1/categories`

Get a list of all categories:
```php
Magento::api('categories')->all($pageSize = 50, $currentPage = 1, $filters = []);
```

<a id="customer-token"></a>
### Customer Token Integration (IntegrationCustomerTokenServiceV1)

`/V1/integration/customer/token`

Generate a customer token:
```php
Magento::api('integration')->customerToken($username, $password);
```

<a id="customers"></a>
### Customers (various)

`/V1/customers/search`

Get a list of customers:
```php
Magento::api('customers')->all($pageSize = 50, $currentPage = 1, $filters = []);
```

`/V1/customers/password`

Send an email to the customer with a password reset link.
```php
Magento::api('customers')->password($email, $template, $websiteId);
```

`/V1/customers/resetPassword`

Reset customer password.
```php
Magento::api('customers')->resetPassword($email, $resetToken, $newPassword);
```

<a id="guest-cart"></a>
### Guest Cart (various)

`/V1/guest-carts`

Enable customer or guest user to create an empty cart and quote for an anonymous customer.
```php
Magento::api('guestCarts')->create();
```

`/V1/guest-carts/{cartId}`

Return information for a specified cart.
```php
Magento::api('guestCarts')->cart($cartId);
```

`/V1/guest-carts/{cartId}/items`

List items that are assigned to a specified cart.
```php
Magento::api('guestCarts')->items($cartId);
```

`/V1/guest-carts/{cartId}/items`

Add/update the specified cart item.
```php
Magento::api('guestCarts')->addItem($cartId, $sku, $quantity);
```

`put` - `/V1/guest-carts/{cartId}/items/{itemId}`

Update the specified cart item.
```php
Magento::api('guestCarts')->editItem($cartId, $itemId, $body = []);
```

Remove the specified cart item.
```php
Magento::api('guestCarts')->removeItem($cartId, $itemId);
```

`/V1/guest-carts/{cartId}/estimate-shipping-methods`

Estimate shipping by address and return list of available shipping methods.
```php
Magento::api('guestCarts')->estimateShippingMethods($cartId);
```

`/V1/guest-carts/{cartId}/coupons/{couponCode}`

Apply a coupon to a specified cart.
```php
Magento::api('guestCarts')->couponCode($cartId, $couponCode);
```

<a id="orders"></a>
### Orders (salesOrderRepositoryV1)

 Lists orders that match specified search criteria.

`/V1/orders`

Lists orders that match specified search criteria. 
```php
Magento::api('orders')->all($pageSize = 50, $currentPage = 1, $filters = []);
```

<a id="product-attributes"></a>
### Product Attributes (catalogProductAttributeRepositoryV1)

`/V1/products/attributes/{attributeCode}`

Retrieve specific product attribute information:
```php
Magento::api('productAttributes')->show($attributeCode);
```

<a id="product-link-types"></a>
### Product Link Types (catalogProductLinkTypeListV1)

`/V1/products/links/types`

Retrieve information about available product link types:
```php
Magento::api('productLinkType')->types();
```

<a id="products"></a>
### Products (catalogProductRepositoryV1)

`/V1/products`

Get a list of products:
```php
Magento::api('products')->all($pageSize = 50, $currentPage = 1, $filters = []);
```

`/V1/products/{sku}`

Get info about a product by the product SKU:
```php
Magento::api('products')->show($sku);
```

<a id="custom-modules"></a>
### Custom Modules
Magento modules can have their own API endpoints.
For example:
```xml
<route method="POST" url="/V1/my-custom-endpoint/save">
    ...
</route>
<route method="GET" url="/V1/my-custom-endpoint/get/:id">
    ...
</route>
```
To use these you can directly use get/post methods:
```php
Magento::api('my-custom-endpoint')->post('save', [...]);
```
```php
Magento::api('my-custom-endpoint')->get('get/1');
```

<a id="schema"></a>
### Schema

Get a schema blueprint of the Magento 2 REST API:
```php
Magento::api('schema')->show(); 
```

### Source Items (inventoryApiSourceItemRepositoryV1)

`/V1/inventory/source-items`

Get a list of paginated sort items (typically used for quantity retrieval):
```php
Magento::api('sourceItems')->all($pageSize = 50, $currentPage = 1, $filters = []);
```

<a id="sources"></a>
### Sources (inventoryApiSourcesRepositoryV1)

`/V1/inventory/sources`

Get a list of paginated sources.
```php
Magento::api('sources')->all($pageSize = 50, $currentPage = 1, $filters = []);
```

`/V1/inventory/sources/{$name}`

Get a specified source.
```php
Magento::api('sources')->bySourceName($name);
```

<a id="stocks"></a>

### Stocks (inventoryApiStocksRepositoryV1)

`/V1/inventory/stocks`

Get a list of paginated stocks.
```php
Magento::api('stocks')->all($pageSize = 50, $currentPage = 1, $filters = []);
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email webmaster@grayloon.com instead of using the issue tracker.

## Credits

- [Gray Loon Marketing Group](https://github.com/grayloon)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
