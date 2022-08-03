<?php

/**
 * Registers the `eventtype` taxonomy,
 * for use with 'event'.
 */
function eventtype_terms_init()
{
	'eventtype';
	wp_insert_term("statement", "eventtype", [
		"slug" => "statement",
		"description" => "for meeting details"
	]);
	wp_insert_term("actuality", "eventtype", [
		"slug" => "actuality",
		"description" => "for actuality"
	]);
}

add_action('init', 'eventtype_terms_init');
