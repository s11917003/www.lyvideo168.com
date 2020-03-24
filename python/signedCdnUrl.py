#import urllib
from urllib.parse import urlparse
import datetime
import base64
import hmac, hashlib
import sys

def sign_url(url):
	return url;


urlstring = sys.argv[1]
expiretime = sys.argv[2]
inputtype = sys.argv[3]
listnum = int(sys.argv[4])
restlist = []

if inputtype == 'm3u8':
	res = sign_url( sys.argv[1], 'c8av01', 'RlAJ-vXa0sDveUdM6HA-vg==', sys.argv[2])
	print(res)
else:
	count = 0
	while count <= listnum:
		restlist.append(sign_url( urlstring+str(count)+'.ts'))
		count = count + 1
	print(restlist)