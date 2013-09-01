<?php

/**
 * Funkcja wypełniająca szablon zadanymi zmiennymi
 */
function template($theme_name, $variables) {
	$template_file = './tpl/' . $theme_name . '.tpl.php';
	extract($variables, EXTR_SKIP);
	ob_start();
	include $template_file;
	$contents = ob_get_contents();
	ob_end_clean();
	return $contents;
}

/**
 * Funkcja do operowania na globalnych zmiennych konfiguracyjnych.
 */
function variable($var, $val=null) {
	global $conf;
	if (isset($val)) {
		$conf[$var] = $val;
	}
	if (!isset($conf[$var])) {
		return null;
	}
	return $conf[$var];
}

/**
 * Funkcja konwertująca zmienną tekstową na tablicę pojedyńcnzych słów. 
 * Wycina znaki przystankowe zdefiniowane w konfiguracji oraz zapisuje słowa małymi literami.
 */
function str_to_words_array($s) {
	return array_map('strtolower', explode(' ', str_replace(variable('delimiters'),' ',$s)));
}

