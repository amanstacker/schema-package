﻿=== Schema Package - A Structured Data Module ===
Contributors: amanstacker
Tags: Structured Data, Schema, Rich Results, carousel schema, Product
Donate link: https://www.paypal.com/paypalme/amanstacker
Requires PHP: 5.6.20
Requires at least: 5.0
Tested up to: 6.8
Stable tag: 1.0.16
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Helps website owners automate and add versatile schema markup to their websites, enabling more informative and visually appealing search results.

== Description ==

The main purpose of the Schema Package is to automate the creation of schema markup (JSON-LD) for websites. Instead of manually entering the same information twice — once in the actual content and again in the **Schema Package Generator** metabox or other custom fields. Schema Package simplifies the process. It achieves this by integrating with plugins or themes that generate content, ensuring compatibility and automation.

We have automated the creation of schema markup (JSON-LD) for some of the plugins listed below. If your plugin is not on the list, please [request](https://github.com/amanstacker/schema-package/issues/new) or contact us, and we will automate it as well.

In some cases, automation isn't enough and requires manual data entry. For such situations, we've provided the **Schema Package Generator** — a powerful, minimalistic, popup-style interface that allows you to smoothly enter data for all schema types, one by one.


== Your Trust, Our Motive: Exceptional Schema Markup Services ==

As newcomers to the market, earning your trust can be challenging. We invite you to give us a try, and we'll go above and beyond to ensure your satisfaction with setting up schema markup for your site. Don't hesitate to reach out to us for any assistance.


== What is Schema Markup and why is it important? ==

Schema Markup refers to the standardized vocabulary (provided by Schema.org) used to structure data in a format that Search Engines or AI Systems can understand. JSON-LD is one way to implement Schema Markup; others include Microdata and RDFa. By providing additional context about your content, schema markup can help Search Engines present more relevant and detailed results to users, benefiting both the website's visibility and user interaction.


1. **Enhanced Search Engine Visibility** - By adding schema markup to a webpage, Search Engines and AI Systems can better understand its content. This often leads to rich snippets, which can appear in search results, such as star ratings, prices, images, and other structured data. These elements increase the visibility of the webpage in search results.
2. **Enhanced AI Systems Results** - AI can easily parse structured data to understand the key attributes of the content, making it more accurate when providing answers or generating summaries.
3. **Improved Click-Through Rate (CTR)** - Rich snippets stand out more in search results, leading to higher engagement and more clicks. For example, when a recipe shows cooking times and ratings in the search results, users may be more likely to click.
4. **Better User Experience** - Schema markup helps Search Engines and AI Systems present content in a more relevant and accessible way. For example, when an article includes structured data, users can find key details like publication date, author, and main topic more easily.
5. **Voice Search Optimization** - Schema markup can help optimize content for voice search, where structured data allows devices like virtual assistants to understand and retrieve the information more efficiently, improving voice search rankings.
6. **Local SEO Improvement** - For businesses with a physical presence, schema markup can improve local SEO by providing location-based data (e.g., business hours, contact information, and address) that helps your business show up in local search results.
7. **Faster Indexing** - Search Engines can better interpret and index your content when schema markup is in place, which can help get your pages indexed faster and more accurately.


### What is JSON-LD (JavaScript Object Notation for Linked Data)?

JSON-LD is a lightweight Linked Data format that uses JSON to encode structured data. It is one of the formats recommended by all popular Search Engines for adding schema markup ( structured data ) to web pages. JSON-LD embeds data in the <script> tags of an HTML document without affecting the visual appearance of the page.


### Schema Package Key Features


* <strong>Unlimited Schema</strong>: No limitation on schema type selection, Add as much as you want.
* <strong>Singular Schema</strong>: Select different kinds of schema based on your needs globally.
* <strong>Schema Mapping</strong>: Effortless schema mapping. Quickly select post meta fields, search custom fields, and map them to schema properties with a user-friendly interface.
* <strong>Schema Mapping for Custom Fields </strong>: Seamlessly map singular schema properties with the core WordPress Custom Fields , enhancing automation flexibility for schema implementation.
* <strong>Schema Mapping for Advanced Custom Fields Plugin </strong>: Seamlessly map singular schema properties with the Advanced Custom Fields plugin, enhancing automation flexibility for schema implementation.
* <strong>Schema Mapping for Secure Custom Fields Plugin </strong>: Seamlessly map singular schema properties with the Secure Custom Fields plugin, enhancing automation flexibility for schema implementation.
* <strong>Targeting</strong>: Target your selected Singular schema types based on your needs, such as posts, pages, custom post types, taxonomies, etc.
* <strong>Carousel Schema</strong>: Choose various schema types according to your requirements and automate them for detailed JSON-LD views.
* <strong>Custom Schema</strong>: Custom Schema allows users to enter their own JSON-LD markup, giving them full control over structured data implementation. This feature enables advanced customization beyond predefined schema types, ensuring flexibility. 
* <strong>Carousel Targeting</strong>: Target your selected Carousel schema types based on your needs, such as categories, tags, Product categories, taxonomies, etc.
* <strong>Schema Package Generator</strong>: Select different kinds of schema based on your needs.
* <strong>Schema Package Generator Control Center</strong>: Enable SPG based on selected post types, taxonomies or author profile.
* <strong>JSON-LD Format</strong>: Schema Package only supports JSON-LD Format as recommended by most of the Search Engines. Like Google, Bing, Yahoo etc.
* <strong>Manage Conflict</strong>: If two or more schema plugins used on same website. They may confict and throw error in schema validator tool. Using Schema Package keep required schema markup
* <strong>Easy To Use UI</strong>: No need to reload schema package dashboard again and again to complete setup. Its a single page dashboard which is very fast in navigation.
* <strong>Compatibility</strong>: Automate schema markup for the plugins who generate schema related contents. You can find the compatibility list down the order.
* <strong>MicroData Cleaner</strong>: Since JSON-LD is the preferred format for structured data, Schema Package helps remove any legacy microdata injected by themes or plugins, ensuring your markup stays clean and consistent.
* <strong>RDFa Cleaner</strong>: Since JSON-LD is the preferred format for structured data, Schema Package helps remove any legacy RDFa injected by themes or plugins, ensuring your markup stays clean and consistent.
* <strong>Default Data Option</strong>: Set global fallback values for schema fields to prevent errors and save time when dynamic data is missing.
* <strong>Delete Data on Uninstall</strong>: Option to remove all Schema Pacakge plugin data from the database when Schema Package plugin is uninstalled, ensuring a clean removal.
* <strong>Fast Help & Support</strong>: If you are unable to find any features related to schema package or found any bug. Please contact us, Schema Package team would try to solve it quickly.


== Schema Package Supported Schema Types ==

The Schema Package plugin supports a wide range of Schema.org types, covering various industries and use cases. Below is the complete list:

=== 1. Organization & Business ===
- [Organization](https://schema.org/Organization)
- [LocalBusiness](https://schema.org/LocalBusiness)
- [Corporation](https://schema.org/Corporation)
- [NGO](https://schema.org/NGO)
- [GovernmentOrganization](https://schema.org/GovernmentOrganization)
- [EducationalOrganization](https://schema.org/EducationalOrganization)
- [MedicalOrganization](https://schema.org/MedicalOrganization)
- [SportsOrganization](https://schema.org/SportsOrganization)
- [Store](https://schema.org/Store)

=== 2. Website & Content ===
- [WebSite](https://schema.org/WebSite)
- [WebPage](https://schema.org/WebPage)
- [Article](https://schema.org/Article)
- [NewsArticle](https://schema.org/NewsArticle)
- [BlogPosting](https://schema.org/BlogPosting)
- [Guide](https://schema.org/Guide)
- [FAQPage](https://schema.org/FAQPage)
- [HowTo](https://schema.org/HowTo)
- [BreadcrumbList](https://schema.org/BreadcrumbList)
- [ItemList](https://schema.org/ItemList)
- [CollectionPage](https://schema.org/CollectionPage)
- [LiveBlogPosting](https://schema.org/LiveBlogPosting)
- [QAPage](https://schema.org/QAPage)
- [TechArticle](https://schema.org/TechArticle)
- [Comment](https://schema.org/Comment)
- [SiteNavigationElement](https://schema.org/SiteNavigationElement)

=== 3. E-commerce & Products ===
- [Product](https://schema.org/Product)
- [Offer](https://schema.org/Offer)
- [AggregateOffer](https://schema.org/AggregateOffer)
- [Brand](https://schema.org/Brand)
- [Review](https://schema.org/Review)
- [AggregateRating](https://schema.org/AggregateRating)
- [Service](https://schema.org/Service)
- [FinancialProduct](https://schema.org/FinancialProduct)
- [MemberProgram](https://schema.org/MemberProgram)

=== 4. Events ===
- [Event](https://schema.org/Event)
- [BusinessEvent](https://schema.org/BusinessEvent)
- [EducationEvent](https://schema.org/EducationEvent)
- [Festival](https://schema.org/Festival)
- [MusicEvent](https://schema.org/MusicEvent)
- [SportsEvent](https://schema.org/SportsEvent)
- [TheaterEvent](https://schema.org/TheaterEvent)
- [VisualArtsEvent](https://schema.org/VisualArtsEvent)
- [ExhibitionEvent](https://schema.org/ExhibitionEvent)
- [CourseInstance](https://schema.org/CourseInstance)

=== 5. Jobs & Employment ===
- [JobPosting](https://schema.org/JobPosting)
- [Occupation](https://schema.org/Occupation)
- [EmployeeRole](https://schema.org/EmployeeRole)
- [WorkBasedProgram](https://schema.org/WorkBasedProgram)

=== 6. People & Personal Profiles ===
- [ProfilePage](https://schema.org/ProfilePage)
- [Person](https://schema.org/Person)
- [Author](https://schema.org/Person)
- [Celebrity](https://schema.org/Person)
- [Teacher](https://schema.org/Person)
- [Parent](https://schema.org/Person)
- [Patient](https://schema.org/Person)
- [Musician](https://schema.org/Musician)
- [Actor](https://schema.org/Person)
- [Athlete](https://schema.org/Person)
- [Politician](https://schema.org/Person)

=== 7. Health & Medical ===
- [MedicalOrganization](https://schema.org/MedicalOrganization)
- [Hospital](https://schema.org/Hospital)
- [Physician](https://schema.org/Physician)
- [Clinic](https://schema.org/MedicalClinic)
- [MedicalProcedure](https://schema.org/MedicalProcedure)
- [MedicalCondition](https://schema.org/MedicalCondition)
- [Drug](https://schema.org/Drug)

=== 8. Recipes & Food ===
- [Recipe](https://schema.org/Recipe)
- [Cookbook](https://schema.org/Book)
- [Menu](https://schema.org/Menu)
- [Restaurant](https://schema.org/Restaurant)
- [CafeOrCoffeeShop](https://schema.org/CafeOrCoffeeShop)
- [FoodEstablishment](https://schema.org/FoodEstablishment)
- [Bakery](https://schema.org/Bakery)
- [BarOrPub](https://schema.org/BarOrPub)
- [FastFoodRestaurant](https://schema.org/FastFoodRestaurant)
- [IceCreamShop](https://schema.org/IceCreamShop)
- [FoodService](https://schema.org/FoodService)

=== 9. Real Estate & Property ===
- [RealEstateListing](https://schema.org/RealEstateListing)
- [Apartment](https://schema.org/Apartment)
- [House](https://schema.org/House)
- [SingleFamilyResidence](https://schema.org/SingleFamilyResidence)

=== 10. Travel & Transportation ===
- [Flight](https://schema.org/Flight)
- [Trip](https://schema.org/Trip)
- [TouristTrip](https://schema.org/TouristTrip)
- [TaxiService](https://schema.org/TaxiService)

=== 11. Education & Courses ===
- [EducationalOrganization](https://schema.org/EducationalOrganization)
- [School](https://schema.org/School)
- [CollegeOrUniversity](https://schema.org/CollegeOrUniversity)
- [Course](https://schema.org/Course)
- [CourseInstance](https://schema.org/CourseInstance)
- [LearningResource](https://schema.org/LearningResource)

=== 12. Media & Entertainment ===
- [Book](https://schema.org/Book)
- [Movie](https://schema.org/Movie)
- [TVSeries](https://schema.org/TVSeries)
- [MusicAlbum](https://schema.org/MusicAlbum)
- [MusicPlaylist](https://schema.org/MusicPlaylist)
- [VideoObject](https://schema.org/VideoObject)
- [AudioObject](https://schema.org/AudioObject)
- [BroadcastService](https://schema.org/BroadcastService)
- [CableOrSatelliteService](https://schema.org/CableOrSatelliteService)

=== 13. Technology & Software ===
- [SoftwareApplication](https://schema.org/SoftwareApplication)
- [MobileApplication](https://schema.org/MobileApplication)
- [WebAPI](https://schema.org/WebAPI)

=== 14. Visual & Image Content ===
- [ImageObject](https://schema.org/ImageObject)
- [MediaGallery](https://schema.org/MediaGallery)
- [ImageGallery](https://schema.org/ImageGallery)
- [Photograph](https://schema.org/Photograph)


### Schema package automation and compatibility with plugins.

* [WooCommerce](https://wordpress.org/plugins/woocommerce)
* [Simple Job Board](https://wordpress.org/plugins/simple-job-board/)
* [Mooberry Book Manager](https://wordpress.org/plugins/mooberry-book-manager)
* [Brands for WooCommerce](https://wordpress.org/plugins/brands-for-woocommerce)
* [Perfect Brands for WooCommerce](https://wordpress.org/plugins/perfect-woocommerce-brands)
* [Ryviu – Product Reviews for WooCommerce](https://wordpress.org/plugins/ryviu)
* [Customer Reviews for WooCommerce](https://wordpress.org/plugins/customer-reviews-woocommerce)
* [Site Reviews](https://wordpress.org/plugins/site-reviews/)
* [YITH WooCommerce Brands Add-On](https://wordpress.org/plugins/yith-woocommerce-brands-add-on)
* [Ultimate Reviews](https://wordpress.org/plugins/ultimate-reviews)
* [Yotpo: Product & Photo Reviews for WooCommerce](https://wordpress.org/plugins/yotpo-social-reviews-for-woocommerce)
* [Accordion By PickPlugins](https://wordpress.org/plugins/accordions)
* [Quick and Easy FAQs](https://wordpress.org/plugins/quick-and-easy-faqs/)
* [Accordion FAQ](https://wordpress.org/plugins/responsive-accordion-and-collapse)
* [Easy Accordion](https://wordpress.org/plugins/easy-accordion-free)
* [WP Responsive FAQ with Category Plugin](https://wordpress.org/plugins/sp-faq)
* [Arconix FAQ](https://wordpress.org/plugins/arconix-faq)
* [kk Star Ratings](https://wordpress.org/plugins/kk-star-ratings/)
* [WooCommerce Event Manager](https://wordpress.org/plugins/mage-eventpress/)
* [WP Event Manager](https://wordpress.org/plugins/wp-event-manager/)
* [WP-PostRatings](https://wordpress.org/plugins/wp-postratings/)
* [Rank Math](https://wordpress.org/plugins/seo-by-rank-math/)
* [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/)
* [The SEO Framework](https://wordpress.org/plugins/autodescription/)
* [Squirrly SEO](https://wordpress.org/plugins/squirrly-seo/)
* [SmartCrawl SEO](https://wordpress.org/plugins/smartcrawl-seo/)
* [SEOPress](https://wordpress.org/plugins/wp-seopress/)
* [Advanced Custom Fields (ACF®)](https://wordpress.org/plugins/advanced-custom-fields/)
* [Secure Custom Fields](https://wordpress.org/plugins/secure-custom-fields/)
* [Absolute Reviews](https://wordpress.org/plugins/absolute-reviews/)
* [Rate My Post – Star Rating Plugin by FeedbackWP](https://wordpress.org/plugins/rate-my-post/)
* [Meta Box](https://wordpress.org/plugins/meta-box/)
* [MasterStudy LMS WordPress Plugin – for Online Courses and Education](https://wordpress.org/plugins/masterstudy-lms-learning-management-system/)


== Notes ==

The Schema package is a tool for adding schema markup to websites according to search engine guidelines and validating it using tools recommended by Search Engines. It does not guarantee that your content will appear in search engine results as you desire. It entirely depends on the Search Engines.

Here are some schema and structured data markup validator tools that can help you validate and troubleshoot your markup:

#### 1. [Google Rich Results Test](https://search.google.com/test/rich-results)

The "Google Rich Results Test" does not validate all types of schema.org markup. It is primarily designed to test the types of schema markup that can generate rich results in Google search, such as Product, Recipe, Event, FAQ and others related to search features.

While it can validate whether your structured data is correctly implemented for rich results, it doesn't support every schema.org type. For example, it may not check more general types like Service, Organization, or CreativeWork, unless they are directly relevant to a rich result display.


#### 2. [Schema Markup Validator](https://validator.schema.org/)

The "Schema Markup Validator" by Google validates all schema.org types, not just those that are eligible for rich results. This tool checks whether your structured data is correctly implemented according to the schema.org specifications, regardless of whether the type is eligible for rich results.


== Report Bug or Contribute fix ==

Encounter an issue with Schema Package? or wanted to contribute. Kindly visit Schema Package repository on [GitHub](https://github.com/amanstacker/schema-package). Please be aware that GitHub is not a support forum, but rather a streamlined platform for effectively addressing and solving problems.


== Support & Documentation ==

For help, documentation, and tutorials, visit our official website:
📚 [Knowledge Base](https://schemapackage.com/knowledge-base/)
💬 [Help & Support](https://schemapackage.com/contactus/)

Inside WordPress, you can also go to:  
**Schema Package → Settings → Help & Support**

== Premium Features ==

Take your schema & structured data to the next level with **Schema Package Premium**:

* WooCommerce Variable Product Automation
* RealEstate Schema Types & Automation
* Healthcare Schema Types & Automation
* Carousel Schema Details Page List
* Multilingual Schema Markup Support
* Advanced ACF/SCF Mapping
* Schema Markup Setup & Error Clean Up
* 24/7 Priority Support
* Premium Features On Demand
* ...and more!

Learn more: https://schemapackage.com/premium/


== Installation ==

1. **Automatic Installation:**
   - Go to **Plugins > Add New** in your WordPress dashboard.
   - Search for "Schema Package Plugin".
   - Click **Install Now**, then **Activate** the plugin.

2. **Manual Installation via WordPress:**
   - Download the plugin ZIP file from the official source.
   - Go to **Plugins > Add New** in WordPress.
   - Click **Upload Plugin**, select the downloaded ZIP file, and click **Install Now**.
   - Activate the plugin after installation.

3. **Manual Installation via FTP:**
   - Download the plugin ZIP file and extract it.
   - Upload the extracted folder to the `/wp-content/plugins/` directory using an FTP client.
   - Log in to your WordPress dashboard and go to **Plugins > Installed Plugins**.
   - Find "Schema Package Plugin" and click **Activate**.

4. From the WordPress dashboard, navigate to the **Schema Package** menu to access and configure the plugin settings.
5. Start adding Schema markup using the built-in **Schema Package Generator** and mapping tools.


== WordPress REST API ==

The Schema Package uses the WordPress REST API to power its single-page application dashboard. If you’re unable to access the Schema Package dashboard, it’s likely that your site is blocking the REST API, or another plugin has restricted access. Please ensure the WordPress REST API is enabled for the Schema Package to function properly.


== External Services ==

Schema Package uses the following external services:

#### 1. Ryviu API

Schema Package connects to Ryviu API to fetch product reviews. Its needed to generate Reviews schema markup for WooCommerce product.

It sends the user's site url when Ryviu option is enabled inside automation metabox and "Ryviu – Product Reviews for WooCommerce" plugin is active.
This service is provided by "Ryviu": [terms of use](https://www.ryviu.com/terms-and-conditions), [privacy policy](https://www.ryviu.com/privacy-policy).


#### 2. YouTube API

Schema Package connects to YouTube API to get video details. Its needed to generate VideoObject schema markup.

It sends youtube video url from posts when VideoObject schema is selected.
This service is provided by "YouTube Inc": [terms of use](https://www.youtube.com/t/terms), [privacy policy](https://www.youtube.com/about/policies/).


#### 3. Google API

Schema Package connects to Google API to get video details. Its needed to generate VideoObject schema markup.

It sends youtube video vid got from youtube api, api key and part ( 'contentDetails, snippet, statistics' ) when VideoObject schema is selected.
This service is provided by "Google Inc": [terms of use](https://developers.google.com/terms), [privacy policy](https://developers.google.com/terms/api-services-user-data-policy).


#### 4. Yotpo API

Schema Package connects to Yotpo API to fetch product reviews. Its needed to generate Reviews schema markup for WooCommerce product.

It sends product id, api key when Yotpo option is enabled inside automation metabox and "Yotpo: Product & Photo Reviews for WooCommerce" plugin is active. API gets store url and api key from Yotpo settings option
This service is provided by "Yotpo": [terms of use](https://www.yotpo.com/terms-of-service/), [privacy policy](https://www.yotpo.com/privacy-policy/).


#### 5. Gravatar API

Schema Package connects to Gravatar API to validate author avatar.

It sends the author's email in hashkey. Validate the author's avatar which included in schema markup.
This service is provided by "Gravatar": [terms of use](https://wordpress.com/tos/), [privacy policy](https://automattic.com/privacy/).

#### 6. YouTube Image 

Schema Package connects to YouTube Image to get video thumbnail.

It sends youtube video vid got from youtube api when VideoObject schema is selected.
This service is provided by "YouTube Inc": [terms of use](https://www.youtube.com/t/terms), [privacy policy](https://www.youtube.com/about/policies/).


== Credits ==

Schema Package uses the following third-party libraries:


1. **React** - A JavaScript library for building user interfaces
   - Link: https://github.com/reactjs/react.dev
   - License: MIT

2. **Babel** - A JavaScript compiler
   - Link: https://babeljs.io/
   - License: MIT

3. **Webpack** - A module bundler for JavaScript applications
   - Link: https://webpack.js.org/
   - License: MIT

4. **Semantic UI** - A fast, small, and feature-rich JavaScript and CSS library.
   - Link: http://github.com/semantic-org/semantic-ui/
   - License: MIT

5. **React Router** - Declarative routing for React
   - Link: https://github.com/remix-run/react-router
   - License: MIT

6. **Query String** - Parse and stringify URL query strings
   - Link: https://github.com/sindresorhus/query-string
   - License: MIT

7. **Aqua-Resizer** - Resize WordPress images on the fly, PHP library
    - Link: https://github.com/sy4mil/Aqua-Resizer/
    - License: Dual MIT and GPL


== Frequently Asked Questions ==

= Does this plugin support multiple schema types? =  

Yes, the Schema Package plugin supports various schema types, including Article, Product, Event, FAQ, How-To, Recipe, Local Business, and more. You can select and customize schema types to match your content.  

= Can I customize schema markup for individual posts or pages? =  

Yes, the plugin allows you to modify schema markup for specific posts, pages, or custom post types. You can manually enter structured data or map fields dynamically using Schema Packge Generator.  

= Is this plugin compatible with page builders like Elementor, WPBakery, or Gutenberg? =  

Yes, the Schema Package plugin works seamlessly with popular page builders, including Elementor, WPBakery, and Gutenberg. It detects content dynamically and applies schema markup accordingly.  

= Does Schema Package automatically update schema markup when I update my content? =  

Yes, the plugin automatically refreshes schema markup when you update a post or page. You don't need to manually reapply the schema, making the process seamless and efficient.  

= Can I exclude specific pages from having schema markup? =  

Yes, you can disable schema markup on specific posts, pages, or post types through the Target On or Target Off Option. This is useful if you want to prevent duplicate schema or exclude certain pages.  

= Does this plugin work with WooCommerce? =  

Yes, the Schema Package plugin integrates with WooCommerce to add structured data for products, reviews, offers, and other relevant elements.  

= Will this plugin slow down my website? =  

No, the Schema Package plugin is optimized for performance. It generates lightweight JSON-LD markup that loads asynchronously, ensuring minimal impact on your website's speed.  

= How often is the plugin updated? =  

The plugin is actively maintained and updated to stay compatible with the latest WordPress versions and schema guidelines. Updates are released regularly to improve features and fix bugs.  

= Can I add multiple schema types to a single page? =  

Yes, the plugin allows multiple schema types on a single page. For example, you can add both "FAQ" and "Product" schema to a product page with FAQs.  

= Does Schema Package support multilingual websites? =  

Yes, the plugin is compatible with multilingual plugins such as WPML and Polylang, allowing you to add schema markup in different languages.  

= How do I troubleshoot schema markup errors? =  

If you encounter schema validation errors, use Google’s Rich Results Test or Schema.org Validator to diagnose issues. You can also check the plugin settings and ensure your content fields are correctly mapped.  

= Is the plugin compatible with SEO plugins like Yoast SEO and Rank Math? =  

Yes, the Schema Package plugin works alongside Yoast SEO, Rank Math, and other SEO plugins. It enhances structured data capabilities without conflicting with existing SEO settings.  

= Can I request a new schema type to be added? =  

Yes, if you need support for a specific schema type that isn't currently included, you can submit a feature request via the plugin's support forum or settings page.  

= Does this plugin work with custom post types? =  

Yes, the Schema Package plugin supports custom post types and allows you to apply schema markup to them.  

= Is there an option to add custom fields to schema? =  

Yes, the plugin integrates with Advanced Custom Fields (ACF) and Secure Custom Fields, allowing you to map custom fields to schema properties.  

= Does this plugin require an API key to work? =  

No, the core functionality does not require an API key. However, integrations with external services (such as YouTube for video schema) may require API keys.  

= Is the Schema Package plugin free? =  

Yes, the core Schema Package plugin is completely free to use. A premium version with advanced features and automation tools is also available for users who want to take their structured data to the next level.  

= Where can I find the plugin documentation? =  

You can access the full documentation, tutorials, and guides on our official website:  
📚 Knowledge Base: https://schemapackage.com/knowledge-base/

= How do I report a bug or request a feature? =  

You can report bugs or request features through the WordPress.org support forum for this plugin or create new ticket on github [URL](https://github.com/amanstacker/schema-package).

= Where can I learn more about premium features? =

Visit our premium page for a detailed list of features and benefits:  
🔗 https://schemapackage.com/premium/



== Changelog ==

= 1.0.16 =

* Intro : Introduced premium features and plugin
* Added : An option to output schema markup in the WordPress REST API.
* Added : Compatibility tab for flexibility
* Added : Donation link
* Added : WPGraphQL Support
* Added : Official website, support link and knowledge base link
* Fixed : Moved 'Multiple Size Images' option to new Advanced tab
* Improvement : Improvement No Conflicts Detected messages.

= 1.0.15 =

* Added : Compatibility for MasterStudy LMS WordPress Plugin – for Online Courses and Education
* Fixed : Course Schema was not being added when setup from schema package schema selection.


= 1.0.14 =

* Added : Offers" and "hasCourseInstance" properties in course schema
* Added : Support email above support form
* Improvement : Enhanced several messages for better readability.


= 1.0.13 =

* Fixed : Faqs schema was not being saved in SPG.
* Improvement : Removed code duplication while generating schema markup

= 1.0.12 =

* Added : AggregateRating property for missing schema types
* Added : Compatibility with Meta Box and Meta Box Lite plugin
* Added : Compatibility with Rate My Post – Star Rating Plugin by FeedbackWP
* Fixed : Improvement done for recipeIngredient & recipeInstructions mapping

= 1.0.11 =

* Added : recipeCuisine property in recipe schema type
* Fixed : Mapping of nested properties was not working.
* Fixed : Minor bug fixes.
* Tested with WordPress 6.8.1

= 1.0.10 =

* Fixed : Resolved an issue where the Schema Package Generator, when enabled for authors, was not working correctly on posts.
* Added : Require PHP and WordPress version.

= 1.0.9 =

* Tested with WordPress 6.8
* Fixed : Errors for incorrect array usage where the top array statement is empty inside the opening array bracket.
* Fixed : Form is Undefined when selecting product schema type in Carousel Schema

= 1.0.8 =

* Improvement : More improvement is done for Absolute Reviews Plugin automation/compatibility
* Improvement : All multiselect html tags converted to group checkbox for better user accessibility
* Improvement : Stop init hook on rest api call for schema package dashboard to avoid any error as its not need.
* Feature : Added ProfilePage Schema
* Feature : Added an option to enable support for Schema Package Generator on author profile page 
* Fixed   : Schema Package Generator was not working properly on taxonomies

= 1.0.7 =

* Feature : Added compatibility with the Absolute Reviews Plugin for Product and Review Schema types.
* Feature : Added the Review Schema type as a parent.
* Fixed   : Minor bug fixes.

= 1.0.6 =

* Feature : Added Custom Schema Textarea
* Feature : Added multiple schema types. Those are Store, Bakery, BarOrPub, CafeOrCoffeeShop, FastFoodRestaurant, IceCreamShop, Restaurant, LiveBlogPosting, MusicAlbum, MusicPlaylist, Trip, MobileApplication, SingleFamilyResidence, House, Apartment, Photograph, ImageObject, MediaGallery, ImageGallery, AudioObject
* Fixed   : Minor bug fixes.

= 1.0.5 =

* Feature : Schema properties mapping for WordPress Core Custom Field
* Feature : Schema properties mapping for Advanced Custom Field plugin
* Feature : Schema properties mapping for Secure Custom Field plugin
* Feature : Default value as post for target on for post type
* Feature : Validation for import file. Only json file is allowed
* Fixed   : Undefined variable


= 1.0.4 =

* Feature : Added BroadcastService, CableOrSatelliteService, FinancialProduct, FoodService, GovernmentService, TaxiService & WebAPI  schema types
* Feature : Powerful singular schema mapping
* Feature : More UI/UX improvement
* Feature : Added Schema Package Generator control center in settings -> tools ( post types & taxonomies ) 
* Feature : Added Minified JSON-LD option
* Feature : Added Escaped Unicode JSON-LD	option
* Feature : Added ImageObject	option
* Bug Fix : Minor and major bugs fixed

= 1.0.3 =

* Feature : Added Service schema type

= 1.0.2 =

* Feature : Added Carousel schema type

= 1.0.1 =

* Tweak : UI Improvement
* Tweak : About and Contact page tooltip added. 
* Fixed : Individual schema package generator data was not being saved.


= 1.0 =

* Just born