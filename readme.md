SSH Key Manager
===============

This package is used to distribute SSH keys (using PHP) to remote servers.


Who would use this?
-------------------
I ran into issues recently where I needed to issue commands to remote systems in batches. Instead of typing in passwords, we can use SSH keys to get into the systems much quicker. 
The added benefit of this is PHP can also execute commands via bash, so I use this tool to do simple batch scripting. I polished it a bit and made it public should anyone else find a need for something like this.

Another side benefit, is almost all linux systems have SSH installed. So you don't need special software to get this working. Just a central system, like a web server, where this package can run. 


Screenshot or it didn't happen...
---------------------------------
![Alt text](screenshot.png "Screenshot of landing page...")


Installation
------------
1) Just place in web directory of your choice running PHP.    
2) Make sure the "keys" directory is writable by your web daemon. (This little thing will tell you if you don't have something setup correctly)


What if I have my own keys?
---------------------------
No problem. Just drop a public and private key (renamed to "public.key" and "private.key") into the "keys" directory. 
My system will use those instead of making you new ones.

 
Things to note
--------------
When creating RSA key pairs, PHP uses entropy on server to generate the keys. Should your server be idle or not have much activity - generating keys may take some time.
I have the system setup to use 2048-bit keys; generating these could take longer than 30 seconds - which is the default timeout for PHP.

So in that case you'll have two options.
1) Change default timeout for PHP. (Not advised)
2) Install the "php5-gmp" package. It will greatly decrease your key generatation time.   
3) Make sure to setup Apache to allow overrides. (Find httpd.conf for Apache, make sure "AllowOverride" is set to "All"). This will prevent external users from accessing your keys...   


Final Notes/Legal
-----------------
This is completely, 100% not supported. I built this thing to help me on projects. It's handy for me but might not work for you and could probably break something else. :/
If my code breaks your system - not my fault.
Otherwise, let me know if something isn't working, needs fixed, or if you have ideas on making it better.
