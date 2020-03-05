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

/**
 * TelefoneModelo: Classe modelo para armazenar telefone
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   modelo
 * @package    xaman.modelo.comum
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class TelefoneXMdl extends ModeloXmn
{
    private $ddd;
    private $numero;
    private $ramal;

    public function pegaDDD()
    {
        return $this->ddd;
    }
    public function pegaNumero()
    {
        return $this->numero;
    }
    public function pegaRamal()
    {
        return $this->ramal;
    }

    public function atribuiDDD($ddd)
    {
        $this->ddd = (int) $ddd;
    }
    public function atribuiNumero($numero)
    {
        $this->numero = (float) $numero;
    }
    public function atribuiRamal($ramal)
    {
        $this->ramal = (int) $ramal;
    }
}
