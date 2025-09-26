<?php

use PHPUnit\Framework\TestCase;
use App\Dado;

class DadoTest extends TestCase
{

    public function testResultadoDentroDointervalo()
    {
        $dado = new Dado(6);
        for($i = 0; $i < 10; $i++)
        {
            $resultado = $dado->jogar();
            $this->assertGreaterThanOrEqual(1, $resultado);
            $this->assertLessThanOrEqual(6, $resultado); 
         }
    }

    public function testDadoLadosDiferentes()
    {
        foreach([6,10,20] as $lados)
        {
            $dado = new Dado($lados);
            $resultado = $dado->jogar();
            $this->assertGreaterThanOrEqual(1, $resultado);
            $this->assertLessThanOrEqual($lados, $resultado); 
        }
    }

    public function testResultadosVariam()
    {
        $dado = new Dado(6);
        $resultado = [];

        for($i = 0; $i < 10; $i++)
        {
            $resultado [] = $dado->jogar();            
        }
        $this->assertGreaterThan(1, count(array_unique($resultado)), "Todos os resultados foram iguais.");
    }

    public function testHistoricoFunciona()
    {
        $dado = new Dado(6);
        $dado->jogar();
        $dado->jogar();
        $historico = $dado->getHistorico();

        $this->assertCount(2, $historico);
        foreach ($historico as $registro) {
            $this->assertArrayHasKey('valor', $registro);
            $this->assertArrayHasKey('data', $registro);
            $this->assertInstanceOf(\DateTime::class, $registro['data']);
        }
    }
}