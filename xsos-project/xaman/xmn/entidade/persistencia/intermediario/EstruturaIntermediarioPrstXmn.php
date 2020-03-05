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

include_once $XAMAN . 'tratamento/TratamentoPrstXmn.php';
include_once $XAMAN . 'persistencia/modelo/ConexaoXMdl.php';

/**
 * EstruturaIntermediarioPrstXaman: Interface para intermedi�rios 
 * de persist�ncia
 * 
 * A interface EstruturaIntermediarioPrstXaman tem como objetivo
 * promover a estrutura b�sica para acesso aos intermedi�rios
 * de persist�ncia de dados
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
interface EstruturaIntermediarioPrstXmn
{
    public static function abreBaseDeDados($nomeBanco);
    public static function conecta(ConexaoXMdl $conexaoModelo);
    public static function consulta($consulta);
    public static function desconecta();
    public static function executa($consulta);
    public static function insere($sentenca);
    public static function pconecta(ConexaoXMdl $conexaoModelo);
    public static function pegaErro();
    public static function pegaInfoTransacao();
    public static function pegaNumLinhasAfetadas();
}
