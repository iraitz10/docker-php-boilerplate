<?php

namespace Deg540\DockerPHPBoilerplate;

class ShoppingList
{
    private array $items = [];
    public function process(string $instruction): string
    {
        $parts = explode(' ', trim($instruction));
        if (empty($parts)) return $this->formatList();

        $command = strtolower(array_shift($parts));

        if ($command === 'añadir') {
            $this->addItem($parts);
        }

        return $this->formatList();
    }

    private function addItem(array $parts): void
    {
        if (empty($parts)) return;

        $name = strtolower($parts[0]);
        $quantity = isset($parts[1]) && is_numeric($parts[1]) ? (int) $parts[1] : 1;

        $this->items[$name] = ($this->items[$name] ?? 0) + $quantity;
    }

    private function formatList(): string
    {
        if (!$this->items) return "";

        uksort($this->items, 'strcasecmp');
        return implode(", ", array_map(fn($name, $quantity) => "$name x$quantity", array_keys($this->items), $this->items));
    }
}