<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../src/libs/Carrinho.php";

class CarrinhoTest extends TestCase
{
    public function testAdicionarProduto()
    {
        $carrinho = new Carrinho("Igor");
        $carrinho->adicionarProduto("Notebook", 2, 1000);

        $itens = $carrinho->getItens();

        $this->assertArrayHasKey("Notebook", $itens);
        $this->assertEquals(2, $itens["Notebook"]["quantidade"]);
        $this->assertEquals(2000, $carrinho->getTotal());
    }
}