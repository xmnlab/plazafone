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
 * @category   artefato
 * @package    xaman
 * @subpackage xaman.artefato
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 */

/** ListaModeloXaman */
include_once $XAMAN . 'modelo/ListaModeloXmn.php';
include_once $XAMAN . 'panteao/criador/modelo/EntidadeXMdl.php';

/**
 * EntidadeXLstMdl: Classe que armazena lista de atributos
 * 
 * A classe EntidadeXLstMdl � utilizada para armazenar
 * e recuperar lista de entidades
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   artefato
 * @package    xaman.artefato
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class EntidadeXLstMdl extends ListaModeloXmn
{
    /**
     * O atributo descricao � utilizado para armazenar a descri��o
     * da classe que ser� utilizado dentro do coment�rio dentro da
     * documenta��o de c�digo
     *
     * @access private
     * @var    string
     */
    private $descricao;
    
    /**
     *
     **/
    private $titularXMdl;

    /**
     *
     **/
    public function __construct($primeiroModeloVazio = null)
    {
        $this->titularXMdl = new AutorEntidadeXMdl();

        parent::__construct('EntidadeXMdl', $primeiroModeloVazio);
    }

    /**
     *
     **/
    public function atribuiDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     *
     **/
    public function atribuiTitularXMdl(AutorEntidadeXMdl $titularXMdl)
    {
        $this->titularXMdl = $titularXMdl;
    }

    /**
     *
     **/
    public function pegaDescricao()
    {
        return $this->descricao;
    }

    /**
     *
     **/
    public function &pegaTitularXMdl()
    {
        return $this->titularXMdl;
    }
}
