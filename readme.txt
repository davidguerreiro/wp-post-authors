=== Transfer Authors ===
Contributors: davidguerreiro
Tags: authors, transfer, switch, post_types
Requires at least: 4.0
Tested up to: 4.9.4
Stable tag: 4.9.3
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html



== Description ==

# Change any post type author with ease.

__Transfer Authors__  allows you to transfer multiple posts from one author to another in just a few clicks. 
You can filter which CPT you want to transfer and the plugin will manage everything for you.

## Use cases for this plugin.

1. After __content migration__ you can use this plugin to re-assign authors to the new imported posts.
2. After a __user import__ you can use this plugin to re-assign posts to those new imported users.
3. If you are a developer and you need to re-assign all those posts/pages to your client admin user.

== Installation ==

1. Download the .zip plugin file clicking on the download button on this page.
2. Login in your WordPress site admin.
3. On the left hand menu, go to __Plugins -> Add new__
4. At the top of the page, click on the button __'Upload Plugin'__
5. Click on the button __'Choose File'__ and choose the .zip plugin file from your local machine.
6. Click on the __'Install Now'__ button.
7. You will be redirected to the installation page. Once the installation is finished click __'Activate Plugin'__.
8. Now you will find a new section on the left hand menu called __'Transfer Authors'__. 
9. Have fun!

Alternatively, you can manually upload the plugins files via FTP or SFTP and then activate the plugin on the plugins section in your admin dashboard.

== Frequently Asked Questions ==

= Would this plugin allow me to transfer default WP Post Types and Custom Post Types? =
Yes, this plugin will allow you to transfer any CPT you create as long as they are public.
About WP default Post Types, at the moment only __Posts, Pages and Attachments__ are available to be transferred.

= What happens if I get an error message when transferring posts? =
This plugin has been optimised to transfer the posts from one author to another as fast as possible. 
However, depending of the amount of posts you want to transfer and the configuration / capacity of your server, you might get
an error after the plugin transfers the posts. Usually the plugin transfers between 1000 and 1500 posts within regular timeout limits.
To continue transferring posts, click the transfer button again to continue transferring the posts until you get a successful notification.

= Some users are not available when I try to transfer the posts. Why is this happening?= 
For security reasons you cannot transfer posts to subscriber user roles.

= What if I mess up the things during a transfer? Can I easily restore the previous post authors? =
Yes, simply swap the authors in the list and click in the transfer button again.

== Screenshots ==

1. Plugin main page
2. Left hand side menu item

== Change log ==

= 1.0.1 =

* Add user notice to inform user about server limitations.