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

/* EntidadeXLstMdl */
include_once $XAMAN . 'panteao/criador/modelo/EntidadeXLstMdl.php';

/* Intermedi�rio ConstrutorArgoUmlXaman */
include_once $XAMAN . 'panteao/criador/intermediario/ConstrutorArgoUmlXmn.php';

/* Intermedi�rio ConstrutorPhpXaman */
include_once $XAMAN . 'panteao/criador/intermediario/ConstrutorPhpXmn.php';

/* Intermedi�rio ConstrutorVbXaman */
include_once $XAMAN . 'panteao/criador/intermediario/ConstrutorVbXmn.php';

/* Intermedi�rio ConstrutorZipXaman */
include_once $XAMAN . 'panteao/criador/intermediario/ConstrutorZipXmn.php';

/**
 * Criador
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   panteao
 * @package    xaman.panteao
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class CriadorXmn
{
    const SAIDA_HTML        = 1;
    const SAIDA_PDF         = 2;
    const SAIDA_TEXTO       = 4;
    const ARQUETIPO_ARGOUML = 8;
    const ARQUETIPO_PHP     = 16;
    const ARQUETIPO_VB      = 32;

    public static function constroiProjeto (EntidadeXLstMdl $entidadeXLstMdl, 
        $tipoSaida = self::SAIDA_TEXTO)
    {
        switch (true) {
        case $tipoSaida & self::ARQUETIPO_ARGOUML:
            $saida = ConstrutorArgoUmlXmn::constroiProjeto($entidadeXLstMdl);
            break;

        case $tipoSaida & self::ARQUETIPO_PHP:
            $saida = ConstrutorPhpXmn::constroiProjeto($entidadeXLstMdl);
            break;

        case $tipoSaida & self::ARQUETIPO_VB:
            $saida = ConstrutorVbXmn::constroiProjeto($entidadeXLstMdl);
            break;

        default:
            $tratXaman = new TratamentoXaman();
            throw $tratXaman;
        }

        return self::preparaSaida($saida, $tipoSaida);
    }

    public static function constroiEntidade (EntidadeXMdl $entidadeXMdl, 
        $tipoSaida = self::SAIDA_TEXTO)
    {
        switch (true) {
        case $tipoSaida & self::ARQUETIPO_ARGOUML:
            $saida = ConstrutorArgoUmlXmn::constroiEntidade($entidadeXMdl);
            break;

        case $tipoSaida & self::ARQUETIPO_PHP:
            $saida = ConstrutorPhpXmn::constroiEntidade($entidadeXMdl);
            break;

        case $tipoSaida & self::ARQUETIPO_VB:
            $saida = ConstrutorVbXmn::constroiEntidade($entidadeXMdl);
            break;

        default:
            $tratXaman = new TratamentoXaman();
            throw $tratXaman;
        }

        return self::preparaSaida($saida, $tipoSaida);
    }

    public static function preparaSaida($saida, $tipoSaida)
    {
        return $saida;
    }

    public static function preparaEntidade(EntidadeXMdl &$entidadeXMdl)
    {
        $metodoAtribuicaoXLstMdl  = new MetodoEntidadeXLstMdl();
        $metodoRecuperacaoXLstMdl = new MetodoEntidadeXLstMdl();

        while ($entidadeXMdl->pegaAtributoXLstMdl()->moveProximo()) {
            $atributoXMdl = $entidadeXMdl->pegaAtributoXLstMdl()->pegaModelo();

            /* CRIA M�TODOS DE ACESSO*/
            if ($entidadeXMdl->pegaArquetipo() == EntidadeXMdl::ENTIDADE_CLASSE_MODELO) {

                /* CRIA��O DO M�TODO DE ATRIBUI��O */
                $metodoAtribuicaoXMdl = new MetodoEntidadeXMdl();

                $metodoAtribuicaoXMdl->atribuiNome(
                      'atribui'
                    . ucfirst($atributoXMdl->pegaNome()));

                $metodoAtribuicaoXMdl->atribuiArquetipo('void');
                $metodoAtribuicaoXMdl->atribuiVisibilidade('public');
                
                $parametroXMdl = new AtributoEntidadeXMdl();
                $parametroXMdl->atribuiNome($atributoXMdl->pegaNome());
                $parametroXMdl->atribuiArquetipo($atributoXMdl->pegaArquetipo());

                $metodoAtribuicaoXMdl->pegaParametroXLstMdl()->adicionaModelo($parametroXMdl);
                $metodoAtribuicaoXMdl->atribuiProposito(MetodoEntidadeXMdl::PROPOSITO_ATRIBUICAO);
                $metodoAtribuicaoXLstMdl->adicionaModelo($metodoAtribuicaoXMdl);

                unset($parametroXMdl);                

                /* CRICA��O DO M�TODO DE RETORNO */
                $metodoRecuperacaoXMdl = new MetodoEntidadeXMdl();
                $metodoRecuperacaoXMdl->atribuiNome(
                      'pega'
                    . ucfirst($atributoXMdl->pegaNome()));
                $metodoRecuperacaoXMdl->atribuiArquetipo($atributoXMdl->pegaArquetipo());
                $metodoRecuperacaoXMdl->atribuiVisibilidade('public');
                $metodoRecuperacaoXMdl->atribuiProposito(MetodoEntidadeXMdl::PROPOSITO_RETORNO);

                $metodoRecuperacaoXLstMdl->adicionaModelo($metodoRecuperacaoXMdl);
            }

        }

        $atributoXMdl = null;

        if ($metodoAtribuicaoXLstMdl->pegaTotalModelo() > 0) {
            $entidadeXMdl->pegaMetodoXLstMdl()->adicionaLista($metodoAtribuicaoXLstMdl);
        }
        unset($metodoAtribuicaoXLstMdl);

        if ($metodoRecuperacaoXLstMdl->pegaTotalModelo() > 0) {
            $entidadeXMdl->pegaMetodoXLstMdl()->adicionaLista($metodoRecuperacaoXLstMdl);
        }
        unset($metodoRecuperacaoXLstMdl);

    }
}
