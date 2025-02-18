<?php

namespace GIS\EditableBlocks\Interfaces;

interface SimpleItemActionsInterface
{
    public function rules(): array;
    public function validationAttributes(): array;
    public function closeData(): void;
    public function showCreate(): void;
    public function store(): void;
    public function showEdit(int $id): void;
    public function update(): void;
}
