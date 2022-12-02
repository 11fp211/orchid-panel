<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Models\Company;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Input::make('user.last_name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Last Name'))
                ->placeholder(__('Last Name')),

            Relation::make('user.company_id')
                ->fromModel(Company::class, 'name',)
                ->title('Choose user company')
                ->required(),


            Input::make('user.phone')
                ->type('text')
                ->required()
                ->title(__('Phone'))
                ->placeholder(__('Phone')),

            Input::make('user.email')
                ->type('email')
                ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),
        ];
    }
}
