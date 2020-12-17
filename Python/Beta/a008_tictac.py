#Tictac Toe
#By: Hernie Jabien
#Copyright @ Syntaxer 2019 all rights reserved.

from tkinter import*
class Tictac(Tk):
    def __init__(self, *args, **kwargs):
        Tk.__init__(self, *args, **kwargs)
        container = Frame(self)
        container.pack(side="top", fill="both", expand = True)
        container.grid_rowconfigure(0, weight=1)
        container.grid_columnconfigure(0, weight=1)
        self.frames = {}
        for F in (First, Second):
            frame = F(container, self)
            self.frames[F] = frame
            frame.grid(row=0, column=0, sticky="nsew")
        self.show_frame(First)
    def show_frame(self, cont):
        frame = self.frames[cont]
        frame.tkraise()

class First(Frame):
    def __init__(self, parent, controller):
        Frame.__init__(self,parent)
        

class Second(Frame):

    def __init__(self, parent, controller):
        Frame.__init__(self, parent)


app = Tictac()
app.geometry("1440x870")
app.mainloop()
