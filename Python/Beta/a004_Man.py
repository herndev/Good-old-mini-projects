#MAN
#By: Hernie Jabien
#Copyright @ Syntaxer 2019 all rights reserved.

from turtle import*
from tkinter import messagebox
import random
import string
class Man():
	def __init__(self):
		#Variables
		self.entt = []
		self.words = ["dog","rats","pogie","beauty","cow","cat","horse","dragon","tiger","snake","monkey","miilo","gatas","choco","coffee","tae","lobot","brief","sampot","shoes","ilok","jelly","nata","icepop","junkfoods","bubblegum","nova","piattos","onionrings","movie","moby","book","bokog","ballpen","paper","jollibee","mcdo","chowking","inasal","rice","petron","electricfan","national","tv","abc","yahoo","happy","sad","smile","frown","crown","laptop","cellphone","hungry"]
		self.word = self.words[random.randint(0,len(self.words)-1)]
		self.inputs = ""
		self.wrongs = -1
		self.btn = []
		#Area
		boundaries = Turtle()
		boundaries.width(10)
		boundaries.speed(0)
		boundaries.hideturtle()
		boundaries.penup()
		boundaries.goto(-300,-300)
		boundaries.pendown()
		for i in range(4):
			boundaries.forward(600)
			boundaries.left(90)
		#INITIALIZE
		self.hints = Turtle()
		self.hints.hideturtle()
		self.hints.speed(0)
		self.hints.penup()
		self.hints.speed(0)
		self.hints.goto(2000,2000)
		self.position = Turtle()
		self.position.hideturtle()
		self.position.speed(0)
		self.position.penup()
		self.position.speed(0)
		self.position.goto(2000,2000)
		for i in range(7):
			self.entt.append(Turtle())
			self.entt[i].hideturtle()
			self.entt[i].penup()
			self.entt[i].speed(0)
			self.entt[i].goto(2000,2000)
		listen()
		onkey(lambda:self.input("a"),"a")
		onkey(lambda:self.input("b"),"b")
		onkey(lambda:self.input("c"),"c")
		onkey(lambda:self.input("d"),"d")
		onkey(lambda:self.input("e"),"e")
		onkey(lambda:self.input("f"),"f")
		onkey(lambda:self.input("g"),"g")
		onkey(lambda:self.input("h"),"h")
		onkey(lambda:self.input("i"),"i")
		onkey(lambda:self.input("j"),"j")
		onkey(lambda:self.input("k"),"k")
		onkey(lambda:self.input("l"),"l")
		onkey(lambda:self.input("m"),"m")
		onkey(lambda:self.input("n"),"n")
		onkey(lambda:self.input("o"),"o")
		onkey(lambda:self.input("p"),"p")
		onkey(lambda:self.input("q"),"q")
		onkey(lambda:self.input("r"),"r")
		onkey(lambda:self.input("s"),"s")
		onkey(lambda:self.input("t"),"t")
		onkey(lambda:self.input("u"),"u")
		onkey(lambda:self.input("v"),"v")
		onkey(lambda:self.input("w"),"w")
		onkey(lambda:self.input("x"),"x")
		onkey(lambda:self.input("y"),"y")
		onkey(lambda:self.input("z"),"z")
		self.hint(self.word)
	def nwgame(self):
		self.entt[0].right(90)
		for i in range(6):
			self.entt[i].speed(0)
			self.entt[i].setheading(self.position.heading())
			self.entt[i].penup()
			self.entt[i].hideturtle()
			self.entt[i].clear()
			self.entt[i].goto(2000,2000)
		self.word = self.words[random.randint(0,len(self.words)-1)]
		self.inputs = ""
		self.wrongs = -1
		self.hint(self.word)
	def input(self, letter):
		if len(self.inputs) < len(self.word):
			self.inputs += letter
			self.entt[6].clear()
			self.entt[6].goto(0,-100)
			self.entt[6].speed(0)
			self.entt[6].pendown()
			self.entt[6].write(self.inputs, False, align="Center", font=("Arial", 50, "bold"))
		if len(self.inputs) == len(self.word):
			if self.inputs == self.word:
				messagebox.showwarning("Congratulation","You got it right!")
				messagebox.showwarning("Game","YOU WON")
				choice = messagebox.askquestion("Game","Do you want to play again?")
				if choice == "yes":
					self.nwgame()
			else:
				messagebox.showwarning("Game","Your answer is wrong!")
				self.wrongs += 1
				self.entt[6].clear()
				self.inputs = ""
				self.wrong(self.wrongs)
	def hint(self, word):
		size = len(word)
		word = list(word)
		combined = []
		letters = ""
		sample = ""
		wordstate = False
		posit = -1
		for i in range(10):
			state = True
			while state:
				sample = string.ascii_lowercase[random.randint(0,len(string.ascii_lowercase)-1)]
				if sample not in combined:
					combined.append(sample)
					state = False
		for i in word:
			posit = random.randint(0,9)
			if i not in combined:
				combined[posit] = i
		self.hints.clear()
		self.hints.goto(-290,-245)
		self.hints.pendown()
		self.hints.write("HINTS", False, align="Left", font=("Arial", 25, "bold"))
		self.hints.penup()
		self.hints.goto(-290,-270)
		self.hints.pendown()
		self.hints.write("SIZE: %s Letters"%(size), False, align="Left", font=("Arial", 15, "bold"))
		self.hints.penup()
		self.hints.goto(-290,-290)
		self.hints.pendown()
		self.hints.write("CLUE: %s"%combined, False, align="Left", font=("Arial", 15, "bold"))
	def wrong(self, num):
		if num == 0:
			self.entt[num].goto(-200, 70)
			self.entt[num].speed(2)
			self.entt[num].pendown()
			self.entt[num].right(10)
			self.entt[num].forward(100)
			self.entt[num].left(100)
			self.entt[num].forward(10)
			self.entt[num].left(80)
			self.entt[num].forward(100)
			self.entt[num].right(150)
			self.entt[num].forward(30)
			self.entt[num].right(30)
			self.entt[num].forward(100)
			self.entt[num].right(80)
			self.entt[num].forward(10)
			self.entt[num].right(70)
			self.entt[num].forward(30)
			self.entt[num].right(110)
			self.entt[num].forward(10)
			self.entt[num].right(70)
			self.entt[num].forward(30)
			self.entt[num].penup()
			self.entt[num].goto(-200, 70)
			self.entt[num].pendown()
			self.entt[num].left(70)
			self.entt[num].forward(10)
		elif num == 1:
			self.entt[num].goto(-150, 75)
			self.entt[num].speed(2)
			self.entt[num].pendown()
			self.entt[num].left(90)
			self.entt[num].forward(170)
			self.entt[num].goto(-150, 75)
			self.entt[num].right(100)
			self.entt[num].forward(20)
			self.entt[num].left(100)
			self.entt[num].forward(170)
			self.entt[num].backward(170)
			self.entt[num].right(70)
			self.entt[num].forward(10)
			self.entt[num].left(70)
			self.entt[num].forward(170)
			self.entt[num].left(110)
			self.entt[num].forward(10)
			self.entt[num].right(30)
			self.entt[num].forward(20)
			self.entt[num].right(150)
			self.entt[num].forward(10)
			self.entt[num].right(30)
			self.entt[num].forward(20)
		elif num == 2:
			self.entt[num].goto(-165, 220)
			self.entt[num].speed(2)
			self.entt[num].pendown()
			self.entt[num].right(10)
			self.entt[num].forward(230)
			self.entt[num].backward(230)
			self.entt[num].left(100)
			self.entt[num].forward(20)
			self.entt[num].right(100)
			self.entt[num].forward(230)
			self.entt[num].backward(230)
			self.entt[num].left(30)
			self.entt[num].forward(5)
			self.entt[num].right(30)
			self.entt[num].forward(230)
			self.entt[num].right(150)
			self.entt[num].forward(5)
			self.entt[num].left(70)
			self.entt[num].forward(20)
			self.entt[num].left(130)
			self.entt[num].forward(5)
			self.entt[num].left(50)
			self.entt[num].forward(20)
			self.entt[num].penup()
			self.entt[num].goto(-140,225)
			self.entt[num].shape("circle")
			self.entt[num].showturtle()
		elif num == 3:
			self.entt[num].goto(15, 210)
			self.entt[num].speed(2)
			self.entt[num].pendown()
			self.entt[num].right(160)
			self.entt[num].forward(5)
			self.entt[num].left(70)
			self.entt[num].forward(20)
			self.entt[num].left(85)
			self.entt[num].forward(5)
			self.entt[num].right(85)
			self.entt[num].forward(50)
		elif num == 4:
			self.entt[num].goto(15, 150)
			self.entt[num].shape("circle")
			self.entt[num].shapesize(2)
			self.entt[num].showturtle()
			self.entt[num+1].goto(15, 150)
			self.entt[num+1].width(10)
			self.entt[num+1].pendown()
			self.entt[num+1].right(70)
			self.entt[num+1].forward(50)
			self.entt[num+1].backward(50)
			self.entt[num+1].right(40)
			self.entt[num+1].forward(50)
			self.entt[num+1].backward(50)
			self.entt[num+1].left(20)
			self.entt[num+1].forward(50)
			self.entt[num+1].left(20)
			self.entt[num+1].forward(50)
			self.entt[num+1].backward(50)
			self.entt[num+1].right(40)
			self.entt[num+1].forward(50)
			messagebox.showwarning("Game","GAME OVER")
			choice = messagebox.askquestion("Game","Do you want to play again?")
			if choice == "yes":
				self.nwgame()
Man()
input()
