#SpaceImpactVSyntaxer
#By: Hernie Jabien
#Copyright @ Syntaxer 2019 all rights reserved.

from turtle import*
from random import*
from math import*

class SpaceImpact():
	def __init__(self):
		screen = Screen()
		screen.tracer(5)
		screen.bgcolor("skyblue")
		screen.register_shape("../img/ship.gif")
		screen.register_shape("../img/enemy.gif")
		self.sideward = False
		
		#Variables
		self.onGame = True
		self.skill1_fire = False
		self.skill2_fire = False
		self.skill3_fire = False
		self.num_enemies = 5
		self.enemies = []
		self.kills = 0
		self.speed = "Easy"
		self.energy = 100
		self.health = 5
		
		#Setarea
		area = Turtle()
		area.penup()
		area.hideturtle()
		area.goto(-300, -100)
		area.pendown()
		area.width(5)
		fillcolor('black')
		area.begin_fill()
		for i in range(4):
			if i % 2:
				area.forward(400)
			else:
				area.forward(600)
			area.left(90)
		area.end_fill()
		area.penup()
		area.goto(-15,315)
		area.write("Space Impact", False, align="center", font=("Arial", 15, "bold"))
		area.goto(-15,302)
		area.write("Developed By: Hernie Jabien", False, align="center", font=("Arial", 10, "italic"))
		area.goto(-290,-135)
		area.write("Ship Status", False, align="Left", font=("Arial", 20, "bold"))
		
		#Status
		self.stats = Turtle()
		self.stats.penup()
		self.stats.hideturtle()
		self.stats.goto(-290,-150)
		self.stats.write("Health: %d"%self.health, False, align="Left", font=("Arial", 10, "bold"))
		self.stats.goto(-290,-165)
		self.stats.write("Speed: %s"%self.speed, False, align="Left", font=("Arial", 10, "bold"))
		self.stats.goto(-290,-180)
		self.stats.write("Kills: %d"%self.kills, False, align="Left", font=("Arial", 10, "bold"))
		self.stats.goto(-290,-195)
		self.stats.write("Energy: %d"%self.energy, False, align="Left", font=("Arial", 10, "bold"))
		
		#Entity
		self.player = Turtle()
		self.player.shape("../img/ship.gif")
		self.player.penup()
		self.player.goto(-260, 100)
		
		#Enemies
		for i in range(self.num_enemies):
			self.enemies.append(Turtle())
			self.enemies[i].color("Yellow")
			self.enemies[i].shape("../img/enemy.gif")
			self.enemies[i].left(180)
			self.enemies[i].penup()
			self.enemies[i].goto(randint(200, 290), randint(-80, 280))
		
		#Bullets
		self.skill11 = Turtle()
		self.skill11.penup()
		self.skill11.hideturtle()
		self.skill11.shape("circle")
		self.skill11.color("blue")
		self.skill22 = Turtle()
		self.skill22.penup()
		self.skill22.hideturtle()
		self.skill22.shapesize(0.7, 0.7)
		self.skill22.color("Yellow")
		self.skill33 = Turtle()
		self.skill33.penup()
		self.skill33.hideturtle()
		self.skill33.color("Red")
		
		#Onclick
		listen()
		onkey(self.Forward,"Right")
		onkey(self.Backward,"Left")
		onkey(self.Up,"Up")
		onkey(self.Down,"Down")
		onkey(self.Playagain,"space")
		
		#Powerups
		onkey(self.skill1,"q")
		onkey(self.skill2,"w")
		onkey(self.skill3,"e")
		
		while True:
			if self.skill1_fire and self.skill11.xcor() < 290:
				self.skill11.forward(2)
			else:
				self.skill1_fire = False
				self.skill11.hideturtle()
			if self.skill2_fire and self.skill22.xcor() < 290:
				self.skill22.forward(5)
			else:
				self.skill2_fire = False
				self.skill22.hideturtle()
			if self.skill3_fire and self.skill33.xcor() < 290:
				self.skill33.forward(10)
			else:
				self.skill3_fire = False
				self.skill33.penup()
				self.skill33.clear()
				
			for i in range(self.num_enemies):
				if self.speed == "Easy":
					self.enemies[i].forward(((i+1)%6)*0.1)
				elif self.speed == "Normal":
					self.enemies[i].forward((((i+1)%6)*0.1)+0.4)
				elif self.speed == "Difficult":
					self.enemies[i].forward((((i+1)%6)*0.1)+0.8)
				elif self.speed == "Impossible":
					self.enemies[i].forward((((i+1)%6)*0.1)+1.6)
				else:
					self.enemies[i].forward((((i+1)%6)*0.1)+3.2)
					
				#On Enemy Hit by a skill 1 bullet
				if self.skill1_fire:
					if self.isEnemyHit(self.skill11.xcor(),self.skill11.ycor(),self.enemies[i].xcor(),self.enemies[i].ycor()):
						self.enemies[i].goto(randint(200, 290), randint(-80, 280))
						self.skill1_fire = False
						self.skill11.hideturtle()
						self.kills += 1
						self.energy += 5
				#On Enemy Hit by a skill 2 bullet
				if self.skill2_fire:
					if self.isEnemyHit(self.skill22.xcor(),self.skill22.ycor(),self.enemies[i].xcor(),self.enemies[i].ycor()):
						self.enemies[i].goto(randint(200, 290), randint(-80, 280))
						self.skill2_fire = False
						self.skill22.hideturtle()
						self.kills += 1
						self.energy += 5
				#On Enemy Hit by a skill 3 bullet
				if self.skill3_fire:
					if self.isEnemyHit(self.skill33.xcor(),self.skill33.ycor(),self.enemies[i].xcor(),self.enemies[i].ycor()):
						self.enemies[i].goto(randint(200, 290), randint(-80, 280))
						self.kills += 1
						self.energy += 5
				#On Enemy Hit the player
				if self.isEnemyHit(self.player.xcor(),self.player.ycor(),self.enemies[i].xcor(),self.enemies[i].ycor()) and self.onGame:
					self.enemies[i].goto(randint(200, 290), randint(-80, 280))
					self.player.clear()
					self.health -= 1
				#On Enemy Hit the border line
				if self.enemies[i].xcor() < -280:
					self.enemies[i].goto(randint(200, 290), randint(-80, 280))
		
		
	
	#Move Player
	def Forward(self):
		if self.sideward and self.onGame:
			self.player.setheading(360)
			self.sideward = False
		self.player.forward(5)
		self.Gamearea("area")
	def Backward(self):
		if self.sideward and self.onGame:
			self.player.setheading(360)
			self.sideward = False
		self.player.backward(5)
		self.Gamearea("area")
	def Up(self):
		if not self.sideward and self.onGame:
			self.player.setheading(90)
			self.sideward = True
		self.player.forward(5)
		self.Gamearea("area")
	def Down(self):
		if not self.sideward and self.onGame:
			self.player.setheading(90)
			self.sideward = True
		self.player.backward(5)
		self.Gamearea("area")
	
	
	#Powerups
	def skill1(self):
		if not self.skill1_fire and self.onGame:
			data = self.Gamearea("player")
			self.skill11.goto(data[0]+50, data[1])
			self.skill11.showturtle()
			self.skill1_fire = True
	def skill2(self):
		if not self.skill2_fire and self.onGame and self.energy >= 10:
			data = self.Gamearea("player")
			self.skill22.goto(data[0]+50, data[1])
			self.skill22.showturtle()
			self.skill2_fire = True
			self.energy -= 10
	def skill3(self):
		if not self.skill3_fire and self.onGame and self.energy >= 30:
			data = self.Gamearea("player")
			self.skill33.goto(data[0]+50, data[1])
			self.skill33.pendown()
			self.skill3_fire = True
			self.energy -= 30
	
	#OnBulletHit
	def isEnemyHit(self, xbullet, ybullet, xenemy, yenemy):
		Output = False
		distance = sqrt(pow(xbullet-xenemy,2)+pow(ybullet-yenemy,2))
		if distance < 30:
			Output = True
		return Output
	
	#Gamearea Checker
	def Gamearea(self, action):
		if action == "area":
			#Trap Entities
			if not self.sideward:
				if self.player.xcor() > 260:
					self.player.backward(5)
				if self.player.xcor() < -260:
					self.player.forward(5)
				if self.player.ycor() > 275:
					self.player.setheading(90)
					self.sideward = True
					self.player.backward(1)
				if self.player.ycor() < -75:
					self.player.setheading(90)
					self.sideward = True
					self.player.forward(1)
			else:
				if self.player.ycor() > 275:
					self.player.backward(5)
				if self.player.ycor() < -75:
					self.player.forward(5)
				if self.player.xcor() > 260:
					self.player.setheading(360)
					self.sideward = False
					self.player.backward(1)
				if self.player.xcor() < -260:
					self.player.setheading(360)
					self.sideward = False
					self.player.forward(1)
		else:
			#Get player location
			x = self.player.xcor()
			y = self.player.ycor()
			data = [x, y]
			return data
		
		#Display stats
		self.setArea()
	
	#Create Area
	def setArea(self):
		self.stats.clear()
		self.stats.goto(-290,-150)
		self.stats.write("Health: %d"%self.health, False, align="Left", font=("Arial", 10, "bold"))
		self.stats.goto(-290,-165)
		self.stats.write("Speed: %s"%self.speed, False, align="Left", font=("Arial", 10, "bold"))
		self.stats.goto(-290,-180)
		self.stats.write("Kills: %d"%self.kills, False, align="Left", font=("Arial", 10, "bold"))
		self.stats.goto(-290,-195)
		self.stats.write("Energy: %d"%self.energy, False, align="Left", font=("Arial", 10, "bold"))
		if self.health < 1:
			self.onGame = False
			self.stats.goto(-290,-150)
			self.stats.write("Health: 0", False, align="Left", font=("Arial", 10, "bold"))
			self.player.hideturtle()
			self.stats.goto(0,-255)
			self.stats.write("Game Over", False, align="Center", font=("Arial", 20, "bold"))
			self.stats.goto(0,-270)
			self.stats.write("Press spacebar to play again !!", False, align="Center", font=("Arial", 10, "bold"))
		if self.kills >= 20 and self.kills < 40:
			self.speed = "Normal"
		elif self.kills >= 40 and self.kills < 80:
			self.speed = "Difficult"
		elif self.kills >= 80 and self.kills < 120:
			self.speed = "Impossible"
		elif self.kills >= 120:
			self.speed = "God Mode"
		if self.energy > 99:
			self.energy = 100
	
	def Playagain(self):
		if not self.onGame:
			self.onGame = True
			self.player.goto(-260, 100)
			self.player.showturtle()
			self.stats.undo()
			self.stats.undo()
			self.kills = 0
			self.speed = "Easy"
			self.energy = 100
			self.health = 5
			self.setArea()

SpaceImpact()
