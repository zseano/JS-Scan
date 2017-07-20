# JS-Scan
A tool designed to scrape a list of .js files and extract urls, as well as juicy information. (as long as you modify regex :P)

# What's needed
- Somewhere to run PHP. I've tested this on PHP 7.1.7 and I recommend running XAMPP locally so you can just run the PHP from your computer locally. You can grab XAMPP from here: https://www.apachefriends.org/index.html. 
- Some PHP knowledge if you wish to modify the script
- InputScanner to scrape .js files

# How to use
I recommend using my InputScanner to gather a list of .js files (https://github.com/zseano/InputScanner). It outputs in the following format: found@https://www.example.com/https://www.example.com/eg.js|, which is parsed when using this script to easily show you where each .js file was discovered. Useful when you find interesting functions etc..

If using InputScanner, your JS-output.txt file should contain data, so copy it over to this script. If not, load your own data. If using your own data, you may want to modify the index.php file and set **$usingInputScanner** to "no", in the processUrls() function.

If setup correctly, you should see this:

![Example](https://i.imgur.com/zbp0azF.png "JS-scan")

Click "Run Scanner" and you'll see something similar to this:

![Example](https://i.imgur.com/3QZKGgR.png "JS-scan")

# Outputs
This script currently doesn't save any data. Feel free to modify.

# Modifying regex
Currently the regex used is: **$a = ['|url:"/(.*)"|U', "|url:'/(.*)'|U"];**. This means it'll look for url:"/string" and url:'/string'. You can modify this to look for other stuff, such as app secrets, interesting functions etc. This can be found in the processUrls() function, on line 60.

## Final remarks
I am not responsible for how you use this tool. You are free to modify this script as you see fit.


