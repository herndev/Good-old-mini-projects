#BounceMe
#By: Hernie Jabien
#Copyright @ Syntaxer 2019 all rights reserved.
from turtle import*
from random import*
from math import*
from tkinter import messagebox

class Billiard():
	def __init__(self):
		screen = Screen()
        
		#Variables
		a = []
		
		#Create area
		border = Turtle()
		border.hideturtle()
		border.penup()
		border.speed(5)
		border.width(15)
		border.goto(-175,-225)
		border.pendown()
		border.fillcolor("#C17E02")
		border.begin_fill()
		
		area = Turtle()
		area.hideturtle()
		area.penup()
		area.speed(5)
		area.width(15)
		area.goto(-150,-200)
		area.pendown()
		area.fillcolor("#005D00")
		area.begin_fill()
		
		for i in range(4):
			if i % 2:
				area.forward(450)
				border.forward(500)
			else:
				area.forward(300)
				border.forward(350)	
			area.left(90)
			border.left(90)
		for i in range(6):
			a.append(Turtle())
			a[i].shape("circle")
			a[i].shapesize(1.5)
			a[i].penup()
			a[i].hideturtle()
		border.end_fill()
		area.end_fill()
		a[0].goto(-150,-200)
		a[1].goto(150,-200)
		a[2].goto(150,25)
		a[3].goto(150,250)
		a[4].goto(-150,250)
		a[5].goto(-150,25)
		for i in range(6):
			a[i].showturtle()
		
		
		
Billiard()
input()
