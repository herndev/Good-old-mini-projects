import os

class herndb:
	def __init__(self):
		super(herndb, self).__init__()

	def console(self):
		print("Hello World")

class Main(object):
	def __init__(self, authenticate):
		super(Main, self).__init__()
		self.authenticate = authenticate
		if  self.authenticate == '__main__':
			self.console()

	def console(self):
		print(self.authenticate)

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


def main():
	console = Main(__name__)

if __name__ == '__main__':
	main()