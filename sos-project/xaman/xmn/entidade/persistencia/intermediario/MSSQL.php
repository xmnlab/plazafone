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
 * @package    xaman.persistencia
 * @subpackage xaman.persistencia.intermediario
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

include_once $XAMAN . 'persistencia/intermediario/EstruturaIntermediarioPrstXmn.php';

/**
 * MSSQL: Classe de persist�ncia do SGBD SQL Server
 * 
 * A classe MSSQL tem como objetivo promover os m�todos para
 * a classe IntermediarioPersistenciaXmn
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
class MSSQL implements EstruturaIntermediarioPrstXmn
{
    public static function conecta(ConexaoXMdl $conexaoModelo)
    {
        $conexao = null;

        if(!$conexao = mssql_connect($conexaoModelo->getServidor(), $conexaoModelo->getUsuario(),
            $conexaoModelo->getSenha())) {

            $tratamentoPrstXmn = new TratamentoPrstXmn();
            $tratamentoPrstXmn->atribuiCodigo('SQL_CONEXAO_SERVIDOR');
            $tratamentoPrstXmn->atribuiArquetipo('SQL');
            throw $tratamentoPrstXmn;
        } else if ($conexaoModelo->getBanco() != '') {
            if (@!$banco = mssql_select_db($conexaoModelo->getBanco(), $conexao)) {
                $tratamentoPrstXmn = new TratamentoPrstXmn();
                $tratamentoPrstXmn->atribuiCodigo('SQL_CONEXAO_DB');
                $tratamentoPrstXmn->atribuiArquetipo('SQL');
                throw $tratamentoPrstXmn;
            }
        }

        return $conexao;
    }
    
    public static function pconecta(ConexaoXMdl $conexaoModelo)
    {
        $conexao = null;

        if(@!$conexao = mssql_pconnect($conexaoModelo->getServidor(), $conexaoModelo->getUsuario(),
            $conexaoModelo->getSenha())) {

            $tratamentoPrstXmn = new TratamentoPrstXmn();
            $tratamentoPrstXmn->atribuiArquetipo('SQL');
            $tratamentoPrstXmn->atribuiCodigo('SQL_PCONEXAO_SERVIDOR');
            throw $tratamentoPrstXmn;
        } else if ($conexaoModelo->getBanco() != '') {
            if (@!$banco = mssql_select_db($conexaoModelo->getBanco(), $conexao)){
                $tratamentoPrstXmn = new TratamentoPrstXmn();
                $tratamentoPrstXmn->atribuiArquetipo('SQL');
                $tratamentoPrstXmn->atribuiCodigo('SQL_CONEXAO_DB');
                throw $tratamentoPrstXmn;
            }
        }
        
        return $conexao;
    }
    
    public static function desconecta()
    {
        mssql_close(ConexaoXmn::$conexao);
    }
    
    public static function abreBaseDeDados($stringBanco)
    {
        if (@!$banco = mssql_select_db($stringBanco, $conexao)) {
            $tratamentoPrstXmn = new TratamentoPrstXmn();
            $tratamentoPrstXmn->atribuiArquetipo('SQL');
            $tratamentoPrstXmn->atribuiCodigo('ERRO_CONEXAO_DB');
            throw $tratamentoPrstXmn;
        }
    }
    
    public static function consulta($query){
        if (@$resultadoIntermediario = mssql_query($query)) {
            if (@mssql_num_rows($resultadoIntermediario) > 0){
                $resultado = array();
                while ($registro = mssql_fetch_assoc($resultadoIntermediario)) {
                    $resultado[] = $registro; 
                }
                return $resultado;
            } else {
                return array();
            }
        } else {
            return false;
        }
    }
    
    public static function executa($consulta)
    {
        if(@$resultado = mssql_query($consulta)) {
            if (is_bool($resultado)) {
                return $resultado;
            } else {
                return true;
            }
        }else{
            return false;
        }
    }

    public static function insere($sentenca)
    {
        if(@$resultado = mssql_query($sentenca)) {
            $id = '';

            $resultado = mssql_query('SELECT @@identity AS id');
            if ($linha = mssql_fetch_row($resultado)) {
                $id = trim($linha[0]);
            }

            mssql_free_result($resultado);
        
            return $id;
        }else{
            return false;
        }
    }
    
    public static function pegaErro()
    {
        //fun��o n�o implementada
        return '';
    }

    public static function pegaInfoTransacao()
    {
        return mssql_get_last_message();
    }

    public static function pegaNumLinhasAfetadas()
    {
        $result = mssql_query('SELECT @@ROWCOUNT');
         list($affected) = mssql_fetch_row($result);

         return $affected;
    }
}
