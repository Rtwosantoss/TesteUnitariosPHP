<?php

class Carrinho
{
    public string $Cliente;
    public array $Itens = [];
    public float $Total = 0;

    public function __construct($cliente)
    {

        $this->setCliente($cliente);
    }

    public function getCliente()
    {
        return $this->Cliente;
    }

    public function setCliente($Cliente)
    {
        $this->Cliente = $Cliente;

    }

    public function getItens()
    {
        return $this->Itens;
    }


    public function getTotal()
    {
        return $this->Total;
    }

    public function setTotal($Total)
    {
        $this->Total = $Total;
    }

    public function adicionarProduto($produto, $quantidade, $valorUnitario): void
    {
        if (isset($this->Itens[$produto])) {
            $quantidade = $this->Itens[$produto] += $quantidade;
        } else {
            $this->Itens[$produto] = [
                'nome' => $produto,
                'quantidade' => $quantidade,
                'valorUnitario' => $valorUnitario
            ];
            $this->calcularTotal();
        }
    }

    public function removerProduto($produto)
    {
        if (isset($this->Itens[$produto])) {
            unset($this->Itens[$produto]);
            $this->calcularTotal();
        }
    }

    public function calcularTotal()
    {
        $this->setTotal(0);

        foreach ($this->Itens as $item) {
            $this->Total += $item['valorUnitario'] * $item['quantidade'];
        }

        return $this->Total;
    }

    public function aplicarDesconto($percentual)
    {
        if ($percentual >= 0 && $percentual <= 100) {
            $novoTotal = $this->getTotal() * ((100 - $percentual) / 100);
            $this->setTotal($novoTotal);
        }
    }

    public function getProdutos()
    {
        echo "PRODUTOS";
        foreach ($this->Itens as $item) {
            echo "Nome - " . $item['nome'] . "<br>";
            echo "Quantidade - " . $item['quantidade'] . "<br>";
            echo "valorUnitario - " . $item['valorUnitario'] . "<br>";
            echo "Total produto - " . $item['quantidade'] * $item['valorUnitario'] . "<br>";
        }

    }
}