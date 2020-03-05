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
class ConstrutorXmlArgoUmlXmn
{
    public static function pegaEscopoPrincipal()
    {
        /* ESCOSPO PRINCIPAL */
        $escopoEntidade  = 
              "<?xml version = '1.0' encoding = '<XAMAN:Artefato.codificacao/>' ?>\n"
            . "<XMI xmi.version = '1.2' xmlns:UML = 'org.omg.xmi.namespace.UML'"
            . " timestamp = '<XAMAN:Artefato.dataCriacao/>'>\n"
            . "<XAMAN:Estrutura.cabecalho/>"
            . "<XAMAN:Estrutura.conteudo/>"
            . "<XAMAN:Estrutura.rodape/>";

        return $escopoEntidade;
    }

    public static function pegaEscopoCabecalho()
    {
        /* ESCOPO CABEÇALHO */
        $escopoCabecalho  = 
              "  <XMI.header>\n"
            . "    <XMI.documentation>\n"
            . "      <XMI.exporter>ArgoUML (using Netbeans XMI Writer version 1.0)</XMI.exporter>\n"
            . "      <XMI.exporterVersion>0.24(5) revised on $Date: <XAMAN:Artefato.dataExportacao/> $ </XMI.exporterVersion>\n"
            . "    </XMI.documentation>\n"
            . "    <XMI.metamodel xmi.name=\"UML\" xmi.version=\"1.4\"/>\n"
            . "  </XMI.header>\n";

        return $escopoCabecalho;
    }

    public static function pegaEscopoConteudo()
    {
        /* ESCOPO CONTEÚDO */
        $escopoConteudo  =
              "  <XMI.content>\n"
            . "    <UML:Model xmi.id = '127-0-1-1--72fb2510:11cdc74b156:-8000:<XAMAN:Modelo.id/>'\n"
            . "      name = 'ModeloXaman' isSpecification = 'false' isRoot = 'false' isLeaf = 'false'\n"
            . "      isAbstract = 'false'>\n"
            . "      <UML:Namespace.ownedElement>\n"
            . "        <UML:Class xmi.id = '127-0-1-1--72fb2510:11cdc74b156:-8000:<XAMAN:Entidade.id/>'\n"
            . "          name = '<XAMAN:Entidade.nome/>' visibility = '<XAMAN:Entidade.visibilidade/>'"
            . "          isSpecification = 'false' isRoot = 'false'\n"
            . "          isLeaf = 'false' isAbstract = '<XAMAN:Entidade.abstracao/>' isActive = 'false'>\n"
            . "          <UML:Classifier.feature>\n<XAMAN:Entidade.listaAtributo/><XAMAN:Entidade.listaMetodo/>"
            . "          </UML:Classifier.feature>\n"
            . "        </UML:Class>\n<XAMAN:Entidade.listaArquetipo/>"
            . "      </UML:Namespace.ownedElement>\n"
            . "    </UML:Model>\n"
            . "  </XMI.content>\n";

        return $escopoConteudo;
    }

    public static function pegaEscopoArquetipo()
    {
        /* ESCOPO ARQUÉTIPO */
        $escopoArquetipo  = 
              "        <UML:DataType xmi.id = '127-0-1-1--72fb2510:11cdc74b156:-8000:<XAMAN:Arquetipo.id/>'\n"
            . "          name = '<XAMAN:Arquetipo.nome/>' isSpecification = 'false' isRoot = 'false' isLeaf = 'false'\n"
            . "          isAbstract = 'false'/>\n";
    
        return $escopoArquetipo;
    }

    public static function pegaEscopoAtributo()
    {
        /* ESCOPO ATRIBUTO */
        $escopoAtributo  = "            <UML:Attribute xmi.id = '127-0-1-1--72fb2510:11cdc74b156:-8000:<XAMAN:Entidade.atributo.id/>'\n";
        $escopoAtributo .= "              name = '<XAMAN:Entidade.atributo.nome/>' visibility = '<XAMAN:Entidade.atributo.visibilidade/>'";
        $escopoAtributo .= "              isSpecification = 'false' ownerScope = 'instance'\n";
        $escopoAtributo .= "              changeability = 'changeable' targetScope = 'instance'>\n";
        $escopoAtributo .= "              <UML:StructuralFeature.multiplicity>\n";
        $escopoAtributo .= "                <UML:Multiplicity xmi.id = '127-0-1-1--72fb2510:11cdc74b156:-8000:";
        $escopoAtributo .=                  "<XAMAN:Entidade.atributo.multiplicidade.id/>'>\n";
        $escopoAtributo .= "                  <UML:Multiplicity.range>\n";
        $escopoAtributo .= "                    <UML:MultiplicityRange xmi.id = '127-0-1-1--72fb2510:11cdc74b156:-8000:";
        $escopoAtributo .=                      "<XAMAN:Entidade.atributo.intervaloMultiplicidade.id/>'\n";
        $escopoAtributo .= "                      lower = '1' upper = '1'/>\n";
        $escopoAtributo .= "                  </UML:Multiplicity.range>\n";
        $escopoAtributo .= "                </UML:Multiplicity>\n";
        $escopoAtributo .= "              </UML:StructuralFeature.multiplicity>\n";
        $escopoAtributo .= "              <UML:StructuralFeature.type>\n";
        $escopoAtributo .= "                <UML:DataType xmi.idref = '127-0-1-1--72fb2510:11cdc74b156:-8000:";
        $escopoAtributo .=                  "<XAMAN:Entidade.atributo.arquetipo.id/>'/>\n";
        $escopoAtributo .= "              </UML:StructuralFeature.type>\n";
        $escopoAtributo .= "            </UML:Attribute>\n";
        
        return $escopoAtributo;
    }

    public static function pegaEscopoMetodo()
    {
        /* ESCOPO MÉTODO */
        $escopoMetodo  = "            <UML:Operation xmi.id = '127-0-1-1--72fb2510:11cdc74b156:-8000:<XAMAN:Entidade.metodo.id/>'\n";
        $escopoMetodo .= "              name = '<XAMAN:Entidade.metodo.nome/>' visibility = '<XAMAN:Entidade.metodo.visibilidade/>'";
        $escopoMetodo .= "              isSpecification = 'false' ownerScope = 'instance'\n";
        $escopoMetodo .= "              isQuery = 'false' concurrency = 'sequential' isRoot = 'false' isLeaf = 'false'\n";
        $escopoMetodo .= "              isAbstract = 'false'>\n";
        $escopoMetodo .= "              <UML:BehavioralFeature.parameter>\n";
        $escopoMetodo .= "                <UML:Parameter xmi.id = '127-0-1-1--72fb2510:11cdc74b156:-8000:<XAMAN:Entidade.metodo.parametro.id/>'\n";
        $escopoMetodo .= "                  name = 'return' isSpecification = 'false' kind = 'return'>\n";
        $escopoMetodo .= "                  <UML:Parameter.type>\n";
        $escopoMetodo .= "                    <UML:DataType xmi.idref = '127-0-1-1--72fb2510:11cdc74b156:-8000:";
        $escopoMetodo .=                      "<XAMAN:Entidade.metodo.parametro.arquetipo.id/>'/>\n";
        $escopoMetodo .= "                  </UML:Parameter.type>\n";
        $escopoMetodo .= "                </UML:Parameter>\n";
        $escopoMetodo .= "              </UML:BehavioralFeature.parameter>\n";
        $escopoMetodo .= "            </UML:Operation>\n";
    
        return $escopoMetodo;
    }

    public static function pegaEscopoRodape()
    {
        $escopoRodape = "</XMI>";
        return $escopoRodape;
    }

    public static function constroiProjeto(EntidadeXLstMdl $entidadeXLstMdl)
    {
        /* ARMAZENA VALORES PARA RECOMPOR O ARTEFATO */
        $listaArquetipoUsado = array();
        $listaArquetipo      = '';
        $listaAtributo       = '';
        $listaMetodo         = '';
        $idObjeto            =  0;

        /* ARMAZENA ESCOPOS */
        $escopoArquetipo    = ConstrutorArgoUmlXmn::pegaEscopoArquetipo();
        $escopoAtributo     = ConstrutorArgoUmlXmn::pegaEscopoAtributo();
        $escopoCabecalho    = ConstrutorArgoUmlXmn::pegaEscopoCabecalho();
        $escopoConteudo     = ConstrutorArgoUmlXmn::pegaEscopoConteudo();
        $escopoEntidade     = ConstrutorArgoUmlXmn::pegaEscopoPrincipal();
        $escopoMetodo       = ConstrutorArgoUmlXmn::pegaEscopoMetodo();
        $escopoRodape       = ConstrutorArgoUmlXmn::pegaEscopoRodape();

        /* PREPARA A SAIDA, MESCLANDO AS INFORMAÇÕES COM A ESTRUTURA */
        $cabecalho = $escopoCabecalho;
        $conteudo  = $escopoConteudo;
        $rodape    = $escopoRodape;
        $saida     = $escopoEntidade;

        /* VARIÁVEL TEMPORÁRIA */
        $textoTemporario = '';

        /* PREPARA A ESTRUTURA DO ARTEFATO */
        $saida = str_replace(
            '<XAMAN:Artefato.codificacao/>',
            'UTF-8',
            $saida);

        /* MODELO DA DATA: Wed Oct 08 09:52:18 BRT 2008 */
        $saida = str_replace(
            '<XAMAN:Artefato.dataCriacao/>',
            date('D M d H:i:s T Y', time()),
            $saida);

        /* PREPARA A ESTRUTURA DO ARTEFATO */
        /* MODELO DA DATA: 2006-11-06 19:55:22 +0100 (Mon, 06 Nov 2006) */
        $cabecalho = str_replace(
            '<XAMAN:Artefato.dataExportacao/>',
            date('Y-m-d H:i:s O (D, d M Y)', time()),
            $cabecalho);

        /* PREPARA CONTEUDO */
        $conteudo = str_replace(
            '<XAMAN:Entidade.id/>',
            str_pad(bin2hex(2 ^ ++$idObjeto), 16, "0", STR_PAD_LEFT),
            $conteudo);

        $conteudo = str_replace(
            '<XAMAN:Modelo.id/>',
            str_pad(bin2hex(2 ^ ++$idObjeto), 16, "0", STR_PAD_LEFT),
            $conteudo);

        /* PREPARA ATRIBUTOS */
        $entidadeXMdl->pegaAtributoXLstMdl()->movePrimeiro();
        while ($entidadeXMdl->pegaAtributoXLstMdl()->moveProximo()) {

            $atributoXMdl = $entidadeXMdl->pegaAtributoXLstMdl()->pegaModelo();

            /* CRIA LISTA DE ARQUETIPOS */
            if ($listaArquetipoUsado[$atributoXMdl->pegaArquetipo()] == ''){
                $listaArquetipoUsado[$atributoXMdl->pegaArquetipo()] = 
                    str_pad(bin2hex(2 ^ ++$idObjeto), 16, "0", STR_PAD_LEFT);
            }

            /* CRIA ATRIBUTO*/
            $textoTemporario = $escopoAtributo;

            $textoTemporario = str_replace(
                '<XAMAN:Entidade.atributo.id/>',
                str_pad(bin2hex(2 ^ ++$idObjeto), 16, "0", STR_PAD_LEFT),
                $textoTemporario);

            $textoTemporario = str_replace(
                '<XAMAN:Entidade.atributo.nome/>',
                $atributoXMdl->pegaNome(),
                $textoTemporario);

            $textoTemporario = str_replace(
                '<XAMAN:Entidade.atributo.arquetipo/>',
                $atributoXMdl->pegaArquetipo(),
                $textoTemporario);

            $textoTemporario = str_replace(
                '<XAMAN:Entidade.atributo.visibilidade/>',
                $atributoXMdl->pegaVisibilidade(),
                $textoTemporario);

            $textoTemporario = str_replace(
                '<XAMAN:Entidade.atributo.arquetipo.id/>',
                $listaArquetipoUsado[$atributoXMdl->pegaArquetipo()],
                $textoTemporario);

            $textoTemporario = str_replace(
                '<XAMAN:Entidade.atributo.multiplicidade.id/>',
                str_pad(bin2hex(2 ^ ++$idObjeto), 16, "0", STR_PAD_LEFT),
                $textoTemporario);

            $textoTemporario = str_replace(
                '<XAMAN:Entidade.atributo.intervaloMultiplicidade.id/>',
                str_pad(bin2hex(2 ^ ++$idObjeto), 16, "0", STR_PAD_LEFT),
                $textoTemporario);

            $listaAtributo .= $textoTemporario;

        }

        /* PREPARA MÉTODOS */
        $entidadeXMdl->pegaMetodoXLstMdl()->movePrimeiro();
        while ($entidadeXMdl->pegaMetodoXLstMdl()->moveProximo()) {
            $metodoXMdl = $entidadeXMdl->pegaMetodoXLstMdl()->pegaModelo();

            $textoTemporario = $escopoMetodo;

            $textoTemporario = str_replace(
                '<XAMAN:Entidade.metodo.id/>',
                str_pad(bin2hex(2 ^ ++$idObjeto), 16, "0", STR_PAD_LEFT),
                $textoTemporario);

            $textoTemporario = str_replace(
                '<XAMAN:Entidade.metodo.nome/>',
                $metodoXMdl->pegaNome(),
                $textoTemporario);

            $textoTemporario = str_replace(
                '<XAMAN:Entidade.metodo.visibilidade/>',
                'public',
                $textoTemporario);

            $textoTemporario = str_replace(
                '<XAMAN:Entidade.metodo.parametro.id/>',
                str_pad(bin2hex(2 ^ ++$idObjeto), 16, "0", STR_PAD_LEFT),
                $textoTemporario);

            $textoTemporario = str_replace(
                '<XAMAN:Entidade.metodo.parametro.arquetipo.id/>',
                $listaArquetipoUsado[$metodoXMdl->pegaArquetipo()],
                $textoTemporario);
        
            $listaMetodo .= $textoTemporario;
        }

        /* PREPARA LISTA DE ARQUÉTIPOS */
        foreach ($listaArquetipoUsado as $chave => $valor) {
            $textoTemporario = $escopoArquetipo;
            
            $textoTemporario = str_replace(
                '<XAMAN:Arquetipo.id/>',
                str_pad(bin2hex(2 ^ ++$idObjeto), 16, "0", STR_PAD_LEFT),
                $textoTemporario);

            $textoTemporario = str_replace(
                '<XAMAN:Arquetipo.nome/>',
                $chave,
                $textoTemporario);

            $listaArquetipo .= $textoTemporario;
        }

        /* CABEÇALHO */
        $saida = str_replace(
            '<XAMAN:Estrutura.cabecalho/>',
            $cabecalho, 
            $saida);

        /* CONTEÚDO */
        $saida = str_replace(
            '<XAMAN:Estrutura.conteudo/>',
            $conteudo,
            $saida);

        /* ARQUETIPO */
        $saida = str_replace(
            '<XAMAN:Entidade.listaArquetipo/>',
            $listaArquetipo, 
            $saida);

        /* ATRIBUTOS DO CONTEÚDO */
        $saida = str_replace(
            '<XAMAN:Entidade.listaAtributo/>',
            $listaAtributo, 
            $saida);

        /* MÉTODOS DO CONTEÚDO */
        $saida = str_replace(
            '<XAMAN:Entidade.listaMetodo/>',
            $listaMetodo, 
            $saida);

        /* RODAPÉ */
        $saida = str_replace(
            '<XAMAN:Estrutura.rodape/>',
            $rodape, 
            $saida);

        /* DEFINIÇÕES DA ENTIDADE */
        $saida = str_replace(
            '<XAMAN:Entidade.nome/>',
            $entidadeXMdl->pegaNome(), 
            $saida);

        $saida = str_replace(
            '<XAMAN:Entidade.visibilidade/>',
            'public', 
            $saida);

        $saida = str_replace(
            '<XAMAN:Entidade.abstracao/>',
            'false', 
            $saida);

        return $saida;

    }
}
