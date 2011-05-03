<?php /*

	This file documents Fokus theme: from how it came to be to features, it's all here.
	The contents are HTML formatted so we can use the same documentation on an admin
	panel inside WordPress. If you can, it's a nicer experience to read the documentation
	from there. You'll get to see the pretty pictures.

	Fokus theme is licensed under GNU GPL v2. For a complete breakdown of what that means,
	see license.txt.

*/ ?>

<h2>Table of contents</h2>
<ul class="tableofcontents">
	<li><a href="#whatisfokustheme">What is Fokus theme?</a></li>
	<li><a href="#howisfokusthemesupported">How is Fokus theme supported, and what does that mean for you?</a></li>
	<li><a href="#howtousefokustheme">How to use Fokus theme</a>
		<ul>
			<li><a href="#gettingstartedbuildingyoursite">Getting started building your site</a></li>
			<li><a href="#recommendedplugins">Recommended plugins</a></li>
			<li><a href="#featurebreakdown">Feature breakdown</a></li>
		</ul>
	</li>
	<li><a href="#conclusion">Conclusion and the future</a></li>
</ul>

<h2 id="whatisfokustheme">What is Fokus theme?</h2>

<p>Fokus theme is a powerful magazine template brought to you, and used by, Swedish magazine Fokus. It sports a very flexible layout, customizable colours and a menu with a twist, to mention some of the neat features. And of course you also get all of the WordPress goodness you know and love: backgrounds, header images and more.</p>

<p>Fokus theme is currently in BETA. We'd be very grateful if you took the time to try it out and reported any problems in the issue queue. Thanks for helping us build an awesome free magazine template!</p>

<h2 id="howisfokusthemesupported">How is Fokus theme supported, and what does that mean for you?</h2>

<p>[Jonatan får skriva om varför fokus har valt att göra så här och hur det finansieras]</p>

<h2 id="howtousefokustheme">How to use Fokus theme</h2>

<p>Fokus theme works out of the box as a standard blog template, but with the help of a few plugins it really begins to shine. We'll begin by doing a basic site building walkthrough to get you started. After that we'll take a look at recommended plugins and how they can augment your online magazine, to finish up with a detailed look at the different features Fokus theme is equipped with.</p>

<p>This tutorial assumes that you're familiar with basic WordPress concepts. If you're unsure what a widget is or how the the WordPress menu works, you should <a href="http://codex.wordpress.org/Main_Page">hop on over to the codex</a> first.</p>

<h3 id="gettingstartedbuildingyoursite">Getting started building your site</h3>

<p>After <a href="http://codex.wordpress.org/Installing_WordPress">installing WordPress</a> and <a href="http://codex.wordpress.org/Using_Themes">activating Fokus theme</a>, you'll wind up with a fairly empty site. It'll look something like this:</p>

<p><a href="<?php bloginfo( 'template_directory' ); ?>/readme/fokus1.png"><img src="<?php bloginfo( 'template_directory' ); ?>/readme/fokus1.png" alt="An (almost) clean install of Fokus theme"></a></p>

<p>I've added some more content for us to experiment with, but other than that this is what you'll see. It's not too exciting, but don't worry - it soon will be. When you're building a WordPress site, it's often best to start making sure your basic options are set. Head on over to Settings, and go through all of them. You'll see that the blog title and tagline are reflected in the header.</p>

<p><a href="<?php bloginfo( 'template_directory' ); ?>/readme/fokus2.png"><img src="<?php bloginfo( 'template_directory' ); ?>/readme/fokus2.png" alt="Starting with the customizations"></a></p>

<p>If you haven't already, it's a good idea to start writing some content for the next step: layouting the site. Fokus theme makes the most of widgets to give you fine grained control over what content goes where, but this control comes with responsibility: it is up to you to create a layout that guides and entices your users to read your awesome content.</p>

<p>On the home page you'll find the following areas:</p>

<p><a href="<?php bloginfo( 'template_directory' ); ?>/readme/fokus3.png"><img src="<?php bloginfo( 'template_directory' ); ?>/readme/fokus3.png" alt="Front page layout"></a></p>

<ul>
	<li><strong>Front top:</strong> this is a widget area only displayed on the home page.</li>
	<li><strong>Front main:</strong> this is both a widget area and the place for the main feed of the site. If you add any widgets to this area it will display them, otherwise it will display the latest posts.</li>
	<li><strong>Front middle:</strong> this is a widget area only displayed on the home page.</li>
	<li><strong>Sidebar:</strong> this is a widget area displayed on all pages of your site.</li>
	<li><strong>Footer:</strong> this is a widget area displayed on all pages of your site.</li>
</ul>

<p>On all other pages the layout looks like this:</p>

<p><a href="<?php bloginfo( 'template_directory' ); ?>/readme/fokus4.png"><img src="<?php bloginfo( 'template_directory' ); ?>/readme/fokus4.png" alt="Other pages' layout"></a></p>

<ul>
	<li><strong>Main content area:</strong> this is either the post (on a single page or post listing) or a list of posts (on an archive listing).</li>
	<li><strong>Middle column:</strong> this is a widget area used on all pages except the front page.</li>
	<li><strong>Sidebar:</strong> this is a widget area displayed on all pages of your site.</li>
	<li><strong>Footer:</strong> this is a widget area displayed on all pages of your site.</li>
</ul>

<p>Knowing this, it's not a bad idea to use the footer for static contact information or pushes, the sidebar for pushes or advertisements, the middle column for widgets with related information (like author info and related posts). The front areas are best used to create pushes for different articles and other things, depending on what is important to highlight at the moment.</p>

<p>After some real quick tinkering with Query Posts, Simple Image and the Fokus Issue plugin I wound up with this:</p>

<p><a href="<?php bloginfo( 'template_directory' ); ?>/readme/fokus5.png"><img src="<?php bloginfo( 'template_directory' ); ?>/readme/fokus5.png" alt="A quick and dirty leyout example"></a></p>

<p>... but I'm sure you can do much, much better.</p>

<p>We've only just begun tapping into the power of Fokus theme - there's much more to do. Coming up is a short description of various plugins that work really well with Fokus theme, as well as a feature breakdown of Fokus theme. Lots of goodies, lots of magazine power.</p>

<h3 id="recommendedplugins">Recommended plugins</h3>

<h4>Fokus Issues</h4>

<p>When you create a magazine you might want to organize your articles by issue. Fokus Issues allows you to do just that - it creates an issue taxonomy where you can add names of issues. It also provides a widget to dynamically show them.</p>

<p>And even better, it can also create an automatic archive of all your issues. To do so, create a page with the slug 'issues', and it will display all active terms in the issue taxonomy in a grid. If you have translated 'issues', then you need to create a page with your localized slug instead. Presto! An issue archive!</p>

<p>Fokus Issues was custom built with Fokus theme in mind, but it should work with other themes as well.</p>

<h4>Taxonomy Images</h4>

<p><a href="http://wordpress.org/extend/plugins/taxonomy-images/">On wordpress.org</a></p>

<p>To make Fokus Issues even better you might want to attach an image to the different issues. Do so by installing and activating Taxonomy Images. It's a well built and straight forward plugin: just add the images and Fokus theme and Fokus Issues will take care of the rest.</p>

<h4>Query posts widget</h4>

<p><a href="http://justintadlock.com/archives/2009/03/15/query-posts-widget-wordpress-plugin">On the authors homepage</a><br>
<a href="http://wordpress.org/extend/plugins/query-posts/">On wordpress.org</a></p>

<p>A central component to Fokus theme is Query posts. It lets you create listings of posts in widget areas. You can control these in detail thanks to the widgets' numerous options. It's highly recommended to use this plugin to build your front page. You can use it to manually edit what post will be displayed in a given position, or you can use it to create a placeholder that is automatically filled with the latest post of a category you choose.</p>

<p>The many options can be confusing at first. Luckily the plugin comes with a comprehensive readme.txt to guide you.</p>

<h4>Image widget</h4>

<p><a href="http://wordpress.org/extend/plugins/image-widget/">On wordpress.org</a></p>

<p>Image widget is a simple way to place an image in a widget area. It's highly suitable for image pushes or advertisements, for instance. You get to upload an image using WordPress native image upload, and can set links and title and a few other parameters.</p>

<h4>Author information widget</h4>

<p><a href="http://wordpress.org/extend/plugins/author-info-widget/">On wordpress.org</a></p>

<p>It's often beneficial for magazines to profile their authors. It helps readers build relationships with writers, which usually gives them additional interest in the publication. Fokus theme doesn't show the writers next to a post by default, but the middle column widget area is built to contain information like this. This makes the Author information widget a great companion to Fokus theme: just make each contributor a WordPress user, and use this widget to dynamically showcase the information about the current writer.</p> 

<h3 id="featurebreakdown">Feature breakdown</h3>

<p>Fokus theme is packed with great features. It has all the things you can expect from a well crafted WordPress theme like great SEO out of the box, changeable header and background image and the easy to use menu system. However, here are some additional goodies you may want to use on your site.</p>

<h4>The color options page</h4>

<p>By using the color options page you can quickly make small customizations to the look of the Fokus theme's menu. Combined with the header and background image, it's an easy way to make the theme yours without hacking any code. You use it by entering color hex values in the different boxes, and then hit save.</p>

<p>The primary and secondary color boxes are quick shortcuts. If you enter two different colors here, Fokus theme will insert them (and appropriate colors to go with) into the menu. If you need to fine tune it all better, there are detailed options below them to let you do just that.</p>

<h4>A responsive layout</h4>

<p>Fokus theme also sports a responsive layout. That basically means the theme automatically adapts to different sizes. Looking at your magazine on a smartphone? No worries, Fokus theme got you covered. A tablet? Yes, that too. If you want to test it out you can resize your browser window and have a look at how the different areas moves around to make the reading experience optimal.</p>

<p><a href="<?php bloginfo( 'template_directory' ); ?>/readme/fokus6.png"><img src="<?php bloginfo( 'template_directory' ); ?>/readme/fokus6.png" alt="The responsive layout"></a></p>

<h4>A dynamic menu</h4>

<p>Another useful feature is a small widget area called Secondary menu. All widgets you place here look like the ordinary secondary menu, with the widget title as the menu item. When you click on it, a dropdown containing the widget contents are shown.</p>

<p>This might sound simple, but it opens up for a lot of interesting usages. You can use this feature to create a drop down tag cloud, or couple it with the Issue plugin to get an issue-dropdown. If you use a text widget, you can place anything you wish in the dropdown. Below is an example with an embedded Google Map.</p>

<p><a href="<?php bloginfo( 'template_directory' ); ?>/readme/fokus7.png"><img src="<?php bloginfo( 'template_directory' ); ?>/readme/fokus7.png" alt="The widgetized sub menu allows for dropdowns of any content"></a></p>

<h4>Localizations</h4>

<p>All text snippets in Fokus theme are localized [http://codex.wordpress.org/Translating_WordPress]. It ships with two languages: English (default) and Swedish. If you want to add translations, we'd be more than grateful.</p>

<h4>Child themes</h4>

<p>Our goal is to make Fokus theme an excellent framework to build magazine sites on. We hope WordPress theme developers will be able to use it as a parent theme, and add new functionality and looks by developing a child theme.</p>

<p>We've created a sub theme called Fokus Fairy Tale - a theme that would be perfect for an online magazine about children books. Open it up and look at how it's built to get started building child themes on Fokus theme. If you have any questions and comments on how we can make it even easier to build child themes, let us know!</p>

<p><a href="<?php bloginfo( 'template_directory' ); ?>/readme/fokus8.png"><img src="<?php bloginfo( 'template_directory' ); ?>/readme/fokus8.png" alt="Fokus Fairy Tale - en example subtheme"></a></p>

<h2 id="conclusion">Conclusion and the future</h2>

<p>And with that we conclude this presentation of Fokus theme. We hope that you'll go ahead and test it out, build awesome sites and give us feedback on how to make it even better. As said, the goal is to make it extremely easy for people to build a neat magazine site on WordPress. We plan on taking a few months to use it ourselves and collect a bunch of feedback, to make another major release sometime in September.</p>

<p>Here's hoping you'll enjoy Fokus theme!<br>
<a href="http://fokus.se">Fokus Magazine</a> and <a href="http://goodold.se">the development team</a></p>