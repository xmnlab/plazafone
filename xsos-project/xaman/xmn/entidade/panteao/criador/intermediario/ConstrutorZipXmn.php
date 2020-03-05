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

/** ListaModeloXaman */
include_once $XAMAN . 'modelo/ListaModeloXmn.php';

/**
 * ConstrutorZipXaman: 
 * 
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
class ConstrutorZipXaman
{

    public static function iniciaCompressao(
        ZipArchive  &$artefatoCompactado, $nomeArtefato, $nomeProjeto)
    {
        $artefatoCompactado = new ZipArchive();

        if ($artefatoCompactado->open("/tmp/$nomeArtefato", ZIPARCHIVE::CREATE) !== TRUE) {
            exit("Falha ao abrir o $nomeArtefato\n");
        }

        /* INICIAÇÃO */
        $artefatoCompactado->addFile(
            Xaman::pegaAldeiaPachamama('ritual/escritura/iniciacao.txt'),
            $nomeProjeto . '/ritual/iniciacao.php'
        );
        
        /* RITUAL PROJETO */
        $artefatoCompactado->addFile(
            Xaman::pegaAldeiaPachamama('ritual/escritura/mascara/projeto.txt'),
            $nomeProjeto . '/mascara/'
            . strtolower($nomeProjeto) . '.php'
        );

        /* RITUAL INDEX */
        $artefatoCompactado->addFile(
            Xaman::pegaAldeiaPachamama('ritual/escritura/mascara/index.txt'),
            $nomeProjeto . '/mascara/index.phtml'
        );

        /* RITUAL ARTESAO */
        $artefatoCompactado->addFile(
            Xaman::pegaAldeiaPachamama(
                'ritual/escritura/artesao/lista_ferramenta.txt'),
            $nomeProjeto . '/ritual/artesao/lista_ferramenta.php'
        );

        /* RITUAL MENSAGEM TRATAMENTO */
        $artefatoCompactado->addFile(
            Xaman::pegaAldeiaPachamama(
                'ritual/escritura/tratamento/lista_mensagem.txt'),
            $nomeProjeto . '/ritual/tratamento/lista_mensagem.php'
        );

        /* LICENSA */
        $artefatoCompactado->addFile(
            Xaman::pegaAldeiaPachamama('LICENSE.txt'),
            $nomeProjeto . '/LICENSE.txt'
        );

        /* TRATAMENTO MASCARA */
        $artefatoCompactado->addFile(
            Xaman::pegaAldeiaPachamama('mascara/tratamento/tratamento.phtml'),
            $nomeProjeto . '/mascara/tratamento/tratamento.phtml'
        );

        /* ENFEITE */
        $artefatoCompactado->addFile(
            Xaman::pegaAldeiaPachamama('mascara/estrutura/enfeite/enfeite.css'),
            $nomeProjeto . '/mascara/estrutura/enfeite/enfeite.css'
        );

        $artefatoCompactado->addFile(
            Xaman::pegaAldeiaPachamama(
                'mascara/estrutura/enfeite/tratamento.css'),
            $nomeProjeto . '/mascara/estrutura/enfeite/tratamento.css'
        );

        /* ROTINA */
        $artefatoCompactado->addFile(
            Xaman::pegaAldeiaPachamama('mascara/estrutura/rotina/atachar.js'),
            $nomeProjeto . '/mascara/estrutura/rotina/atachar.js'
        );

        $artefatoCompactado->addFile(
            Xaman::pegaAldeiaPachamama('mascara/estrutura/rotina/requisitaMascara.js'),
            $nomeProjeto . '/mascara/estrutura/rotina/requisitaMascara.js'
        );

        $artefatoCompactado->addFromString($nomeProjeto 
            . '/artefato/phpdoc/tmp.txt', '');
        $artefatoCompactado->addFromString($nomeProjeto 
            . '/artefato/pintura/tmp.txt', '');

        $artefatoCompactado->addFromString($nomeProjeto 
            . '/ritual/artesao/tmp.txt', '');

        $artefatoCompactado->addFromString($nomeProjeto 
            . '/entidade/modelo/tmp.txt', '');
        $artefatoCompactado->addFromString($nomeProjeto 
            . '/entidade/fluxo/tmp.txt', '');
        $artefatoCompactado->addFromString($nomeProjeto 
            . '/entidade/persistencia/tmp.txt', '');

        $artefatoCompactado->addFromString($nomeProjeto 
            . '/mascara/estrutura/escritura/tmp.txt', '');
        $artefatoCompactado->addFromString($nomeProjeto 
            . '/mascara/estrutura/sitio/tmp.txt', '');

    }

    public static function concluiCompressao(
        ZipArchive  &$artefatoCompactado, $nomeArtefato)
    {
        $artefatoCompactado->close();

        $arquivo = file_get_contents("/tmp/$nomeArtefato");

        exec("rm /tmp/$nomeArtefato");

        return $arquivo;
    }

    public static function adicionaArtefato(
        ZipArchive &$artefatoCompactado, $direcao, $conteudo, $nomeProjeto) 
    {
        if (!$artefatoCompactado->addFromString($nomeProjeto . $direcao, 
            $conteudo)) {
            
            throw new TratamentoXaman();
        }

    }
}