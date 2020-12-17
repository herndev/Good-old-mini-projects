import turtle

state = True

wn = turtle.Screen()
wn.bgcolor("black")

#DrawBoard
p = turtle.Turtle()
p.speed(0)
p.color("white")
p.penup()
p.setposition(-300,-300)
p.pendown()
p.pensize(3)
for side in range(4):
	p.fd(600)
	p.lt(90)
p.hideturtle()


#Me
m = turtle.Turtle()
m.speed = 5
m.color("red")
m.penup()
m.setposition(0, -250)
m.setheading(90)

#moveFunc
def m_left():
	x = m.xcor()
	x -= 5
	m.setx(x)
def m_right():
	x = m.xcor()
	x += 5
	m.setx(x)

#keyboard
turtle.listen()
turtle.onkey(m_left, "Left")
turtle.onkey(m_right, "Right")

delay = input("Press Enter to stop")