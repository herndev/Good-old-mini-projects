#BounceMe
#By: Hernie Jabien
#Copyright @ Syntaxer 2019 all rights reserved.
from turtle import*
from random import*
from math import*
from tkinter import messagebox

class BounceMe():
	def __init__(self):
		screen = Screen()
		screen.register_shape("../img/block.gif")
		
		#Variables
		score1 = 0
		score2 = 0
		self.downer1 = False
		self.uper1 = False
		self.downer2 = False
		self.uper2 = False
		
		#Create area
		area = Turtle()
		area.hideturtle()
		area.penup()
		area.speed(5)
		area.width(15)
		area.goto(-300,-300)
		area.pendown()
		area.fillcolor("#8B6914")
		area.begin_fill()
		for i in range(4):
			area.forward(600)
			area.left(90)
		area.end_fill()
		
		#Dispay Score
		scorer1 = Turtle()
		scorer1.hideturtle()
		scorer1.penup()
		scorer1.goto(-300, 315)
		scorer1.write("Score: 0")
		scorer2 = Turtle()
		scorer2.hideturtle()
		scorer2.penup()
		scorer2.goto(230, 315)
		scorer2.write("Score: 0")
		
		
		#Player 1
		self.player1 = Turtle()
		self.player1.penup()
		self.player1.hideturtle()
		self.player1.speed(0)
		self.player1.goto(275, 0)
		self.player1.left(90)
		self.player1.showturtle()
		self.player1.shape("../img/block.gif")
		
		#Player 2
		self.player2 = Turtle()
		self.player2.penup()
		self.player2.hideturtle()
		self.player2.speed(0)
		self.player2.goto(-275, 0)
		self.player2.left(90)
		self.player2.showturtle()
		self.player2.shape("../img/block.gif")
		
		
		#Ball
		ball = Turtle()
		ball.penup()
		ball.shape("circle")
		ball.color("blue")
		ball.speed(0)
		ball.left(randint(0, 360))
		
		#Buttons
		listen()
		onkey(self.down1, "Down")
		onkey(self.up1, "Up")
		onkey(self.down2, "s")
		onkey(self.up2, "w")
		
		
		while True:
			if ball.ycor() > 285 or ball.ycor() < -285 or self.get_distance(self.player1.xcor(), self.player1.ycor(), ball.xcor(), ball.ycor()) or self.get_distance(self.player2.xcor(), self.player2.ycor(), ball.xcor(), ball.ycor()):
				ball.right(280)
			if ball.xcor() > 285 or ball.xcor() < -285:
					if ball.xcor() < -285:
						score2 += 1
						scorer2.clear()
						scorer2.write("Score: %d"%score2)
					if ball.xcor() > 285:
						score1 += 1
						scorer1.clear()
						scorer1.write("Score: %d"%score1)
					if score1 > 9 or score2 > 9:
						if score1 > 9:
							messagebox.showinfo("GAME OVER","Player 1 WINS")
						if score2 > 9:
							messagebox.showinfo("GAME OVER","Player 2 WINS")
						value = messagebox.askquestion("Bounce ME", "Do you want to play again?")
						if value == "yes":
							score1 = score2 = 0
							scorer1.clear()
							scorer1.write("Score: 0")
							scorer2.clear()
							scorer2.write("Score: 0")
						else:
							screen.exit()
					ball.goto(0,0)
					ball.left(randint(0, 360))
			ball.forward(3)
			if self.downer1 and self.player1.ycor() > -225:
				self.player1.backward(20)
				self.downer1 = False
			if self.uper1 and self.player1.ycor() < 225:
				self.player1.forward(20)
				self.uper1 = False
			if self.downer2 and self.player2.ycor() > -225:
				self.player2.backward(20)
				self.downer2 = False
			if self.uper2 and self.player2.ycor() < 225:
				self.player2.forward(20)
				self.uper2 = False
	
	def down1(self):
		self.downer1 = True
	def up1(self):
		self.uper1 = True
	def down2(self):
		self.downer2 = True
	def up2(self):
		self.uper2 = True
	def get_distance(self, ax, ay, bx, by):
		Output = False
		distance = sqrt(pow(ax-bx,2)+pow(ay-by,2))
		distance1 = sqrt(pow(ax-bx,2)+pow((ay + 25)-by,2))
		distance2 = sqrt(pow(ax-bx,2)+pow((ay - 25)-by,2))
		if distance < 30 or distance2 < 30 or distance1 < 30:
			Output = True
		return Output

BounceMe()
input("")
