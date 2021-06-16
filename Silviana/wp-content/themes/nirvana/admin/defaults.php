<?php

function nirvana_get_option_defaults() {

// DEFAULT OPTIONS ARRAY
$nirvana_defaults = array(

"nirvana_db" => "1.0",

"nirvana_side"		=> "2cSr",
"nirvana_sidewidth"	=> 900,
"nirvana_sidebar"	=> 300,
"nirvana_duality"	=> "Wide",
"nirvana_mobile"	=> "Enable",
"nirvana_zoom"	=> 0,


"nirvana_hheight"	=> "150",
"nirvana_hcenter"	=> 0,
"nirvana_hratio"	=> 0,

"nirvana_logoupload"	=> "",
"nirvana_favicon"		=> "",
"nirvana_siteheader"	=> "Site Title and Description",
"nirvana_headermargintop"	=> "35",
"nirvana_headermarginleft"	=> "0",
"nirvana_headerwidgetwidth" => "33%",


"nirvana_frontpage"		=> "Disable",
"nirvana_frontposts"	=> "Enable",
"nirvana_frontpostscount" 		=> get_option('posts_per_page'),
"nirvana_frontpostsperrow"		=> "2",
"nirvana_frontmoreposts"		=> "More Posts",
"nirvana_fpsliderwidth"			=> "1920",
"nirvana_fpsliderheight"		=> "580",
"nirvana_fpslideranim"	=> "slideInLeft",
"nirvana_fpslidertime"	=> "250",
"nirvana_fpsliderpause"	=> "5000",
"nirvana_fpslidernav"	=> "Bullets",
"nirvana_fpsliderarrows"		=> "Visible on Hover",
"nirvana_fpslidertitlesize"		=> "66px",
"nirvana_fpslider_titlecaps"	=> 1,
"nirvana_fpslidertextsize"		=> "24px",
"nirvana_fpslider_textcaps"		=> 0,
"nirvana_fpslider_centertext"	=> 0,
"nirvana_fpsliderexcerptsize"	=> "50",
"nirvana_fpslider_bordersize"	=> "0",
"nirvana_fpslider_topmargin"	=> "0",

"nirvana_slideShortcode"=> "",
"nirvana_slideType"		=> "Custom Slides",
"nirvana_slideCateg"	=> "",
"nirvana_slideNumber"	=> "5",
"nirvana_slideSpecific"	=> "",

"nirvana_sliderimg1"	=> get_template_directory_uri()."/images/slider/nirvana-slide1.jpg",
"nirvana_slidertitle1"	=> "Nirvana makes things easy!",
"nirvana_slidertext1"	=> 'Nirvana makes things easier than ever before. No coding and no extra CSS styling needed. With a simple user interface of over 200 settings you can change anything:
							every color, every line of text and every design element is editable with a simple mouse click from the <a href="/wp-admin/themes.php?page=nirvana-page">Theme Settings</a>.',
"nirvana_sliderlink1"	=> "#",
"nirvana_sliderimg2"	=> get_template_directory_uri()."/images/slider/nirvana-slide2.jpg",
"nirvana_slidertitle2"	=> "Nirvana gives you choices!",
"nirvana_slidertext2"	=> "This slider alone has over 20 options for you to customize it with: size, borders, animations, navigation types and individual slides are all editable via the Theme Settings.
							<br>The columns, as well as everything else on this Presentation page are also fully customizable.",
"nirvana_sliderlink2"	=> "#",
"nirvana_sliderimg3"	=> get_template_directory_uri()."/images/slider/nirvana-slide3.jpg",
"nirvana_slidertitle3"	=> "Nirvana in full color!",
"nirvana_slidertext3"	=> "With over 50 color settings you can change the color of virtually anything in your site without writing a single line of code. Enable, configure or disable important site elements
							like pagination, breadcrumbs, top bar, menus, post metas, back to top button and much more.",
"nirvana_sliderlink3"	=> "#",
"nirvana_sliderimg4"	=>  get_template_directory_uri()."/images/slider/nirvana-slide4.jpg",
"nirvana_slidertitle4"	=> "Nirvana is neverending!",
"nirvana_slidertext4"	=> "Advanced typography settings, great control over post excerpts and featured images, magazine and blog layouts, social media settings and custom CSS and JS fields complete
							the Nirvana line-up. But there's much much more!",
"nirvana_sliderlink4"	=> "#",
"nirvana_sliderimg5"	=> '',
"nirvana_slidertitle5"	=> "",
"nirvana_slidertext5" 	=> "",
"nirvana_sliderlink5"	=> "",
"nirvana_slidereadmore"	=> "Read more",

"nirvana_columnType"	=> "Widget Columns",
"nirvana_nrcolumns"		=> "3",
"nirvana_columnNumber"	=> "3",
"nirvana_coldisplay"	=> "0",
"nirvana_colimageheight"=> "311",
"nirvana_colimagewidth"	=> "397",
"nirvana_colspace"		=> "0.3",
"nirvana_columnstitle"	=> "There will be columns!",
"nirvana_columnCateg"	=> "",
"nirvana_columnSpecific"	=> "",
"nirvana_column_frames"	=> 0,

"nirvana_fronttext1"	=> "There will be text!",
"nirvana_fronttext3"	=> "<img src='".get_template_directory_uri()."/images/columns/cake1.png' style='float:left;padding-right:20px' alt=''><br><br>
							The presentation page also comes equipped with 3 text areas and an infinite number of columns. The text areas are positioned above and below the columns and blog posts.
							They support <strong>HTML</strong> tags (including images) and <em>[shortcodes]</em> so you can turn the Presentation Page into your personal playground.<br><br>
							Just like everything else on the Presentation Page you can choose whether to use these text areas or not. You can edit them from
							<em>Theme Settings &raquo; Presentation Page Settings &raquo; Text Areas</em>.",
"nirvana_fronttext2"	=> "There will be posts!",
"nirvana_fronttext4"	=> "<img src='".get_template_directory_uri()."/images/columns/cake2.png' style='float:right;padding-left:20px' alt=''>
							You can also choose to show your latest posts on the Presentation page. From the theme settings you can select how many posts to show and more will be loaded via an Ajax button.<br><br>
							Even if you can show your latest posts on the Presentation Page, you can also use the <strong>Blog Page Template</strong> to designate another page as your primary blog posts page.
							While creating a new page or editing an existing one choose <em>Blog Template</em> as the page template and save.<br><br>
							For more information read all the help sections from the <a href='/wp-admin/themes.php?page=nirvana-page'>Theme Settings</a>.",
"nirvana_fronttext5"	=> "There will be more!",
"nirvana_fronttext6"	=> "Nirvana and its huge array of tools are waiting for your carefully crafted content. It will embrace and enhance it while also giving it room to breathe and grow.
							Can you imagine a better home for your deepest thoughts, your greatest ideas, your best travel photos and anything else you want to share with the world?
							With Nirvana, the world will never know what hit it ;) <br><br>
							So bring out your diamond in the rough and let Nirvana find its luster.",

"nirvana_fronthidetopbar"	=> "",
"nirvana_fronthideheader"	=> "",
"nirvana_fronthidemenu"		=> "",
"nirvana_fronthidewidget"	=> "",
"nirvana_fronthidefooter"	=> "",

"nirvana_fontfamily"		=> 'Source Sans Pro',
"nirvana_googlefont"		=> '',
"nirvana_fontsize"			=> "18px",
"nirvana_fonttitle"			=> 'General Font',
"nirvana_googlefonttitle"	=> '',
"nirvana_headfontsize"		=> "42px",
"nirvana_fontside"			=> 'General Font',
"nirvana_googlefontside"	=> '',
"nirvana_sidefontsize"		=> "22px",
"nirvana_fontwidget"		=> 'General Font',
"nirvana_googlefontwidget"	=> '',
"nirvana_widgetfontsize"	=> "18px",
"nirvana_sitetitlefont"		=> 'General Font',
"nirvana_sitetitlegooglefont"=> '',
"nirvana_sitetitlesize"		=> "46px",
"nirvana_menufont" 			=> 'General Font',
"nirvana_menugooglefont"	=> '',
"nirvana_menufontsize"		=> "14px",
"nirvana_headingsfont"		=> 'General Font',
"nirvana_headingsgooglefont"=> '',
"nirvana_headingsfontsize"	=> '130%',

"nirvana_textalign"			=> "Default",
"nirvana_paragraphspace"	=> "1.0em",
"nirvana_parindent"			=> "0px",
"nirvana_headingsindent"	=> "Disable",
"nirvana_lineheight"		=> "1.8em",
"nirvana_wordspace"			=> "Default",
"nirvana_letterspace"		=> "Default",
"nirvana_uppercasetext"		=> 0,

"nirvana_colorschemes"		=> "Nirvana",

"nirvana_backcolorheader"	=> "",
"nirvana_backcolormain"		=> "#FFFFFF",
"nirvana_backcolorfooterw"	=> "#F5F5F5",
"nirvana_backcolorfooter"	=> "#3A3B3D",

"nirvana_contentcolortxt"	=> "#555555",
"nirvana_contentcolortxtlight"	=> "#999999",
"nirvana_footercolortxt"	=> "#AAAAAA",

"nirvana_accentcolora"	=> "#1EC8BB",
"nirvana_accentcolorb"	=> "#CB5920",
"nirvana_accentcolorc"	=> "#EEEEEE",
"nirvana_accentcolord"	=> "#CCCCCC",
"nirvana_accentcolore"	=> "#F7F7F7",

"nirvana_titlecolor"	=> "#1EC8BB",
"nirvana_descriptioncolor"	=> "#666666",
"nirvana_descriptionbg"	=> "",

"nirvana_menucolorbgdefault"	=> "#3A3B3D",
"nirvana_menucolortxtdefault"	=> "#EEEEEE",
"nirvana_submenucolorbgdefault"	=> "#1EC8BB",
"nirvana_submenucolortxtdefault"	=> "#FFFFFF",
"nirvana_submenucolorshadow"		=> "",

"nirvana_topbarcolorbg"	=> "#FFFFFF",
"nirvana_topmenucolortxt"	=> "#999999",
"nirvana_topmenucolortxthover"	=> "#FFFFFF",

"nirvana_contentcolorbg" 	=> "#FFFFFF",
"nirvana_contentcolortxttitle"	=> "#444444",
"nirvana_contentcolortxttitlehover"	=> "#000000",
"nirvana_contentcolortxtheadings"	=> "#444444",

"nirvana_fpsliderbgcolor"	=> "#eeeeee",
"nirvana_fpsliderbordercolor"	=> "#ffffff",
"nirvana_fpslidercaptioncolor"	=> "#ffffff",
"nirvana_fpslidercaptionbg"	=> "#000000",
"nirvana_fronttextbgcolortop"	=> "#F7F7F7",
"nirvana_fronttextbgcolormiddle"	=> "#EEEEEE",
"nirvana_fronttextbgcolorbottom"	=> "#FAFAFA",
"nirvana_frontcolumnsbgcolor"	=> "#FFFFFF",
"nirvana_fronttitlecolor"	=> "#444444",

"nirvana_sidebg"	=> "",
"nirvana_sidetxt"	=> "#555555",
"nirvana_sidetitlebg"	=> "",
"nirvana_sidetitletxt"	=> "#CB5920",

"nirvana_widgetbg"		=> "",
"nirvana_widgettxt"		=> "#555555",
"nirvana_widgettitlebg"		=> "",
"nirvana_widgettitletxt"	=> "#CB5920",

"nirvana_linkcolortext"		=> "#1EC8BB",
"nirvana_linkcolorhover"	=> "#CB5920",
"nirvana_linkcolorside"		=> "",
"nirvana_linkcolorsidehover"	=> "",
"nirvana_linkcolorwooter"	=> "",
"nirvana_linkcolorwooterhover"	=> "",
"nirvana_linkcolorfooter"	=> "",
"nirvana_linkcolorfooterhover"	=> "",

"nirvana_metacoloricons"	=> "#CB5920",
"nirvana_metacolorlinks"	=> "",
"nirvana_metacolorlinkshover"	=> "",

"nirvana_socialcolorbg"	=> "#ADBF2D",
"nirvana_socialcolorbghover"	=> "#1EC8BB",
"nirvana_caption"		=> "caption-simple",

"nirvana_topbar"		=> "Normal",
"nirvana_topbarwidth"	=> "Site width",
"nirvana_breadcrumbs"	=> "Enable",
"nirvana_pagination"	=> "Enable",
"nirvana_menualign"		=> "left",
"nirvana_searchbar"		=> array(
	"top" => 1,
	"main" => 0,
	"footer" => 0,
	),
"nirvana_contentmargintop" => "5",
"nirvana_contentpadding" => "0",
"nirvana_image_style"	=> "nirvana-image-one",
"nirvana_title"		=> "Show",
"nirvana_pagetitle"	=> "Show",
"nirvana_categtitle"	=> "Show",
"nirvana_tables"	=> "Disable",
"nirvana_backtop"	=> "Enable",

"nirvana_metapos"	=> "Top",
"nirvana_blog_show"	=> array(
	"comments"	=> 1,
	"date"		=> 1,
	"time"		=> 0,
	"author"	=> 1,
	"category"	=> 1,
	"tag"		=> 1,
	),
"nirvana_single_show" => array(
	"date"		=> 1,
	"time"		=> 0,
	"author"	=> 1,
	"category"	=> 1,
	"tag"		=> 1,
	"bookmark"	=> 1,
),
"nirvana_comtext"	=> "Show",
"nirvana_comclosed"	=> "Hide everywhere",
"nirvana_comoff"	=> "Show",

"nirvana_excerpthome"		=> "Excerpt",
"nirvana_excerptsticky"		=> "Full Post",
"nirvana_excerptarchive"	=> "Excerpt",
"nirvana_excerptlength"		=> "50",
"nirvana_excerpttype"		=> "Words",
"nirvana_magazinelayout"	=> "Disable",
"nirvana_excerptdots"		=> " &hellip;",
"nirvana_excerptcont"		=> "Continue reading",
"nirvana_excerpttags"		=> "Disable",

"nirvana_fpost" 	=> "Enable",
"nirvana_fpostlink" => "1",
"nirvana_fauto" 	=> "Enable",
"nirvana_falign" 	=> "Left",
"nirvana_fwidth" 	=> "250",
"nirvana_fheight" 	=> "150",
"nirvana_fcrop" 	=> 1,
"nirvana_fheader" 	=> "Disable",

"nirvana_social1" 			=> "YouTube",
"nirvana_social2" 			=> "#",
"nirvana_social_title1" 	=> "",
"nirvana_social_target1" 	=> "1",
"nirvana_social3" 			=> "Twitter",
"nirvana_social4" 			=> "#",
"nirvana_social_title3" 	=> "",
"nirvana_social_target3" 	=> "1",
"nirvana_social5" 			=> "RSS",
"nirvana_social6"			=> "#",
"nirvana_social_title5" 	=> "",
"nirvana_social_target5" 	=> "1",
"nirvana_social7" 			=> "",
"nirvana_social8" 			=> "",
"nirvana_social_title7" 	=> "",
"nirvana_social_target7" 	=> "1",
"nirvana_social9" 			=> "",
"nirvana_social10" 			=> "",
"nirvana_social_title9" 	=> "",
"nirvana_social_target9" 	=> "1",

"nirvana_socialsdisplay0" => "1",
"nirvana_socialsdisplay1" => "",
"nirvana_socialsdisplay2" => "1",
"nirvana_socialsdisplay3" => "1",
"nirvana_socialsdisplay4" => "",
"nirvana_socialsdisplay5" => "1",

"nirvana_postboxes" => '',
"nirvana_current_admin_menu" => '',
"nirvana_copyright"	=> 'This text can be changed from the Miscellaneous section of the settings page. <br />
<b>Lorem ipsum</b> dolor sit amet, <a href="#">consectetur adipiscing</a> elit, cras ut imperdiet augue. ',
"nirvana_customcss"	=> "/* Nirvana Custom CSS */  ",
"nirvana_customjs"	=> "",
"nirvana_iecompat"	=> 0,
"nirvana_protectionoutput"  => 0,
//"nirvana_masonry"   => 0,
"nirvana_fitvids"   => 1,
"nirvana_editorstyle"   => 1,
);
return apply_filters( 'nirvana_option_defaults', $nirvana_defaults );
}

// Default column text
$nirvana_column_defaults= array(
	$nirvana_column_content[] = array (
        'image'	=> get_template_directory_uri()."/images/columns/nirvana-column1.jpg",
        'title'	=> 'Countless columns',
        'text'	=> 'The columns on the Presentation Page are also very versatile. You can either generate them from existing posts or create them individually with the help of specially designed widgets.<br>
					You can also set the number of columns per row and much more from the <a href="/wp-admin/themes.php?page=nirvana-page">Theme Settings</a>.',
        'link'	=> 'http://www.cryoutcreations.eu',
        'blank'	=> 1,
    ),
    $nirvana_column_content[] = array (
        'image'	=> get_template_directory_uri()."/images/columns/nirvana-column2.jpg",
        'title'	=> 'Responsive Design',
        'text'	=> "Nirvana has been built from the ground up with responsiveness in mind. It will fit anywhere and change its layout according to the gadget and resolution it's being viewed on.",
        'link'	=> 'http://www.cryoutcreations.eu',
        'blank'	=> 1,
    ),
	$nirvana_column_content[] = array (
        'image'	=> get_template_directory_uri()."/images/columns/nirvana-column3.jpg",
        'title'	=> '~ Font Fiesta ~',
        'text'	=> "Nirvana comes bundled with some of the best fonts of the moment, but it also supports Google fonts. Extended font sets are also fully supported.",
        'link'	=> 'http://www.cryoutcreations.eu',
        'blank' => 1,
    ),
    $nirvana_column_content[] = array (
        'image'	=> get_template_directory_uri()."/images/columns/nirvana-column4.jpg",
        'title'	=> 'Layouts & Templates',
        'text'	=> "With Nirvana you can choose the size and position of the content and sidebars to your liking. Also, make every page stand out with 8 Page Templates (<em>Magazine</em> and <em>Blog</em> included).",
        'link'	=> 'http://www.cryoutcreations.eu',
        'blank'	=> 1,
    ),
    $nirvana_column_content[] = array (
        'image'	=> get_template_directory_uri()."/images/columns/nirvana-column5.jpg",
        'title'	=> 'Socials Galore',
        'text'	=> "Nirvana provides over 40 social media icons and 5 different locations to showcase them at. You can even customizable their colors.",
        'link'	=> 'http://www.cryoutcreations.eu',
        'blank' => 1,
    ),
    $nirvana_column_content[] = array (
        'image'	=> get_template_directory_uri()."/images/columns/nirvana-column6.jpg",
        'title'	=> 'HTML5 + CSS3',
        'text'	=> "Nirvana may seem <u>soft</u> and <u>sensitive</u> on the outside, but at its core you'll find armies of code that are <u>strong</u> and <u>precise</u>.
					Being built on the latest technologies not only makes Nirvana <u>stable</u> and <u>compatible</u> but also <u>future proof</u>. ",
        'link'	=> 'http://www.cryoutcreations.eu',
        'blank' => 1,
    ),
);

// FIN