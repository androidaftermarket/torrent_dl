torrent_dl<br />
==========<br />

Automatically download tv show torrents from http://showrss.karmorra.info/<br />

1) Create an account with http://showrss.karmorra.info/<br />
2) Select the TV shows you'd lke to track. http://showrss.karmorra.info/?cs=shows<br />
3) Select the quality you want and generate your feed http://showrss.karmorra.info/?cs=feeds<br />
4) Copy your feed address - http://showrss.karmorra.info/rss.php?user_id=XXXX<br />
5) Paste that address into the showrssFetch.php<br />
6) Edit $destDir = "../personal/torrents/" to match where your torrent client looks for torrents - I use dropbox.<br />
7) set a cron job to run showrssFetch.php every few hours.<br />
8) That's it<br />
