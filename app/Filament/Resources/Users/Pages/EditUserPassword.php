<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\Schemas\UserPasswordForm;
use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;

class EditUserPassword extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected ?string $heading = 'Edit password';

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    public function form(Schema $schema): Schema
    {
        return UserPasswordForm::configure($schema);
    }
}
