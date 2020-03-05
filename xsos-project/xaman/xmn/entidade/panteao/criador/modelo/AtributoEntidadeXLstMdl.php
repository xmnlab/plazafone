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
include_once $XAMAN . 'panteao/criador/modelo/AtributoEntidadeXMdl.php';

/**
 * AtributoEntidadeXLstMdl: Classe que armazena lista de atributos
 * 
 * A classe MetodoEntidadeXMdl � utilizada para armazenar
 * e recuperar lista de atributos
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   artefato
 * @package    xaman.artefato
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class AtributoEntidadeXLstMdl extends ListaModeloXmn
{
    public function __construct($primeiroModeloVazio = null)
    {
        parent::__construct('AtributoEntidadeXMdl', $primeiroModeloVazio);
    }
}
