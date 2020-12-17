#ANY MODIFICATION OF THE FILE ARE STRICTLY PROHIBITED
#DO NOT COPY ANY PARTS OF THIS FILE WITHOUT ANY PERMISSION TO THE DEVELOPER

import os
newpath1 = r'Database' 
newpath2 = r'res' 
if not os.path.exists(newpath1):
	os.makedirs(newpath1)
if not os.path.exists(newpath2):
	os.makedirs(newpath2)
	os.makedirs('res/config')
	os.makedirs('res/config/cache')
	tst = open('res/config/prio', 'w+')
	tst.write('')
	tst.close()
files_in_db = os.listdir('Database')
def prio(Database):
	data = open('res/config/prio', 'w+')
	data.write('%s'%Database)
	data.close()

def getprio():
	data = open('res/config/prio', 'r+')
	deta = data.read()
	data.close()
	return deta
def decrypt(stR, action=''):
	dic = {}
	d = ''
	tempor = ''
	if action == 'cache':
		stR = stR.splitlines()
		temp = stR[0].split()
		dic[temp.pop(0)] = temp
		stR.pop(0)
		for i in stR:
			tempor = i.split()
			if len(tempor) > 1:
				for x,j in enumerate(tempor):
					if x % 2:
						dic[d] = j
						d = ''
					else:
						d = j
			else:
				if len(tempor) > 0:
					dic[tempor[0]] = ''
	else:
		stR = stR.splitlines() 
		for i in stR:
			temp = i.split()
			if len(temp) > 1:
				tempor = temp.pop(0)
				dic[tempor] = ' '.join(temp)
			else:
				if len(temp) > 0:
					dic[temp[0]] = ''
	return dic

def encrypt(Dictionary, action=''):
	temp = ''
	if type(Dictionary) == dict:
		if action == 'cache':
			for i in Dictionary:
				if type(Dictionary[i]) == str:
					temp += i + ' ' + Dictionary[i] + '\n'
				else:
					temp += i + ' ' + ' '.join(Dictionary[i]) + '\n'
		else:
			for i in Dictionary:
				temp += i + ' ' + Dictionary[i] + '\n'
		return temp
	else:
		return False
def check_database():
	if len(list_of_files) > 0:
		return False
	else:
		return True

def checkdb(Database):
	mpath = r'Database/' + Database
	if os.path.exists(mpath):
		return True
	else:
		return False

def checktb(Database,Table):
	mpath = r'Database/' + Database + '/' + Table
	if os.path.exists(mpath):
		return True
	else:
		return False
def raw_tree():
	merger = ''
	startpath = 'Database'
	for root, dirs, files in os.walk(startpath):
		level = root.replace(startpath, '').count(os.sep)
		indent = ' ' * 4 * (level)
		merger += '{}{}/'.format(indent, os.path.basename(root)) + '\n'
		subindent = ' ' * 4 * (level + 1)
		for f in files:
			merger += '{}{}'.format(subindent, f) + '\n'
	return merger

def raw_database():
	mpath = os.listdir('Database')
	return mpath

def rawdb(Database):
	mpath = os.listdir('Database/%s'%Database)
	return mpath

def rawtb(Database,Table):
	mpath = os.listdir('Database/%s/%s'%(Database,Table))
	return mpath
def showall(Table):
	db = getprio()
	temp = {}
	d = {}
	l = []
	try:
		for i in rawtb(db, Table):
			data = open('Database/%s/%s/%s'%(db,Table,i), 'r+')
			deta = data.read()
			data.close()
			d = decrypt(deta)
			if d != {}:
				l.append(d)
		if l == []:
			return False
		else:
			return l
	except:
		return False
def createdb(Database):
	if not checkdb(Database):
		os.makedirs('Database/%s'%Database)
		os.makedirs('res/config/cache/%s'%Database)
		prio(Database)
		return True
	else:
		prio(Database)
		return False

def createtb(Table, List):
	db = getprio()
	try:
		os.makedirs('Database/%s/%s'%(db,Table))
		data = open('res/config/cache/%s/%s'%(db,Table), 'a')
		data.write('%s %s\ncount 10000000000'%(Table,' '.join(List)))
		data.close()
		return True
	except:
		return False
		
def connectdb(Database):
	if checkdb(Database):
		prio(Database)
	return checkdb(Database)
	

def connecttb(Table):
	db = getprio()
	if db is not '':
		return checktb(db, Table)
	else:
		return False
		
def tbreq(Table):
	db = getprio()
	if db is not '':
		if checktb(db,Table):
			data = open('res/config/cache/%s/%s'%(db,Table), 'r+')
			deta = data.read()
			data.close()
			d = decrypt(deta)
			data = d[Table].split()
			return(data)
	else:
		return False
def insertdata(Table, Dictionary):
	db = getprio()
	pure_data = False
	temp = ''
	d = {}
	try:
		data = open('res/config/cache/%s/%s'%(db,Table), 'r+')
		deta = data.read()
		data.close()
		d = decrypt(deta)			
		for i in Dictionary:
			if i in d[Table]:
				temp += i + ' ' + Dictionary[i] + '\n'
				pure_data = True
			else:
				pure_data = False
				break
		if pure_data:
			data = open('Database/%s/%s/a%s'%(db,Table,d['count']), 'w+')
			data.write('%s'%temp)
			data.close()		
			d['count'] = str(int(d['count']) + 1)
			d = encrypt(d, 'cache')		
			data = open('res/config/cache/%s/%s'%(db,Table), 'w+')
			data.write('%s'%d)
			data.close()
			return True
		else:
			return False
	except:
		return False
def selectdata(Table, Dictionary, List=[]):
	db = getprio()
	temp = {}
	d = {}
	l = []
	try:
		for i in rawtb(db, Table):
			data = open('Database/%s/%s/%s'%(db,Table,i), 'r+')
			deta = data.read()
			data.close()
			d = decrypt(deta)
			for j in Dictionary:
				if j in d.keys():
					if Dictionary[j] == d[j]:
						temp = dict(d)
						if List != []:
							for i in d:
								if i not in List:
									temp.pop(i)
						l.append(temp)
										
		if l == []:
			return False
		elif len(l) == 1:
			return l[0]
		else:
			return l
	except:
		return False
def updatedata(Table, Dictionary1, Dictionary2):
	db = getprio()
	temp = {}
	d = {}
	try:
		for i in rawtb(db, Table):
			data = open('Database/%s/%s/%s'%(db,Table,i), 'r+')
			deta = data.read()
			data.close()
			d = decrypt(deta)
			for j in Dictionary1:
				if j in d.keys():
					if Dictionary1[j] == d[j]:
						for x in Dictionary2:
							d[x] = Dictionary2[x]
						temp = encrypt(d)
						data = open('Database/%s/%s/%s'%(db,Table,i), 'w+')
						data.write('%s'%temp)
						data.close()	
						return True
					else:
						break
		return False
	except:
		return False
def deletedata(Table, Dictionary):
	db = getprio()
	temp = {}
	d = {}
	try:
		for i in rawtb(db, Table):
			data = open('Database/%s/%s/%s'%(db,Table,i), 'r+')
			deta = data.read()
			data.close()
			d = decrypt(deta)
			for j in Dictionary:
				if j in d.keys():
					if Dictionary[j] == d[j]:
						data = open('Database/%s/%s/%s'%(db,Table,i), 'w+')
						data.write('')
						data.close()	
						os.remove('Database/%s/%s/%s'%(db,Table,i))
						return True
					else:
						break
		return False
	except:
		return False

# usr = ["Tisoy", "Pogie", "Gwapo", "Beauty", "Tisay"]
# usr.sort()
# for x in usr:
# 	insertdata("bank",{"name":x,"money":"0"})

# insertdata("bank",{"name":"Beauty","money":"0"})