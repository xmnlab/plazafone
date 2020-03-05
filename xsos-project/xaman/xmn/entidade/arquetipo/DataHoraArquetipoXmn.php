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
 * @category   arquetipo
 * @package    xaman
 * @subpackage xaman.arquetipo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @see        http://sourceforge.net/projects/xaman/
 */

/** ArquetipoXaman */
include_once $XAMAN . 'arquetipo/ArquetipoXmn.php';

/**
 * DataHoraArquetipoXmn: Classe de tipo de dados de Data e Hora
 * 
 * A classe DataHoraArquetipoXmn � um classe para ser utilizada como
 * um tipo da dados de data e hora
 * 
 * @license    http://www.gnu.org/licenses    GNU License
 * @copyright  Copyright (C) 2008  Ivan Ogassavara
 * @category   arquetipo
 * @package    xaman.arquetipo
 * @version    Release: @package_version@
 * @author     Ivan Ogassavara <ivan.ogassavara@gmail.com>
 * @access     public
 */
class DataHoraArquetipoXmn extends ArquetipoXmn
{
    private $data;
    private $formatoSaida;
    
    public function __construct($datetime = null, 
        $formatoEntrada = 'timestamp', $formatoSaida = 'd/m/Y')
    {
        $this->formatoSaida = $formatoSaida;
        
        if ($datetime == null) {
            $this->data = null;
            return;
        }

        if ($formatoEntrada == 'timestamp') {
            $this->data = $datetime;
        } else {
            $this->data = TempoXmn::formataDataHora($datetime, 
                $formatoEntrada, 'timestamp');
        }
    }
    
    public function pegaDataHora($formatoSaida = null, 
        $padraoDataVazia = 'dataAtual')
    {
        if ($formatoSaida == null) {
            if ($this->formatoSaida == null || $this->formatoSaida == '') {
                $formatoSaida = 'd/m/Y';
            }else{
                $formatoSaida = $this->formatoSaida;
            }
        }
        
        if ($this->data == null) {
            switch ($padraoDataVazia) {
            case 'dataAtual':
                return TempoXmn::formataDataHora(time(), 'timestamp', 
                    $formatoSaida);
                    
            case '':
                return '';

            case null:
                return null;

            default:
                return null;
            }
        }
        return TempoXmn::formataDataHora($this->data, 'timestamp', 
            $formatoSaida);
    }
    
    public function atribuiDataHora($data, $formatoEntrada = 'timestamp')
    {
        if ($data == null) {
            $this->data = null;
            return;
        }
        
        $this->data = TempoXmn::formataDataHora($data, $formatoEntrada);
    }

    public function atribuiFormatoSaida($formatoEntrada) {
        $this->formatoSaida = $formatoEntrada;
    }
}
