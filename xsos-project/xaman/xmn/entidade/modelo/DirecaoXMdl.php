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
 * @category   modelo
 * @package    xaman
 * @subpackage xaman.modelo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

/** ModeloXaman */
include_once $XAMAN . 'modelo/ModeloXmn.php';

/**
 * DirecaoXMdl: Classe para que armazena as requisi��es 
 * e dados para a camada de fluxo
 * 
 * A classe DirecaoXMdl � utilizada para armazenar e recuperar
 * informa��es referentes a requisi��es e sess�o
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   modelo
 * @package    xaman.modelo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class DirecaoXMdl extends ModeloXmn
{
    public $artefato;
    public $pegada;
    public $postagem;
    public $requisicao;
    public $sessao;
    
    public function atribuiArtefato(&$artefato)
    {
        $this->artefato = (array) $artefato;
    }
    public function atribuiPegada(&$pegada)
    {
        $this->pegada = (array) $pegada;
    }
    public function atribuiPostagem(&$postagem)
    {
        $this->postagem = (array) $postagem;
    }
    public function atribuiRequisicao(&$requisicao)
    {
        $this->requisicao = (array) $requisicao;
    }
    public function atribuiSessao(&$sessao)
    {
        $this->sessao = (array) $sessao;
    }

    public function &pegaArtefato()
    {
        return $this->artefato;
    }
    public function &pegaPegada()
    {
        return $this->pegada;
    }
    public function &pegaPostagem()
    {
        return $this->postagem;
    }
    public function &pegaRequisicao()
    {
        return $this->requisicao;
    }
    public function &pegaSessao()
    {
        return $this->sessao;
    }    
}

