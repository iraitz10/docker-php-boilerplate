<?php

namespace Deg540\DockerPHPBoilerplate\Test;

use PHPUnit\Framework\TestCase;
use Deg540\DockerPHPBoilerplate\ShoppingList;

class ShoppingListTest extends TestCase
{
    private ShoppingList $list;

    protected function setUp(): void {
        $this->list = new ShoppingList();
    }

    /**
     * @test
     */
    public function givenItemAddToList(): void {
        $this->assertEquals("pan x1", $this->list->process("añadir pan"));
        $this->assertEquals("leche x2, pan x1", $this->list->process("añadir leche 2"));
        $this->assertEquals("leche x2, pan x3", $this->list->process("añadir Pan 2"));
    }

    /**
     * @test
     */
    public function givenItemRemoveFromList(): void {
        $this->list->process("añadir pan");
        $this->list->process("añadir leche 2");
        $this->assertEquals("El producto seleccionado no existe", $this->list->process("eliminar arroz"));
        $this->assertEquals("leche x2", $this->list->process("eliminar pan"));
    }
}