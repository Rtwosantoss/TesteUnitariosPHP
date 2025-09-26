<?php

namespace App;

use InvalidArgumentException;

class Dado
{
    private int $lados;
    private array $historico = [];

    public function __construct(int $lados, array $historico = [])
    {
        if ($lados < 1) {
            throw new InvalidArgumentException("Os lados devem ser maiores que 0");
        }

        $this->lados = $lados;
        $this->historico = $historico;
    }

    public function jogar(): int
    {
        $resultado = rand(1, $this->lados);
        $this->historico[] = [
            'valor' => $resultado,
            'data' => new \DateTime()
        ];
        return $resultado;
    }

    public function adicionarHistorico($valor): void
    {
        $this->historico[] = [
            'valor' => $valor,
            'data' => new \DateTime()
        ];
    }

    public function getHistorico(): array
    {
        return $this->historico;
    }
}
