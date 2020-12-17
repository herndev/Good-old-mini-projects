#LocalDatabaseV0.2
#By: Hernie Jabien
#Copyright @ Syntaxer 2019 all rights reserved.

import os

#CheckPath
newpath = r'Database' 
if not os.path.exists(newpath):
    os.makedirs(newpath)
list_of_files = os.listdir("Database")

#Others
def startup():
	if len(list_of_files) > 0:
		return False
	else:
		return True

def check(table):
	if table in list_of_files:
		return True
	else:
		return False

def raw():
	return list_of_files
		
def rawdata(table):
	data = open("Database/%s"%table, "r+")
	deta = data.read()
	data.close()
	return deta

def datacount(table):
	data = open("Database/%s"%table, "r+")
	deta = data.read().splitlines()
	data.close()
	return len(deta)

#CRUD
def insert(table, key, value):
	data = open("Database/%s"%table, "a")
	data.write("%s=%s\n"%(key,value))
	data.close()

def get(table, key):
	if check(table):
		data = open("Database/%s"%table, "r+")
		deta = data.read().splitlines()
		data.close()
		keys = []
		for i in deta:
			for j in range(len(i)):
				if i[0:j] == key:
					return i[j+1:len(i)]

def getkeys(table):
	if check(table):
		data = open("Database/%s"%table, "r+")
		deta = data.read().splitlines()
		data.close()
		keys = []
		for idx,i in enumerate(deta):
			for j in range(len(i)):
				if i[j] == "=":
					keys.append(i[0:j])
		return keys

def update(table, key, value):
	if check(table):
		data = open("Database/%s"%table, "r+")
		deta = data.read().splitlines()
		data.close()
		for idx,i in enumerate(deta):
			if key in i:
				for j in range(len(i)):
					if i[j] == "=":
						deta[idx] = i[0:j+1] + value
		nwdata = open("Database/%s"%table, "w")
		for i in deta:
			nwdata.write("%s\n"%i)
		nwdata.close()

def delete(table, key):
	if check(table):
		data = open("Database/%s"%table, "r+")
		deta = data.read().splitlines()
		data.close
		for idx,i in enumerate(deta):
			if key in i:
				for j in range(len(i)):
					if i[0:j] == key:
						deta[idx] = ""
		nwdata = open("Database/%s"%table, "w")
		for i in deta:
			if i is not "":
				nwdata.write("%s\n"%i)
		nwdata.close()
