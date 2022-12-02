<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Cropper;
use App\Models\Company;


class CompanyListLayout extends Table
{
     /**
     * Data source.
     *
     * @var string
     */
    public $target = 'companies';


    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->render(function (Company $company) {
                    return Link::make($company->name)
                        ->route('platform.company.edit', $company);
            }),
            TD::make('email', 'Email')
                ->render(function (Company $company) {
                    return Link::make($company->email)
                        ->route('platform.company.edit', $company);
            }),
            TD::make('logo', 'Logo')
            ->width('150')
            ->render(fn (Company $company) => // Please use view('path')
                     "<img src='$company->logo'
                      alt='sample'
                      class='mw-100 d-block img-fluid rounded-1 w-100'>"),
            TD::make('website', 'Website')
                ->render(function (Company $company) {
                    return Link::make($company->website)
                        ->route('platform.company.edit', $company);
            }),
            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
        ];
    }
}
