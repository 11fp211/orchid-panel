<?php

namespace App\Orchid\Screens;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class CompanyEditScreen extends Screen
{

    public $company;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Company $company): iterable
    {
        return [
            'company' => $company
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */

    public function name(): ?string
    {
        return $this->company->exists ? 'Edit company' : 'Creating a new company';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Companies";
    }


    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create company')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->company->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->company->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->company->exists),
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
            Layout::rows([
                Input::make('company.name')
                    ->title('Name')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive name for this company.')
                    ->required(),

                Input::make('company.email')
                    ->type('email')
                    ->title('Email')
                    ->placeholder('Attractive but mysterious email')
                    ->required(),

                Picture::make('company.logo')
                    ->minWidth(100)
                    ->minHeight(100)
                    ->required(),

                Input::make('company.website')
                    ->type('url')
                    ->title('Website')
                    ->placeholder('Attractive but mysterious website url')
                    ->required(),
            ])
        ];
    }

     /**
     * @param Post    $post
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Company $company, Request $request)
    {
        $company->fill($request->get('company'))->save();

        Alert::info('You have successfully created a company.');

        return redirect()->route('platform.company.list');
    }

    /**
     * @param Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */

    public function remove(Company $company)
    {
        $company->delete();

        Alert::info('You have successfully deleted the company.');

        return redirect()->route('platform.company.list');
    }
}
