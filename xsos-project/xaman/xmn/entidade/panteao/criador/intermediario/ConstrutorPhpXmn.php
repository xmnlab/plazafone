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

include_once $XAMAN . 'panteao/criador/intermediario/ConstrutorDocXmn.php';

/**
 * ConstrutorPhpXmn: Classe intermediária do ConstrutorXaman
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   panteao
 * @package    xaman.panteao.intermediario
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class ConstrutorPhpXmn
{
    public static function constroiProjeto(EntidadeXLstMdl $entidadeXLstMdl)
    {
        $artefatoCompactado = new ZipArchive();
        $nomeArtefato       = $entidadeXLstMdl->pegaNome() . time() . '.zip';
        $nomeProjeto        = $entidadeXLstMdl->pegaNome();

        ConstrutorZipXmn::iniciaCompressao(
            $artefatoCompactado, $nomeArtefato, $nomeProjeto);

        $entidadeXLstMdl->movePrimeiro();
        
        while ($entidadeXLstMdl->moveProximo()) {
            $direcao = '/entidade/modelo/' 
                . $entidadeXLstMdl->pegaModelo()->pegaNome()
                . '.php';

            ConstrutorZipXmn::adicionaArtefato(
                $artefatoCompactado,
                $direcao,
                self::constroiEntidade($entidadeXLstMdl->pegaModelo()),
                $nomeProjeto
            );
        }

        $saidaProjeto =  ConstrutorZipXmn::concluiCompressao(
            $artefatoCompactado, $nomeArtefato);

        /* PROJETO NOME */
        $saidaProjeto = str_replace('<XAMAN:Projeto.nome/>',
            $entidadeXLstMdl->pegaNome(), $saidaProjeto);

        /* PROJETO DESCRIÇÃO */
        $saidaProjeto = str_replace('<XAMAN:Projeto.descricao/>',
            $entidadeXLstMdl->pegaDescricao(), $saidaProjeto);

        /* PROJETO TITULAR OBRA */
        $saidaProjeto = str_replace('<XAMAN:Projeto.titular_obra/>',
            $entidadeXLstMdl->pegaTitularXMdl()->pegaNome(), $saidaProjeto);


    }

    public static function constroiEntidade(EntidadeXMdl $entidadeXMdl, &$listaArquetipo = array())
    {
        /* DEFINIÇÕES DA ESTRUTURA DA ENTIDADE */
        $escopoEntidade  = "<?php\n";
        $escopoEntidade .= "<XAMAN:Entidade.introducaoArtefato/>\n\n";
        $escopoEntidade .= "<XAMAN:Entidade.inclusoes/>\n\n";
        $escopoEntidade .= "<XAMAN:Entidade.introducao/>\n\n";

        $escopoEntidade .= "<XAMAN:Entidade.arquetipo/> <XAMAN:Entidade.nome/> {\n";
        $escopoEntidade .= "<XAMAN:Entidade.atributos/>\n";
        $escopoEntidade .= "<XAMAN:Entidade.metodos/>\n";
        $escopoEntidade .= "}";

        $atributos       = '';
        $inclusoes       = '';
        $metodos         = '';

        /* LISTA DE ARQUETIPOS */
        $listaArquetipoPrimitivo = array();

        self::constroiListaArquetipoPrimitivo($listaArquetipo);
        self::constroiListaArquetipoPrimitivo($listaArquetipoPrimitivo);

        $listaArquetipo[$entidadeXMdl->pegaNome()] = true;

        /* CRIAÇÃO DOS ATRIBUTOS */
        $entidadeXMdl->pegaAtributoXLstMdl()->movePrimeiro();

        while ($entidadeXMdl->pegaAtributoXLstMdl()->moveProximo()) {
            $atributoXMdl = $entidadeXMdl->pegaAtributoXLstMdl()->pegaModelo();

            $atributos .= "\n\tprivate \$" . $atributoXMdl->pegaNome() . ';';

            $listaArquetipo[$atributoXMdl->pegaArquetipo()] = true;

        }

        /* DEFINIÇÕES DE ARQUETIPO DA ENTIDADE */
        switch ($entidadeXMdl->pegaArquetipo()) {
        case EntidadeXMdl::ENTIDADE_INTERFACE:
            $escopoEntidade = str_replace(
                '<XAMAN:Entidade.arquetipo/>',
                'interface',
                $escopoEntidade
            );

            $escopoEntidade = str_replace(
                '<XAMAN:Padrao.terminador/>',
                ';',
                $escopoEntidade
            );

            break;

        case EntidadeXMdl::ENTIDADE_CLASSE:
        case EntidadeXMdl::ENTIDADE_CLASSE_MODELO:
        default:

            if ($entidadeXMdl->pegaEstadoAbstracao()) {
                $escopoEntidade = str_replace(
                    '<XAMAN:Entidade.arquetipo/>',
                    'abstract class',
                    $escopoEntidade
                );
            } else {
                $escopoEntidade = str_replace(
                    '<XAMAN:Entidade.arquetipo/>',
                    'class',
                    $escopoEntidade
                );
            }

            $escopoEntidade = str_replace(
                '<XAMAN:Padrao.terminador/>',
                " {\n\t\t\n\t}\n\n",
                $escopoEntidade
            );

            break;
        }

        /* CRIAÇÃO DOS MÉTODOS */
        $entidadeXMdl->pegaMetodoXLstMdl()->movePrimeiro();
        while ($entidadeXMdl->pegaMetodoXLstMdl()->moveProximo()) {

            $metodoXMdl = $entidadeXMdl->pegaMetodoXLstMdl()->pegaModelo();
            
            /* PREPARAÇÃO DA DOCUMENTAÇÃO */
            $construtorDocXmn = new ConstrutorDocXmn();
            $construtorDocXmn->atribuiParametro('access', $metodoXMdl->pegaVisibilidade());
            $construtorDocXmn->atribuiParametro('return', $metodoXMdl->pegaArquetipo());

            /*CRIAÇÃO DO MÉTODO*/
            $metodoDefinicao =
                  "\n\t" . $metodoXMdl->pegaVisibilidade(). ' function '
                . $metodoXMdl->pegaNome()
                . '(';

            $metodoComando = '';

            /* PARÂMETROS DO MÉTODO */
            if ($metodoXMdl->pegaParametroXLstMdl()->pegaTotalModelo() > 0) {

                $contador = 0;
                $parametroXMdl = null;

                $metodoXMdl->pegaParametroXLstMdl()->movePrimeiro();

                while ($metodoXMdl->pegaParametroXLstMdl()->moveProximo()) {
                    $parametroXMdl = $metodoXMdl->pegaParametroXLstMdl()->pegaModelo();

                    if ($contador == 1) {
                        $metodoDefinicao .= ', ';
                    }

                    if (!isset($listaArquetipoPrimitivo[$parametroXMdl->pegaArquetipo()])) {
                        $metodoDefinicao .= $parametroXMdl->pegaArquetipo() . ' ';
                    }

                    $metodoDefinicao .= "\$"
                         . $parametroXMdl->pegaNome();

                    $construtorDocXmn->atribuiParametro('param', 
                        $parametroXMdl->pegaNome());

                    $contador = 1;

                    /* PROPÓSITO DO MÉTODO */
                    switch ($metodoXMdl->pegaProposito()) {
                    case MetodoEntidadeXMdl::PROPOSITO_ATRIBUICAO:
                        $metodoComando .=
                            "\t\t\$this->" . $parametroXMdl->pegaNome() . ' = $'
                            . $parametroXMdl->pegaNome() . ";\n";
                    }

                }

                unset($parametroXMdl);
                $metodoDefinicao .= ")\n\t{\n" . $metodoComando;

                $metodos .= $construtorDocXmn->pegaDocumentacao("\t") . $metodoDefinicao;

            } else {
                /* MÉTODO COM PROPÓSITO DE RECUPERAÇÃO */
                switch ($metodoXMdl->pegaProposito()) {
                case MetodoEntidadeXMdl::PROPOSITO_RETORNO:
                    $nomeAtributo = $metodoXMdl->pegaNome();
                    $nomeAtributo = str_replace('pega', '', $nomeAtributo);
                    $nomeAtributo{0} = strtolower($nomeAtributo{0});

                    $metodoComando .=
                        "\t\treturn \$this->" . $nomeAtributo . ";\n";

                    $nomeAtributo = '';
                }

                $metodos .= 
                      $construtorDocXmn->pegaDocumentacao("\t") 
                    . $metodoDefinicao . ")\n\t{\n" 
                    . $metodoComando;
            }

            $metodos .= "\n\t}\n";
        }

        /* FINALIZAÇÃO DA CONSTRUÇÃO DA ENTIDADE */

        /* INTRODUÇÃO DO ARTEFATO */
        $escopoEntidade = str_replace('<XAMAN:Entidade.introducaoArtefato/>',
            $entidadeXMdl->pegaIntroducaoArtefato(), $escopoEntidade);

        /* INTRODUÇÃO DA ENTIDADE */
        $escopoEntidade = str_replace('<XAMAN:Entidade.introducao/>',
            $entidadeXMdl->pegaIntroducaoEntidade(), $escopoEntidade);

        /* ATRIBUTOS */
        $escopoEntidade = str_replace('<XAMAN:Entidade.atributos/>',
             $atributos, $escopoEntidade);

        /* AUTOR NOME */
        $escopoEntidade = str_replace('<XAMAN:Entidade.autor.nome/>',
            $entidadeXMdl->pegaAutorXMdl()->pegaNome(), $escopoEntidade);

        /* AUTOR EMAIL */
        $escopoEntidade = str_replace('<XAMAN:Entidade.autor.email/>',
            $entidadeXMdl->pegaAutorXMdl()->pegaEmail(), $escopoEntidade);

        /* CATEGORIA */
        $escopoEntidade = str_replace('<XAMAN:Entidade.categoria/>',
            $entidadeXMdl->pegaCategoria(), $escopoEntidade);

        /* DESCRIÇÃO DA ENTIDADE */
        $escopoEntidade = str_replace('<XAMAN:Entidade.descricao/>',
            $entidadeXMdl->pegaDescricao(), $escopoEntidade);

        /* ENTIDADE NOME */
        $escopoEntidade = str_replace('<XAMAN:Entidade.nome/>',
            $entidadeXMdl->pegaNome(), 
            $escopoEntidade);

        /* INCLUSÕES */
        $escopoEntidade = str_replace('<XAMAN:Entidade.inclusoes/>', 
            $inclusoes, $escopoEntidade);

        /* MÉTODOS */
        $escopoEntidade = str_replace('<XAMAN:Entidade.metodos/>',
            $metodos, $escopoEntidade);

        /* PACOTE */
        $escopoEntidade = str_replace('<XAMAN:Entidade.pacote/>',
            $entidadeXMdl->pegaPacote(), $escopoEntidade);

        /* PACOTE-SUB */
        $escopoEntidade = str_replace('<XAMAN:Entidade.subpacote/>',
            $entidadeXMdl->pegaSubPacote(), $escopoEntidade);

        /* VISIBILIDADE */
        $escopoEntidade = str_replace('<XAMAN:Entidade.visibilidade/>',
            $entidadeXMdl->pegaVisibilidade(), $escopoEntidade);

        /* TABULAÇÃO */
        $escopoEntidade = str_replace("\t", '    ', $escopoEntidade);

        /* VALIDA A ENTIDADE CRIADA */
        self::validaEntidade($escopoEntidade);

        return $escopoEntidade;
    }

    private static function constroiListaArquetipoPrimitivo(&$listaArquetipo = array())
    {
        if (count($listaArquetipo) < 1) {
            $listaArquetipo['int']      = true;
            $listaArquetipo['string']   = true;
            $listaArquetipo['float']    = true;
            $listaArquetipo['array']    = true;
            $listaArquetipo['bool']     = true;
            $listaArquetipo['void']     = true;
            $listaArquetipo['object']   = true;
            $listaArquetipo['resource'] = true;
        }
    }

    private static function validaEntidade($entidade)
    {
        //header('Content-Type: text/plain;charset="iso-8859-1"');
        eval(str_replace('<?php', '', $entidade));
    }

}
