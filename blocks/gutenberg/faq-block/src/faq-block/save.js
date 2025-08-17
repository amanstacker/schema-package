/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, RichText } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {Element} Element to render.
 */
export default function save({ attributes }) {
	const { faqs = [] } = attributes;

	if (!faqs.length) {
		return null;
	}

	// Generate FAQ schema data
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

	return (
		<div { ...useBlockProps.save() } className="sp-faq-block">
			{faqs.map((faq, index) => (
				<div key={index} className="sp-faq-item">
					{/* Question */}
					<RichText.Content
						tagName="h3"
						className="sp-faq-question"
						value={faq.question}
					/>

					{/* Answer */}
					<RichText.Content
						tagName="div"
						className="sp-faq-answer"
						value={faq.answer}
					/>

					{/* Answer Image (optional) */}
					{faq.imageUrl && (
						<div className="sp-faq-image">
							<img src={faq.imageUrl} alt="" />
						</div>
					)}
				</div>
			))}
			{/* Schema Markup Output */}
			<script type="application/ld+json">
				{JSON.stringify(schemaData)}
			</script>
		</div>
	);
}
