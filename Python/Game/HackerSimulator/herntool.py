import os

class herndb:
	def __init__(self):
		super(herndb, self).__init__()

	def console(self):
		print("Hello World")

class strmod:
	def __init__(self):
		super(strmod, self).__init__()

	def listTable(self, List, Spacing = 0):
		row = [0 for i in List]
		column = [0 for x,i in enumerate(List[0])]
		col_mxsize = [0 for x,i in enumerate(List[0])]
		for i in List:
			for x,y in enumerate(i):
				if col_mxsize[x] <= len(y):
					col_mxsize[x] = len(y) + Spacing
		for a,i in enumerate(List):
			columns = [y + (" " * (col_mxsize[x] - len(y))) for x,y in enumerate(i)]
			row[a] = columns
		return row

	def searchByStartEnd(self, String, Start, End):
		Start = Start.lower()
		End = End.lower()
		String = String.split()
		data=set()
		for i in String:
			if i.lower().startswith(Start) and i.lower().endswith(End):
				data.add(i)
		if data:
			return list(data)
		else:
			return []

	def searchByStart(self, String, Start):
		Start = Start.lower()
		String = String.split()
		data=set()
		for i in String:
			if i.lower().startswith(Start):
				data.add(i)
		if data:
			return list(data)
		else:
			return []

	def searchByEnd(self, String, End):
		End = End.lower()
		String = String.split()
		data=set()
		for i in String:
			if i.lower().endswith(End):
				data.add(i)
		if data:
			return list(data)
		else:
			return []

	def search(self, String, Mid):
		Mid = Mid.lower()
		String = String.split()
		data=set()
		for i in String:
			if Mid in i.lower():
				data.add(i)
		if data:
			return list(data)
		else:
			return []

# 	def strToDict(self, String):
# 		data = {}
# 		temp = {}
# 		s = 0
# 		m = 0
# 		l = 0
# 		state = True
# 		while l <= len(String):
# 			if String[s] == "{":
# 				m = s
# 				while String[m] != ":":
# 					m += 1
# 				l = m
# 				while String[l] != "}":
# 					l += 1
# 			else:
# 				s += 1

# 		# for x in String.lower():
# 		# 	print(x)


# a = [["No.","Name","Age","number"],["1", "john doe","18","911"],["2", "jesica doe","21","143"],['3', "toby doe","9","211"]]
# b = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
# c = "{\'abc\':\'aaa\',\'bbc\':\'bbb\',\'cbc\':\'ccc\'}"
# d = "{{\'abc\':\'aaa\'},{\'bbc\':\'bbb\',\'cbc\':\'ccc\'}}"
# e = ["a","b","c","a"]

# strmod().strToDict(c)
# print(d)
# print()
# act = [
# 		["[1]","Home stats", "Details about home utilities."],
# 		["[2]","Hack", "Get money base on experience."],
# 		["[3]","Sleep", "Gain energy."]
# 	]

