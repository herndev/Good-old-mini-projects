from tkinter import*
from random import*
class eightball:
	def __init__(self):
		self.Master = Tk()
		self.Master.geometry("400x400")
		self.Master.resizable(0,0)
		self.Master.configure(background="#ffffff")
		a = Frame(self.Master, background="#ffffff")
		a.pack(fill=BOTH, expand=1)
		canvas = Canvas(a)
		canvas.create_oval(50,50,350, 350, outline="white", fill="black", width=2)
		canvas.create_polygon([80, 280, 200, 60, 320, 280], outline="black", fill="white")
		canvas.pack(fill=BOTH, expand=1)
		canvas.configure(background="#ffffff")
		
		bnnr = Label(self.Master, text="Eight Ball", font=("Arial 30 bold"), bg="#ffffff", fg="#000000")
		bnnr.place(x=110, y=0)
		
		self.dsp = Label(self.Master, text="8", font=("Arial 90 bold"), bg="#ffffff", fg="#000000")
		self.dsp.place(x=165, y=130)
		
		self.outp = Label(self.Master, text="8", font=("Arial 30 bold"), bg="#ffffff", fg="#000000")
		self.outp.place(x=2000, y=2000)
		
		self.qst = Entry(self.Master, width=29, font=("Arial 15 bold"))
		self.qst.place(x=5, y=365)
		
		btn = Button(self.Master, text=" ASK ", fg="#ffffff", bg="#000000", font=("Arial 10 bold"), command=lambda:self.onClick("none"))
		btn.place(x=333, y=365)
		btn.bind("<Return>",self.onClick)
		
		self.Master.mainloop()
	def onClick(self, none):
		num = randint(1,10)
		if self.qst.get() != "" and "?" in self.qst.get():
			if num % 2 == 0:
				self.outp.configure(text="Yes")
			else:
				self.outp.configure(text="No")
			self.dsp.place_configure(x=2000, y=2000)
			self.outp.place_configure(x=165, y=170)
eightball()
