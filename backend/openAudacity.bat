@if (@CodeSection == @Batch) @then


@echo off

rem Use %SendKeys% to send keys to the keyboard buffer
set SendKeys=CScript //nologo //E:JScript "%~F0"

rem Start the other program in the same Window
start "" /B C:\"Program Files (x86)"\Audacity\audacity.exe
ping -n 4 -w 1 127.0.0.1 > NUL
start openWindow.bat "Audacity" ""
ping -n 2 -w 1 127.0.0.1 > NUL
%SendKeys% "R"

EXIT 

goto :EOF


@end


// JScript section

var WshShell = WScript.CreateObject("WScript.Shell");
WshShell.SendKeys(WScript.Arguments(0));