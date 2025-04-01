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

        if ($command === 'añadir')
            $this->addItem($parts);

        elseif ($command === 'eliminar')
            return $this->removeItem($parts);

        elseif ($command === 'vaciar')
            $this->clearList();
        
        return $this->formatList();
    }

    private function addItem(array $parts): void
    {
        if (empty($parts)) return;

        $name = strtolower($parts[0]);
        $cantidad = isset($parts[1]) && is_numeric($parts[1]) ? (int) $parts[1] : 1;

        $this->items[$name] = ($this->items[$name] ?? 0) + $cantidad;
    }

    private function removeItem(array $parts): string
    {
        if (empty($parts)) return $this->formatList();
        $name = strtolower($parts[0]);
        if (isset($this->items[$name]))
        {
            unset($this->items[$name]);
            return $this->formatList();
        }
        return "El producto seleccionado no existe";
    }

    private function clearList(): void
    {
        $this->items = [];
    }

    private function formatList(): string
    {
        if (!$this->items) return "";

        uksort($this->items, 'strcasecmp');
        return implode(", ", array_map(fn($name, $cantidad) => "$name x$cantidad", array_keys($this->items), $this->items));
    }
}