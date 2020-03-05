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
 * @package    xaman.modelo
 * @subpackage xaman.modelo.comum
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

/** ModeloXaman */
include_once $XAMAN . 'modelo/ModeloXmn.php';

/** ZonaXMdl */
include_once $XAMAN . 'modelo/comum/ZonaXMdl.php';

/**
 * UfXMdl: Classe modelo para armazenar unidade federal
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   modelo
 * @package    xaman.modelo.comum
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class UfXMdl extends ModeloXmn
{
    private $sigla;
    private $zonaXMdl;

    /**
     * O construtor da Classe instancia zonaXMdl para que o atributo
     * fique pronto assim que a classe for instanciada
     *
     * @access public
     */
    public function __construct()
    {
        $this->zonaXMdl   = new ZonaXMdl();
    }


    public function atribuiSigla($sigla)
    {
        $this->sigla = (string) $sigla;
    }

    /**
     * Atribui um modelo de zona ao bairro
     *
     * @access public
     * @param  ZonaXMdl $zonaXMdl
     * @return void
     */
    public function atribuiZonaXMdl(ZonaXMdl $zonaXMdl)
    {
        $this->zonaXMdl = $zonaXMdl;
    }

    public function pegaSigla()
    {
        return $this->sigla;
    }

    /**
     * Pega o modelo da zona do bairro
     *
     * @access public
     * @return ZonaXMdl
     */
    public function &pegaZonaXMdl()
    {
        return $this->zonaXMdl;
    }

}
