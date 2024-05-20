<?php

namespace App\JsonApi\V2\Users;

use App\Models\User;
use Carbon\Carbon;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\DateTime;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Filters\WhereIdIn;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;

class UserSchema extends Schema
{

    /**
     * The model the schema corresponds to.
     *
     * @var string
     */
    public static string $model = User::class;

    /**
     * Get the resource fields.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            ID::make(),
            Str::make('name')->sortable(),
            Str::make('email')->sortable(),
            Str::make('password')->hidden(),
            Str::make('password_confirmation')->hidden(),
            DateTime::make('created_at')
                ->serializeUsing(static fn(?Carbon $value) => $value?->format('Y-m-d H:i:s'))
                ->sortable()
                ->readOnly(),
            DateTime::make('updated_at')
                ->serializeUsing(static fn(?Carbon $value) => $value?->format('Y-m-d H:i:s'))
                ->readOnly(),
        ];
    }

    /**
     * Get the resource filters.
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            WhereIdIn::make($this),
        ];
    }

    /**
     * Get the resource paginator.
     *
     * @return Paginator|null
     */
    public function pagination(): ?Paginator
    {
        return PagePagination::make();
    }

}
