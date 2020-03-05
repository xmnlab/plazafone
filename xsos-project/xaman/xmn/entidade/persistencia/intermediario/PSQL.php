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
 * PSQL: Classe de persist�ncia do SGBD PosgreSQL
 * 
 * A classe PSQL tem como objetivo promover os m�todos para
 * a classe IntermediarioPersistenciaXaman
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
class PSQL implements EstruturaIntermediarioPrstXmn
{

    public static function conecta(ConexaoXMdl $conexaoModelo)
    {
        $textoConexao = '';
        $textoConexao.= $conexaoModelo->pegaServidor() != '' ? 
            ' host='     . $conexaoModelo->pegaServidor()  : '';
        $textoConexao.= $conexaoModelo->pegaUsuario()  != '' ? 
            ' user='     . $conexaoModelo->pegaUsuario()   : '';
        $textoConexao.= $conexaoModelo->pegaSenha()    != '' ? 
            ' password=' . $conexaoModelo->pegaSenha() : '';
        $textoConexao.= $conexaoModelo->pegaBanco()    != '' ? 
            ' dbname='   . $conexaoModelo->pegaBanco()   : '';

        $conexao = null;
        
        if(!@$conexao = pg_connect($textoConexao)){
            $tratamentoPrstXmn = new TratamentoPrstXmn();
            $tratamentoPrstXmn->atribuiCodigo('SQL_CONEXAO_SERVIDOR');
            $tratamentoPrstXmn->atribuiArquetipo('SQL_CONEXAO');
            throw $tratamentoPrstXmn;
        }
        return $conexao;
    }
    
    public static function pconecta(ConexaoXMdl $conexaoModelo)
    {
        $textoConexao = '';
        $textoConexao.= $conexaoModelo->pegaServidor() != '' ? 
            ' host='     . $conexaoModelo->pegaServidor() : '';
        $textoConexao.= $conexaoModelo->pegaUsuario()  != '' ? 
            ' user='     . $conexaoModelo->pegaUsuario()  : '';
        $textoConexao.= $conexaoModelo->pegaSenha()    != '' ? 
            ' password=' . $conexaoModelo->pegaSenha()    : '';
        $textoConexao.= $conexaoModelo->pegaBanco()    != '' ? 
            ' dbname='   . $conexaoModelo->pegaBanco()    : '';
        
        $conexao = null;
        
        if(!$conexao = pg_pconnect($textoConexao)){
            $tratamentoPrstXmn = new TratamentoPrstXmn();
            $tratamentoPrstXmn->atribuiArquetipo('SQL');
            $tratamentoPrstXmn->atribuiCodigo('SQL_PCONEXAO_SERVIDOR');
            throw $tratamentoPrstXmn;
        }
        return $conexao;
    }
    
    public static function desconecta()
    {
        pg_close(ConexaoXmn::$conexao);
    }
    
    public static function abreBaseDeDados($nomeBanco)
    {
        //Função não implementada
    }
        
    public static function consulta($consulta)
    {
        if(@$resultadoIntermediario = pg_query($consulta)) {
            if (is_bool($resultadoIntermediario)){
                return $resultadoIntermediario;
            } else if (@pg_num_rows($resultadoIntermediario) > 0) {
                $resultado = array();
                while ($registro = pg_fetch_assoc($resultadoIntermediario)) {
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
        if(@$resultado = pg_query($consulta)) {
            if (is_bool($resultado)) {
                return $resultado;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public static function insere($sentenca)
    {
        @pg_query('BEGIN TRANSACTION');
        $sentenca = explode(';', $sentenca);

        if(@pg_query($sentenca[0])) {
            @$resultado = pg_query($sentenca[1]);
            @$registro  = pg_fetch_assoc($resultado);
            @pg_free_result($resultado);
            @pg_query('COMMIT TRANSACTION');
            return $registro['seq'];
        } else {
            pg_query('ROLLBACK');
            return false;
        }
    }

    public static function pegaErro()
    {
        return @pg_last_error(ConexaoXmn::$conexao);
    }
    
    public static function pegaInfoTransacao()
    {
        return @pg_get_notify(ConexaoXmn::$conexao);
    }
    
    public static function pegaNumLinhasAfetadas()
    {
        return @pg_affected_rows();
    }
}
