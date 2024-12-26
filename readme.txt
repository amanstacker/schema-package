=== Schema Package - A Structured Data Module ===
Contributors: amanstacker
Tags: Structured Data, Schema, Rich Results, Product, Event
Requires at least: 5.0
Tested up to: 6.7
Requires PHP: 5.6.20
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Helps you to add versatile schema markup on your websites.

== Description ==

Helps you to add versatile schema markup on your websites which provides users with more informative and visually appealing search results.

### Schema Package Key Features

* <strong>Schema Package Generator</strong>: Select different kinds of schema based on your needs. No limitation on schema type selection, Add as much as you want.
* <strong>Targeting</strong>: Add schema types based on your target. Such as posts, pages, post types, taxonomies etc.
* <strong>JSON-LD Format</strong>: Schema Package only supports JSON-LD Format as recommended by most of the search engines. Like Google, Bing, Yahoo etc.
* <strong>Manage Conflict</strong>: If two or more schema plugins used on same website. They may confict and throw error in schema validator tool. Using Schema Package keep required schema markup
* <strong>Easy To Use UI</strong>: No need to reload schema package dashboard again and again to complete setup. Its a single page dashboard which is very fast in navigation.
* <strong>Compatibility</strong>: Automate schema markup for the plugins who generate schema related contents. You can find the compatibility list down the order.
* <strong>Fast Help & Support</strong>: If you are unable to find any features related to schema package or found any bug. Please contact us, Schema Package team would try to solve it quickly.


### Schema Package Supported Schema Types

* Article : [schema.org url](https://schema.org/Article)
* BlogPosting : [BlogPosting](https://schema.org/BlogPosting)
* NewsArticle : [schema.org url](https://schema.org/NewsArticle)
* TechArticle : [schema.org url](https://schema.org/TechArticle)
* HowTo : [schema.org url](https://schema.org/HowTo)
* FAQPage : [schema.org url](https://schema.org/FAQPage)
* QAPage : [schema.org url](https://schema.org/QAPage)
* Book : [schema.org url](https://schema.org/Book)
* Course : [schema.org url](https://schema.org/Course)
* JobPosting : [schema.org url](https://schema.org/JobPosting)
* LocalBusiness : [schema.org url](https://schema.org/LocalBusiness)
* Event : [schema.org url](https://schema.org/Event)
* Recipe : [schema.org url](https://schema.org/Recipe)
* VideoObject : [schema.org url](https://schema.org/VideoObject)
* SoftwareApplication : [schema.org url](https://schema.org/SoftwareApplication)
* Product : [schema.org url](https://schema.org/Product)
* BreadcrumbList : [schema.org url](https://schema.org/BreadcrumbList)
* Comment : [schema.org url](https://schema.org/Comment)

### Schema Package compatible with plugins

* WooCommerce : [URL](https://wordpress.org/plugins/woocommerce)
* Simple Job Board : [URL](https://wordpress.org/plugins/simple-job-board/)
* Mooberry Book Manager : [URL](https://wordpress.org/plugins/mooberry-book-manager)
* Brands for WooCommerce : [URL](https://wordpress.org/plugins/brands-for-woocommerce)
* Perfect Brands for WooCommerce : [URL](https://wordpress.org/plugins/perfect-woocommerce-brands)
* Ryviu – Product Reviews for WooCommerce : [URL](https://wordpress.org/plugins/ryviu)
* Customer Reviews for WooCommerce : [URL](https://wordpress.org/plugins/customer-reviews-woocommerce)
* YITH WooCommerce Brands Add-On : [URL](https://wordpress.org/plugins/yith-woocommerce-brands-add-on)
* Ultimate Reviews : [URL](https://wordpress.org/plugins/ultimate-reviews)
* Yotpo: Product & Photo Reviews for WooCommerce : [URL](https://wordpress.org/plugins/yotpo-social-reviews-for-woocommerce)
* Accordion By PickPlugins : [URL](https://wordpress.org/plugins/accordions)
* Quick and Easy FAQs : [URL](https://wordpress.org/plugins/quick-and-easy-faqs/)
* Accordion FAQ : [URL](https://wordpress.org/plugins/responsive-accordion-and-collapse)
* Easy Accordion : [URL](https://wordpress.org/plugins/easy-accordion-free)
* WP responsive FAQ with category plugin : [URL](https://wordpress.org/plugins/sp-faq)
* Arconix FAQ : [URL](https://wordpress.org/plugins/arconix-faq)
* kk Star Ratings : [URL](https://wordpress.org/plugins/kk-star-ratings/)
* WooCommerce Event Manager : [URL](https://wordpress.org/plugins/mage-eventpress/)
* WP Event Manager : [URL](https://wordpress.org/plugins/wp-event-manager/)
* WP-PostRatings : [URL](https://wordpress.org/plugins/wp-postratings/)
* Rank Math : [URL](https://wordpress.org/plugins/seo-by-rank-math/)
* Yoast Seo : [URL](https://wordpress.org/plugins/wordpress-seo/)
* The SEO Framework : [URL](https://wordpress.org/plugins/autodescription/)
* Squirrly SEO : [URL](https://wordpress.org/plugins/squirrly-seo/)
* SmartCrawl Seo : [URL](https://wordpress.org/plugins/smartcrawl-seo/)
* SEOPress : [URL](https://wordpress.org/plugins/wp-seopress/)


== Report Bug or Contribute fix ==

Encounter an issue with Schema Package? or wanted to contribute. Kindly visit Schema Package repository on [GitHub](https://github.com/amanstacker/schema-package). Please be aware that GitHub is not a support forum, but rather a streamlined platform for effectively addressing and solving problems.


== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.


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

= Where can I ask for help ? =

You can submit a support ticket via the [support forum](https://wordpress.org/support/plugin/schema-package/) at anytime.


== Changelog ==

= 1.0.1 =

* Tweak : UI Improvement
* Teak  : About and Contact page tooltip added. 
* Fixed : Individual schema package generator data was not being saved.


= 1.0 =

* Just born