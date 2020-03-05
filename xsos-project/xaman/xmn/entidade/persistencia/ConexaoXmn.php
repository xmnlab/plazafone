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

include_once $XAMAN . 'persistencia/modelo/ConexaoXMdl.php';
include_once $XAMAN . 'persistencia/intermediario/MSSQL.php';
include_once $XAMAN . 'persistencia/intermediario/MySQL.php';
include_once $XAMAN . 'persistencia/intermediario/PSQL.php';
include_once $XAMAN . 'tratamento/TratamentoPrstXmn.php';

/**
 * ConexaoXaman: Classe Controladora do Tempo
 * 
 * A classe TempoXaman tem como int�ito permitir m�todos que trabalhem com 
 * conexao em SGBD's
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
class ConexaoXmn
{
    public static $conexao;
    public static $baseDados;
    public static $conexaoXMdl;
    public static $estado = false;
    public static $formato   = array('entada' => '', 'saida' => '');
    
    public static function conecta(SimpleXMLElement $prstXml, $conexao_nome)
    {
        self::$conexaoXMdl  = new ConexaoXMdl();
        self::$estado       = false;
        
        $prst               = $prstXml->xpath('/persistencia/conexao');
        
        foreach ($prst as $chave => $conteudo)
        {
            $atributo = $conteudo->attributes();
            
            if ($atributo['nome'] == $conexao_nome) {
                
                $tmp = (string) $atributo['sgbd'];
                self::$conexaoXMdl->atribuiSGBD($tmp);
                
                $tmp = (string) $atributo['servidor'];
                self::$conexaoXMdl->atribuiServidor($tmp);
                
                $tmp = (string) $atributo['usuario'];
                self::$conexaoXMdl->atribuiUsuario($tmp);
                
                $tmp = (string) $atributo['senha'];
                self::$conexaoXMdl->atribuiSenha($tmp);
                
                $tmp = (string) $atributo['banco'];
                self::$conexaoXMdl->atribuiBanco($tmp);
                
                $tmp = (string) $atributo['medtodo_conexao'];
                $persistente = $tmp;
                
                unset($tmp);
                
                self::$estado = true;
            }
        }
        
        if (self::$estado == false)
        {
            $tratPrstXmn = new TratamentoPrstXmn(debug_backtrace());
            $tratPrstXmn->atribuiArquetipo('FALHA_CONEXAO');
            $tratPrstXmn->atribuiCodigo('CONEXAO_NAO_ENCONTRADA');
            throw $tratPrstXmn;
        }
        
        if ($persistente == 'persistente') {
            $metodo = 'pconecta';
        } else {
            $metodo = 'conecta';
        }

        try {
            self::$estado = false;
            
            self::$conexao = call_user_func_array(
                array(self::$conexaoXMdl->pegaSGBD(), $metodo),
                array(self::$conexaoXMdl));
                
        } catch (TratamentoPrstXmn $tratPrstXmn) {
            
            if (class_exists(self::$conexaoXMdl->pegaSGBD())) {
                $tratPrstXmn = new TratamentoPrstXmn();
                $tratPrstXmn->atribuiArquetipo('FALHA_CONEXAO');
                $tratPrstXmn->atribuiCodigo(call_user_func_array(
                    array(self::$conexaoXMdl->pegaSGBD(), 'pegaErro'), 
                    array()));
                
            } else {
                $tratPrstXmn = new TratamentoPrstXmn(debug_backtrace());
                $tratPrstXmn->atribuiArquetipo('SGBD_NAO_REGISTRADO');
                $tratPrstXmn->atribuiCodigo(
                    'SGBD_INFORMADO_NAO_PERTENCE_A_LISTA_DE_SGBDS_AUTORIZADOS');
            }
            
            throw $tratPrstXmn;
        }

        self::$estado = true;
        
        if (self::$conexaoXMdl->pegaBanco() != '') {
            self::abreBaseDeDados(self::$conexaoXMdl->pegaBanco());
        } 
    }
    
    public static function abreBaseDeDados($dbName = '')
    {
        try {            
            self::$baseDados = call_user_func_array(
                array(self::$conexaoXMdl->pegaSGBD(), 'abreBaseDeDados'), 
                array($dbName));
                
        } catch (TratamentoPrstXmn $tratPrstXmn) {
            
            if (!class_exists(self::$conexaoXMdl->pegaSGBD())) {
                $tratPrstXmn = new TratamentoPrstXmn(debug_backtrace());
                $tratPrstXmn->atribuiArquetipo('FALHA_SELECAO_BANCO');
                $tratPrstXmn->atribuiCodigo(call_user_func_array(
                    array(self::$conexaoXMdl->pegaSGBD(), 'requestError'), 
                    array()));
                    
            } else {
                $tratPrstXmn = new TratamentoPrstXmn(debug_backtrace());
                $tratPrstXmn->atribuiArquetipo('SGBD_NAO_REGISTRADO');
                $tratPrstXmn->atribuiCodigo(
                    'SGBD_INFORMADO_NAO_PERTENCE_A_LISTA_DE_SGBDS_AUTORIZADOS');
            }
            
            self::$conexaoXMdl->atribuiBanco('');
            throw $tratPrstXmn;
        }
        self::$conexaoXMdl->atribuiBanco($dbName);
    }
    public static function pegaConexao()
    {
        return self::$conexao;
    }
}
