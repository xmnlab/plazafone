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
 * ConsultorXaman: Classe para verificar tipos de informa��es
 * 
 * A classe ConsultorXaman atualmente possibilita a verifica��o da consist�ncia
 * de um n�mero de c.p.f. ou de um c.n.p.j
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
class ConsultorXmn
{
    
    public static function validaCnpj($cnpj) {
        $sCNPJ = '';
        
        for ($x = 1; $x <= strlen($cnpj); $x = $x + 1) {
            $ch = substr($cnpj, $x-1, 1);
        
            if (ord($ch) >= 48 && ord($ch) <= 57) {
                $sCNPJ.= $ch;
            } 
        }
         
        $cnpj = $sCNPJ;
        if (strlen($cnpj) != 14) {
            return false;
        } else {
            if ($cnpj == '00000000000000') {
                return false;
            } else {
                $numero[1] = intval(substr($cnpj, 1-1, 1));
                $numero[2] = intval(substr($cnpj, 2-1, 1));
                $numero[3] = intval(substr($cnpj, 3-1, 1));
                $numero[4] = intval(substr($cnpj, 4-1, 1));
                $numero[5] = intval(substr($cnpj, 5-1, 1));
                $numero[6] = intval(substr($cnpj, 6-1, 1)); 
                $numero[7] = intval(substr($cnpj, 7-1, 1)); 
                $numero[8] = intval(substr($cnpj, 8-1, 1)); 
                $numero[9] = intval(substr($cnpj, 9-1, 1)); 
                $numero[10] = intval(substr($cnpj, 10-1, 1)); 
                $numero[11] = intval(substr($cnpj, 11-1, 1)); 
                $numero[12] = intval(substr($cnpj, 12-1, 1)); 
                $numero[13] = intval(substr($cnpj, 13-1, 1)); 
                $numero[14] = intval(substr($cnpj, 14-1, 1));
                 
                $soma = $numero[1] * 5 
                        + $numero[2] * 4 
                        + $numero[3] * 3 
                        + $numero[4] * 2 
                        + $numero[5] * 9
                        + $numero[6] * 8
                        + $numero[7] * 7
                        + $numero[8] * 6
                        + $numero[9] * 5
                        + $numero[10] * 4
                        + $numero[11] * 3
                        + $numero[12] * 2;
                 
                $soma = $soma - (11 * (intval($soma / 11))); 
                
                if ($soma == 0 || $soma ==1 ) { 
                    $resultado1=0;
                } else { 
                    $resultado1 = 11 - $soma; 
                }  
                
                if ($resultado1 == $numero[13]) { 
                    $soma = $numero[1] * 6
                            + $numero[2] * 5
                            + $numero[3] * 4
                            + $numero[4] * 3
                            + $numero[5] * 2
                            + $numero[6] * 9
                            + $numero[7] * 8
                            + $numero[8] * 7
                            + $numero[9] * 6
                            + $numero[10] * 5
                            + $numero[11] * 4
                            + $numero[12] * 3
                            + $numero[13] * 2;
                             
                    $soma = $soma - (11 * (intval($soma / 11))); 
                    
                    if ($soma == 0 || $soma == 1) { 
                        $resultado2 = 0; 
                    } else { 
                        $resultado2 = 11 - $soma; 
                    }  
            
                    if ($resultado2 == $numero[14]) { 
                        return true;
                    } else { 
                        return false;
                    }  
                } else { 
                    return false;
                }
            }
        }
    }
    
    public static function validaCpf($cpf = '', $validaCpfConsistente = true) {
        //Retirar todos os caracteres que nao sejam 0-9
        $sCPF = '';
        
        for ($x=1; $x<=strlen($cpf); $x = $x + 1) {
            $ch = substr($cpf,$x-1,1);
        
            if (ord($ch)>=48 && ord($ch)<=57) {
                $sCPF.= $ch;
            } 
        } 
        $cpf = $sCPF;
        
        if (strlen($cpf)!=11) {
            return false;
        } else {
            if ($validaCpfConsistente == true) {
                for ($indice = 0; $indice < 10; $indice++) {
                    if ($cpf == str_repeat("$indice", 11)) {
                        return false;
                    }
                }
            }

            if ($cpf == '00000000000') {
                return false;
            }else{
                $numero[1] = intval(substr($cpf,1-1,1));
                $numero[2] = intval(substr($cpf,2-1,1));
                $numero[3] = intval(substr($cpf,3-1,1));
                $numero[4] = intval(substr($cpf,4-1,1));
                $numero[5] = intval(substr($cpf,5-1,1));
                $numero[6] = intval(substr($cpf,6-1,1));
                $numero[7] = intval(substr($cpf,7-1,1));
                $numero[8] = intval(substr($cpf,8-1,1));
                $numero[9] = intval(substr($cpf,9-1,1));
                $numero[10] = intval(substr($cpf,10-1,1));
                $numero[11] = intval(substr($cpf,11-1,1));
                
                $soma =  10 * $numero[1] 
                        + 9 * $numero[2]
                         + 8 * $numero[3]
                          + 7 * $numero[4]
                          + 6 * $numero[5]
                          + 5 * $numero[6]
                          + 4 * $numero[7]
                          + 3 * $numero[8]
                          + 2 * $numero[9];
                          
                $soma=$soma-(11*(intval($soma/11)));
                
                if ($soma==0 || $soma==1) {
                    $resultado1=0;
                }else{
                    $resultado1=11-$soma;
                } 
                
                if ($resultado1==$numero[10]) {
                    $soma =   $numero[1] * 11
                            + $numero[2] * 10
                            + $numero[3] * 9
                            + $numero[4] * 8
                            + $numero[5] * 7
                            + $numero[6] * 6
                            + $numero[7] * 5
                            + $numero[8] * 4
                            + $numero[9] * 3
                            + $numero[10]*2;
                            
                    $soma = $soma - (11 * (intval($soma / 11)));
                    
                    if ($soma == 0 || $soma == 1) {
                        $resultado2 = 0;
            
                    }else{
                        $resultado2 = 11 - $soma;
                    } 
                    
                    if ($resultado2 == $numero[11]) {
                        return true;
                    }else{
                        return false;
                    } 
                }else{    
                    return false;
                } 
            }
        }
    }
}
?>
