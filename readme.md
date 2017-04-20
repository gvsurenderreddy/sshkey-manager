SSH Key Manager
===============

This package is used to distribute SSH keys (using PHP) to remote servers.


Who would use this?
-------------------
I ran into issues recently where I needed to issue commands to remote systems in batches. Instead of typing in passwords, we can use SSH keys to get into the systems much quicker. 
The added benefit of this is PHP can also execute commands via bash, so I use this tool to do simple batch scripting. I polished it a bit and made it public should anyone else find a need for something like this.

Another side benefit, is all linux systems have SSH installed. So you don't need special software to get this working. Just a webserver with apache and php. 


Screenshot or it didn't happen...
---------------------------------
![Alt text](screenshot.png "Screenshot of landing page...")


Installation
------------
See "Things to Note" section after installation.
1. Just place in web directory of your choice running PHP.    
2. Done. Seriously.

What if I have my own keys?
---------------------------
No problem. Just drop a public and private key (renamed to "public.key" and "private.key") into the "keys" directory. 
My system will use those instead of making you new ones.

 
Things to note
--------------
1. Make sure the "keys" directory is writable by your web daemon. This software will notify you if not correct.

2. Ensure Apache is set to "AllowOverrides All" for the web directory where this package sits. (Find httpd.conf or default-server.conf for Apache, make sure "AllowOverride" is set to "All").     
  1. This will prevent external users from accessing your keys. 
  2. I include htaccess files to prevent outside access of the "keys" directory, but it only works when AllowOverride is set to "All".

3. When creating RSA key pairs, PHP uses entropy on server to generate the keys. Should your server be idle or not have much activity - generating keys may take some time and may not work correctly. 

So in that case you'll have two options.    
  1. Change default timeout for PHP. (Not advised)    
  2. Install the "php5-gmp" package. It will greatly decrease your key generatation time. 

Either way, the software package will notify you if the "php5-gmp" package isn't installed or loaded.


What is the Config file?
------------------------
As I add functionality over time, I may have a need to setup a more "global" approach to how this software works. I added the file to allow me to enable or disable alerting on the index page as it can get annoying.


Final Notes/Legal
-----------------
This is completely, 100% not supported. I built this thing to help me on projects. It's handy for me but might not work for you and could probably break something else. :/
If my code breaks your system - not my fault.
Otherwise, let me know if something isn't working, needs fixed, or if you have ideas on making it better.


Changelog
---------
- Updated PHPSECLIB to 1.0.5
- Fix bug with SSH Key deployment
- Added some small functionality to remote commands showing live instead of static.