import my_debugger
from my_debugger_defines import *

import sys
debugger = my_debugger.debugger()

password = str(sys.argv[1])

debugger.load("Ambrosius2.exe")
debugger.setPassword(password)
debugger.bp_set(0x00401458);
debugger.bp_set(0x00401425);
debugger.bp_set(0x0040143B);

debugger.run()
debugger.detach()