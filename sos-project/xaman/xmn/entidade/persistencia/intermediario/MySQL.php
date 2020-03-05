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

include_once $XAMAN 
    . 'persistencia/intermediario/EstruturaIntermediarioPrstXmn.php';

/**
 * MySQL: Classe de persist�ncia do SGBD MySQL
 * 
 * A classe MySQL tem como objetivo promover os m�todos para
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
class MySQL implements EstruturaIntermediarioPrstXmn
{
        
    public static function conecta(ConexaoXMdl $conexaoXMdl)
    {
        $conexao = null;
        if(!$conexao = mysql_connect($conexaoXMdl->pegaServidor(), 
            $conexaoXMdl->pegaUsuario(),
            $conexaoXMdl->pegaSenha())) {

            $tratamentoPrstXmn = new TratamentoPrstXmn();
            $tratamentoPrstXmn->atribuiCodigo('SQL_CONEXAO_SERVIDOR');
            $tratamentoPrstXmn->atribuiArquetipo('SQL');
            throw $tratamentoPrstXmn;
        }
        return $conexao;
    }
    
    public static function pconecta(ConexaoXMdl $conexaoXMdl)
    {
        $conexao = null;
        
        if(!$conexao = @mysql_pconnect($conexaoXMdl->pegaServidor(),
            $conexaoXMdl->pegaUsuario(),
            $conexaoXMdl->pegaSenha())) {

            $tratamentoPrstXmn = new TratamentoPrstXmn();
            $tratamentoPrstXmn->atribuiArquetipo('SQL');
            $tratamentoPrstXmn->atribuiCodigo('SQL_PCONEXAO_SERVIDOR');
            throw $tratamentoPrstXmn;
        }
        return $conexao;
    }
    
    public static function desconecta()
    {
        mysql_close(ConexaoXmn::$conexao);
    }
    
    public static function abreBaseDeDados($nomeBanco)
    {
        $banco = null;
        if (!$banco = mysql_select_db($nomeBanco, ConexaoXmn::$conexao)) {
            $tratamentoPrstXmn = new TratamentoPrstXmn();
            $tratamentoPrstXmn->atribuiArquetipo('SQL');
            $tratamentoPrstXmn->atribuiCodigo('ERRO_CONEXAO_DB');
            throw $tratamentoPrstXmn;
        }
        return $banco;
    }
        
    public static function consulta($consulta)
    {
        if(@$resultadoIntermediario = mysql_query($consulta)) {
            if (is_bool($resultadoIntermediario)) {
                return $resultadoIntermediario;
            } else if (@mysql_num_rows($resultadoIntermediario) > 0) {
                $resultado = array();
                while ($registro = mysql_fetch_assoc($resultadoIntermediario)) {
                    $resultado[] = $registro; 
                }
                return $resultado;
            } else {
                return array();
            }
        }else{
            return false;
        }
    }
    
    public static function executa($consulta)
    {
        if(@$resultado = mysql_query($consulta)) {
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
        if(@$resultado = mysql_query($sentenca)) {
            return mysql_insert_id();
        } else {
            throw new TratamentoPrstXmn();
        }
    }

    public static function pegaErro()
    {
        return mysql_error();
    }
    
    public static function pegaInfoTransacao()
    {
        return mysql_info();
    }
    
    public static function pegaNumLinhasAfetadas()
    {
        return mysql_affected_rows();
    }
}
