<?php

/*****************************************************
 * Voorbeeld van ABS API:							 *
 * Vraag versieinformatie op.						 *
 *****************************************************/

include("includes/base.inc.php");

print("<pre>");
print_r(absApiCall('GET', 'versie', array(), $apiClientName, $apiSecret, $apiEndpoint));
print("</pre>");