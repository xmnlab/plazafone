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
class MascaraXmn
{
    public function exibeMascara($mascara_conteudo, 
        $modoMoldura = true)
    {
        if (isset(Xaman::$portal[session_id()]['listaParametro'])) {
            foreach (Xaman::$portal[session_id()]['listaParametro'] 
                as $param => $valor) {
            
                $$param = $valor;
            }
        }
        
        foreach (Xaman::$portal[session_id()]['listaModelo'] 
            as $objeto => $modelo) {
            
            $$objeto = $modelo;
        }
        
        if ($modoMoldura == true) {
            eval("include_once '" . 
              Xaman::$portal[session_id()]['listaParametro']['MASCARA'] . "';");
            
        } else {
            eval("include_once \"$mascara_conteudo\";");
        }
        
        unset(Xaman::$portal[session_id()]);
        return;
    }
    
    public static function adicionaModelo(ModeloXmn &$modelo, $nome = null)
    {
        if ($nome == null) {
            $nome = get_class($modelo);
            $nome{0} = strtolower($nome{0});
        }
        
        Xaman::$portal[session_id()]['listaModelo'][$nome] = $modelo;
    }
    
    public static function adicionaParametro($nomeParametro, $valor)
    {
        Xaman::$portal[session_id()]['listaParametro'][$nomeParametro] = $valor;
    }
}
