import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {
	const {
		faqs = [],
		showNumbering = false,
		headingLevel = 4,
		listStyle = 'decimal',
	} = attributes;

	if (!faqs.length) return null;

	const schemaData = {
		"@context": "https://schema.org",
		"@type": "FAQPage",
		"mainEntity": faqs.map(faq => ({
			"@type": "Question",
			"name": faq.question,
			"acceptedAnswer": {
				"@type": "Answer",
				"text": faq.answer
			}
		}))
	};

	const getMarkerForIndex = (i) => {
		switch (listStyle) {
			case 'disc': return '•';
			case 'circle': return '○';
			case 'square': return '■';
			case 'decimal':
			default: return `${i + 1}.`;
		}
	};

	const HeadingTag = `h${headingLevel}`;

	return (
		<div {...useBlockProps.save()} className="sp-faq-block">
			{faqs.map((faq, index) => (
				<div key={index} className="sp-faq-item">
					{/* Question with optional marker */}
					<HeadingTag className="sp-faq-question">
						{showNumbering && (
							<span className={`faq-marker marker-${listStyle}`}>
								{getMarkerForIndex(index)}{' '}
							</span>
						)}
						{faq.question}
					</HeadingTag>

					{/* Answer */}
					<RichText.Content
						tagName="div"
						className="sp-faq-answer"
						value={faq.answer}
					/>

					{/* Image */}
					{faq.imageUrl && (
						<div className="sp-faq-image">
							<img src={faq.imageUrl} alt="" />
						</div>
					)}
				</div>
			))}

			{/* Schema Markup */}
			<script type="application/ld+json">
				{JSON.stringify(schemaData)}
			</script>
		</div>
	);
}
