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
 * @category   xaman
 * @package    xaman
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

/** DirecaoXMdl */
include_once $XAMAN . 'modelo/DirecaoXMdl.php';

/**
 * EstruturaXaman: Interface de classes do tipo Xaman
 * 
 * A interface EstruturaXaman cont�m o escopo obrigat�rio para
 * classes do tipo Xaman
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   xaman
 * @package    xaman
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 * @static
 */
interface EstruturaXmn
{
    public static function iniciaJornada(DirecaoXMdl &$direcaoMdl);
        
    public static function preparaJornada(SimpleXMLElement $origem_jornada);

    public static function atribuiAldeia($caminho, $aldeiaXmn);
    
    public static function pegaAldeia($caminho, $direcao = '');
}
