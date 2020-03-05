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
 * ConstrutorXmlArgoUmlXmn: Classe intermediária do ConstrutorXaman
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   panteao
 * @package    xaman.panteao.intermediario
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class ConstrutorVbXmn
{
    public static function constroiProjeto(EntidadeXLstMdl $entidadeXLstMdl)
    {
        $atributoXMdl = null;

        $escopoEntidade = 
              "<XAMAN:Artefato.introducao/>\n\n"
            . "<XAMAN:Entidade.introducao/>\n\n"
            . "<XAMAN:Entidade.atributos/>\n"
            . "<XAMAN:Entidade.iniciacao/>\n"
            . "<XAMAN:Entidade.metodos/>";

        $escopoAtributo =
              "<XAMAN:Entidade.atributo.visibilidade/> "
            . "<XAMAN:Entidade.atributo.nome/> as "
            . "<XAMAN:Entidade.atributo.arquetipo/>\n";

        $escopoMetodo =
              "<XAMAN:Entidade.metodo.visibilidade/> Function "
            . "<XAMAN:Entidade.metodo.nome/> ("
            . "<XAMAN:Entidade.metodo.parametros/>) as "
            . "<XAMAN:Entidade.metodo.arquetipo/>\n"
            . "<XAMAN:Entidade.metodo.execucao/>\n"
            . "End Function";

        $introducaoMetodo   = '';
        $introducaoAtributo = '';

        $atributos          = '';
        $inclusoes          = '';
        $metodos            = '';
        $iniciacao          = '';

        $textoTemporario    = '';

        $entidadeXMdl->pegaAtributoXLstMdl()->movePrimeiro();
        while ($entidadeXMdl->pegaAtributoXLstMdl()->moveProximo()) {
            $atributoXMdl = $entidadeXMdl->pegaAtributoXLstMdl()->pegaModelo();

            $textoTemporario = $escopoAtributo;

            $textoTemporario = str_replace(
                '<XAMAN:Entidade.atributo.nome/>',
                $atributoXMdl->pegaNome(),
                $textoTemporario);

            $textoTemporario = str_replace(
                '<XAMAN:Entidade.atributo.arquetipo/>',
                ucfirst($atributoXMdl->pegaArquetipo()),
                $textoTemporario);

            $textoTemporario = str_replace(
                '<XAMAN:Entidade.atributo.visibilidade/>',
                ucfirst($atributoXMdl->pegaVisibilidade()),
                $textoTemporario);

            $atributos .=  $textoTemporario;
        }

        unset($atributoXMdl);

        if (EntidadeXMdl::ENTIDADE_CLASSE_MODELO) {
            $metodosAtribuicao = '';
            $metodosRetorno    = '';

            $entidadeXMdl->pegaAtributoXLstMdl()->movePrimeiro();
            while ($entidadeXMdl->pegaAtributoXLstMdl()->moveProximo()) {

                $atributoXMdl = $entidadeXMdl->pegaAtributoXLstMdl()
                    ->pegaModelo();

                /*DOCUMENTAÇÃO DO MÉTODO DE ATRIBUIÇÃO*/
                $metodosAtribuicao .= 
                      "\n\n'/**"
                    . "\n' * <XAMAN:Entidade.metodo.descricao/>" 
                    . "\n' *"
                    . "\n' * @access   Public"
                    . "\n' * @param    " . $atributoXMdl->pegaNome()
                    . "\n' * @return   void"
                    . "\n' */";

                /*CRIAÇÃO DO MÉTODO DE ATRIBUIÇÃO*/
                $atributoXMdl = $entidadeXMdl->pegaAtributoXLstMdl()
                    ->pegaModelo();

                $textoTemporario = $escopoMetodo;

                $parametros = $atributoXMdl->pegaNome()
                    . ' as ' . $atributoXMdl->pegaArquetipo();

                $execucao   = 'this_' . $atributoXMdl->pegaNome()
                    . ' = ' . $atributoXMdl->pegaNome();

                $textoTemporario = str_replace(
                    '<XAMAN:Entidade.metodo.nome/>',
                    'atribui' . ucfirst($atributoXMdl->pegaNome()),
                    $textoTemporario);

                $textoTemporario = str_replace(
                    '<XAMAN:Entidade.metodo.arquetipo/>',
                    ucfirst($atributoXMdl->pegaArquetipo()),
                    $textoTemporario);

                $textoTemporario = str_replace(
                    '<XAMAN:Entidade.metodo.visibilidade/>',
                    'Public',
                    $textoTemporario);

                $textoTemporario = str_replace(
                    '<XAMAN:Entidade.metodo.parametros/>',
                    $parametros,
                    $textoTemporario);

                $textoTemporario = str_replace(
                    '<XAMAN:Entidade.metodo.execucao/>',
                    "\t" . $execucao,
                    $textoTemporario);

                $metodosAtribuicao .= "\n" . $textoTemporario;

                /*DOCUMENTAÇÃO DO MÉTODO DE RETORNO*/
                $metodosRetorno .= 
                      "\n\n'/**"
                    . "\n' * "
                    . "\n' *"
                    . "\n' * @access   Public"
                    . "\n' * @return   void"
                    . "\n' */";

                /*CRICAÇÃO DO MÉTODO DE RETORNO*/
                $textoTemporario = $escopoMetodo;

                $parametros = '';

                $execucao   = 'pega' . ucfirst($atributoXMdl->pegaNome())
                    . ' = this_' . $atributoXMdl->pegaNome();

                $textoTemporario = str_replace(
                    '<XAMAN:Entidade.metodo.nome/>',
                    'pega' . ucfirst($atributoXMdl->pegaNome()),
                    $textoTemporario);

                $textoTemporario = str_replace(
                    '<XAMAN:Entidade.metodo.arquetipo/>',
                    ucfirst($atributoXMdl->pegaArquetipo()),
                    $textoTemporario);

                $textoTemporario = str_replace(
                    '<XAMAN:Entidade.metodo.visibilidade/>',
                    'Public',
                    $textoTemporario);

                $textoTemporario = str_replace(
                    '<XAMAN:Entidade.metodo.parametros/>',
                    $parametros,
                    $textoTemporario);

                $textoTemporario = str_replace(
                    '<XAMAN:Entidade.metodo.execucao/>',
                    "\t" . $execucao,
                    $textoTemporario);

                $metodosRetorno .= "\n" . $textoTemporario;
            }

            $metodos = $metodosAtribuicao . "\n" . $metodosRetorno;
        }

        /* PREPARA INTRODUÇÃO DO ARTEFATO */
        $introducao = str_replace(' *' , '\' *',
            $entidadeXMdl->pegaIntroducaoEntidade());

        $introducao = str_replace('/**' , '\'/**',
            $introducao);

        $escopoEntidade = str_replace('<XAMAN:Entidade.introducao/>' , 
            $introducao, $escopoEntidade);

        /* PREPARA INTRODUÇÃO DA ENTIDADE */
        $introducao = str_replace(' *' , '\' *',
            $entidadeXMdl->pegaIntroducaoEntidade());

        $introducao = str_replace('/**' , '\'/**',
            $introducao);

        $escopoEntidade = str_replace('<XAMAN:Entidade.introducao/>' , 
            $introducao, $escopoEntidade);

        $escopoEntidade = str_replace('<XAMAN:Entidade.atributos/>',
            $atributos, $escopoEntidade);

        $escopoEntidade = str_replace('<XAMAN:Entidade.metodos/>',
            $metodos, $escopoEntidade);

        $escopoEntidade = str_replace("\t", '    ', $escopoEntidade);

        return $escopoEntidade;
    }
}