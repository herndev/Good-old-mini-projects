import datetime
date = datetime.datetime.now()
print('{:%B %d, %Y}'.format(date))
print('{:%j} day of the year'.format(date))