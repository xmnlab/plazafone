# coding: latin-1
from pydaruma.pydaruma import (
    iImprimirTexto_DUAL_DarumaFramework,
    # regCodePageAutomatico_DUAL_DarumaFramework,
    # eAbrirSerial_Daruma,
    # eFecharSerial_Daruma
)
from ctypes import create_string_buffer

# eAbrirSerial_Daruma('COM10', '115200')
# regCodePageAutomatico_DUAL_DarumaFramework('0')

texto = create_string_buffer(2000)

with open('/var/www/html/xsos/xsos_print.txt', 'r', encoding='utf-8') as f:
    texto = f.read()

# guilhotina
texto += '<gui></gui>'

iImprimirTexto_DUAL_DarumaFramework(texto, 0)

# eFecharSerial_Daruma()

