#TABBED LAYOUT
#By: Hernie Jabien
#Copyright @ Syntaxer 2019 all rights reserved.
from hern import*
from tkinter import*
from tkinter import messagebox
from tkinter.ttk import Combobox

usr = ["Tisoy", "Pogie", "Gwapo", "Beauty", "Tisay"]
usr.sort()

class MainView(Frame):
	def __init__(self, *arg, **args):
		Frame.__init__(self, *arg, **args)

		label = Label(self, text="")
		label.pack(side="top", fill="both", expand=True)
		self.userr = StringVar()
		self.userrr = StringVar()
		self.code = ""

		user = Combobox(self, width=18, font="Arial 20", values= usr, textvariable=self.userr)
		user.set("Select user")
		user.place(x=280, y=105)
		self.money = Entry(self, relief="ridge", bd=3, width=20, font="Arial 19")
		self.money.place(x=280, y=145)
		btn = Button(self, text="Deposit money", font="Arial 18", width=20, bd=3, relief="raised", background="orange", command=lambda:self.adder(self.money.get()))
		btn.place(x=280, y=190)
		btn1 = Button(self, text="Withdraw money", font="Arial 18", width=20, bd=3, relief="raised", background="orange", command=lambda:self.withdrawer(self.money.get()))
		btn1.place(x=280, y=240)

		self.lstView1 = Listbox(self, width=36, height=17, background="white", fg="#000")
		self.lstView1.place(x=280, y=300)

		user1 = Combobox(self, width=15, font="Arial 20", values= usr, textvariable=self.userrr)
		user1.set("Select user")
		user1.place(x=810, y=105)
		btn2 = Button(self, text="Search", font="Arial 17", width=6, background="orange", fg="white", bd=3, relief="raised", command=lambda:self.display(""))
		btn2.place(x=1060, y=105)

		self.lstView = Listbox(self, width=44, height=25, background="white", fg="#000")
		self.lstView.place(x=810, y=155)

	def adder(self,money):
		# self.userr.get()
		if self.userr.get() == "Select user":
			self.lstView1.insert(0,"Error$ Please select valid username.")
		else:
			if money != "":
				messagebox.showinfo("Bank", "Money added successfully.")
				insertdata("bank",{"name":self.userr.get(),"money":money})
				self.lstView1.insert(0,"Info$ Verified successfully.")
				self.lstView1.insert(0,"Info$ P%s added to %s."%(money,self.userr.get()))
				self.userr.set("Select user")
				self.money.delete(0,END)
			else:
				self.lstView1.insert(0,"Info$ Money must not be empty.")

	def withdrawer(self,money):
		if self.userr.get() == "Select user":
			self.lstView1.insert(0,"Error$ Please select valid username.")
		else:
			if money != "":
				rem = (int(money)*0.10)
				if rem <= 1:
					rem = 1
				money = int(money) + rem
				money = str(money)
				messagebox.showinfo("Bank", "Money withdrawn successfully.")
				insertdata("bank",{"name":self.userr.get(),"money":"-"+money})
				self.lstView1.insert(0,"Info$ Verified successfully.")
				self.lstView1.insert(0,"Info$ P%s withdrawn to %s."%(money,self.userr.get()))
				self.userr.set("Select user")
				self.money.delete(0,END)
			else:
				self.lstView1.insert(0,"Info$ Money must not be empty.")

	def display(self,arr):
		if self.userrr.get() != "Select user":
			if selectdata("bank", {"name":self.userrr.get()}) is not False:
				sum = 0
				self.lstView.delete(0,END)
				for m in selectdata("bank", {"name":self.userrr.get()}):
					self.lstView.insert(END, "%s"%str(m["money"]))
					sum = sum + float(m["money"])
				self.lstView.insert(0, "Total money: %2d"%sum)

if __name__ == "__main__":
    root = Tk()
    main = MainView(root)
    main.pack(side="top", fill="both", expand=True)
    root.wm_geometry("1440x900")
    root.resizable(0,0)
    root.mainloop()