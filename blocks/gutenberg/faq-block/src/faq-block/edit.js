/**
 * Retrieves the translation of text.
 */
import { __ } from '@wordpress/i18n';

/**
 * WordPress block editor components.
 */
import {
	useBlockProps,
	RichText,
	InspectorControls,
	BlockControls,
	HeadingLevelDropdown,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';

/**
 * WordPress UI components.
 */
import {
	Button,
	PanelBody,
	ToggleControl,
	SelectControl,
	ToolbarGroup,
} from '@wordpress/components';

/**
 * React hook
 */
import { useEffect } from '@wordpress/element';

/**
 * Custom CSS for editor.
 */
import './editor.scss';

/**
 * Block Edit Component
 */
export default function Edit({ attributes, setAttributes }) {
	const {
		faqs = [],
		boxStyle = 'bordered',
		showNumbering = false,
		headingLevel = 4,
		listStyle = 'decimal',
	} = attributes;

	/**
	 * Ensure at least one FAQ exists when block is first added
	 */
	useEffect(() => {
		if (faqs.length === 0) {
			setAttributes({ faqs: [{ question: '', answer: '', imageUrl: '' }] });
		}
	}, []); // Run only once on mount

	/**
	 * Add a new FAQ item.
	 */
	const addFaq = () => {
		setAttributes({ faqs: [...faqs, { question: '', answer: '', imageUrl: '' }] });
	};

	/**
	 * Update FAQ field.
	 */
	const updateFaq = (index, key, value) => {
		const newFaqs = [...faqs];
		newFaqs[index][key] = value;
		setAttributes({ faqs: newFaqs });
	};

	/**
	 * Remove FAQ.
	 */
	const removeFaq = (index) => {
		const newFaqs = [...faqs];
		newFaqs.splice(index, 1);
		setAttributes({ faqs: newFaqs });
	};

	/**
	 * Get the visible marker text for the header label based on listStyle.
	 */
	const getMarkerForIndex = (i) => {
		switch (listStyle) {
			case 'disc':
				return '•';
			case 'circle':
				return '○';
			case 'square':
				return '■';
			case 'decimal':
			default:
				return `${i + 1}.`;
		}
	};

	return (
		<>
			{/* Top toolbar with Gutenberg heading selector */}
			<BlockControls>
				<ToolbarGroup>
					<HeadingLevelDropdown
						value={headingLevel}
						onChange={(newLevel) => setAttributes({ headingLevel: newLevel })}
					/>
				</ToolbarGroup>
			</BlockControls>

			{/* Sidebar settings */}
			<InspectorControls>
				<PanelBody title={__('FAQ Settings', 'faq-block')} initialOpen={true}>
					<SelectControl
						label={__('Box Style', 'faq-block')}
						value={boxStyle}
						options={[
							{ label: __('Bordered', 'faq-block'), value: 'bordered' },
							{ label: __('Shadowed', 'faq-block'), value: 'shadowed' },
							{ label: __('Minimal', 'faq-block'), value: 'minimal' },
						]}
						onChange={(value) => setAttributes({ boxStyle: value })}
					/>

					<ToggleControl
						label={__('Show Numbering / Marker', 'faq-block')}
						checked={showNumbering}
						onChange={(value) => setAttributes({ showNumbering: value })}
					/>

					{/* Heading Label Style appears directly below toggle */}
					{showNumbering && (
						<SelectControl
							label={__('Heading Label Style', 'faq-block')}
							value={listStyle}
							options={[
								{ label: __('1, 2, 3 (Decimal)', 'faq-block'), value: 'decimal' },
								{ label: __('• (Disc)', 'faq-block'), value: 'disc' },
								{ label: __('○ (Circle)', 'faq-block'), value: 'circle' },
								{ label: __('■ (Square)', 'faq-block'), value: 'square' },
							]}
							onChange={(value) => setAttributes({ listStyle: value })}
							help={__('Controls the marker shown before each question heading.', 'faq-block')}
						/>
					)}

					<SelectControl
						label={__('Heading Level', 'faq-block')}
						value={headingLevel}
						options={[1, 2, 3, 4, 5, 6].map((level) => ({
							label: `H${level}`,
							value: level,
						}))}
						onChange={(value) => setAttributes({ headingLevel: parseInt(value, 10) })}
					/>
				</PanelBody>
			</InspectorControls>

			{/* Main block wrapper */}
			<div {...useBlockProps()}>
				{faqs.length === 0 && (
					<p>{__('Click "Add FAQ" to start creating questions.', 'faq-block')}</p>
				)}

				{faqs.map((faq, index) => {
					const HeadingTag = `h${headingLevel}`;

					return (
						<div key={index} className={`faq-item faq-style-${boxStyle}`}>
							{/* FAQ Header */}
							<div className="faq-header">
								<div className="faq-header-left">
									{showNumbering && (
										<span className={`faq-marker marker-${listStyle}`}>
											{getMarkerForIndex(index)}
										</span>
									)}
									<RichText
										tagName={HeadingTag}
										placeholder={__('Enter question…', 'faq-block')}
										value={faq.question}
										onChange={(value) => updateFaq(index, 'question', value)}
									/>
								</div>

								<div className="faq-header-right">
									<Button
										icon="trash" // changed from "no-alt" to "trash"
										label={__('Remove FAQ', 'faq-block')}
										onClick={() => removeFaq(index)}
										className="faq-remove-icon"
										isDestructive
									/>
								</div>
							</div>

							{/* Answer */}
							<div className="faq-answer-wrapper">
								<RichText
									tagName="p"
									placeholder={__('Enter the answer to the question…', 'faq-block')}
									value={faq.answer}
									onChange={(value) => updateFaq(index, 'answer', value)}
								/>
							</div>

							{/* Image Upload / Change / Remove */}
							<div className="faq-image-wrapper">
								{faq.imageUrl && (
									<img
										src={faq.imageUrl}
										alt={faq.question || __('FAQ image', 'faq-block')}
										className="faq-answer-image"
									/>
								)}

								<div className="faq-image-actions">
									<MediaUploadCheck>
										<MediaUpload
											onSelect={(media) => updateFaq(index, 'imageUrl', media.url)}
											allowedTypes={['image']}
											render={({ open }) => (
												<Button isSecondary onClick={open}>
													{faq.imageUrl
														? __('Change Image', 'faq-block')
														: __('Upload Image', 'faq-block')}
												</Button>
											)}
										/>
									</MediaUploadCheck>

									{faq.imageUrl && (
										<Button
											isTertiary
											onClick={() => updateFaq(index, 'imageUrl', '')}
										>
											{__('Remove Image', 'faq-block')}
										</Button>
									)}
								</div>
							</div>
						</div>
					);
				})}

				<Button variant="primary" onClick={addFaq}>
					{__('Add More FAQ', 'faq-block')}
				</Button>
			</div>
		</>
	);
}
