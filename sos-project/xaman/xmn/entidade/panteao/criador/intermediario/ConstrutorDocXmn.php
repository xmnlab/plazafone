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
 */

/**
 * ConstrutorPhpXaman: Classe intermedi�ria do ConstrutorXaman
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   panteao
 * @package    xaman.panteao.intermediario
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class ConstrutorDocXmn
{
    private $parametro = array();

    public function atribuiParametro($parametro, $valor)
    {
        $this->parametro[$parametro] = $valor;
    }

    public function pegaDocumentacao($espacamento = '')
    {
        $doc = "\n" . $espacamento . "/**\n";

        foreach ($this->parametro as $chave => $valor) {
            $doc .= ''
                . $espacamento . ' * @' 
                . str_pad($chave, 11, " ", STR_PAD_RIGHT)
                . $valor . "\n"; 
        }

        $doc .= $espacamento . " **/\t";

        return $doc;
    }
}
