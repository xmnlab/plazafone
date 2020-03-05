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
 * @category   fluxo
 * @package    xaman
 * @subpackage xaman.fluxo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

/** DirecaoModeloXaman */
include_once $XAMAN . 'modelo/DirecaoXMdl.php';

/** EstruturaFluxoXaman */
include_once $XAMAN . 'fluxo/EstruturaFluxoXmn.php';

/**
 * FluxoXaman: Classe principal de fluxo
 * 
 * A classe FluxoXaman apresenta o escopo prim�rio de uma classe de fluxo
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   fluxo
 * @package    xaman.fluxo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 * @static
 * @abstract
 */
class FluxoXmn implements EstruturaFluxoXmn {

    public static function adicionaCaminhoFluxo($fluxo)
    {
        include_once $fluxo;
    }

    public static function iniciaFluxo(DirecaoXMdl &$direcaoMdl){
        
    }

    public static function mudaFluxo($fluxo)
    {
        header('Location: ' . $fluxo);
    }
}
