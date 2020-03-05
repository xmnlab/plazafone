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
 * MensageiroXmn: Classe respons�vel por enviar informa��es a outros dispositivos
 * 
 * A classe MensageiroXmn � respons�vel pelo envio de informa��es a outros dispositivos,
 * arquivos, ou tratamento da mensagem como por exemplo uma criptografia.
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
class MensageiroXmn
{

    public static function codificaMensagem($mesagem, $codificacao) {
        //nao implementado
    }

    public static function decodificaMensagem() {
        //nao implementado
    }
    
    public static function log($caminho, $texto) {
        file_put_contents($caminho, $texto . "\n", FILE_APPEND);
    }

    public static function registraOcorrencia($debug_backtrace)
    {
        $log = '';
        
        return;
        foreach ($debug_backtrace as $chave => $valor){
            @$log.= 'Arquivo:' . $valor['file']     . '\n';
            @$log.= 'Linha:'   . $valor['line']     . '\n';
            @$log.= 'M�todo:'  . $valor['function'] . '\n';
            @$log.= 'Classe:'  . $valor['class']    . '\n';
            @$log.= 'Tipo:'    . $valor['type']     . '\n';

            if (is_array($valor['args'])){
                $arg = $valor['args'];
                $log.= 'Parâmetros:'.serialize($arg)."\n";
            }else{
                $log.= 'Parâmetros:'.$valor['args']."\n";
            }
            $log.= '\n';
        }
        error_log($log, 0);
    }

    public static function enviaCorrespondencia(CorrespondenciaXMdl $correspondenciaMdl){
        //se necess�rio deve anexar os artefatos(arquivos) -- anexaDocumentoMensagem
        //se necess�rio deve validar as informa��es antes de enviar a mensagem -- validaCorrespondencia
        if (!mail($correspondenciaMdl->pegaDestinatario(), 
                $correspondenciaMdl->pegaAssunto(), 
                $correspondenciaMdl->pegaMessagem(), 
                $correspondenciaMdl->pegaCaracteristicas()))
        {
            $tratamentoXmn = new TratamentoXmn();
            $tratamentoXmn->atribuiArquetipo('EMAIL');
            $tratamentoXmn->atribuiCodigo('FALHA_ENVIO_CORRESPONDENCIA');
            throw $tratamentoXmn;
        }
    }
    
    public static function anexaDocumentoMensagem(ArtefatoXmn $artefatoXmn, $artefato){
        //refazer classe
        $nomeArtefato    = substr(strrchr($artefato, "/"), 1);
        $conteudo = file_get_contents($artefato);
        $i = count($partes);

        $id_conteudo = 
            "part$i." . 
            sprintf("%09d", crc32($nomeArtefato)) . 
            strrchr($artefatoXmn->pegaDestinatario(), "@");

        $partes[$i] = 
            "Content-Type: ".mime_content_type($artefato) . "; " .
            "name=\"$nomeArtefato\"\r\n" .
            "Content-Transfer-Encoding: base64\r\n" .
            "Content-ID: <$id_conteudo>\r\n" .
            "Content-Disposition: inline;\n" .
            " filename=\"$nomeArtefato\"\r\n" .
            "\n" .

        chunk_split(base64_encode($conteudo), 68, "\n");
        $artefatoXmn->atribuiConteudo($id_conteudo);
    }
    
    private static function validaCorrespondencia($destinatario, $maquinaInternet) {
        //refazer classe
        $resultado = array();
        
        /*Step 1: initialize function
        Step 2 -- Check the e-mail address format
        Next, you'll use our regular expression to determine if the e-mail address is properly formatted. If the e-mail address is not valid, return in error:
        */
        if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $destinatario)) {
            $resultado[0] = false;
            $resultado[1] = "$destinatario is not properly formatted";
            return $resultado;
        }
        
        $resultado[0] = true;
        $resultado[1] = "$destinatario appears to be valid.";
        return $resultado;
        
        /*
        Step 3 -- Find the address of the mail server
        
        Now, split apart the e-mail address and use the domain name to search for a mail server you can use to further check the e-mail address. If no mail server is found, you'll just use the domain address as a mail server address:
        
        Note: In the event that the optional step 4 is not followed, the else portion of this step must return in error in order for the script to function properly.
        */
        
        list ($usuario, $dominio ) = explode ("@", $destinatario);

        if (getmxrr($dominio, $maquinaMx = array())){
            $enderecoConexao = $maquinaMx[0];
        } else {
            $enderecoConexao = $dominio;        
        }
        
        /*
        Step 4 -- Connect to mail server and check e-mail address (OPTIONAL)
        
        Finally, once you have the best guess at a mail server, it's time to open a connection and talk to the server. As I stated earlier, this step is optional. After every command you send, you'll need to read a kilobyte (1024 bytes) of data from the server. It should be more than enough to receive the complete response from the server for that command.
        
        Note that you'll store the output from the server in three separate variables: $To, $From and $Out. This is done so you can check the responses after you close the connection, to see if you actually have a real e-mail address or not.
        
        If the script cannot connect at all, or the e-mail address wasn't valid, set the $resultado array to the proper values:
        */
        
        $conexao = fsockopen ($enderecoConexao, 25 );
        
        if ($conexao) {
            if (ereg("^220", $saida = fgets($conexao, 1024))) {
                fputs ($conexao, "HELO $maquinaInternet\r\n");
                $saida = fgets ( $conexao, 1024 );

                fputs ($conexao, "MAIL FROM: <{$destinatario}>\r\n");
                $origem = fgets ( $conexao, 1024 );

                fputs ($conexao, "RCPT TO: <{$destinatario}>\r\n");
                $destino = fgets ($conexao, 1024);

                fputs ($conexao, "QUIT\r\n");
                fclose($conexao);
                
                if (!ereg ("^250", $origem) || !ereg ( "^250", $destino )) {
                    $resultado[0] = false;
                    $resultado[1] = 'Server rejected address';
                    return $resultado;
                }
            }else{
                $resultado[0] = false;
                $resultado[1] = 'No response from server';
                return $resultado;
            }
            }else{
            $resultado[0] = false;
            $resultado[1] = 'Can not connect E-Mail server.';
                return $resultado;
        }
        
        /*
        Step 5 -- Return the results
        
        Finally, our last and easiest step is to return the results and finish:
        */
        $resultado[0] = true;
        $resultado[1] = "$destinatario appears to be valid.";
        return $resultado;
    }
    
    public static function xml($texto , $xmn)
    {
        header("Content-type: application/xml; charset=" 
            . Xaman::pegaAtributo($xmn . '_LINGUA'));
        echo '<?xml version="1.0" encoding="' 
            . Xaman::pegaAtributo($xmn . '_LINGUA') .'"?>' . $texto;
        return true;
    }

}
