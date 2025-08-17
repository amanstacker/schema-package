<?php
// This file is generated. Do not modify it manually.
return array(
	'faq-block' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/faq-block',
		'version' => '0.1.0',
		'title' => 'FAQ Block',
		'category' => 'widgets',
		'icon' => 'editor-help',
		'description' => 'A block to add FAQs with schema markup.',
		'supports' => array(
			'html' => false,
			'color' => array(
				'background' => true,
				'text' => true
			),
			'spacing' => array(
				'padding' => true,
				'margin' => true
			)
		),
		'textdomain' => 'faq-block',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'viewScript' => 'file:./view.js',
		'attributes' => array(
			'faqs' => array(
				'type' => 'array',
				'default' => array(
					
				)
			),
			'boxStyle' => array(
				'type' => 'string',
				'default' => 'bordered'
			),
			'showNumbering' => array(
				'type' => 'boolean',
				'default' => false
			),
			'headingLevel' => array(
				'type' => 'number',
				'default' => 4
			),
			'listStyle' => array(
				'type' => 'string',
				'default' => 'decimal'
			)
		)
	)
);
