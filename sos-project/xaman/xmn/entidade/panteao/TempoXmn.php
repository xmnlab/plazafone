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

/**
 * TempoXaman: Classe Controladora do Tempo
 * 
 * A classe TempoXaman tem como int�ito permitir m�todos que trabalhem com 
 * dados de tempo assim como: anos, meses, dias, horas, minutos e segundos
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
class TempoXmn
{
    /**
     * Formata Data e Hora
     * 
     * @return void
     */
    public static function formataDataHora($data = '', $formatoEntrada = '', $formatoSaida = 'timestamp',
        $retornarAspas = false)
    {
        $dataFinal['h'] = 0;
        $dataFinal['i'] = 0;
        $dataFinal['s'] = 0;
        $dataFinal['m'] = 0;
        $dataFinal['d'] = 0;
        $dataFinal['y'] = 0;
        
        switch ($formatoEntrada) {
            case 'timestamp':
                if ($formatoSaida != 'timestamp') {
                    $retorno = date($formatoSaida, $data);
                }else{
                    $retorno = $data;
                }
                break;
            default:
                $formatoEntrada = str_replace(' ', '/', $formatoEntrada);
                $formatoEntrada = str_replace(':', '/', $formatoEntrada);
                $formatoEntrada = str_replace('-', '/', $formatoEntrada);
                $formatoEntrada = explode("/", $formatoEntrada);
                
                $data = str_replace(' ', '/', $data);
                $data = str_replace(':', '/', $data);
                $data = str_replace('-', '/', $data);
                $data = explode('/', $data);
                $novaChave = ''; 
                
                foreach ($formatoEntrada as $key => $value) {
                    $dataFinal[strtolower($value)] = (int) $data[$key];
                }
                
                $dataTimeStamp = 
                    mktime(
                        $dataFinal['h'], 
                        $dataFinal['i'], 
                        $dataFinal['s'], 
                        $dataFinal['m'], 
                        $dataFinal['d'], 
                        $dataFinal['y']
                    );
                
                if ($formatoSaida != 'timestamp') {
                    $retorno = date($formatoSaida, $dataTimeStamp);
                }else{
                    $retorno = $dataTimeStamp;
                }
                break;
        }
        if ($retornarAspas === true) {
                $retorno = "'".$retorno."'";
        }
        return $retorno;
    }

    /**
     * Formata segundos
     * 
     * @return void
     */    
    public static function formataSegundos($seg)
    {
        $hora = 0;
        $minuto = 0;
        $segundo = 0;
        
        $minuto = (int) ($seg / 60);
        if ($minuto > 59) {
            $minuto-= 60;
        }
        if ($minuto > 59) {
            $minuto = 0;
        }
        
        $hora+= (int) (($seg / 60) / 60);
        
        $segundo = $seg - ($hora * 60 * 60 + $minuto * 60);
                
        echo $hora.':'.$minuto.':'.$segundo;
    }
}
