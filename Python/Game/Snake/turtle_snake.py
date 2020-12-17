import turtle
import time
import random

wn = turtle.Screen()
wn.title("COpied game")
wn.bgcolor('black')
wn.setup(width=600, height=600)
wn.tracer(0)

head = turtle.Turtle()
head.speed(0)
head.shape('square')
head.color('blue')
head.penup()
head.goto(0,0)
head.direction = "right"

delay = 0.1
segments = []

food = turtle.Turtle()
food.speed(0)
food.shape('circle')
food.color('green')
food.penup()
food.goto(0,100)
temp = 600
last = [0,0]

def ai_bot():
    if head.distance(food) < temp:
        if random.randint(1,2) == 1:
            if head.xcor() > food.xcor() and head.direction != 'right':
                head.direction = 'left'
            elif head.direction != 'left':
                head.direction = 'right'
        else:
            if head.ycor() > food.ycor() and head.direction != 'up':
                head.direction = 'down'
            elif head.direction != 'down':
                head.direction = 'up'
    else:
        if random.randint(1,10) == 3:
            if head.direction == 'right' or head.direction == 'left':
                if random.randint(1,2) == 1:
                    head.direction = 'up'
                else:
                    head.direction = 'down'
            elif head.direction == 'up' or head.direction == 'down':
                if random.randint(1,2) == 1:
                    head.direction = 'right'
                else:
                    head.direction = 'left'

def Up():
    head.direction = "up"

def Down():
    head.direction = "down"

def Left():
    head.direction = "left"

def Right():
    head.direction = "right"

def collision():
    if head.distance(food) < 20:
        return True
    else:
        return False

def move():
    ai_bot()

    if head.direction == 'up':
        y = head.ycor()
        head.sety(y + 20)
        if head.ycor() > 280:
            head.sety(-290)
    if head.direction == 'down':
        y = head.ycor()
        head.sety(y - 20)
        if head.ycor() < -280:
            head.sety(290)
    if head.direction == 'right':
        x = head.xcor()
        head.setx(x + 20)
        if head.xcor() > 280:
            head.setx(-290)
    if head.direction == 'left':
        x = head.xcor()
        head.setx(x - 20)
        if head.xcor() < -280:
            head.setx(290)
    last[0] = head.xcor()
    last[1] = head.ycor()

wn.listen()
wn.onkeypress(Up,"Up")
wn.onkeypress(Down,"Down")
wn.onkeypress(Left,"Left")
wn.onkeypress(Right,"Right")

while True:
    wn.update()
    if collision():
        x = random.randint(-250,250)
        y = random.randint(-250,250)
        food.goto(x,y)
        
        segment = turtle.Turtle()
        segment.speed(0)
        segment.shape('square')
        segment.color('skyblue')
        segment.penup()
        segments.append(segment)    
    
    for index in range(len(segments)-1, 0, -1):
        while True:
            x = segments[index-1].xcor()
            y = segments[index-1].ycor()
            if x % 20 == 0 and y % 20 == 0:
                break
        segments[index].goto(x,y)
    
    if len(segments) > 0:
        x = head.xcor()
        y = head.ycor()
        segments[0].goto(x,y)

    move()
    time.sleep(delay)

wn.mainloop()