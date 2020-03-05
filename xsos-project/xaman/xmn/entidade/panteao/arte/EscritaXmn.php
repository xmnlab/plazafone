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
 * @category   artefato
 * @package    xaman
 * @subpackage xaman.panteao
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

/** ModeloXaman */
include_once $XAMAN . 'modelo/artefato/ArtefatoXMdl.php';

/**
 * EscritorXmn
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   artefato
 * @package    xaman.panteao
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class EscritaXmn
{
    public static function pegaValorListaTexto($lista, $item)
    {
        $resultado = array();
        $padrao    = '/' . $item . "[=][@!#$%&*(){}\/\:\._[:alnum:][:blank:]-]*/i";
        
        preg_match($padrao, $lista, $resultado);
        return @substr($resultado[0], 
            - (strlen($resultado[0]) - strlen($item) - 1));
    }
    
    public static function atribuiValorListaTexto($lista, $item, $valor)
    {
        if (!preg_match('/' . $item . '/i', $lista)) {
            $lista .= $item . '=' . $valor . ';';

        } else {
            $padrao = '/' . $item . "[=][@!#$%&*(){}\/\:\.\_[:alnum:][:blank:]-]*/i";

            $lista  = preg_replace($padrao, $item . '=' . $valor, $lista);
        }
        
        return $lista;
    }
    
    public static function lista2xml($lista, $artefato = NULL)
    {
        return ClassXmlArray::array2xml($lista, $artefato);
    }
    
    public static function xml2lista($artefato, $html = true) 
    {
        return ClassXmlArray::xml2array($artefato, $html);
    }
}