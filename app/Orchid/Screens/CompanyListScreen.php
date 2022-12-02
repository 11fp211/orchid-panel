<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\CompanyListLayout;
use App\Models\Company;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CompanyListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'companies' => Company::paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Company';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All companies";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.company.edit')
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {

        return [
            CompanyListLayout::class,
        ];
    }
}
