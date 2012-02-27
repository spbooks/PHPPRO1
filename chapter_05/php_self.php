<?php

echo $_SERVER['SCRIPT_NAME'];

echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME']);
