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

/** GravuraXmn */
include_once $XAMAN . 'panteao/arte/GravuraXmn.php';

/** EscritaXmn */
include_once $XAMAN . 'panteao/arte/EscritaXmn.php';

/**
 * ArtesaoXaman: Classe que trabalha com elementos visuais
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
class ArtesaoXmn
{

    private static $param           = array();
    private static $caixaFerramenta = array();
    
    private static function atribuiParametro($id, $valor)
    {
        self::$param[$id] = $valor;
    }

    public static function criaFerramenta($xaman, $nomeFerramenta, $conteudo)
    {
        self::$caixaFerramenta[$xaman][] = 
            array('nome' => $nomeFerramenta, 'conteudo' => $conteudo);
    }

    public static function pegaFerramenta($xaman, $nomeFerramenta)
    {
        foreach (self::$caixaFerramenta[$xaman] as $caixa => $ferramenta) {
            if ($ferramenta['nome'] == $nomeFerramenta) {
                return $ferramenta['conteudo'];
            }
        }
    }

}
