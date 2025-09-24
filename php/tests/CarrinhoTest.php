<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../src/libs/Carrinho.php";

class CarrinhoTest extends TestCase
{
    public function testAdicionarProduto()
    {
        $carrinho = new Carrinho("Igor");
        $carrinho->adicionarProduto("Notebook", 2, 1000);

        $itens = $carrinho->getProdutos();

        $this->assertCount(1, $itens);
        $this->assertEquals("Notebook", $itens[0]["nome"]);
        $this->assertEquals(2, $itens[0]["quantidade"]);
        $this->assertEquals(1000, $itens[0]["valorUnitario"]);

        $this->assertEquals(2000, $carrinho->getTotal());
    }

    public function testAdicionarProdutoQuantidadeNegativa()
    {
        $carrinho = new Carrinho("Igor");
        $carrinho->adicionarProduto("Notebook", -2, 1000);

        $itens = $carrinho->getProdutos();

        $this->assertCount(0, $itens);
    }

    public function testAdicionarProdutoDuasVezes()
    {
        $carrinho = new Carrinho("Igor");
        $carrinho->adicionarProduto("Notebook", 2, 1000);
        $carrinho->adicionarProduto("Notebook", 3, 1000);

        $itens = $carrinho->getProdutos();

        $this->assertCount(1, $itens);
        $this->assertEquals(5, $itens[0]["quantidade"]);
        $this->assertEquals(1000, $itens[0]["valorUnitario"]);

        $this->assertEquals(5000, $carrinho->getTotal());
    }

    public function testRemoverProdutoExistente()
    {
        $carrinho = new Carrinho("Igor");

        $carrinho->adicionarProduto("Notebook", 2, valorUnitario: 1000);

        $carrinho->adicionarProduto("Mouse", 2, 50);


        $carrinho->removerProduto("Notebook");

        $itens = $carrinho->getProdutos();

        $this->assertCount(1, $itens);
        $this->assertEquals("Mouse", $itens[0]["nome"]);
        $this->assertEquals(2, $itens[0]["quantidade"]);
        $this->assertEquals(50, $itens[0]["valorUnitario"]);

        $this->assertEquals(100, $carrinho->getTotal());
    }

    public function testRemoverProdutoInexistente()
    {
        $carrinho = new Carrinho("Igor");

        $carrinho->adicionarProduto("Notebook", 2, 1000);

        $carrinho->adicionarProduto("Mouse", 2, 50);


        $carrinho->removerProduto("Teclado");

        $itens = $carrinho->getProdutos();

        $this->assertCount(2, $itens);
        $this->assertEquals("Notebook", $itens[0]["nome"]);
        $this->assertEquals("2", $itens[0]["quantidade"]);
        $this->assertEquals(1000, $itens[0]["valorUnitario"]);

        $this->assertEquals("Mouse", $itens[1]["nome"]);
        $this->assertEquals("2", $itens[1]["quantidade"]);
        $this->assertEquals(50, $itens[1]["valorUnitario"]);


        $this->assertEquals(2100, $carrinho->getTotal());
    }

    public function testTotalCarrinhoVazio()
    {
        $carrinho = new Carrinho("Igor");

        $itens = $carrinho->getProdutos();

        $this->assertEquals(0, $carrinho->getTotal());
    }

    public function testAplicarDescontoValido()
    {
        $carrinho = new Carrinho("Igor");

        $carrinho->adicionarProduto("Notebook", 2, 1000);

        $carrinho->aplicarDesconto(50);

        $itens = $carrinho->getProdutos();

        $this->assertCount(1, $itens);
        $this->assertEquals("Notebook", $itens[0]["nome"]);
        $this->assertEquals(2, $itens[0]["quantidade"]);
        $this->assertEquals(1000, $itens[0]["valorUnitario"]);
        $this->assertEquals(1000, $carrinho->getTotal());
    }

    public function testAplicarDescontoInvalidoAcimaDe100()
    {
        $carrinho = new Carrinho("Igor");

        $carrinho->adicionarProduto("Notebook", 2, 1000);

        $carrinho->aplicarDesconto(500);

        $itens = $carrinho->getProdutos();

        $this->assertCount(1, $itens);
        $this->assertEquals("Notebook", $itens[0]["nome"]);
        $this->assertEquals(2, $itens[0]["quantidade"]);
        $this->assertEquals(1000, $itens[0]["valorUnitario"]);
        $this->assertEquals(2000, $carrinho->getTotal());
    }

    public function testAplicarDescontoInvalidoAbaixoDe0()
    {
        $carrinho = new Carrinho("Igor");

        $carrinho->adicionarProduto("Notebook", 2, 1000);

        $carrinho->aplicarDesconto(-10);

        $itens = $carrinho->getProdutos();

        $this->assertCount(1, $itens);
        $this->assertEquals("Notebook", $itens[0]["nome"]);
        $this->assertEquals(2, $itens[0]["quantidade"]);
        $this->assertEquals(1000, $itens[0]["valorUnitario"]);
        $this->assertEquals(2000, $carrinho->getTotal());
    }
}