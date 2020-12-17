import turtle
from tkinter import *
import os

def main():
        def game(event):
                f = open("file1.txt","rt")
                f.read()
                wn = turtle.Screen()
                wn.title("Pong Game")
                wn.bgcolor("#4db8ff")
                wn.setup(width=800, height=600)
                wn.tracer(0)
                
                # Score
                score_a = 0
                score_b = 0

                # Paddle A
                paddle_a = turtle.Turtle()
                paddle_a.speed(0)
                paddle_a.shape("square")
                paddle_a.color("white")
                paddle_a.shapesize(stretch_wid=5, stretch_len=1)
                paddle_a.penup()
                paddle_a.goto(-350, 0)

                # Paddle B
                paddle_b = turtle.Turtle()
                paddle_b.speed(0)
                paddle_b.shape("square")
                paddle_b.color("white")
                paddle_b.shapesize(stretch_wid=5, stretch_len=1)
                paddle_b.penup()
                paddle_b.goto(350, 0)

                # Ball
                ball = turtle.Turtle()
                ball.speed(0)
                ball.shape("circle")
                ball.color("red")
                ball.penup()
                ball.goto(0, 0)
                ball.dx = 0.5
                ball.dy = -0.5

                # Pen
                pen = turtle.Turtle()
                pen.speed(0)
                pen.color("white")
                pen.penup()
                pen.hideturtle()
                pen.goto(0, 260)
                pen.write("{} : 0  {} : 0".format(str(txt1.get()),str(txt2.get())), align="center", font=("Courier", 24, "normal"))

                # Function
                def paddle_a_up():
                        y = paddle_a.ycor()
                        y += 20
                        paddle_a.sety(y)

                def paddle_a_down():
                        y = paddle_a.ycor()
                        y -= 20
                        paddle_a.sety(y)

                def paddle_b_up():
                        y = paddle_b.ycor()
                        y += 20
                        paddle_b.sety(y)

                def paddle_b_down():
                        y = paddle_b.ycor()
                        y -= 20
                        paddle_b.sety(y)

                

                # Keyboard binding
                wn.listen()
                wn.onkeypress(paddle_a_up, "w")
                wn.onkeypress(paddle_a_down, "s")
                wn.onkeypress(paddle_b_up, "Up")
                wn.onkeypress(paddle_b_down, "Down")

                # Main game loop
                while True:
                    wn.update()

            

                        # Move the ball
                    ball.setx(ball.xcor() + ball.dx)
                    ball.sety(ball.ycor() + ball.dy)


                
                
                        # Border checking
                    if ball.ycor() > 290:
                        ball.sety(290)
                        ball.dy *= -1

                    if ball.ycor() < -290:
                        ball.sety(-290)
                        ball.dy *= -1

                    if ball.xcor() > 390:
                        ball.goto(0, 0)
                        ball.dx *= -1
                        score_a += 1
                        pen.clear()
                        pen.write("{} : {}  {} : {}".format(str(txt1.get()),score_a,str(txt2.get()), score_b), align="center", font=("Courier", 24, "normal"))

                    if ball.xcor() < -390:
                        ball.goto(0, 0)
                        ball.dx *= -1
                        score_b += 1
                        pen.clear()
                        pen.write("{} : {}  {} : {}".format(str(txt1.get()),score_a,str(txt2.get()), score_b), align="center", font=("Courier", 24, "normal"))

                    if ball.ycor()>300 or ball.ycor()<-300:
                        print("Game Over")
                        turtle.done()
                        

                   
                    if paddle_a.ycor()>=250:
                        paddle_a.sety(250)

                    if paddle_a.ycor()<=-250:
                        paddle_a.sety(-250)

                    if paddle_b.ycor()>=250:
                        paddle_b.sety(250)

                    if paddle_b.ycor()<=-250:
                        paddle_b.sety(-250)


                    # Paddle and ball collisions
                    if (ball.xcor() > 340 and ball.xcor() < 350) and (ball.ycor() < paddle_b.ycor() + 40 and ball.ycor() > paddle_b.ycor() -40):
                        ball.setx(340)
                        ball.dx *= -1

                    if (ball.xcor() < -340 and ball.xcor() > -350) and (ball.ycor() < paddle_a.ycor() + 40 and ball.ycor() > paddle_a.ycor() -40):
                        ball.setx(-340)
                        ball.dx *= -1

                    #Game Over
                    if score_a == 1:
                        pen.setposition(0,0)    
                        pen.write("Game Over", align="center", font="Courier 60 bold")
                        Replay()
                    if score_b == 1:
                        pen.setposition(0,0)
                        pen.write("Game Over", align="center", font="Courier 60 bold")
                        Replay()
                        

                    
        wn = Tk()
        wn.title("Pong Game")
        wn.geometry("300x300")
        wn.config(bg="black")
        wn.resizable("0","0")

        frm1 = Frame(wn, bg="black")
        frm2 = Frame(wn, bg="black")
        frm1.pack()
        frm2.pack()


                
        lbl1 = Label(frm1, text = 'Player 1:', font ="Courier 15 bold", bg="black", fg="white", relief ="flat")
        lbl1.grid(row= 0, column =0, pady ='20')
        lbl2 = Label(frm1, text = "Player 2:", font ="Courier 15 bold", bg="black", fg="white", relief ="flat")
        lbl2.grid(row= 1, column =0)
        txt1 = Entry(frm1, text="Enter Player 1:")
        txt1.grid(row= 0, column =1)
        txt2 = Entry(frm1, text ="Enter Player 2:")
        txt2.grid(row= 1, column =1)
        btn = Button(frm2, text ="START", font ="Courier 15 bold", bg="black", fg="white", relief ="flat")
        btn.pack(pady="20")
        btn.bind("<Button-1>",game)
            
        if os.path.exists("file1.txt"):
                f = open("file1.txt","at")
                f.write(txt1.get())
                f.write(txt2.get())

                f= open("file1.txt","rt")
                print(f.read())

        else:
                f = open("file1.txt","xt")
                print("Saved")

def Replay():
        wn = Tk()
        wn.title("Pong Game")
        wn.geometry("300x300")
        wn.config(bg="black")
        wn.resizable("0","0")
        #frm1 = Frame(wn)
        #frm2 = Frame(wn)
        #frm1.pack()
        #frm2.pack()
        lbl = Label(wn,text ="Do you want to play again?", font ="Courier 10 bold", bg="black", fg="white")
        lbl.pack()
        btn1 = Button(wn, text ="YES",font ="Courier 20 bold", bg="black", fg="white")
        btn1.pack()
        btn1.bind("<Button-1>", main)
        btn2 = Button(wn, text ="NO",font ="Courier 20 bold", bg="black", fg="white")
        btn2.pack()
        btn2.bind("<Button-1>", Replay)

        
        wn.mainloop()
Replay()
