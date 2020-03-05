<?php
/**
 * Xaman - Estrutura de Desenvolvimento
 * Copyright (C) 2008  Ivan Ogassavara  
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   persistencia
 * @package    xaman
 * @subpackage xaman.persistencia
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

include_once $XAMAN .'persistencia/intermediario/MSSQL.php';
include_once $XAMAN .'persistencia/intermediario/MySQL.php';
include_once $XAMAN .'persistencia/intermediario/PSQL.php';

/**
 * IntermediarioPersistenciaXmn: Classe Controladora do Tempo
 * 
 * A classe IntermediarioPersistenciaXmn tem como objetivo
 * intermediar as requisi��es aos SGBD's para que o utilizador n�o
 * tenha que saber quais m�todos ser�o utilizados
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   persistencia
 * @package    xaman.persistencia
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 * @static
 */
class IntermediarioPrstXmn
{
    private $parametro = array();
    private $sentenca;
    
    public function __construct($sentencaPreparada = '')
    {
        $this->sentenca = $sentencaPreparada;
    }
    
    public function executa($sentenca = null)
    {
        if ($sentenca == null) {
            $sentenca = $this->pegaSolicitacao();
        }

        try { 
            
            return call_user_func_array(
                array(ConexaoXmn::$conexaoXMdl->pegaSGBD(), 'executa'), 
                array($sentenca));
        } catch (TratamentoPrstXmn $tratPrstXmn) {
            return false;
        }        
    }

    public function insere($sentenca = null)
    {
        if ($sentenca == null) {
            $sentenca = $this->pegaSolicitacao();
        }

        try { 
            return call_user_func_array(
                array(ConexaoXmn::$conexaoXMdl->pegaSGBD(), 'insere'), 
                array($sentenca));
                
        } catch (TratamentoPrstXmn $tratPrstXmn) {
            throw $tratPrstXmn;
        }
    }
        
    public function consulta($sentenca = null)
    {
        if ($sentenca == null) {
            $sentenca = $this->pegaSolicitacao();
        }
        
        try {
            $consulta = call_user_func_array(
                array(ConexaoXmn::$conexaoXMdl->pegaSGBD(), 'consulta'), 
                array($sentenca));
                
            if (!is_array($consulta)) {
                $consulta = array($consulta);
            }
            
            switch (ConexaoXmn::$formato['saida']) {
            case 'latin-1->utf-8':
                foreach ($consulta as $chaveLinha => $conteudoLinha) {
                    foreach ($conteudoLinha as $chaveValor => $conteudo) {
                        $consulta[$chaveLinha][$chaveValor] = utf8_encode($conteudo);
                    }
                }
                break;
            }
            reset($consulta);
            return $consulta;
        } catch (TratamentoPrstXmn $tratPrstXmn) {
            return false;
        }
    }
    
    public function pegaSolicitacao()
    {
        $preparedStatement = explode('?', $this->sentenca);
        
        $sentenca = '';
        
        foreach ($preparedStatement as $key => $value) {
            $sentenca.= $value;
            @$sentenca.= $this->parametro[$key];
        }
        return $sentenca;
    }
    
    public function atribuiBinario($indice = 0, $valor = '', 
        $valorPadrao = "NULL")
    {
        if ($valor == '') {
            $valor = $valorPadrao;
        }else{
            $valor = "'" . addslashes($valor) . "'";
        }
        $this->atribuiParametro($indice, $valor);
    }
    
    public function atribuiInteiro($indice = 0, $valor = '', $valorPadrao = 0)
    {
        if ($valor == '') {
            $valor = $valorPadrao;
        }else{
            $valor = (int) $valor;
        }
        
        $this->atribuiParametro($indice, $valor);
    }
    
    public function atribuiVetorInteiro($indice = 0, $lista = array(), 
        $valorPadrao = 0)
    {
        $valor = '';
        if (count($lista) == 0) {
            $valor = $valorPadrao;
        }else{
            foreach ($lista as $key => $value) {
                if ($valor != '') {
                    $valor.= ',';
                }
                $valor.= (int) $value;
            }
            
        }
        
        $this->atribuiParametro($indice, $valor);
    }
    
    public function atribuiParametro($indice = 0, $valor = '')
    {
        $this->parametro[--$indice] = $valor;
    }
    
    public function atribuiTexto($indice = 0, $valor = '', $valorPadrao = "''")
    {
        switch (ConexaoXmn::$formato['entrada']) {
        case 'utf-8->latin-1':
            $valor = utf8_decode($valor);
            break;
        }
        
        if ($valor == '') {
            $valor = $valorPadrao;
        }else{
            $valor = "'".str_replace("'", "''", $valor)."'";
        }
        
        $this->atribuiParametro($indice, $valor);
    }
        
    public function atribuiVetorTexto($indice = 0, $lista = array(), 
        $valorPadrao = "''")
    {
        $valor = '';
        if (count($lista) == 0) {
            $valor = $valorPadrao;
        }else{
            foreach ($lista as $key => $conteudo) {
                if ($valor != '') {
                    $valor.= ',';
                }
                
                switch (ConexaoXmn::$formato['entrada']) {
                case 'utf-8->latin-1':
                    $conteudo = utf8_decode($conteudo);
                    break;
                }
                
                $valor.= "'".str_replace("'", "''", $conteudo)."'";
            }
            
        }
        
        $this->atribuiParametro($indice, $valor);
    }

    public function pegaErro()
    {
        try { 
            return call_user_func_array(
                array(ConexaoXmn::$conexaoXMdl->pegaSGBD(), "pegaErro"), 
                array());
        } catch (TratamentoPrstXmn $tratPrstXmn) {
            return false;
        }
    }
    
    public function pegaInfoTransacao()
    {
        try { 
            return call_user_func_array(
                array(ConexaoXmn::$conexaoXMdl->pegaSGBD(), 
                    "pegaInfoTransacao"), 
                array());
        } catch (TratamentoPrstXmn $tratPrstXmn) {
            throw $tratPrstXmn;
        }
    }
    
    public function pegaNumLinhasAfetadas()
    {
        try { 
            return call_user_func_array(
                array(ConexaoXmn::$conexaoXMdl->pegaSGBD(), 
                    "pegaNumLinhasAfetadas"), 
                array());
        } catch (TratamentoPrstXmn $tratPrstXmn) {
            throw $tratPrstXmn;
        }
    }
}