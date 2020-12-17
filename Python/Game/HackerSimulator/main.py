from getpass import getpass
from herntool import*
import time
import os

#Game class
class Game(object):
	"""docstring for Main"""
	def __init__(self):
		super(Game, self).__init__()
		self.player_name = ""
		self.player_money = ""
		self.player_experience = ""
		self.player_energy = ""
		#HouseSTATS
		self.Immunity = 10
		self.Energy = 5
		self.Mind = 5
		self.Hands = 5
		self.Computer = 5
		self.Fridge = 5

	def play(self):
		state = True
		while state:
			if self.player_name == "":
				print("="*60)
				print("||  WELCOME TO HackerSimulator")
				print("="*60)
				codename = input("Codename: ")
				passkey = getpass("Passkey: ")

				if passkey == "123":
					self.player_name = codename
					self.player_experience = 10
					self.player_money = 100
					self.player_energy = 100
					return True
				else:
					os.system("clear")
					print("-"*60)
					print("ERROR: Authentication failed.")


	def player(self):
		pass

	def Bedroom(self):
		os.system("clear")
		act = [
			["[1]","Home stats", "Details about home utilities."],
			["[2]","Hack", "Get money base on experience."],
			["[3]","Sleep", "Gain energy."]
		]

		print(("="*60))
		print("||  BEDROOM")
		print("="*60)
		print("Player: %s\tEXP: %d\t\tMoney: $%d"%(self.player_name, self.player_experience, self.player_money))
		print("-"*60)
		print("Energy: %d"%self.player_energy)
		print(("-"*22)+"   ACTIVITIES   "+("-"*22))
		for x in strmod().listTable(act,5):
			menu = ""	
			for i in x:
				menu += i
			print(menu)
		print("-"*60)
		choice =""
		while choice == "" or choice not in "123":
			self.player_energy -= 1
			choice = input("No. of act:>> ")
		
		if int(choice) == 1:
			self.Bedroom_homeStats()
		elif int(choice) == 2:
			self.Bedroom_hack()
		elif int(choice) == 3:
			self.Bedroom_sleep()

	def Bedroom_sleep(self):
		os.system("clear")
		act = [
			["[1]", "Go back"],
			["[2]", "Sleep again"]
		]
		print(("="*60))
		print("||  BEDROOM")
		print("="*60)
		print("Player: %s\tEXP: %d\t\tMoney: $%d"%(self.player_name, self.player_experience, self.player_money))
		print("-"*60)
		print("Energy: %d"%self.player_energy)
		print(("-"*22)+"     -ON BED     "+("-"*22))
		print("_"*40)
		for x in range(1,30):
			print("Sleeping: "+("#"*x)+"\r",end="")
			time.sleep(1)
		print("Sleeping: "+("#"*30))
		self.player_energy += 20
		self.player_experience += 2
		os.system("clear")
		print(("="*60))
		print("||  BEDROOM")
		print("="*60)
		print("Player: %s\tEXP: %d\t\tMoney: $%d"%(self.player_name, self.player_experience, self.player_money))
		print("-"*60)
		print("Energy: %d"%self.player_energy)
		print("\n"+("-"*22)+"     ACTION     "+("-"*22))
		for x in strmod().listTable(act,5):
			menu = ""	
			for i in x:
				menu += i
			print(menu)
		print("-"*60)
		choice =""
		while choice == "" or choice not in "12":
			self.player_energy -= 1
			choice = input("No. of act:>> ")
		
		if int(choice) == 1:
			self.Bedroom()
		elif int(choice) == 2:
			self.Bedroom_sleep()
		


	def Bedroom_hack(self):
		os.system("clear")
		self.player_energy -= 5
		stR = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
		stR = stR.replace(",", "")
		stR = stR.replace(".", "")
		stR = stR.split()
		data = []
		data.append(stR)
		act = [
			["[1]", "Go back"],
			["[2]", "Play again"]
		]
		print(("="*60))
		print("||  PERSONAL COMPUTER")
		print("="*60)
		print("Player: %s\tEXP: %d\t\tMoney: $%d"%(self.player_name, self.player_experience, self.player_money))
		print("-"*60)
		print("Energy: %d"%self.player_energy)
		print(("-"*22)+"    << PC >>    "+("-"*22))
		menu = ""
		for y,x in enumerate(strmod().listTable(data,5)[0]):
			if y % 6 == 0:
				print(menu)
				menu = ""
			else:
				menu += x
		print("-"*60)
		inputs = ""
		while ";" not in inputs:
			self.player_energy -= 1
			if inputs == "":
				inputs += input("Enter as many words(Put \';\' symbol to submit):>> ")
			else:
				inputs += " "
				inputs += input("\t\t:>> ")
		os.system("clear")
		inputs = inputs.replace(";", "")
		inputs = set(inputs.split())
		stR = set(stR)
		score = len(inputs.intersection(stR))
		earned = int(score * (self.player_experience * 0.10))
		if score != 0:
			self.player_money += earned
			self.player_experience += 2
			exp = 2
		else:
			exp = 0
		self.player_energy -= 5
		
		print(("="*60))
		print("||  PERSONAL COMPUTER")
		print("="*60)
		print("Player: %s\tEXP: %d\t\tMoney: $%d"%(self.player_name, self.player_experience, self.player_money))
		print("-"*60)
		print("Energy: %d"%self.player_energy)
		print(("-"*22)+"    << PC >>    "+("-"*22))
		print("\n\tResult:")
		print("\tScore: %d/%d"%(score,len(inputs)))
		print("\tEarned experience: %d"%exp)
		print("\tEarned money: $%d"%earned)
		print("\n"+("-"*22)+"     ACTION     "+("-"*22))
		for x in strmod().listTable(act,5):
			menu = ""	
			for i in x:
				menu += i
			print(menu)
		print("-"*60)
		choice =""
		while choice == "" or choice not in "12":
			self.player_energy -= 1
			choice = input("No. of act:>> ")
		
		if int(choice) == 1:
			self.Bedroom()
		elif int(choice) == 2:
			self.Bedroom_hack()


	def Bedroom_homeStats(self):
		os.system("clear")
		self.player_energy -= 5
		stat = [
			["Immunity",("* "*int((self.Immunity / 5)))],
			["Energy",("* "*int((self.Energy / 5)))],
			["Mind",("* "*int((self.Mind / 5)))],
			["Hands",("* "*int((self.Hands / 5)))]
		]
		gadgets = [
			["Computer", ("* "*int((self.Computer / 5)))],
			["Laptop", "- - - - - - - - - -"]
		]
		fridge = [
			["Fridge", ("* "*int((self.Fridge / 5)))]
		]

		print(("="*60))
		print("||  HOME STATISTICS")
		print("="*60)
		print("Player: %s\tEXP: %d\t\tMoney: $%d"%(self.player_name, self.player_experience, self.player_money))
		print("-"*60)
		print("Energy: %d"%self.player_energy)
		print(("-"*22)+"     SKILLS     "+("-"*22))
		for x in strmod().listTable(stat,5):
			menu = ""	
			for i in x:
				menu += i
			print(menu)
		print(("-"*22)+"     TECHIE     "+("-"*22))
		for x in strmod().listTable(gadgets,5):
			menu = ""	
			for i in x:
				menu += i
			print(menu)
		print(("-"*22)+"     FRIDGE     "+("-"*22))
		for x in strmod().listTable(fridge,7):
			menu = ""	
			for i in x:
				menu += i
			print(menu)
		print("-"*60)
		input("\nPress enter to go back >>")
		self.Bedroom()

#Main Function
def Main():
	os.system("clear")
	game = Game()
	if game.play():
		game.Bedroom()



#START...
Main()