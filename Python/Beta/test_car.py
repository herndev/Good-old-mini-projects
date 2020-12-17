import turtle

state = True

wn = turtle.Screen()
wn.title("CarPark")
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
m.shape("square")
m.color("red")
m.penup()
m.setposition(0, -250)
m.setheading(90)

#moveFunc
def m_left():
	m.setheading(m.heading()+5)
def m_right():
	m.setheading(m.heading()-5)
def m_forward():
    m.forward(5)

#keyboard
turtle.listen()
turtle.onkey(m_left, "Left")
turtle.onkey(m_right, "Right")
turtle.onkey(m_forward, "Up")

delay = input("Press Enter to stop")