#ShootOut
#By: Hernie Jabien
#Copyright @ Syntaxer 2019 all rights reserved.
from turtle import*
from random import*
from math import*

class Shootout:
    def __init__(self):
        screen = Screen()
        screen.register_shape("../img/mini_scope.gif")
        screen.tracer(2)
	#Variables
        self.btnpress = False
        self.enemy = 5
        self.enemies = []
        self.sideward = True
        self.direction = []
        self.onGame = True
		
	#Create area
        area = Turtle()
        area.hideturtle()
        area.penup()
        area.speed(5)
        area.width(15)
        area.goto(-300,-300)
        area.pendown()
        area.fillcolor("#008000")
        area.begin_fill()
        for i in range(4):
            area.forward(600)
            area.left(90)
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
	
        #SCOPE
        self.scope = Turtle()
        self.scope.shape("../img/mini_scope.gif")
        self.scope.penup()
	#Enemies
        for i in range(self.enemy):
            self.enemies.append(Turtle())
            self.enemies[i].speed(2)
            self.enemies[i].color("Yellow")
            self.enemies[i].shape("circle")
            self.enemies[i].left(randint(0, 359))
            self.enemies[i].penup()
            self.enemies[i].hideturtle()
            self.enemies[i].goto(randint(-260, 260), randint(-260, 260))
            self.enemies[i].showturtle()
	#KEYS
        listen()
        onkey(self.up, "Up")
        onkey(self.down, "Down")
        onkey(self.left, "Left")
        onkey(self.right, "Right")
        onkey(self.shoot, "s")
        onkey(self.reload, "r")
	
        while True:
            for i in range(self.enemy):
                self.enemies[i].forward(1)
                if self.enemies[i].xcor() < -280 or self.enemies[i].xcor() > 280 or self.enemies[i].ycor() < -280 or self.enemies[i].ycor() > 280:
                    self.enemies[i].left(280)
                if self.isEnemyHit(self.scope.xcor(),self.scope.ycor(),self.enemies[i].xcor(),self.enemies[i].ycor()) and self.btnpress:
                    self.enemies[i].left(randint(0, 359))
                    self.enemies[i].hideturtle()
                    self.enemies[i].goto(randint(-260, 260), randint(-260, 260))
                    self.enemies[i].showturtle()
            self.btnpress = False
	
    def right(self):
        if self.onGame:
            self.scope.setheading(self.direction[1].heading())
            self.scope.forward(5)
        self.Gamearea("area")
    def left(self):
        if self.onGame:
            self.scope.setheading(self.direction[1].heading())
            self.scope.backward(5)
        self.Gamearea("area")
    def up(self):
        if self.onGame:
            self.scope.setheading(self.direction[0].heading())
            self.scope.forward(5)
        self.Gamearea("area")
    def down(self):
        if self.onGame:
            self.scope.setheading(self.direction[0].heading())
            self.scope.backward(5)
        self.Gamearea("area")
    def Gamearea(self,nx):
        if nx == "area":
            if self.scope.heading() == self.direction[1].heading():
                if self.scope.xcor() < -240:
                    self.scope.goto(-240,self.scope.ycor())
                if self.scope.xcor() > 240:
                    self.scope.goto(240,self.scope.ycor())
            else:
                if self.scope.ycor() < -240:
                    self.scope.goto(self.scope.xcor(),-240)
                if self.scope.ycor() > 240:
                    self.scope.goto(self.scope.xcor(),240)
    def shoot(self):
        if self.onGame:
            self.btnpress = True
    def reload(self):
        if self.onGame:
            print("RELOADED!!")
    def isEnemyHit(self, xbullet, ybullet, xenemy, yenemy):
        Output = False
        distance = sqrt(pow(xbullet-xenemy,2)+pow(ybullet-yenemy,2))
        if distance < 20:
            Output = True
        return Output
Shootout()
input()
