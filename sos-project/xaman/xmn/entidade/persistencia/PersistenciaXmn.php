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
include_once $XAMAN . 'arquetipo/DataHoraArquetipoXmn.php';
include_once $XAMAN . 'persistencia/ConexaoXmn.php';
include_once $XAMAN . 'persistencia/IntermediarioPrstXmn.php';
include_once $XAMAN . 'persistencia/EstruturaPrstXmn.php';
include_once $XAMAN . 'tratamento/TratamentoPrstXmn.php';

/**
 * PersistenciaXaman: Classe Controladora do Tempo
 * 
 * A classe PersistenciaXaman tem como objetivo promover recursos comuns 
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
 * @abastract
 */
abstract class PersistenciaXmn
{
    abstract protected static function inicia();
    
    protected static function consultaModeloXmn(
        $entidadeName = __CLASS__, 
        ModeloXmn $modelo, 
        IntermediarioPrstXmn $iprst)
    {
        try {
            if ($consulta = $iprst->consulta()) {
                if (is_array($consulta) && count($consulta) > 0) {
                    call_user_func_array(array($entidadeName, 'carregaModelo'), 
                        array($modelo, current($consulta)));
                } else {
                    $modelo = null;
                }
                
            } else {
                $modelo = null;
                throw new TratamentoPrstXmn(
                    array('codigo' => 'INFORMACAO_NAO_CARREGADA')
                );
            }
            $iprst = null;
        } catch (TratamentoPrstXmn $tratamentoPrstXmn) {
            throw $tratamentoPrstXmn;
        }
    }
    
    protected static function consultaListaModeloXmn(
        $entidadeName = __CLASS__, 
        ListaModeloXmn $listaModelo,
        IntermediarioPrstXmn $iprst)
    {
        $modeloNome = $listaModelo->pegaArquetipoModelo();
        
        $listaModelo->zeraLista();

        try {
            if ($consulta = $iprst->consulta()) {
                for ($x = 0; $x < count($consulta); $x++) {
                    $newModelo = new $modeloNome();
                    
                    call_user_func_array(array($entidadeName, 'carregaModelo'), 
                        array($newModelo, current($consulta)));
                    $listaModelo->adicionaModelo($newModelo);
                    next($consulta);
                }
                
            } else {
                $listaModelo = null;
                if (!is_array($consulta)) {
                    throw new TratamentoPrstXmn(
                        array('codigo' => 'INFORMACOES_NAO_CARREGADAS')
                    );
                }
            }
            
        } catch (TratamentoPrstXmn $tratamentoPrstXmn) {
            throw $tratamentoPrstXmn;
        }
    }
}