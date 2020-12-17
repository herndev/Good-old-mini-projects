import os

class herndb:
	def __init__(self):
		super(herndb, self).__init__()
		self.queries = ['select','insert','update','delete','use','create']
	
	def strToQueryConverter(self, sql):
		sql = sql.lower()
		query = []
		temp = []
		start = 0
		mid = 0
		end = 0
		state = False
		scan_state = True
		for q in self.queries:
			if sql.startswith(q+" "):


				#IF SQL IS A SELECT STATEMENT
				if q == self.queries[0]:
					query.append('select')
					query.append(sql.split()[1].replace(","," ").split())
					query.append('from')
					query.append(sql.split()[3])

					if sql.split()[4] == 'where':
						key = sql.split()[-1].replace("\'"," ").replace("="," ").split()[0]
						value = sql.split()[-1].replace(key,"").replace("=","").replace("\'","").replace("\"","")

						query.append('where')
						query.append(key)
						query.append(value)

					state = True
				

				#IF SQL IS A INSERT STATEMENT
				if q == self.queries[1]:
					query.append('insert')
					query.append('into')
					query.append(sql.replace("("," ").split()[2])
					query.append(sql.replace("("," ").replace(")"," ").split()[3].replace(","," ").split())
					query.append('values')

					ilastOpenedParenthesis=0
					for ilastParenthesis in range(len(sql)-1, 0, -1):
						if sql[ilastParenthesis] == "(":
							ilastOpenedParenthesis = ilastParenthesis
							break

					temp_value = sql[ilastOpenedParenthesis+1:-1].replace(" ","(").replace("\'"," ").replace("\""," ").replace(","," ").split()
					temp_value = [value.replace("("," ") for value in temp_value]

					query.append(temp_value)
					state = True

					

						
		if state:
			return query
		else:
			return []

	def query(self, sql):
		print(self.strToQueryConverter(sql))

	def encrypt(self):
		pass

	def decrypt(self):
		pass

	def create(self):
		pass
	
	def insert(self):
		pass

	def select(self):
		pass

	def update(self):
		pass

	def delete(self):
		pass

class Main(herndb):
	def __init__(self):
		super(Main, self).__init__()
		self.banner()
		self.console()
		self.query(input("Query: "))

	def console(self):
		print('Hello World')

	def banner(self):
		print('     ___   ___                          ___________                  ___')
		print('    /  /  /  /                         /___   ____/                 /  /')
		print('   /  /__/  / _______  __  ___  __ _____  /  / ________  ________  /  /')
		print('  /   __   / /  __  / / /.\" _/ / /\"    / /  / /  __   / /  __   / /  /')
		print(' /  /  /  / /  ____/ /  .\'\"   / /     / /  / /  /_/  / /  /_/  / /  /')
		print('/__/  /__/ /______/ /__/     /____/__/ /__/ /_______/ /_______/ /__/')
		print()
		print('\u001b[01mDeveloped by: \u001b[00m\u001b[03mHernie Jabien\u001b[00m')
		print('\u001b[01mVersion: \u001b[00m\u001b[03m0.7\u001b[00m')
	# def console(self):
	# 	print('Hello Worlds')

#String modification
class strmod:
	def __init__(self):
		super(strmod, self).__init__()

	#Convert words in list into same sizes and spaces
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
	console = Main()

if __name__ == '__main__':
	main()