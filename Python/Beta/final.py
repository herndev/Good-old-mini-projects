from tkinter import*



root = Tk()
root.geometry("700x500+300+100")
root.title("PLDT PHILCOM, INC")


##########################################
value1=IntVar()
value2=IntVar()
value3=IntVar()
value4=IntVar()
value5=IntVar()
result1=""
result2=""
result3=""
x=0

##########################################
f1 = Frame(root, width = 700, height = 50, bg = "red",bd=5)
f1.place(x=0,y=0)
title=Label(f1,font=('arial',15,'bold'),text="BILLING FORM",bg="red",fg="black")
title.place(x=275,y=0)
mainbody = Frame(root, width = 700, height = 450, bg = "white",bd=5)
mainbody.place(x=0,y=50)

title1=Label(mainbody,font=('arial',15,'bold'),text="Previous Charges",bg="white",fg="black")
title1.place(x=5,y=20)
title1=Label(mainbody,font=('arial',8),text="Balance From Prev. Bill",bg="white",fg="black")
title1.place(x=75,y=50)
title1=Label(mainbody,font=('arial',8),text="Less:Payments Recieved",bg="white",fg="black")
title1.place(x=75,y=70)
title1=Label(mainbody,font=('arial',8,'bold'),text="Remaining Balance from Previous Bill",bg="white",fg="black")
title1.place(x=75,y=90)


title1=Label(mainbody,font=('arial',15,'bold'),text="Current Charges",bg="white",fg="black")
title1.place(x=5,y=130)
title1=Label(mainbody,font=('arial',8),text="Monthly Service Fee/other Basic Charges",bg="white",fg="black")
title1.place(x=75,y=160)
title1=Label(mainbody,font=('arial',8),text="Usage Charges",bg="white",fg="black")
title1.place(x=75,y=180)
title1=Label(mainbody,font=('arial',8),text="Value Added Tax",bg="white",fg="black")
title1.place(x=75,y=200)
title1=Label(mainbody,font=('arial',8,'bold'),text="Total per Charges",bg="white",fg="black")
title1.place(x=75,y=220)

title1=Label(mainbody,font=('arial',15,'bold'),text="DUE DATE:",bg="white",fg="black")
title1.place(x=5,y=260)
title1=Label(mainbody,font=('arial',15,'bold'),text="DUE IMMEDIATELY:",bg="white",fg="black")
title1.place(x=5,y=290)
title1=Label(mainbody,font=('arial',15,'bold'),text="MARCH 32, 2002",bg="white",fg="black")
title1.place(x=5,y=320)
title1=Label(mainbody,font=('arial',15,'bold'),text="AMOUNT DUE:",bg="white",fg="black")
title1.place(x=500,y=260)
title1=Label(mainbody,font=('arial',15,'bold'),text="TOTAL AMOUNT DUE:",bg="white",fg="black")
title1.place(x=5,y=350)

def calc():
    global result1,result2,result3
    result1=value1.get()-value2.get()
    result2=value3.get()+value4.get()+value5.get()
    result3=result1+result2
    main()
def main():
##############################################################
    name=Entry(mainbody,font=('arial',8),fg='black',bg='white',textvariable=value1,justify="center")
    name.place(x=550,y=50,width=100,height=15)
    name=Entry(mainbody,font=('arial',8),fg='black',bg='white',textvariable=value2,justify="center")
    name.place(x=550,y=70,width=100,height=15)
    name=Entry(mainbody,font=('arial',8),fg='black',bg='white',textvariable=value3,justify="center")
    name.place(x=550,y=160,width=100,height=15)
    name=Entry(mainbody,font=('arial',8),fg='black',bg='white',textvariable=value4,justify="center")
    name.place(x=550,y=180,width=100,height=15)
    name=Entry(mainbody,font=('arial',8),fg='black',bg='white',textvariable=value5,justify="center")
    name.place(x=550,y=200,width=100,height=15)
###############################################################
    comparison=Label(mainbody,font=('arial',8),fg='black',bg='white',text=result1)
    comparison.place(x=550,y=90,width=100,height=15)
    comparison=Label(mainbody,font=('arial',8),fg='black',bg='white',text=result2)
    comparison.place(x=550,y=220,width=100,height=15)
    comparison=Label(mainbody,font=('arial',15),fg='black',bg='white',text=result3)
    comparison.place(x=550,y=350,width=100,height=15)
#############################################################
    comparison=Label(mainbody,font=('arial',15,'bold'),fg='black',bg='white',text=result1)
    comparison.place(x=550,y=290,width=100,height=15)
    comparison=Label(mainbody,font=('arial',15,'bold'),fg='black',bg='white',text=result2)
    comparison.place(x=550,y=320,width=100,height=15)
    comparison=Label(mainbody,font=('arial',15,'bold'),fg='black',bg='white',text=result3)
    comparison.place(x=550,y=350,width=100,height=15)
############################################################
new_next=Button(mainbody, fg="white", font=('calibri',12,'bold'),text="Confirm", bg="dark blue", command=calc)
new_next.place(x=300,y=400,width=100,height=40)
main()
root.mainloop()
