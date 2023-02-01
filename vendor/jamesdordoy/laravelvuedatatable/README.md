
# Laravel Vue Datatable
A Vue.js Datatable Component for Laravel that works with Bootstrap.

## Requirements

* [Vue.js](https://vuejs.org/) 2.x
* [Laravel](http://laravel.com/docs/) 5.x
* [Bootstrap](http://getbootstrap.com/) 4 (Optional)

This package makes use of an optional default component, the [Laravel Vue Pagination](https://github.com/gilbitron/laravel-vue-pagination)  component created by [gilbitron](https://github.com/gilbitron). If you need a pagination component for other areas of your website and you are using a Laravel API &amp; Bootstrap, i highly suggest using this flexible component.

## Demo

See [https://jamesdordoy.github.io/vue-datatable/](https://jamesdordoy.github.io/vue-datatable/)

## Table of Contents
- [Example](#example)
- [Package Installation](#package-installation)
	- [Add Service Provider](#add-service-provider)
  	- [Publish the Config](#publish-the-config)
  		- [Package Options](#package-options)
  	- [Use the Trait](#use-the-trait)
	- [Use the Controller Resource](#use-the-controller-resource)
- [Component Installation](#component-installation)

## Example
![Image description](https://www.jamesdordoy.co.uk/images/projects/bootstrap-datatable.png?a=a)

## Package Installation
```
$ composer require jamesdordoy/laravelvuedatatable
```

### Add Service Provider
```
JamesDordoy\LaravelVueDatatable\Providers\LaravelVueDatatableServiceProvider::class,
```

### Publish the Config
```
$ php artisan vendor:publish --provider="JamesDordoy\LaravelVueDatatable\Providers\LaravelVueDatatableServiceProvider"
```

#### Package Options

```php
[
    'models' => [
        "alias" => "as",
        "search_term" => "searchable",
        "order_term" => "orderable",
    ],
    "default_order_by" => "id"
]
```


### Use the Trait
This trait is optional and simply provides a basic method for filtering your data based on the $dataTableColumns attribute set in the model. If you would like more control on how the data is filtered, feel free to omit this trait use your own filtering methods. Just remember to paginate the results!

```php
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class User extends Authenticatable
{
    use Notifiable, LaravelVueDatatableTrait;

    protected $dataTableColumns = [
        'id' => [
            'searchable' => false,
        ],
        'name' => [
            'searchable' => true,
        ],
        'email' => [
            'searchable' => true,
        ]
    ];
}
```

## Use the Controller Resource

The Collection Resource is expecting a paginated collection, so feel free to use your own queries and omit the provided query if your require more complex filtering.

```php
<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class UserController extends Controller
{
    public function index(Request $request)
    {   
        $length = $request->input('length');
        $orderBy = $request->input('column'); //Index
        $orderByDir = $request->input('dir', 'asc');
        $searchValue = $request->input('search');
        
        $query = User::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data = $query->paginate($length);
        
        return new DataTableCollectionResource($data);
    }
}
```

## Using Laravels Query Builder

For more complex filtering, it is suggested to use the query builder as you are able to make cross table queries and searches in only a single call to the database. You can add your own joins to the query to add additional data but you will have to reselect the data you want and as previous filters have been applied by the default searching, please use the orWhere function to apply additional filters as using where will clear the previously set search filters.

```php
<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class UserController extends Controller
{
    public function index(Request $request)
    {   
        $searchValue = $request->input('search');
        $orderBy = $request->input('column');
        $orderBydir = $request->input("dir");
        $length = $request->input('length');

        $data = \DB::table('users')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->join('departments', 'departments.id', '=', 'roles.department_id')
            ->select(
                'roles.name as role_name',
                'users.id',
                'users.cost',
                'users.name as user_name',
                'users.email',
                'departments.name as department_name'
            )
            ->where("users.name", "LIKE", "%$searchValue%")
            ->orWhere('users.email', "LIKE", "%$searchValue%")
            ->orWhere('roles.name', "LIKE", "%$searchValue%")
            ->orWhere('departments.name', "LIKE", "%$searchValue%")
            ->orderBy($orderBy, $orderBydir)
            ->paginate($length);

        return new DataTableCollectionResource($data);
    }
}
```

## Component Installation

See [https://github.com/jamesdordoy/vue-datatable](https://github.com/jamesdordoy/vue-datatable)