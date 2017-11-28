<?php

namespace OrderSystem\Framework\Persistence\Adapters;

interface AdapterInterface
{
    public function get(string $id);

    public function getAll(): array;

    public function set(string $id, $value): void;

    public function has(string $id): bool;

    public function delete(string $id): void;
}