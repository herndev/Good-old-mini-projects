#Developed by Hernie Jabien
#TictactoeBot

import os
import random
import time

class Tictac:
	def __init__(self):
		super(Tictac, self).__init__()
		self.board = ["_" for i in range(9)]
		self.combination = [
			[0,1,2],[3,4,5],[6,7,8],
			[0,4,8],[2,4,6],[1,4,7],
			[0,3,6],[2,5,8]
		]
		self.me = "X"
		self.turn = "X"
		self.win = ""
		self.game = False

	def play(self):
		if not self.game:
			self.Drawboard()
			self.myMove()

	def Drawboard(self):
		if not self.game:
			os.system("clear")
			self.Banner()
			print(("_"*10))
			line = ""
			for i,x in enumerate(self.board, start=1):
				if i % 3 == 0:
					print("" + line + x)
					line = ""
				else:
					line += x + " | "
			print(("_"*10))

	def myMove(self):
		if not self.game:
			self.checkWin()
			state = True
			while state:
				move = input("Block: ")
				if move in "123456789" and move != "" and len(move) == 1:
					if self.board[int(move)-1] == "_":
						self.board[int(move)-1] = self.me
						if self.me == "X":
							self.turn = "O"
						else:
							self.turn = "X"
						state = False
					else:
						print("\rError: Position already taken.")
				else:
					print("\rError: Invalid position.")
			self.Drawboard()
			self.move_medium()

	def Banner(self):
		if not self.game:
			print("\u001b[3mTIC-TAC-TOE")

	def move_basic(self):
		if not self.game:
			self.checkWin()
			time.sleep(1)
			state = True
			position = 0
			while state:
				position = random.randint(1,9)
				if self.board[position-1] == "_" and position != 0:
					self.board[position-1] = self.turn
					state = False
					
			self.play()

	def move_medium(self):
		if not self.game:
			self.checkWin()
			time.sleep(1)
			state = True
			position = 0
			target = -1
			# rnd = random.randint(1,2)
			rnd = random.randint(1,3)
			if rnd > 1:
				while state:
					for x in self.combination:
						if self.board[x[0]] == self.board[x[1]] and self.board[x[2]] == "_" and self.board[x[0]] == self.me:
							target = x[2]
						elif self.board[x[0]] == self.board[x[2]] and self.board[x[1]] == "_" and self.board[x[0]] == self.me:
							target = x[1]
						elif self.board[x[1]] == self.board[x[2]] and self.board[x[0]] == "_" and self.board[x[1]] == self.me:
							target = x[0]
					if self.board[target] == "_" and target != -1:
						self.board[target] = self.turn
						state = False
					else:
						position = random.randint(1,9)
						if self.board[position-1] == "_" and position != 0:
							self.board[position-1] = self.turn
							state = False
			else:
				while state:
					position = random.randint(1,9)
					if self.board[position-1] == "_" and position != 0:
						self.board[position-1] = self.turn
						state = False
			self.play()

	def checkWin(self):
		for i in ["X","O"]:
			for x in self.combination:
				if self.board[x[0]] == self.board[x[1]] and self.board[x[0]] == self.board[x[2]]:
					self.win = self.board[x[0]]
					
		# print(self.win)
		if self.win == self.me:
			os.system("clear")
			self.game = True
			print("YOU WON !!")
		elif self.win != self.me and self.win != "" and self.win != "_":
			os.system("clear")
			self.game = True
			print("BOT WON !!")
		elif "_" not in self.board:
			os.system("clear")
			self.game = True
			print("It's a TIE.")

		if self.game:
			self.board = ["_" for i in range(9)]
			self.me = "X"
			self.turn = "X"
			self.win = ""
			self.game = False
			choice = ""
			while choice != "y" and choice != "n":
				print("Do you want to play again?[y/n]")
				choice = input("$:>> ")
			if choice == "y":
				self.play()
			else:
				self.game = True


def main():
	tt = Tictac()
	tt.play()

if __name__ == '__main__':
	main()