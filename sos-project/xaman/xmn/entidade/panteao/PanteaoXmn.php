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
 * @category   panteao
 * @package    xaman
 * @subpackage xaman.panteao
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

/** ListaModeloXmn */
include_once $XAMAN . 'modelo/ListaModeloXmn.php';

/**
 * PortalXaman: Classe que trabalha com modelos de tela
 * 
 * A classe ArtesaoXaman tem como int�ito permitir trabalhar com elementos
 * visuais como trabalhar com imagens ou criar combos de forma simples
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   panteao
 * @package    xaman.panteao
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 * @static
 */
class PanteaoXmn
{
    private static $panteao  = array();

    public static function criaPanteao(SimpleXMLElement $panteao)
    {
        $lista_entidade = $panteao->xpath('/lista_panteao/panteao');
        foreach($panteao as $clave => $contenido) {
            if (get_class($contenido) == 'SimpleXMLElement') {
                $atributos = $contenido->attributes();
                
                $nome_panteao = $atributos['nome'];
                
                $lista_entidade = $contenido->xpath('entidade');
                
                foreach ($lista_entidade as $claveEntidade 
                    => $contenidoEntidade) {
                        
                    $atributoEntidade = $contenidoEntidade->attributes();
                    
                    self::$panteao[(string)$nome_panteao][] = 
                        $atributoEntidade['nome'];
                }
                 
            }
        }
        
        return true;
    }
    
    public static function invoca($nomePanteao)
    {
        if (!isset(self::$panteao[$nomePanteao])) {
            return false;
        }
        foreach(self::$panteao[$nomePanteao] as $id => $entidade) {
            
            if (is_array($entidade)) {
                continue;
            }
            
            if (isset(Xaman::$portal[session_id()]['listaParametro'])) {
                foreach (Xaman::$portal[session_id()]['listaParametro'] 
                    as $param => $valor) {
            
                    $$param = $valor; 
                }
            }
            
            $portal = explode('.', $nomePanteao);

            $xaman = ucfirst($portal[0]);
            
            unset($portal[0]);
            
            $aldeia = strtoupper($xaman);
            
            if($xaman != 'Xaman') {
                $xaman .= 'Xmn';
            }
            
            include_once $$aldeia . implode('/', $portal) . '/' .$entidade;
        }
    }
    
}
