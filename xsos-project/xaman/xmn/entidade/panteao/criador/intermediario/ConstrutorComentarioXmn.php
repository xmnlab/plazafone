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

include_once $XAMAN . 'panteao/criador/modelo/EntidadeXMdl.php';

/**
 * ConstrutorArgoUmlXmn: Classe intermediária do ConstrutorXaman
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   panteao
 * @package    xaman.panteao.intermediario
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class ConstrutorComentarioXmn
{
    public static function constroiComentarioAtributo(
        AtributoEntidadeXLstMdl $atributoXLstMdl, $espacamento)
    {
        if ($atributoXLstMdl == null) {
            return;
        }

        $comentario = ''
            . $espacamento . '/*'
            . $espacamento . ' * <DESCRICAO>'
            . $espacamento . ' *';

        $atributoXLstMdl->movePrimeiro();

        while ($atributoXLstMdl->moveProximo())
        {
            $comentario .= 
                  $espacamento . ' * @'
                . str_pad($atributoXLstMdl->pegaModelo()->pegaArquetipo(), 10)
                . $atributoXLstMdl->pegaModelo()->pegaNome();
        }

        return $comentario;
    }

    public static function constroiComentarioEntidade(
        EntidadeXMdl $entidadeXMdl, $espacamento)
    {
        if ($entidadeXMdl == null) {
            return;
        }

        $comentario = ''
            . $espacamento . '/*'
            . $espacamento . ' * <DESCRICAO>'
            . $espacamento . ' *';

    
        $comentario .= 
              $espacamento . ' * @'
            . str_pad($entidadeXMdl->pegaArquetipo(), 10)
            . $entidadeXMdl->pegaNome();

        return $comentario;
    }

    public static function constroiComentarioMetodo(
        MetodoEntidadeXLstMdl $metodoXLstMdl, $espacamento)
    {
        if ($metodoXLstMdl == null) {
            return;
        }

        $comentario = ''
            . $espacamento . '/*'
            . $espacamento . ' * <DESCRICAO>'
            . $espacamento . ' *';

        $metodoXLstMdl->movePrimeiro();

        while ($metodoXLstMdl->moveProximo())
        {
            $comentario .= 
                  $espacamento . ' * @'
                . str_pad($metodoXLstMdl->pegaModelo()->pegaArquetipo(), 10)
                . $metodoXLstMdl->pegaModelo()->pegaNome();
        }

        return $comentario;
    }
}
