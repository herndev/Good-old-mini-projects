#Evolution
#By: Hernie Jabien
#Copyright @ Syntaxer 2019 all rights reserved.
from turtle import*
from random import*
from math import*

class Evo:
	def __init__(self):
		screen = Screen()
		screen.register_shape("../img/target.gif")
		screen.register_shape("../img/worm.gif")
		screen.register_shape("../img/bee.gif")
		screen.register_shape("../img/frog.gif")
		screen.register_shape("../img/snake.gif")
		screen.register_shape("../img/duck.gif")
		
		#Variables
		self.d = "right"
		self.m = []
		self.go = ""
		self.onGame = True
		self.value = [0,0,0,0,0,0,0,0,0,0]
		self.entity = []
		self.direction = []
		self.position = 0
		
		#Create area
		area = Turtle()
		area.hideturtle()
		area.penup()
		area.speed(5)
		area.width(15)
		area.goto(-300,-300)
		area.pendown()
		area.forward(600)
		area.left(90)
		area.forward(400)
		area.fillcolor("#DF4B4B")
		area.begin_fill()
		area.forward(200)
		area.left(90)
		for i in range(2):
			area.forward(600)
			area.left(90)
		#WALLS
		area.penup()
		area.goto(-300,100)
		area.pendown()
		area.width(5)
		area.forward(350)
		area.width(3)
		area.left(70)
		area.forward(40)
		area.right(20)
		area.forward(20)
		area.width(3)
		area.left(20)
		area.forward(30)
		area.right(160)
		area.forward(50)
		area.goto(100,100)
		area.left(90)
		area.width(5)
		area.forward(200)
		area.left(180)
		area.forward(200)
		area.end_fill()
		
		area.penup()
		area.goto(-300,100)
		area.width(15)
		area.pendown()
		area.left(90)
		area.forward(3)
		area.fillcolor("#90EE90")
		area.begin_fill()
		area.forward(398)
		area.left(90)
		area.forward(600)
		area.left(90)
		area.forward(398)
		area.end_fill()
		area.width(5)
		area.left(90)
		area.forward(200)
		
		
		area.fillcolor("#90EE90")
		area.begin_fill()
		area.right(30)
		area.forward(20)
		area.width(3)
		area.right(30)
		area.forward(20)
		area.right(30)
		area.forward(20)
		area.left(120)
		area.forward(10)
		area.left(40)
		area.forward(45)
		area.end_fill()
		area.right(150)
		area.penup()

		
		#WATER
		area.goto(100,-100)
		area.fillcolor("#1E90FF")
		area.begin_fill()
		area.left(30)
		area.pendown()
		area.forward(20)
		for i in range(20):
			area.right(5)
			area.forward(5)
		area.right(10)
		area.forward(70)
		for i in range(30):
			area.right(5)
			area.forward(5)
		area.left(120)
		area.forward(10)
		for i in range(15):
			area.right(10)
			area.forward(5)
		area.forward(80)
		for i in range(10):
			area.right(15)
			area.forward(5)
		area.left(120)
		area.forward(10)
		area.goto(100,-100)
		area.end_fill()
		
		#DIRECTIONS
		for i in range(2):
			self.direction.append(Turtle())
			self.direction[i].hideturtle()
			self.direction[i].penup()
			self.direction[i].speed(0)
			self.direction[i].goto(2000,2000)
			if i == 0:
				self.direction[i].left(90)
		
		for i in range(10):
			num = randint(0,1)
			if num == 0:
				self.m.append("right")
			else:
				self.m.append("left")
			self.entity.append(Turtle())
			self.entity[i].hideturtle()
			self.entity[i].penup()
			self.entity[i].shape("circle")
			self.entity[i].color("red")
			self.entity[i].speed(0)
			self.entity[i].goto(randint(-280,280),300)
			self.entity[i].showturtle()
			self.entity[i].goto(self.entity[i].xcor(),randint(-280,50))
		self.target = Turtle()
		self.target.speed(0)
		self.target.hideturtle()
		self.target.shape("../img/target.gif")
		self.target.penup()
		self.target.goto(2000,2000)
		
		listen()
		onkey(self.up, "Up")
		onkey(self.down, "Down")
		onkey(self.left, "Left")
		onkey(self.right, "Right")
		onkey(self.change, "space")
		while True:
			for i in range(10):
				if i != self.position - 1:
					if self.entity[i].heading() != 0.0:
						self.entity[i].setheading(0.0)
					if self.m[i] == "right":
						self.entity[i].forward(2)
						if self.entity[i].xcor() > 260:
							self.m[i] = "left"
					else:
						self.entity[i].backward(2)
						if self.entity[i].xcor() < -260:
							self.m[i] = "right"
	def change(self):
		self.target.hideturtle()
		self.go = "xyz"
		if self.position < 10:
			self.position += 1
		else:
			self.position = 1
		self.target.goto(self.entity[self.position-1].xcor(), self.entity[self.position-1].ycor())
		self.target.showturtle()
	def right(self):
		if self.onGame:
			if self.entity[self.position-1].heading() != 0.0:
				self.entity[self.position-1].setheading(0.0)
			self.entity[self.position-1].forward(5)
			self.target.goto(self.entity[self.position-1].xcor(), self.entity[self.position-1].ycor())
			self.Gamearea("area")
	def left(self):
		if self.onGame:
			if self.entity[self.position-1].heading() != 0.0:
				self.entity[self.position-1].setheading(0.0)
			self.entity[self.position-1].backward(5)
			self.target.goto(self.entity[self.position-1].xcor(), self.entity[self.position-1].ycor())
			self.Gamearea("area")
	def up(self):
		if self.onGame:
			if self.entity[self.position-1].heading() != 90.0:
				self.entity[self.position-1].setheading(90.0)
			self.entity[self.position-1].forward(5)
			self.target.goto(self.entity[self.position-1].xcor(), self.entity[self.position-1].ycor())
			self.Gamearea("area")
	def down(self):
		if self.onGame:
			if self.entity[self.position-1].heading() != 90.0:
				self.entity[self.position-1].setheading(90.0)
			self.entity[self.position-1].backward(5)
			self.target.goto(self.entity[self.position-1].xcor(), self.entity[self.position-1].ycor())
			self.Gamearea("area")
	def Gamearea(self,nx):
		if nx == "area":
			if self.target.xcor() < -260:
				self.target.goto(-260,self.target.ycor())
				self.entity[self.position-1].goto(-260,self.target.ycor())
			if self.target.xcor() > 260:
				self.target.goto(260,self.target.ycor())
				self.entity[self.position-1].goto(260,self.target.ycor())
			if self.target.ycor() < -260:
				self.target.goto(self.target.xcor(),-260)
				self.entity[self.position-1].goto(self.target.xcor(),-260)
			if self.target.ycor() > 70:
				self.target.goto(self.target.xcor(),70)
				self.entity[self.position-1].goto(self.target.xcor(),70)
		#Check hit
		for i in range(10):
			if self.position-1 is not i:
				if self.isHit(self.entity[self.position-1].xcor(), self.entity[self.position-1].ycor(), self.entity[i].xcor(), self.entity[i].ycor()):
					if self.value[self.position-1] == self.value[i]:
						self.value[self.position-1] += 1
						if self.value[self.position-1] == 1:
							self.entity[self.position-1].shape("../img/worm.gif")
						elif self.value[self.position-1] == 2:
							self.entity[self.position-1].shape("../img/bee.gif")
						elif self.value[self.position-1] == 3:
							self.entity[self.position-1].shape("../img/frog.gif")
						elif self.value[self.position-1] == 4:
							self.entity[self.position-1].shape("../img/snake.gif")
						elif self.value[self.position-1] == 5:
							self.entity[self.position-1].shape("../img/duck.gif")
						self.entity[i].hideturtle()
						self.value[i] = 0
						self.entity[i].color("red")
						self.entity[i].shape("circle")
						self.entity[i].speed(2)
						self.entity[i].goto(randint(-280,280),300)
						self.entity[i].showturtle()
						self.entity[i].goto(self.entity[i].xcor(),randint(-280,50))
						
	def isHit(self, xbullet, ybullet, xenemy, yenemy):
		Output = False
		distance = sqrt(pow(xbullet-xenemy,2)+pow(ybullet-yenemy,2))
		if distance < 20:
			Output = True
		return Output

			
Evo()
input()
